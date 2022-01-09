<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('permission:User_Create')->only('create','store');
        $this->middleware('permission:User_Read')->only('index','show');
        $this->middleware('permission:User_Update')->only('update','edit');
        $this->middleware('permission:User_Delete')->only('delete','destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users=User::paginate(50);
        return view('backend.users.index',compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('backend.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
            'password' => 'required|same:c_password',
            'c_password' => 'required|same:password',
            'gender' => 'required',
            'roles' => 'required',
//            'type_id' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['type_id'] = 1;

        //Email and mobile verification Codes
        $input['email_verify_code']='Verified';
        $input['mobile_verify_code']='Verified';


        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $image_ex = $image->getClientOriginalName();
            $imageName = date('YmdHis')."_".$image_ex;
            $path = 'storage/images/users/profile_image/';
            $image->move($path, $imageName);
            $input['profile_image'] = $path.$imageName;
        }


        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success',trans('users.Account Created !'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('backend.users.show',compact('user','roles','userRole'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('backend.users.edit',compact('user','roles','userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile' => 'required|unique:users,mobile,'.$id,
            'roles' => 'required',
            'gender' => 'required',
        ]);

        $input=[];
        $input["fullname"] = $request->fullname;
        $input["email"] = $request->email;
        $input["mobile"] = $request->mobile;
        $input["gender"] = $request->gender;

        $user = User::find($id);
        $user->update($input);

        $admins_array=[1];
        if(!in_array($id,$admins_array)){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
        }

        return redirect()->back()->with('success',trans('users.Account Updated !'));
    }


    public function updatepassword(Request $request,$id)
    {

        $this->validate($request, [
            'password' => 'required|same:c_password',
            'c_password' => 'required|same:password',
        ]);

        $input['password'] = Hash::make($request['password']);

        $user = User::find($id);
        $user->update($input);

        return redirect()->back()->with('success',trans('users.Password Updated !'));
    }


    public function updateProfileImage(Request $request,$id)
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

        $user = User::find($id);
        $user->update($input);

        return redirect()->back()->with('success',trans('users.Profile Image Updated !'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admins_array=[1];
        if(in_array($id,$admins_array)){
            return redirect()->back()
                ->with('success',trans('users.Cant Delete Admin Account !'));
        }
        //delete image
        $old_image=User::find($id)->profile_image;
        File::delete($old_image);
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success',trans('users.Account Deleted !'));
    }


    public function my_profile()
    {
        $id=Auth::user()->id;
        return redirect()->route('users.edit',$id);
    }

}
