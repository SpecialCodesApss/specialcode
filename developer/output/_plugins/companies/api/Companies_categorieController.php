<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Companies_categorie;

use Validator;
use File;

class Companies_categorieController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $companies_categories = Companies_categorie:: 
        where(function($q) use ($searchText){
            $q->orWhere("parent_category_id","like","%".$searchText."%")->orWhere("slug","like","%".$searchText."%")->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("description_ar","like","%".$searchText."%")->orWhere("description_en","like","%".$searchText."%")->orWhere("category_image","like","%".$searchText."%")->orWhere("category_icon","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("companies_categories.Companies_categorie_read"),$companies_categories->toArray());
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
            'slug'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
                'description_ar'=>'required',
                'description_en'=>'required',
                'category_image'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                if ($request->hasFile('category_image')) {
                    $document = $request->file('category_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies_categories/category_image/';
                        $request->file('category_image')->move($path, $imageName);
                        $input['category_image'] = $path.$imageName;
                }
                
                if ($request->hasFile('category_icon')) {
                    $document = $request->file('category_icon');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies_categories/category_icon/';
                        $request->file('category_icon')->move($path, $imageName);
                        $input['category_icon'] = $path.$imageName;
                }
                

        $Companies_categorie = Companies_categorie::create($input);

        
        

        return $this->sendResponse(trans("companies_categories.Companies_categorie_create"),$Companies_categorie->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Companies_categorie = Companies_categorie::where('id', $id)->first();
        
        if(isset($Companies_categorie)){
        
        
        }

        if (is_null($Companies_categorie)) {
            return $this->sendError('Companies_categorie not found.');
        }

        return $this->sendResponse(trans("companies_categories.Companies_categorie_read"),$Companies_categorie->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Companies_categorie_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'slug'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
                'description_ar'=>'required',
                'description_en'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                $old_category_image=Companies_categorie::find($Companies_categorie_id)->category_image;
                if ($request->hasFile('category_image')) {
                    $document = $request->file('category_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies_categories/category_image/';
                        $request->file('category_image')->move($path, $imageName);
                        $input['category_image'] = $path.$imageName;
                        File::delete($old_category_image);
                    }
                    else{
                    $input['category_image'] =$old_category_image;
                }
                
                $old_category_icon=Companies_categorie::find($Companies_categorie_id)->category_icon;
                if ($request->hasFile('category_icon')) {
                    $document = $request->file('category_icon');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies_categories/category_icon/';
                        $request->file('category_icon')->move($path, $imageName);
                        $input['category_icon'] = $path.$imageName;
                        File::delete($old_category_icon);
                    }
                    else{
                    $input['category_icon'] =$old_category_icon;
                }
                

        $Companies_categorie=Companies_categorie::where(['id'=>$Companies_categorie_id ])->update($input);

        
        

        $Companies_categorie = Companies_categorie::where(['id'=>$Companies_categorie_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("companies_categories.Companies_categorie_update"),$Companies_categorie->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Companies_categorie_id)
    {
        //delete files
         // delete files and images
        
                $old_category_image=Companies_categorie::find($Companies_categorie_id)->category_image;
                 File::delete($old_category_image);
                
                $old_category_icon=Companies_categorie::find($Companies_categorie_id)->category_icon;
                 File::delete($old_category_icon);
                
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Companies_categorie::where(['id'=>$Companies_categorie_id ])->delete();



        return $this->sendResponse(trans("companies_categories.Companies_categorie_delete"));

    }

     //additional Functions
            
            

}
