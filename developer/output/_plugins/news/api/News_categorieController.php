<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\News_categorie;

use Validator;
use File;

class News_categorieController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $news_categories = News_categorie:: 
        where(function($q) use ($searchText){
            $q->orWhere("parent_category_id","like","%".$searchText."%")->orWhere("slug","like","%".$searchText."%")->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("description_ar","like","%".$searchText."%")->orWhere("description_en","like","%".$searchText."%")->orWhere("category_image","like","%".$searchText."%")->orWhere("category_icon","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("news_categories.News_categorie_read"),$news_categories->toArray());
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
            'parent_category_id'=>'required',
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

        
                if ($request->hasFile('category_image')) {
                    $document = $request->file('category_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_categories/category_image/';
                        $request->file('category_image')->move($path, $imageName);
                        $input['category_image'] = $path.$imageName;
                }
                
                if ($request->hasFile('category_icon')) {
                    $document = $request->file('category_icon');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_categories/category_icon/';
                        $request->file('category_icon')->move($path, $imageName);
                        $input['category_icon'] = $path.$imageName;
                }
                

        $News_categorie = News_categorie::create($input);

        
        

        return $this->sendResponse(trans("news_categories.News_categorie_create"),$News_categorie->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $News_categorie = News_categorie::where('id', $id)->first();
        
        if(isset($News_categorie)){
        
        
        }

        if (is_null($News_categorie)) {
            return $this->sendError('News_categorie not found.');
        }

        return $this->sendResponse(trans("news_categories.News_categorie_read"),$News_categorie->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$News_categorie_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'parent_category_id'=>'required',
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

        
                $old_category_image=News_categorie::find($News_categorie_id)->category_image;
                if ($request->hasFile('category_image')) {
                    $document = $request->file('category_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_categories/category_image/';
                        $request->file('category_image')->move($path, $imageName);
                        $input['category_image'] = $path.$imageName;
                        File::delete($old_category_image);
                    }
                    else{
                    $input['category_image'] =$old_category_image;
                }
                
                $old_category_icon=News_categorie::find($News_categorie_id)->category_icon;
                if ($request->hasFile('category_icon')) {
                    $document = $request->file('category_icon');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_categories/category_icon/';
                        $request->file('category_icon')->move($path, $imageName);
                        $input['category_icon'] = $path.$imageName;
                        File::delete($old_category_icon);
                    }
                    else{
                    $input['category_icon'] =$old_category_icon;
                }
                

        $News_categorie=News_categorie::where(['id'=>$News_categorie_id ])->update($input);

        
        

        $News_categorie = News_categorie::where(['id'=>$News_categorie_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("news_categories.News_categorie_update"),$News_categorie->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$News_categorie_id)
    {
        //delete files
         // delete files and images
        
                $old_category_image=News_categorie::find($News_categorie_id)->category_image;
                 File::delete($old_category_image);
                
                $old_category_icon=News_categorie::find($News_categorie_id)->category_icon;
                 File::delete($old_category_icon);
                
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        News_categorie::where(['id'=>$News_categorie_id ])->delete();



        return $this->sendResponse(trans("news_categories.News_categorie_delete"));

    }

     //additional Functions
            
            

}
