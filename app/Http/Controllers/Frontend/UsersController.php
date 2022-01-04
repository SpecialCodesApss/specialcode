<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use File;
class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $user = Auth::user();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('frontend.users.view',compact('user','roles','userRole'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('frontend.users.edit',compact('user','roles','userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile' => 'required|unique:users,mobile,'.$id,
//            'roles' => 'required',
            'gender' => 'required',
        ]);

        $input=[];
        $input["fullname"] = $request->fullname;
        $input["email"] = $request->email;
        $input["mobile"] = $request->mobile;
        $input["gender"] = $request->gender;

        $user = Auth::user();
        $user->update($input);
//        DB::table('model_has_roles')->where('model_id',$id)->delete();
//        $user->assignRole($request->input('roles'));

        return redirect()->back()->with('success',trans('users.Account Updated !'));
    }


    public function updatepassword(Request $request)
    {
        $id = Auth::user()->id;
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|same:c_password',
            'c_password' => 'required|same:password',
        ]);


        $user = Auth::user();

        if (Hash::check($request['old_password'], $user->password)) {
            // Success
            $input['password'] = Hash::make($request['password']);
            $user->update($input);
            return redirect()->back()->with('success',trans('users.Password Updated !'));
        }
        else{
            return redirect()->back()->with('error',trans('users.old password incorrect !'));
        }


    }


    public function updateProfileImage(Request $request)
    {

        $this->validate($request,[
            'profile_image' => 'required',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $image_ex = $image->getClientOriginalName();
            $imageName = date('YmdHis')."_".$image_ex;
            $path = 'storage/images/users/profile_image/';
            $image->move($path, $imageName);
            $input['profile_image'] = $path.$imageName;
        }

        $user = Auth::user();
        $user->update($input);

        return redirect()->back()->with('success',trans('users.Profile Image Updated !'));
    }


    public function my_account()
    {
        $user = Auth::user();
        return view('frontend.users.my_account',compact('user'));
    }


    public function verify_account()
    {
        $user=Auth::user();
        return view('frontend.users.verify_account',compact('user'));
    }

}
