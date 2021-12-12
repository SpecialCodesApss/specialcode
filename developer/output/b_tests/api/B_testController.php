<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\B_test;

use Validator;
use File;

class B_testController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id=$request->user()->id;
        $searchText=$request->searchText;
        $b_tests = B_test::where(['user_id' => $user_id ])-> 
        where(function($q) use ($searchText){
            $q->orWhere("users_ids","like","%".$searchText."%")->orWhere("pages_id","like","%".$searchText."%")->orWhere("table_ids","like","%".$searchText."%")->orWhere("page_html","like","%".$searchText."%")->orWhere("test_2","like","%".$searchText."%")->orWhere("email","like","%".$searchText."%")->orWhere("image","like","%".$searchText."%")->orWhere("type","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("b_tests.B_test_read"),$b_tests->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
       $user_id=$request->user()->id;
             $input['user_id']=$user_id;
            

        $validator=
            Validator::make($input, [
            'users_ids'=>'required',
                'pages_id'=>'required',
                'table_ids'=>'required',
                'page_html'=>'required',
                'test_2'=>'required',
                'email'=>'required',
                'image'=>'required',
                'type'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/b_tests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                }
                

        $B_test = B_test::create($input);

        
        

        return $this->sendResponse(trans("b_tests.B_test_create"),$B_test->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         $user_id=$request->user()->id;
            
        $B_test = B_test::where('id', $id)->where(['user_id' => $user_id ])->first();
        
        if(isset($B_test)){
        
        
        }

        if (is_null($B_test)) {
            return $this->sendError('B_test not found.');
        }

        return $this->sendResponse(trans("b_tests.B_test_read"),$B_test->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$B_test_id)
    {
        $input = $request->except('images','files','_method');
        $user_id=$request->user()->id;
             $input['user_id']=$user_id;
            

         $validator=
            Validator::make($input, [
            'users_ids'=>'required',
                'pages_id'=>'required',
                'table_ids'=>'required',
                'page_html'=>'required',
                'test_2'=>'required',
                'email'=>'required',
                'type'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                $old_image=B_test::find($B_test_id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/b_tests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                }
                

        $B_test=B_test::where(['id'=>$B_test_id ])->where(['user_id' => $user_id ])->update($input);

        
        

        $B_test = B_test::where(['id'=>$B_test_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("b_tests.B_test_update"),$B_test->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$B_test_id)
    {
        //delete files
         // delete files and images
        
                $old_image=B_test::find($B_test_id)->image;
                 File::delete($old_image);
                
        $user_id=$request->user()->id;
            
         // delete files and images in sub tables if this module has mutiple files or images
        
        B_test::where(['id'=>$B_test_id ])->where(['user_id' => $user_id ])->delete();



        return $this->sendResponse(trans("b_tests.B_test_delete"));

    }

     //additional Functions
            
            

}
