<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Companie;

use Validator;
use File;
use DB;

class CompanieController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $companies = Companie::
        where('active',1)->
        where(function($q) use ($searchText){
            $q->orWhere("categories","like","%".$searchText."%")->orWhere("country_id","like","%".$searchText."%")->orWhere("city_id","like","%".$searchText."%")->orWhere("slug","like","%".$searchText."%")->orWhere("company_name_ar","like","%".$searchText."%")->orWhere("company_name_en","like","%".$searchText."%")->orWhere("description_ar","like","%".$searchText."%")->orWhere("description_en","like","%".$searchText."%")->orWhere("logo_image","like","%".$searchText."%")->orWhere("email","like","%".$searchText."%")->orWhere("phone_number","like","%".$searchText."%")->orWhere("whatsapp_number","like","%".$searchText."%")->orWhere("website_link","like","%".$searchText."%")->orWhere("address","like","%".$searchText."%")->orWhere("lat","like","%".$searchText."%")->orWhere("lng","like","%".$searchText."%")->orWhere("facebook","like","%".$searchText."%")->orWhere("twitter","like","%".$searchText."%")->orWhere("linkedin","like","%".$searchText."%")->orWhere("youtube","like","%".$searchText."%")->orWhere("SEO_company_page_title","like","%".$searchText."%")->orWhere("SEO_company_page_metatags","like","%".$searchText."%")->orWhere("is_recommended","like","%".$searchText."%")->orWhere("views_count","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("companies.Companie_read"),$companies->toArray());
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
            'categories'=>'required',
                'country_id'=>'required',
                'city_id'=>'required',
                'slug'=>'required',
                'company_name_ar'=>'required',
                'company_name_en'=>'required',
                'description_ar'=>'required',
                'description_en'=>'required',
                'logo_image'=>'required',
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                if ($request->hasFile('logo_image')) {
                    $document = $request->file('logo_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                }
                

        $Companie = Companie::create($input);

        
        

        return $this->sendResponse(trans("companies.Companie_create"),$Companie->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Companie = Companie::where('id', $id)->first();
        
        if(isset($Companie)){
        
        
        }

        if (is_null($Companie)) {
            return $this->sendError('Companie not found.');
        }

        return $this->sendResponse(trans("companies.Companie_read"),$Companie->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Companie_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'categories'=>'required',
                'country_id'=>'required',
                'city_id'=>'required',
                'slug'=>'required',
                'company_name_ar'=>'required',
                'company_name_en'=>'required',
                'description_ar'=>'required',
                'description_en'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                $old_logo_image=Companie::find($Companie_id)->logo_image;
                if ($request->hasFile('logo_image')) {
                    $document = $request->file('logo_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                        File::delete($old_logo_image);
                    }
                    else{
                    $input['logo_image'] =$old_logo_image;
                }
                

        $Companie=Companie::where(['id'=>$Companie_id ])->update($input);

        
        

        $Companie = Companie::where(['id'=>$Companie_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("companies.Companie_update"),$Companie->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Companie_id)
    {
        //delete files
         // delete files and images
        
                $old_logo_image=Companie::find($Companie_id)->logo_image;
                 File::delete($old_logo_image);
                
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Companie::where(['id'=>$Companie_id ])->delete();



        return $this->sendResponse(trans("companies.Companie_delete"));

    }

     //additional Functions


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_Variables_for_companies_store()
    {

        $companies_categories=DB::table("companies_categories")->orderBy('id', 'asc')->get();
        $countries=DB::table("countries")->orderBy('id', 'asc')->get();
//        $countries=[];
//        foreach ($country_ids as $info){
//            $countries[$info->id]=$info->name_ar;
//        }
        $country_cities=DB::table("country_cities")->orderBy('id', 'asc')->where("country_id",1)->get();
//        $country_cities=[];
//        foreach ($city_ids as $info){
//            $country_cities[$info->id]=$info->name_ar;
//        }

        $response=[];

        $response["companies_categories"]=$companies_categories;
        $response["countries"]=$countries;
        $response["country_cities"]=$country_cities;


        return $this->sendResponse("",$response);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_CountryCites_for_companies_store(Request $request)
    {
        $country_id = $request->country_id;
        $country_cities=DB::table("country_cities")->orderBy('id', 'asc')->where("country_id",$country_id)->get();

        $response=[];
        $response["country_cities"]=$country_cities;
        return $this->sendResponse("",$response);
    }
            
            

}
