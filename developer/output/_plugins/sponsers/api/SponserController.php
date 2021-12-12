<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Sponser;

use Validator;
use File;

class SponserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $sponsers = Sponser:: 
        where(function($q) use ($searchText){
            $q->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("logo_image","like","%".$searchText."%")->orWhere("website_link","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("sponsers.Sponser_read"),$sponsers->toArray());
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
                'logo_image'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                if ($request->hasFile('logo_image')) {
                    $document = $request->file('logo_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/sponsers/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                }
                

        $Sponser = Sponser::create($input);

        
        

        return $this->sendResponse(trans("sponsers.Sponser_create"),$Sponser->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Sponser = Sponser::where('id', $id)->first();
        
        if(isset($Sponser)){
        
        
        }

        if (is_null($Sponser)) {
            return $this->sendError('Sponser not found.');
        }

        return $this->sendResponse(trans("sponsers.Sponser_read"),$Sponser->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Sponser_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'name_ar'=>'required',
                'name_en'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                $old_logo_image=Sponser::find($Sponser_id)->logo_image;
                if ($request->hasFile('logo_image')) {
                    $document = $request->file('logo_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/sponsers/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                        File::delete($old_logo_image);
                    }
                    else{
                    $input['logo_image'] =$old_logo_image;
                }
                

        $Sponser=Sponser::where(['id'=>$Sponser_id ])->update($input);

        
        

        $Sponser = Sponser::where(['id'=>$Sponser_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("sponsers.Sponser_update"),$Sponser->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Sponser_id)
    {
        //delete files
         // delete files and images
        
                $old_logo_image=Sponser::find($Sponser_id)->logo_image;
                 File::delete($old_logo_image);
                
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Sponser::where(['id'=>$Sponser_id ])->delete();



        return $this->sendResponse(trans("sponsers.Sponser_delete"));

    }

     //additional Functions
            
            

}
