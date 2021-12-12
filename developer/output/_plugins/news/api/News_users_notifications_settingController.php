<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\News_users_notifications_setting;

use Validator;
use File;

class News_users_notifications_settingController extends BaseController
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
        $news_users_notifications_settings = News_users_notifications_setting::where(['user_id' => $user_id ])-> 
        where(function($q) use ($searchText){
            $q->orWhere("user_id","like","%".$searchText."%")->orWhere("active_notification","like","%".$searchText."%")->orWhere("notification_type","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("news_users_notifications_settings.News_users_notifications_setting_read"),$news_users_notifications_settings->toArray());
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
            'user_id'=>'required',
                'active_notification'=>'required',
                'notification_type'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $News_users_notifications_setting = News_users_notifications_setting::create($input);

        
        

        return $this->sendResponse(trans("news_users_notifications_settings.News_users_notifications_setting_create"),$News_users_notifications_setting->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

        $user_id = $request->user()->id;
        $News_users_notifications_setting = News_users_notifications_setting::where('user_id', $user_id)->first();


        if (is_null($News_users_notifications_setting)) {
            //create one
            $input=[];
            $input['user_id']=$user_id;
            $input['active_notification']=0;
            $input['notification_type']="every week";
            $News_users_notifications_setting=News_users_notifications_setting::create($input);
        }


        return $this->sendResponse(trans("news_users_notifications_settings.News_users_notifications_setting_read"),$News_users_notifications_setting->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$News_users_notifications_setting_id)
    {
        $input = $request->except('images','files','_method');
        $user_id=$request->user()->id;
             $input['user_id']=$user_id;
            

         $validator=
            Validator::make($input, [
            'user_id'=>'required',
                'active_notification'=>'required',
                'notification_type'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }


        $News_users_notifications_setting=
            News_users_notifications_setting::where(['user_id' => $user_id ])->update($input);

        
        

        $News_users_notifications_setting = News_users_notifications_setting::where(['id'=>$News_users_notifications_setting_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("news_users_notifications_settings.News_users_notifications_setting_update"),$News_users_notifications_setting->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$News_users_notifications_setting_id)
    {
        //delete files
         // delete files and images
        
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        News_users_notifications_setting::where(['id'=>$News_users_notifications_setting_id ])->delete();



        return $this->sendResponse(trans("news_users_notifications_settings.News_users_notifications_setting_delete"));

    }

     //additional Functions
            
            

}
