<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\News_favorite;

use Validator;
use File;

class News_favoriteController extends BaseController
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
        $news_favorites = News_favorite::where(['user_id' => $user_id ])-> 
        where(function($q) use ($searchText){
            $q->orWhere("news_id","like","%".$searchText."%")->orWhere("user_id","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("news_favorites.News_favorite_read"),$news_favorites->toArray());
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
            'news_id'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $News_favorite = News_favorite::create($input);

        
        

        return $this->sendResponse(trans("news_favorites.News_favorite_create"),$News_favorite->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $News_favorite = News_favorite::where('id', $id)->first();
        
        if(isset($News_favorite)){
        
        
        }

        if (is_null($News_favorite)) {
            return $this->sendError('News_favorite not found.');
        }

        return $this->sendResponse(trans("news_favorites.News_favorite_read"),$News_favorite->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$News_favorite_id)
    {
        $input = $request->except('images','files','_method');
        $user_id = $request->user_id;

         $validator=
            Validator::make($input, [
            'news_id'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $News_favorite=News_favorite::where(['id'=>$News_favorite_id , 'user_id' => $user_id ])->update($input);

        

        $News_favorite = News_favorite::where(['id'=>$News_favorite_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("news_favorites.News_favorite_update"),$News_favorite->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$News_favorite_id)
    {
        //delete files
         // delete files and images
        
        $user_id=$request->user()->id;
            
         // delete files and images in sub tables if this module has mutiple files or images
        
        News_favorite::where(['id'=>$News_favorite_id ])->where(['user_id' => $user_id ])->delete();



        return $this->sendResponse(trans("news_favorites.News_favorite_delete"));

    }

     //additional Functions
            
            

}
