<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Country_cities_area;

use Validator;
use File;

class Country_cities_areaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $country_cities_areas = Country_cities_area:: 
        where(function($q) use ($searchText){
            $q->orWhere("city_id","like","%".$searchText."%")->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("slug","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("country_cities_areas.Country_cities_area_read"),$country_cities_areas->toArray());
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
            'city_id'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
                'slug'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Country_cities_area = Country_cities_area::create($input);

        
        

        return $this->sendResponse(trans("country_cities_areas.Country_cities_area_create"),$Country_cities_area->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Country_cities_area = Country_cities_area::where('id', $id)->first();
        
        if(isset($Country_cities_area)){
        
        
        }

        if (is_null($Country_cities_area)) {
            return $this->sendError('Country_cities_area not found.');
        }

        return $this->sendResponse(trans("country_cities_areas.Country_cities_area_read"),$Country_cities_area->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Country_cities_area_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'city_id'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
                'slug'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Country_cities_area=Country_cities_area::where(['id'=>$Country_cities_area_id ])->update($input);

        
        

        $Country_cities_area = Country_cities_area::where(['id'=>$Country_cities_area_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("country_cities_areas.Country_cities_area_update"),$Country_cities_area->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Country_cities_area_id)
    {
        //delete files
         // delete files and images
        
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Country_cities_area::where(['id'=>$Country_cities_area_id ])->delete();



        return $this->sendResponse(trans("country_cities_areas.Country_cities_area_delete"));

    }

     //additional Functions
            
            

}
