<?php


namespace App\Http\Controllers\API;


use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
//use App\Doctor;
//use App\Store;
use Illuminate\Support\Facades\Auth;
use Validator;
use Mail;
use Illuminate\Support\Str;


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $input = $request->all();

            $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|unique:users',
//            'type' => 'required',
//            'gender' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
            ]);


            if($validator->fails()){
                return $this->sendError($validator->errors()->first());
            }


        if (isset($input['profile_image'])){
            $photo = $input['profile_image'];
            $photodest = 'storage/images/users/profile_image/';
            $photoname = date('YmdHis')."_".rand(1000,9999).'_'.$photo->getClientOriginalName();
            $photo->move($photodest,$photoname);
            $photo=$photodest.$photoname;
            $input['profile_image']=$photo;
        }
        else{
            $input['profile_image']=null;
        }


//            if ($request->hasFile('image')){
//            $photo = $request->image;
//                $photodest = "storage/images/users/";
//                $photoname = rand(100000,999999).'_'.$photo->getClientOriginalName();
//                $photo->move($photodest,$photoname);
//                $photo=$photodest.$photoname;
//            }


           //Email and mobile verification Codes
            //$emailtoken=rand(100000,999999);
            //$mobiletoken=rand(100000,999999);
            $emailtoken=123456;
            $mobiletoken=123456;
            $input['email_verify_code']=$emailtoken;
            $input['mobile_verify_code']=$mobiletoken;
            $input['role']='user';

            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

        $user = User::find($user->id);

            $user['token'] =  $user->createToken('MyApp')->accessToken;




        //check method of Verification and send Verify Email or Mobile
//        $mobile_API_verify_account=Setting::where('setting_key','mobile_API_verify_account')->first()->setting_value;
//        $mobile_API_verify_account_method=Setting::where('setting_key','mobile_API_verify_account_method')->first()->setting_value;
        $mobile_API_verify_account=true;
        $mobile_API_verify_account_method = "mobile";
        if($mobile_API_verify_account == true){
            if($mobile_API_verify_account_method == 'mobile'){

//                //get message text
//                $message=Setting::where('setting_key','verify_message_with_SMS')->first()->setting_value;
//                $message_subj=Setting::where('setting_key','verify_message_with_SMS_subject')->first()->setting_value;
//                $message=$message.' '.$mobiletoken;
//                // send SMS Code
//                $ch = curl_init('https://smsmisr.com/api/webapi/?Username=XXX&password=XXX&language=1&sender=Tremno&Mobile='.$input['mobile'].'&message='.$message);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLINFO_HEADER_OUT, true);
//                curl_setopt($ch, CURLOPT_POST, true);
//                $result = curl_exec($ch);
//                // Close cURL session handle
//                curl_close($ch);

            }
            else{
//                //Send Email
//                //get message text
//                $message=Setting::where('setting_key','verify_message_with_Email')->first()->setting_value;
//                $message_subj=Setting::where('setting_key','verify_message_with_Email_subject')->first()->setting_value;
//                $message=$message.' '.$emailtoken;
//
//                Mail::raw('Hi, welcome user!', function ($message) use ($input,$message_subj) {
//                    $message->to($input['email'])
//                    ->subject($message_subj);
//                });

            }
        }

            return $this->sendResponse(trans('messages.User_register_successfully'),$user);

    }
}
