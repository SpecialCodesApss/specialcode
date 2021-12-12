<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\News;

use Validator;
use File;

class NewsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $news_comments = News:: 
        where(function($q) use ($searchText){
            $q->orWhere("user_id","like","%".$searchText."%")->orWhere("comment_text","like","%".$searchText."%")->orWhere("users_likes_ids","like","%".$searchText."%")->orWhere("users_dislikes_ids","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("news_comments.News_read"),$news_comments->toArray());
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
            'user_id'=>'required',
                'comment_text'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $News = News::create($input);

        
        

        return $this->sendResponse(trans("news_comments.News_create"),$News->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $News = News::where('id', $id)->first();
        
        if(isset($News)){
        
        
        }

        if (is_null($News)) {
            return $this->sendError('News not found.');
        }

        return $this->sendResponse(trans("news_comments.News_read"),$News->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$News_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'user_id'=>'required',
                'comment_text'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $News=News::where(['id'=>$News_id ])->update($input);

        
        

        $News = News::where(['id'=>$News_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("news_comments.News_update"),$News->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$News_id)
    {
        //delete files
         // delete files and images
        
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        News::where(['id'=>$News_id ])->delete();



        return $this->sendResponse(trans("news_comments.News_delete"));

    }

     //additional Functions
            
            

}
