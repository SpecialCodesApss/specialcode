<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test;

use Spatie\Permission\Models\Role;
use DB;
use Auth;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;



class TestController extends Controller
{

    use file_type_traits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id=Auth::user()->id;
        $searchText=$request->searchText;
        $tests = Test::where(['user_id' => $user_id ])->paginate(20);
        return view("frontend.tests.index",compact('tests'));
    }


    /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Test::all()->count()+1;

            
                return view('frontend.tests.create',compact('sort_number'));
            }

            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {

                $lang = App::getLocale();
                
            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'number'=>'required',
                    'image'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                
                $input["name_ar"]=$request->name_ar;
                $input["name_en"]=$request->name_en;
                $input["number"]=$request->number;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;
                $input["save_type"]=$request->save_type;


                 $user_id=Auth::user()->id;
             $input['user_id']=$user_id;
            

                

                

                
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/tests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                    }
                }
                


                $Test = Test::create($input);

                //store images if found
                //store files if found


                if($input['save_type']=="save_and_add_new"){
                    return redirect('tests/create')
                        ->with('success',trans('admin_messages.info_added'));
                }
                else{
                    return redirect('tests')
                        ->with('success',trans('admin_messages.info_added'));
                }

            }


            /**
             * Display the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
            $lang = App::getLocale();

            $user_id=Auth::user()->id;
            

               $Test = Test::where('id', $id)->where(['user_id' => $user_id ])->first();

        if(isset($Test)){
        
        
        }

        if (is_null($Test)) {
            return $this->sendError('Test not found.');
        }

                
                 


                return view('frontend.tests.show',compact('Test'   ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {

            $lang = App::getLocale();
                $Test = Test::find($id);
                
                

                
                

                


                return view('frontend.tests.edit',compact('Test'
                 ));
            }


            /**
             * Update the specified resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function update(Request $request, $id)
            {

            
                $input["name_ar"]=$request->name_ar;
                $input["name_en"]=$request->name_en;
                $input["number"]=$request->number;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;
            $user_id=Auth::user()->id;
             $input['user_id']=$user_id;
            


              
            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'number'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

 
                $old_image=Test::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/tests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }
                

                

                

                
                $old_image=Test::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/tests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }
                

                 $Test=Test::where(['id'=>$id ])->where(['user_id' => $user_id ])->update($input);

        //store images if found
        //store files if found

        $Test = Test::where(['id'=>$id , 'user_id' => $user_id ])->get();

                return redirect('tests')
                    ->with('success',trans('admin_messages.info_edited'));
            }

            /**
             * Remove the specified resource from storage.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {

        //delete files
         // delete files and images
        
                $old_image=Test::find($id)->image;
                 File::delete($old_image);
                
        $user_id=Auth::user()->id;
            
         // delete files and images in sub tables if this module has mutiple files or images
        

        Test::where(['id'=>$Test_id ])->where(['user_id' => $user_id ])->delete();

                return redirect('tests')
                    ->with('success',trans('admin_messages.info_deleted'));
            }

            //additional Functions
            
            


            
}
