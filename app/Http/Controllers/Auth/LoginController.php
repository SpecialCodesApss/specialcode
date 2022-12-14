<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        $user=Auth::user();

        if ($user->hasRole(['super_admin','admin','moderator'])) {
            return redirect('admin/dashboard');
        }
        else{
            return redirect('/home');
        }

//        if ($user->hasRole(['super_admin','admin','moderator'])) {
//            return 'admin/dashboard';
//        }
//        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password'])))
        {

            $user=Auth::user();
            if ($user->hasRole(['super_admin','admin','moderator'])) {
                return redirect('admin/dashboard');
            }
            else{
                return redirect('/home');
            }

//            return redirect()->route('home');
        }else{

            return redirect()->route('login')
                ->withErrors([
                    "mobile" => [trans('auth.failed')],
                ]);
        }

    }
}
