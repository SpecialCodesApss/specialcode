<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\News_newspaper_publisher;

use Validator;
use File;

class News_newspaper_publisherController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $news_newspaper_publishers = News_newspaper_publisher:: 
        where(function($q) use ($searchText){
            $q->orWhere("country_id","like","%".$searchText."%")->orWhere("slug","like","%".$searchText."%")->orWhere("newspaper_name_ar","like","%".$searchText."%")->orWhere("newspaper_name_en","like","%".$searchText."%")->orWhere("description_ar","like","%".$searchText."%")->orWhere("description_en","like","%".$searchText."%")->orWhere("logo_image","like","%".$searchText."%")->orWhere("email","like","%".$searchText."%")->orWhere("website_link","like","%".$searchText."%")->orWhere("facebook","like","%".$searchText."%")->orWhere("twitter","like","%".$searchText."%")->orWhere("linkedin","like","%".$searchText."%")->orWhere("SEO_newspaper_page_title","like","%".$searchText."%")->orWhere("SEO_newspaper_page_metatags","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("news_newspaper_publishers.News_newspaper_publisher_read"),$news_newspaper_publishers->toArray());
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
                'slug'=>'required',
                'newspaper_name_ar'=>'required',
                'newspaper_name_en'=>'required',
                'description_ar'=>'required',
                'description_en'=>'required',
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
                        $path = 'storage/images/news_newspaper_publishers/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                }
                

        $News_newspaper_publisher = News_newspaper_publisher::create($input);

        
        

        return $this->sendResponse(trans("news_newspaper_publishers.News_newspaper_publisher_create"),$News_newspaper_publisher->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $News_newspaper_publisher = News_newspaper_publisher::where('id', $id)->first();
        
        if(isset($News_newspaper_publisher)){
        
        
        }

        if (is_null($News_newspaper_publisher)) {
            return $this->sendError('News_newspaper_publisher not found.');
        }

        return $this->sendResponse(trans("news_newspaper_publishers.News_newspaper_publisher_read"),$News_newspaper_publisher->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$News_newspaper_publisher_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'country_id'=>'required',
                'slug'=>'required',
                'newspaper_name_ar'=>'required',
                'newspaper_name_en'=>'required',
                'description_ar'=>'required',
                'description_en'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                $old_logo_image=News_newspaper_publisher::find($News_newspaper_publisher_id)->logo_image;
                if ($request->hasFile('logo_image')) {
                    $document = $request->file('logo_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_newspaper_publishers/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                        File::delete($old_logo_image);
                    }
                    else{
                    $input['logo_image'] =$old_logo_image;
                }
                

        $News_newspaper_publisher=News_newspaper_publisher::where(['id'=>$News_newspaper_publisher_id ])->update($input);

        
        

        $News_newspaper_publisher = News_newspaper_publisher::where(['id'=>$News_newspaper_publisher_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("news_newspaper_publishers.News_newspaper_publisher_update"),$News_newspaper_publisher->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$News_newspaper_publisher_id)
    {
        //delete files
         // delete files and images
        
                $old_logo_image=News_newspaper_publisher::find($News_newspaper_publisher_id)->logo_image;
                 File::delete($old_logo_image);
                
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        News_newspaper_publisher::where(['id'=>$News_newspaper_publisher_id ])->delete();



        return $this->sendResponse(trans("news_newspaper_publishers.News_newspaper_publisher_delete"));

    }

     //additional Functions
            
            

}
