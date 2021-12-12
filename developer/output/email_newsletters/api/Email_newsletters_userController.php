<?php
namespace App\Http\Controllers\API;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Email_newsletters_user;

use Validator;
use File;

class Email_newsletters_userController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $email_newsletters_users = Email_newsletters_user:: 
        where(function($q) use ($searchText){
            $q->orWhere("user_id","like","%".$searchText."%")->orWhere("email","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("email_newsletters_users.Email_newsletters_user_read"),$email_newsletters_users->toArray());
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


        $validator=
            Validator::make($input, [
                'user_id'=>'required_if:email,!=,null',
                'email'=>'required_if:user_id,!=,null',
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }


        $input = $request->all();
        $email=$input['email'];


        //check if user id != null and is inserted before
        if($user_id != null){

            //get user data
            $user = User::find($user_id)->first();
            $email = $user->email;
            $input['email'] = $email;

            $news_user = Email_newsletters_user::where([
                'user_id'=>$user_id,
            ])->first();
            if(isset($news_user)) {
                return $this->sendError('هذا البريد مسجل لدينا في النشرة البريديه مسبقا');
            }



            $news_user = Email_newsletters_user::where([
                'email'=>$email,
            ])->first();
            if(isset($news_user)){
                return $this->sendError('هذا البريد مسجل لدينا في النشرة البريديه مسبقا');
            }

            $input['user_id'] = $user_id;
        }

        elseif($email != null){
            $news_user = Email_newsletters_user::where([
                'email'=>$email,
            ])->first();
            if(isset($news_user)){
                return $this->sendError('هذا البريد مسجل لدينا في النشرة البريديه مسبقا');
            }

            $input['email'] = $email;
        }

        $Email_newsletters_user = Email_newsletters_user::create($input);

        return $this->sendResponse(trans("email_newsletters_users.Email_newsletters_user_create"),$Email_newsletters_user->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Email_newsletters_user = Email_newsletters_user::where('id', $id)->first();
        
        if(isset($Email_newsletters_user)){
        
        
        }

        if (is_null($Email_newsletters_user)) {
            return $this->sendError('Email_newsletters_user not found.');
        }

        return $this->sendResponse(trans("email_newsletters_users.Email_newsletters_user_read"),$Email_newsletters_user->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Email_newsletters_user_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'user_id'=>'required',
                'email'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Email_newsletters_user=Email_newsletters_user::where(['id'=>$Email_newsletters_user_id ])->update($input);

        
        

        $Email_newsletters_user = Email_newsletters_user::where(['id'=>$Email_newsletters_user_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("email_newsletters_users.Email_newsletters_user_update"),$Email_newsletters_user->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Email_newsletters_user_id)
    {
        //delete files
         // delete files and images
        
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Email_newsletters_user::where(['id'=>$Email_newsletters_user_id ])->delete();



        return $this->sendResponse(trans("email_newsletters_users.Email_newsletters_user_delete"));

    }

     //additional Functions
            
            

}
