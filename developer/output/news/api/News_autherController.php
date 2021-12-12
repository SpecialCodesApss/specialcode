<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\News_auther;

use Validator;
use File;

class News_autherController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id=$request->user()->id;
        $searchText=$request->searchText;
        $news_authers = News_auther::
        where(function($q) use ($searchText){
            $q->orWhere("country_id","like","%".$searchText."%")->orWhere("slug","like","%".$searchText."%")->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("work_title","like","%".$searchText."%")->orWhere("Biographical_info_ar","like","%".$searchText."%")->orWhere("Biographical_info_en","like","%".$searchText."%")->orWhere("profile_image","like","%".$searchText."%")->orWhere("email","like","%".$searchText."%")->orWhere("website_link","like","%".$searchText."%")->orWhere("facebook","like","%".$searchText."%")->orWhere("twitter","like","%".$searchText."%")->orWhere("linkedin","like","%".$searchText."%")->orWhere("SEO_auther_page_title","like","%".$searchText."%")->orWhere("SEO_auther_page_metatags","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("news_authers.News_auther_read"),$news_authers->toArray());
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
                'SEO_auther_page_metatags'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                if ($request->hasFile('profile_image')) {
                    $document = $request->file('profile_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_authers/profile_image/';
                        $request->file('profile_image')->move($path, $imageName);
                        $input['profile_image'] = $path.$imageName;
                }
                

        $News_auther = News_auther::create($input);

        
        

        return $this->sendResponse(trans("news_authers.News_auther_create"),$News_auther->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         $user_id=$request->user()->id;
            
        $News_auther = News_auther::where('id', $id)->first();
        
        if(isset($News_auther)){
        
        
        }

        if (is_null($News_auther)) {
            return $this->sendError('News_auther not found.');
        }

        return $this->sendResponse(trans("news_authers.News_auther_read"),$News_auther->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$News_auther_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'slug'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
                'SEO_auther_page_metatags'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                $old_profile_image=News_auther::find($News_auther_id)->profile_image;
                if ($request->hasFile('profile_image')) {
                    $document = $request->file('profile_image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_authers/profile_image/';
                        $request->file('profile_image')->move($path, $imageName);
                        $input['profile_image'] = $path.$imageName;
                        File::delete($old_profile_image);
                    }
                    else{
                    $input['profile_image'] =$old_profile_image;
                }
                

        $News_auther=News_auther::where(['id'=>$News_auther_id ])->update($input);

        
        

        $News_auther = News_auther::where(['id'=>$News_auther_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("news_authers.News_auther_update"),$News_auther->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$News_auther_id)
    {
        //delete files
         // delete files and images
        
                $old_profile_image=News_auther::find($News_auther_id)->profile_image;
                 File::delete($old_profile_image);
                
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        News_auther::where(['id'=>$News_auther_id ])->delete();



        return $this->sendResponse(trans("news_authers.News_auther_delete"));

    }

     //additional Functions
            
            

}
