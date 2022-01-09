<?php


namespace App\Http\Controllers\admin;
use App\Role;
use Illuminate\Http\Request;
use Auth;


class LoginController
{

    /**
     * view login page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()){
            $user = Auth::user();
            if ($user->hasRole(['super_admin','admin','moderator'])) {
                return redirect('admin/dashboard');
            }
            else{
                return redirect('/home');
            }
//            $user_id=Auth::user()->id;
//            $user_role=Role::find($user_id);
//            if ($user_role->name == 'super_admin') {
//                return redirect('admin/dashboard');
//            }
//            else{
//                return redirect('login');
//            }
        }

        $theme_name = config('global.theme_name');
        return view('themes::admin.'.$theme_name.'.auth.login');

    }

    /**
     * post login page
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {

    }


}
