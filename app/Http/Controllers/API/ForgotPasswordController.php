<?php
namespace App\Http\Controllers\API;


use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use App\Password_reset;
use Validator;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends BaseController
{

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SendMobileResetCode($mobile)
    {



        //check if this mobile in db
        $user=User::where('mobile',$mobile)->first();
        if(isset($user)){

        	$token='123456';
        	// $token=rand(100000,999999);
        	$userEmail=$user->email;

        	$input['email']=$userEmail;
        	$input['token']=$token;


        	//Update Current Email or Create
        	$isfound=Password_reset::where('email',$userEmail)->first();
        	if(isset($isfound)){
        		$isfound->Update($input);
        	}
        	else{
        		Password_reset::Create($input);
        	}


            // send SMS Code
            //get message text
            $message=Setting::where('setting_key','verify_message_with_SMS')->first()->setting_value;
            $message_subj=Setting::where('setting_key','verify_message_with_SMS_subject')->first()->setting_value;
            $message=$message.' '.$token;
            $ch = curl_init('https://smsmisr.com/api/webapi/?Username=XXX&password=XXX&language=1&sender=Tremno&Mobile='.$mobile.'&message='.$message);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_POST, true);
            $result = curl_exec($ch);
            // Close cURL session handle
            curl_close($ch);

           return $this->sendResponse( trans('messages.Reset_Code_sent_mobile'));
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
    public function SendEmailResetCode($email)
    {


        //check if this mobile in db
        $user=User::where('email',$email)->first();
        if(isset($user)){

        	$token='123456';
        	// $token=rand(100000,999999);
        	$userEmail=$email;

        	$input['email']=$userEmail;
        	$input['token']=$token;

        	//Update Current Email or Create
        	$isfound=Password_reset::where('email',$userEmail)->first();
        	if(isset($isfound)){
        		$isfound->Update($input);
        	}
        	else{
        		Password_reset::Create($input);
        	}

            //Send Email
            //get message text
            $message=Setting::where('setting_key','verify_message_with_Email')->first()->setting_value;
            $message_subj=Setting::where('setting_key','verify_message_with_Email_subject')->first()->setting_value;
            $message=$message.' '.$token;

            Mail::raw('Hi, welcome user!', function ($message) use ($input,$message_subj) {
                $message->to($input['email'])
                    ->subject($message_subj);
            });

            return $this->sendError( trans('messages.verify_code_sent_email'));
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
    public function CheckResetCode(Request $request)
    {
    	$input = $request->all();
    	$validator = Validator::make($input, [
    		'email' => 'required_without:mobile',
            'mobile' => 'required_without:email',
            'token' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }



       if(isset($request->mobile)){
       		$user=User::where('mobile',$request->mobile)->first();
       		if(isset($user)){
       			$userEmail=$user->email;
       		}
       		else{
                 return $this->sendError( trans('messages.Mobile_Not_Found'));
       		}

       }
       else {
       		$userEmail=$request->email;
       }

       $resetCode=Password_reset::where(['email'=>$userEmail  , 'token' => $request->token])->first();
       if(isset($resetCode)){
            return $this->sendResponse( trans('messages.Code_is_true'));

        }
        else{
            return $this->sendError( trans('messages.code_invalid'));
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ResetPassword(Request $request)
    {
    	$input = $request->all();
    	$validator = Validator::make($input, [
            'token' => 'required',
            'email' => 'required_without:mobile',
            'mobile' => 'required_without:email',
            'password' => ['required', 'string', 'min:6', 'confirmed'],

        ]);

    	if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }


       if(isset($request->mobile)){
       		$user=User::where('mobile',$request->mobile)->first();
       		if(isset($user)){
       			$userEmail=$user->email;
       		}
       		else{
                return $this->sendError( trans('messages.Mobile_Not_Found'));
       		}

       }
       else {
       		$userEmail=$input['email'];
       }

       $resetCode=Password_reset::where(['email'=>$userEmail  , 'token' => $request->token])->first();
       if(isset($resetCode)){
       		$NewPassword= Hash::make($input['password']);
       		User::where('email',$userEmail)->update(['password'=>$NewPassword]);
       		Password_reset::where(['email'=>$userEmail])->delete();
            return $this->sendResponse( trans('messages.password_updated'));
        }
        else{
            return $this->sendError(trans('messages.code_invalid'));
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ChangePassword(Request $request)
    {
    	$input = $request->all();

    	$validator = Validator::make($input, [
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:6', 'confirmed'],

        ]);

    	if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        $user_id=$request->user()->id;
        $user = User::find($user_id);
		if (Hash::check($input['old_password'], $user->password)) {
			$NewPassword=Hash::make($input['password']);
		    User::find($user_id)->update(['password'=>$NewPassword ]);
		    return $this->sendResponse(trans('messages.password_updated_successfully'));
		}
		else{
			return $this->sendError(trans('messages.this_password_is_incorrect'));
		}


    }

}
