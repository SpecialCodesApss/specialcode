<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;

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

//        if ($request->ajax()) {
//            $data = User::query();
//            return Datatables::eloquent($data)
//                ->order(function ($data) {
//                    $data->orderBy('id', 'desc');
//                })
//                ->editColumn('type', function(User $user) {
//                    if($user->type=="user"){
//                        return 'مستخدم';
//                    }
//                })
//                ->addColumn('action', function($row){
//                    $user_id=$row->id;
//                    $form_id="delete_user_form_".$user_id;
//                    $btn='
//                    <div style="display:inline-block; width: 210px;">
//                    <a class="btn btn-info" href="users/'.$user_id.'">عرض</a>
//                            <a class="btn btn-primary" href="users/'.$user_id.'/edit">تعديل</a>
//                            <form id="delete_user_form_'.$user_id.'" method="POST" action="users/'.$user_id.'" style="display:inline">
//                                <input name="_method" type="hidden" value="DELETE">
//                                <input name="_token" type="hidden" value="'.csrf_token().'">
//                                <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
//                            </form>
//                    </div>
//                    ';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//
//        }
        return view('backend.users.index',compact($users));

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
            'type' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        //Email and mobile verification Codes
        $input['email_verify_code']='Verified';
        $input['mobile_verify_code']='Verified';

        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success','تم اضافة بيانات المستخدم بنجاح');
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
        if($user->type == 'user'){
            $user->type = "عميل";
        }
        if($user->type == 'doctor'){
            $user->type = "دكتور";
        }
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
            'password' => 'same:c_password',
            'c_password' => 'same:password',
            'roles' => 'required',
            'gender' => 'required',
        ]);


        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        //Email and mobile verification Codes
        $input['email_verify_code']='Verified';
        $input['mobile_verify_code']='Verified';

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success','تم تحديث بيانات المستخدم بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success','تم حذف بيانات المستخدم بنجاح');
    }
}
