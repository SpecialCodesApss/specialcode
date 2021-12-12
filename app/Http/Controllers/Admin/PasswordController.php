<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function viewChangePwd(){

        return view('admin.change_password');
    }

    public function changePwd(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'old_password' => 'required',
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],

        ]);

        if($validator->fails()){
            return redirect()->back()
                ->with('error',$validator->errors()->first());
        }

        $user_id=$request->user()->id;
        $user = User::find($user_id);
        if (Hash::check($input['old_password'], $user->password)) {
            $NewPassword=Hash::make($input['new_password']);
            User::find($user_id)->update(['new_password'=>$NewPassword ]);
            return redirect()->back()
                ->with('success','تم تعديل الرقم السري بنجاح');
        }
        else{
            return redirect()->back()
                ->with('error','الرقم السري غير صحيح');
        }
    }
}
