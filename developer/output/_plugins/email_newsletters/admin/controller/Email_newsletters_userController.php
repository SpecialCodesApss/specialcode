<?php
namespace App\Http\Controllers\admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Email_newsletters_user;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;



class Email_newsletters_userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');

        $this->middleware('permission:Email_newsletters_user-list', ['only' => ['index','show']]);
        $this->middleware('permission:Email_newsletters_user-create', ['only' => ['create','store']]);
        $this->middleware('permission:Email_newsletters_user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Email_newsletters_user-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Email_newsletters_user::query();

            return Datatables::eloquent($data)

                ->order(function ($data) {
                    $data->orderBy('id', 'desc');
                })
                ->addColumn('action', function($row){
                    $row_id=$row->id;
                    $form_id="delete_Email_newsletters_user_form_".$row_id;
                    $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="email_newsletters_users/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="email_newsletters_users/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="email_newsletters_users/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                    return $btn;
                })
                ->rawColumns(['action'])

                ->make(true);
        }
        return view('backend.email_newsletters_users.index');

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort_number = Email_newsletters_user::all()->count()+1;


        $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
        $users=[];
        $users[""]="غير مسجل";
        foreach ($user_ids as $info){
            $users[$info->id]=$info->email;
        }

        return view('backend.email_newsletters_users.create',compact('sort_number','users'));
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
            'user_id'=>'required_if:email,!=,null',
            'email'=>'required_if:user_id,!=,null',
        ]);


        $input = $request->all();
        $user_id=$input['user_id'];
        $email=$input['email'];

        //check if user id != null and is inserted before
        if($user_id != null){
            $news_user = Email_newsletters_user::where([
                'user_id'=>$user_id,
            ])->first();
            if(isset($news_user)) {
                return back()->with('error', 'هذا البريد مسجل لدينا في النشرة البريديه مسبقا');
            }

            //get user email
            $user = User::find($user_id);
            $email = $user->email;
            $input['email'] = $email;

            $news_user = Email_newsletters_user::where([
                'email'=>$email,
            ])->first();
            if(isset($news_user)){
                return back()->with('error','هذا البريد مسجل لدينا في النشرة البريديه مسبقا');
            }
        }

        if($email != null){
            $news_user = Email_newsletters_user::where([
                'email'=>$email,
            ])->first();
            if(isset($news_user)){
                return back()->with('error','هذا البريد مسجل لدينا في النشرة البريديه مسبقا');
            }

            $input['email'] = $email;
        }

        $Email_newsletters_user = Email_newsletters_user::create($input);

        //store images if found
        //store files if found


        if($input['save_type']=="save_and_add_new"){
            return redirect()->route('email_newsletters_users.create')
                ->with('success','تم اضافة البيانات بنجاح');
        }
        else{
            return redirect()->route('email_newsletters_users.index')
                ->with('success','تم اضافة البيانات بنجاح');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Email_newsletters_user = Email_newsletters_user::find($id);
        $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
        $users=[];
        $users[""]="غير مسجل";
        foreach ($user_ids as $info){
            $users[$info->id]=$info->email;
        }




        return view('backend.email_newsletters_users.show',compact('Email_newsletters_user'  ,'users' ));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Email_newsletters_user = Email_newsletters_user::find($id);
        $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
        $users=[];
        $users[""]="غير مسجل";
        foreach ($user_ids as $info){
            $users[$info->id]=$info->email;
        }

        return view('backend.email_newsletters_users.edit',compact('Email_newsletters_user' ,'users' ));
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

        $Email_newsletters_user = Email_newsletters_user::find($id);

//            $this->validate($request, [
//            'user_id'=>'required|unique:email_newsletters_users,user_id,'.$Email_newsletters_user->id.',id',
//                    'email'=>'required|unique:email_newsletters_users,email,'.$Email_newsletters_user->id.',id',
//
//        ]);

        $this->validate($request, [
            'user_id'=>'required_if:email,!=,null',
            'email'=>'required_if:user_id,!=,null',
        ]);


        $input = $request->all();
        $user_id=$input['user_id'];
        $email=$input['email'];

        //check if user id != null and is inserted before
        if($user_id != null){
            $news_user = Email_newsletters_user::where([
                'user_id'=>$user_id,
                ['id','!=', $id],
            ])->first();
            if(isset($news_user)) {
                return back()->with('error', 'هذا البريد مسجل لدينا في النشرة البريديه مسبقا');
            }

            //get user email
            $user = User::find($user_id);
            $email = $user->email;
            $input['email'] = $email;

            $news_user = Email_newsletters_user::where([
                'email'=>$email,
                ['id','!=', $id],
            ])->first();
            if(isset($news_user)){
                return back()->with('error','هذا البريد مسجل لدينا في النشرة البريديه مسبقا');
            }
        }

        if($email != null){
            $news_user = Email_newsletters_user::where([
                'email'=>$email,
                ['id','!=', $id],
            ])->first();
            if(isset($news_user)){
                return back()->with('error','هذا البريد مسجل لدينا في النشرة البريديه مسبقا');
            }

            $input['email'] = $email;
        }

        $Email_newsletters_user->update($input);

        //store images if found
        //store files if found

        return redirect()->route('email_newsletters_users.index')
            ->with('success','تم تحديث البيانات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete files and images


        // delete files and images in sub tables if this module has mutiple files or images


        Email_newsletters_user::find($id)->delete();
        return redirect()->route('email_newsletters_users.index')
            ->with('success','تم حذف البيانات بنجاح');
    }

    //additional Functions









}