<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Country_citie;

use Validator;
use File;

class Country_citieController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $country_cities = Country_citie:: 
        where(function($q) use ($searchText){
            $q->orWhere("country_id","like","%".$searchText."%")->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("slug","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("country_cities.Country_citie_read"),$country_cities->toArray());
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
            'country_id'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
                'slug'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Country_citie = Country_citie::create($input);

        
        

        return $this->sendResponse(trans("country_cities.Country_citie_create"),$Country_citie->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Country_citie = Country_citie::where('id', $id)->first();
        
        if(isset($Country_citie)){
        
        
        }

        if (is_null($Country_citie)) {
            return $this->sendError('Country_citie not found.');
        }

        return $this->sendResponse(trans("country_cities.Country_citie_read"),$Country_citie->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Country_citie_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'country_id'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
                'slug'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Country_citie=Country_citie::where(['id'=>$Country_citie_id ])->update($input);

        
        

        $Country_citie = Country_citie::where(['id'=>$Country_citie_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("country_cities.Country_citie_update"),$Country_citie->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Country_citie_id)
    {
        //delete files
         // delete files and images
        
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Country_citie::where(['id'=>$Country_citie_id ])->delete();



        return $this->sendResponse(trans("country_cities.Country_citie_delete"));

    }

     //additional Functions
            
            

}
