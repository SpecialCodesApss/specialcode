<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Our_service;

use Validator;
use File;

class Our_serviceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $our_services = Our_service:: 
        where(function($q) use ($searchText){
            $q->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("description_html_ar","like","%".$searchText."%")->orWhere("description_html_en","like","%".$searchText."%")->orWhere("image","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("our_services.Our_service_read"),$our_services->toArray());
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
       

        $validator=
            Validator::make($input, [
            'name_ar'=>'required',
                'name_en'=>'required',
                'description_html_ar'=>'required',
                'description_html_en'=>'required',
                'image'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/our_services/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                }
                

        $Our_service = Our_service::create($input);

        
        

        return $this->sendResponse(trans("our_services.Our_service_create"),$Our_service->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Our_service = Our_service::where('id', $id)->first();
        
        if(isset($Our_service)){
        
        
        }

        if (is_null($Our_service)) {
            return $this->sendError('Our_service not found.');
        }

        return $this->sendResponse(trans("our_services.Our_service_read"),$Our_service->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Our_service_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'name_ar'=>'required',
                'name_en'=>'required',
                'description_html_ar'=>'required',
                'description_html_en'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                $old_image=Our_service::find($Our_service_id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/our_services/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                }
                

        $Our_service=Our_service::where(['id'=>$Our_service_id ])->update($input);

        
        

        $Our_service = Our_service::where(['id'=>$Our_service_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("our_services.Our_service_update"),$Our_service->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Our_service_id)
    {
        //delete files
         // delete files and images
        
                $old_image=Our_service::find($Our_service_id)->image;
                 File::delete($old_image);
                
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Our_service::where(['id'=>$Our_service_id ])->delete();



        return $this->sendResponse(trans("our_services.Our_service_delete"));

    }

     //additional Functions
            
            

}
