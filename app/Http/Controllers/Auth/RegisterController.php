<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'max:255', 'unique:users'],
            'gender' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {



        if (isset($data['profile_image'])){
            $photo = $data['profile_image'];
            $photodest = 'storage/images/users/profile_image/';
            $photoname = date('YmdHis')."_".rand(1000,9999).'_'.$photo->getClientOriginalName();
            $photo->move($photodest,$photoname);
            $photo=$photodest.$photoname;
            $data['profile_image']=$photo;
        }
        else{
            $data['profile_image']=null;
        }


        return User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'gender' =>  $data['gender'],
            'profile_image' =>  $data['profile_image'],
            'email_verify_code' => "1234",
            'mobile_verify_code' => "1234",
            'active' => "0",
            'password' => Hash::make($data['password']),
        ]);
    }
}
