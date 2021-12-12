<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController  as BaseController;
use App\User;
use File;
use Validator;
use Carbon\Carbon;
use Auth;

class VerificationController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SendMobVerifyCode(Request $request)
    {
        $input = $request->all();
        $user_mobile=$request->user()->mobile;
        //check if this mobile in db
        $user=User::where('mobile',$user_mobile)->first();
        if(isset($user)){
        if($user->mobile_verify_code != 'Verified'){

                    $token=$user->mobile_verify_code;

                    // send SMS Code
                    /*
                    $ch = curl_init('https://smsmisr.com/api/webapi/?Username=XXX&password=XXX&language=1&sender=Tremno&Mobile=201013758590&message=123456');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                    curl_setopt($ch, CURLOPT_POST, true);
                    //curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

                    // Submit the POST request
                    $result = curl_exec($ch);
                     print_r($result);
                    // Close cURL session handle
                    curl_close($ch);
                    */

                    return $this->sendResponse(trans('messages.verify_code_sent_mobile'));
                }
                else{
                    return $this->sendError( trans('messages.Mobile_already_Verified'));
                }
        }
        else{
        return $this->sendError( trans('messages.Mobile_Not_Found'));
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SendEmailVerifyCode(Request $request)
    {
        $input = $request->all();
        $user_email=$request->user()->email;
        //check if this mobile in db
        $user=User::where('email',$user_email)->first();
        if(isset($user)){
            if( $user->email_verify_code != 'Verified'){
                        $token=$user->email_verify_code;

                        // send SMS Code
                        /*
                        $ch = curl_init('https://smsmisr.com/api/webapi/?Username=XXX&password=XXX&language=1&sender=Tremno&Mobile=201013758590&message=123456');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                        curl_setopt($ch, CURLOPT_POST, true);
                        //curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

                        // Submit the POST request
                        $result = curl_exec($ch);
                         print_r($result);
                        // Close cURL session handle
                        curl_close($ch);
                        */

                        return $this->sendResponse(trans('messages.verify_code_sent_email'));
                    }
                    else{
                        return $this->sendError( trans('messages.Email_already_Verified'));
                    }

        }
        else{
                return $this->sendError( trans('messages.Email_Not_Found'));
        }

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function VerifyCode(Request $request)
    {
        $input = $request->all();
        $user_id=$request->user()->id;
        $user_email_verify_code=$request->user()->email_verify_code;
        $user_mobile_verify_code=$request->user()->mobile_verify_code;

        $validator = Validator::make($input, [
            'verify_type' => 'required',
            'token' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        $verify_type=$input['verify_type'];
        $token=$input['token'];
        $offset=3*60*60; // to get KSA Time  GMT+3
        $currenttime=date("Y-m-d h:i:s",time()+$offset);

        if($verify_type=='mobile'){
            if($token==$user_mobile_verify_code){
                User::where('id',$user_id)->update(['mobile_verify_code'=>'Verified' , 'mobile_verified_at' => $currenttime]);
                return $this->sendResponse( trans('messages.Mobile_Verified_successfully'));
            }
            else{

                return $this->sendError( trans('messages.code_invalid_mobile_verified'));
            }
        }
        else {
            if($token==$user_email_verify_code){
                User::where('id',$user_id)->update(['email_verify_code'=>'Verified' , 'email_verified_at' => $currenttime]);
                return $this->sendResponse(trans('messages.Email_Verified_successfully'));
            }
            else{
                return $this->sendError(trans('messages.code_invalid_email_verified'));
            }
        }

    }

    function UpdateVerMobile(Request $request){
        $user_id=$request->user()->id;
        $mobile=$request->mobile;
        $is_there_mobile=User::where('mobile',$mobile)->first();
        if(isset($is_there_mobile)){
            return $this->sendError(trans('messages.mobile_used'));
        }
        User::where('id',$user_id)->update(['mobile' => $mobile]);
        $user = User::find($user_id);
        $data['mobile']=$user->mobile;
        $data['email']=$user->email;
        return $this->sendResponse(trans('messages.mobile_changed'),$data);
    }

    function UpdateVerEmail(Request $request){
        $user_id=$request->user()->id;
        $mobile=$request->email;
        User::where('id',$user_id)->update(['email' => $mobile]);
        $user = User::find($user_id);
        $data['mobile']=$user->mobile;
        $data['email']=$user->email;
        return $this->sendResponse(trans('messages.email_changed'),$data);

    }

}
