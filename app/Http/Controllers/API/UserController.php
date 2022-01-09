<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController  as BaseController;
use App\Models\User;
//use App\Store;
use File;
use Validator;
use Carbon\Carbon;

class UserController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $user_id=$request->user()->id;
        $user = User::where('id',$user_id)->leftjoin('stores','user_id','id')->get();
        return $this->sendResponse($user->toArray(), 'Profile retrieved successfully.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        $input = $request->all();
        $user_id=$request->user()->id;
        $user = User::where('id',$user_id)->first();

        return $this->sendResponse( null,$user);
    }


    //

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       // $input = $request->all();
        $input['fullname']=$request->fullname;
        $input['email']=$request->email;
        $input['mobile']=$request->mobile;
        $user_id=$request->user()->id;
        $auth_mobile=$request->user()->mobile;
        $auth_email=$request->user()->email;

            $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'profile_image' => 'required',
            'email' => "unique:users,email,$user_id,id",
            'mobile' => "unique:users,mobile,$user_id,id",
            ]);


            if($validator->fails()){
                return $this->sendError($validator->errors()->first());
            }

            //check if mobile or email changes to do nuVerified
            //$emailtoken=rand(100000,999999);
            //$mobiletoken=rand(100000,999999);
            $emailtoken=111111;
            $mobiletoken=111111;
            if($auth_mobile !=$input['mobile']){
                //mobile changed code here
                $input['mobile_verify_code']=$mobiletoken;
                $input['mobile_verified_at']=null;
            }
            if($auth_email != $input['email']){
                //email changed code here
                $input['email_verify_code']=$emailtoken;
                $input['email_verified_at']=null;
            }


        if (isset($request['profile_image'])){
            $photo = $request['profile_image'];
            $photodest = 'storage/images/users/profile_image/';
            $photoname = date('YmdHis')."_".rand(1000,9999).'_'.$photo->getClientOriginalName();
            $photo->move($photodest,$photoname);
            $photo=$photodest.$photoname;
            $input['profile_image']=$photo;

//            delete old file
            $old_image=User::find($user_id)->profile_image;
            File::delete($old_image);
        }


            User::where('id',$user_id)->update($input);
            $user=User::where('id',$user_id)->first();


        return $this->sendResponse(trans('messages.profile_updated'),$user);
        }




}
