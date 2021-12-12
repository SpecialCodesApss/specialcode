<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Countrie;

use Validator;
use File;

class CountrieController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $countries = Countrie:: 
        where(function($q) use ($searchText){
            $q->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("slug","like","%".$searchText."%")->orWhere("country_flag","like","%".$searchText."%")->orWhere("country_alpha2_code","like","%".$searchText."%")->orWhere("country_alpha3_code","like","%".$searchText."%")->orWhere("languages","like","%".$searchText."%")->orWhere("currencies","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("countries.Countrie_read"),$countries->toArray());
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
                'slug'=>'required',
                'country_flag'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                if ($request->hasFile('country_flag')) {
                    $document = $request->file('country_flag');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/countries/country_flag/';
                        $request->file('country_flag')->move($path, $imageName);
                        $input['country_flag'] = $path.$imageName;
                }
                

        $Countrie = Countrie::create($input);

        
        

        return $this->sendResponse(trans("countries.Countrie_create"),$Countrie->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Countrie = Countrie::where('id', $id)->first();
        
        if(isset($Countrie)){
        
        
        }

        if (is_null($Countrie)) {
            return $this->sendError('Countrie not found.');
        }

        return $this->sendResponse(trans("countries.Countrie_read"),$Countrie->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Countrie_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'name_ar'=>'required',
                'name_en'=>'required',
                'slug'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                $old_country_flag=Countrie::find($Countrie_id)->country_flag;
                if ($request->hasFile('country_flag')) {
                    $document = $request->file('country_flag');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/countries/country_flag/';
                        $request->file('country_flag')->move($path, $imageName);
                        $input['country_flag'] = $path.$imageName;
                        File::delete($old_country_flag);
                    }
                    else{
                    $input['country_flag'] =$old_country_flag;
                }
                

        $Countrie=Countrie::where(['id'=>$Countrie_id ])->update($input);

        
        

        $Countrie = Countrie::where(['id'=>$Countrie_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("countries.Countrie_update"),$Countrie->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Countrie_id)
    {
        //delete files
         // delete files and images
        
                $old_country_flag=Countrie::find($Countrie_id)->country_flag;
                 File::delete($old_country_flag);
                
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Countrie::where(['id'=>$Countrie_id ])->delete();



        return $this->sendResponse(trans("countries.Countrie_delete"));

    }

     //additional Functions
            
            

}
