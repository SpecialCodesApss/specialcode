<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin_message;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;

use App\Models\User;

class Admin_messageController extends Controller
{

    use file_type_traits;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

        $this->middleware('permission:Admin_message_Create', ['only' => ['create','store']]);
        $this->middleware('permission:Admin_message_Read', ['only' => ['index','show']]);
        $this->middleware('permission:Admin_message_Update', ['only' => ['update','edit']]);
        $this->middleware('permission:Admin_message_Delete', ['only' => ['delete','destroy']]);

    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Admin_message::query();








                    return Datatables::eloquent($data)


                     ->editColumn('message_type', function(Admin_message $data) {

                            if($data->message_type=="Complaint"){
                            return trans('admin_messages.Complaint');
                            }
                            if($data->message_type=="Suggestion"){
                            return trans('admin_messages.Suggestion');
                            }
                            if($data->message_type=="Technical Support"){
                            return trans('admin_messages.Technical Support');
                            }
                            if($data->message_type=="Management"){
                            return trans('admin_messages.Management');
                            }
                        })

                     ->editColumn('open_status', function(Admin_message $data) {

                            if($data->open_status=="open"){
                            return trans('admin_messages.Open');
                            }
                            if($data->open_status=="closed"){
                            return trans('admin_messages.Closed');
                            }
                        })


                     ->editColumn('user_id', function(Admin_message $data) {
                            $user_id_data ='';
                            $info =$data->user_id;
                            if($info != null){
                                $User = User::find($info);
                                $user_id_data.= $User->email ;
                                }
                                return $user_id_data;
                        })


                     ->editColumn('marked_as_readed', function(Admin_message $data) {
                            if($data->marked_as_readed != null){
                              return trans("admin.yes");
                            }
                            else{
                                return trans("admin.no");
                            }
                        })

                     ->editColumn('marked_as_deleted', function(Admin_message $data) {
                            if($data->marked_as_deleted != null){
                              return trans("admin.yes");
                            }
                            else{
                                return trans("admin.no");
                            }
                        })



                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Admin_message_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="icon-btn" href="admin_messages/'.$row_id.'"><i class="fa fa-eye text-view"></i></a>
            <a class="icon-btn" href="admin_messages/'.$row_id.'/edit"><i class="fa fa-pencil text-edit"></i></a>
            <form id="'.$form_id.'" method="POST" action="admin_messages/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')"
                                        class="btn icon-btn"><i class="fa fa-trash text-delete"></i></button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.admin_messages.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Admin_message::all()->count()+1;


                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                $users[""]="";
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }

                return view('backend.admin_messages.create',compact('sort_number','users'));
            }

            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {

                $lang = App::getLocale();

            $this->validate($request, [
            'fullname'=>'required',
                    'email'=>'required',
                    'mobile'=>'required',
                    'message_type'=>'required',
                    'messages_text'=>'required',

        ]);



                $input["fullname"]=$request->fullname;
                $input["email"]=$request->email;
                $input["mobile"]=$request->mobile;
                $input["message_type"]=$request->message_type;
                $input["messages_text"]=$request->messages_text;
                $input["open_status"]=$request->open_status;
                $input["marked_as_readed"]=$request->marked_as_readed;
                $input["marked_as_deleted"]=$request->marked_as_deleted;


                        if(isset($input['marked_as_readed'])){
                        $input['marked_as_readed']= 1;
                        }else{
                        $input['marked_as_readed']= 0;
                        }

                        if(isset($input['marked_as_deleted'])){
                        $input['marked_as_deleted']= 1;
                        }else{
                        $input['marked_as_deleted']= 0;
                        }





                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/admin_messages/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                    }
                }



                $Admin_message = Admin_message::create($input);

                //store images if found
                //store files if found


                if($request->save_type=="save_and_add_new"){
                    return redirect()->route('admin_messages.create')
                        ->with('success',trans('admin.info_added'));
                }
                else{
                    return redirect()->route('admin_messages.index')
                        ->with('success',trans('admin.info_added'));
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
            $lang = App::getLocale();
                $Admin_message = Admin_message::find($id);




                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }

                $Admin_message->update([
                    'marked_as_readed' => 1
                ]);




                return view('backend.admin_messages.show',compact('Admin_message'  ,'users' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {

            $lang = App::getLocale();
                $Admin_message = Admin_message::find($id);




                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                $users[""]="";
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }


                $Admin_message->update([
                    'marked_as_readed' => 1
                ]);



                return view('backend.admin_messages.edit',compact('Admin_message'
                ,'users' ));
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

            $Admin_message = Admin_message::find($id);

            $this->validate($request, [
            'fullname'=>'required',
                    'email'=>'required',
                    'mobile'=>'required',
                    'message_type'=>'required',
                    'messages_text'=>'required',

        ]);



                $input["fullname"]=$request->fullname;
                $input["email"]=$request->email;
                $input["mobile"]=$request->mobile;
                $input["message_type"]=$request->message_type;
                $input["messages_text"]=$request->messages_text;
                $input["open_status"]=$request->open_status;
                $input["marked_as_readed"]=$request->marked_as_readed;
                $input["marked_as_deleted"]=$request->marked_as_deleted;


                        if(isset($input['marked_as_readed'])){
                        $input['marked_as_readed']= 1;
                        }else{
                        $input['marked_as_readed']= 0;
                        }

                        if(isset($input['marked_as_deleted'])){
                        $input['marked_as_deleted']= 1;
                        }else{
                        $input['marked_as_deleted']= 0;
                        }





                $old_image=Admin_message::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/admin_messages/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }



                $Admin_message->update($input);

                //store images if found
                //store files if found

                return redirect()->route('admin_messages.index')
                    ->with('success',trans('admin.info_edited'));
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

                $old_image=Admin_message::find($id)->image;
                 File::delete($old_image);


                 // delete files and images in sub tables if this module has mutiple files or images


                Admin_message::find($id)->delete();
                return redirect()->route('admin_messages.index')
                    ->with('success',trans('admin.info_deleted'));
            }

            //additional Functions









        }
