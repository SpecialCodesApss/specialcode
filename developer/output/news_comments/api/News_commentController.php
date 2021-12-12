<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\News_comment;

use Validator;
use File;

class News_commentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $news_comments = News_comment:: 
        where(function($q) use ($searchText){
            $q->orWhere("user_id","like","%".$searchText."%")->orWhere("comment_text","like","%".$searchText."%")->orWhere("users_likes_ids","like","%".$searchText."%")->orWhere("users_dislikes_ids","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("news_comments.News_comment_read"),$news_comments->toArray());
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
                'comment_text'=>'required',

        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $News_comment = News_comment::create($input);

        
        

        return $this->sendResponse(trans("news_comments.News_comment_create"),$News_comment->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $News_comment = News_comment::where('id', $id)->first();
        
        if(isset($News_comment)){
        
        
        }

        if (is_null($News_comment)) {
            return $this->sendError('News_comment not found.');
        }

        return $this->sendResponse(trans("news_comments.News_comment_read"),$News_comment->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$News_comment_id)
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

        

        $News_comment=News_comment::where(['id'=>$News_comment_id ])->update($input);

        
        

        $News_comment = News_comment::where(['id'=>$News_comment_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("news_comments.News_comment_update"),$News_comment->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$News_comment_id)
    {
        //delete files
         // delete files and images
        
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        News_comment::where(['id'=>$News_comment_id ])->delete();



        return $this->sendResponse(trans("news_comments.News_comment_delete"));

    }

     //additional Functions
            
            

}
