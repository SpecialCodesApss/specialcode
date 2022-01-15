<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin_notification;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;

use App\Models\Notifications_text;use App\Models\User;

class Admin_notificationController extends Controller
{

    use file_type_traits;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

        $this->middleware('permission:Admin_notification_Create', ['only' => ['create','store']]);
        $this->middleware('permission:Admin_notification_Read', ['only' => ['index','show']]);
        $this->middleware('permission:Admin_notification_Update', ['only' => ['update','edit']]);
        $this->middleware('permission:Admin_notification_Delete', ['only' => ['delete','destroy']]);

    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

               $lang = App::getLocale();

                if ($request->ajax()) {
                    $data = Admin_notification::query()->where('is_marked_as_deleted','0');
                    return Datatables::eloquent($data)

                     ->editColumn('notification_id', function(Admin_notification $data) use($lang) {
                            $notification_id_data ='';
                            $info =$data->notification_id;
                                $Notifications_text = Notifications_text::find($info);
                                $notification_id_data.= $Notifications_text->{"description_text_".$lang} ;
                                return $notification_id_data;
                        })
//
//                     ->editColumn('module_id', function(Admin_notification $data) {
//                            $module_id_data ='';
//                            $info =$data->module_id;
//                            $module_name=$data->module_name;
//
//                            //add_module_notification_here
//                            if($module_name=="users"){
//                                $User=User::find($info);
//                                $module_id_data.= $User->fullname ;
//                            }
//                            return $module_id_data;
//                        })
//

                     ->editColumn('is_marked_as_readed', function(Admin_notification $data) {
                            if($data->is_marked_as_readed != null){
                              return trans("admin_messages.yes");
                            }
                            else{
                                return trans("admin_messages.no");
                            }
                        })

                     ->editColumn('is_marked_as_deleted', function(Admin_notification $data) {
                            if($data->is_marked_as_deleted != null){
                              return trans("admin_messages.yes");
                            }
                            else{
                                return trans("admin_messages.no");
                            }
                        })

                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Admin_notification_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="icon-btn" target="_blank" href="admin_notifications/'.$row_id.'"><i class="fa fa-eye text-view"></i></a>
            <form id="'.$form_id.'" method="POST" action="admin_notifications/'.$row_id.'" style="display:inline">
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
                return view('backend.admin_notifications.index');

            }


            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Admin_notification::all()->count()+1;

                $notification_ids=DB::table("notifications_texts")->orderBy('id', 'asc')->get();
                $notifications_texts=[];
                foreach ($notification_ids as $info){
                    $notifications_texts[$info->id]=$info->{'description_text_'.$lang} ;
                }

                $model_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($model_ids as $info){
                    $users[$info->id]=$info->email;
                }

                return view('backend.admin_notifications.create',compact('sort_number',
                    'notifications_texts','users'));
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
            'notification_id'=>'required',
                    'model_id'=>'required',
            ]);

                $input["notification_id"]=$request->notification_id;
                $input["model_id"]=$request->model_id;
                $input["is_marked_as_readed"]=$request->is_marked_as_readed;
                $input["is_marked_as_deleted"]=$request->is_marked_as_deleted;

                        if(isset($input['is_marked_as_readed'])){
                        $input['is_marked_as_readed']= 1;
                        }else{
                        $input['is_marked_as_readed']= 0;
                        }

                        if(isset($input['is_marked_as_deleted'])){
                        $input['is_marked_as_deleted']= 1;
                        }else{
                        $input['is_marked_as_deleted']= 0;
                        }

                $Admin_notification = Admin_notification::create($input);

                if($request->save_type=="save_and_add_new"){
                    return redirect()->route('admin_notifications.create')
                        ->with('success',trans('admin_messages.info_added'));
                }
                else{
                    return redirect()->route('admin_notifications.index')
                        ->with('success',trans('admin_messages.info_added'));
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
                $Admin_notification = Admin_notification::find($id);


                //mark this notification readed
                $input['is_marked_as_readed']= 1;
                $Admin_notification->update($input);

                $notification_id=$Admin_notification->notification_id;
                //notification basic data
                $notification=Notifications_text::find($notification_id);
                $notification_url =$notification->target_url;
                $notification_url=str_replace("##module_name##",$Admin_notification->module_name,$notification_url);
                $notification_url=str_replace("##module_id##",$Admin_notification->module_id,$notification_url);


                return redirect($notification_url);

                //return to module
//                $notification_ids=DB::table("notifications_texts")->orderBy('id', 'asc')->get();
//                $notifications_texts=[];
//                foreach ($notification_ids as $info){
//                    $notifications_texts[$info->id]=$info->{'description_text_'.$lang} ;
//                }
//
//                $model_ids=DB::table("users")->orderBy('id', 'asc')->get();
//                $users=[];
//                foreach ($model_ids as $info){
//                    $users[$info->id]=$info->email;
//                }
//                return view('backend.admin_notifications.show',compact('Admin_notification'  ,'notifications_texts','users' ));

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
                $Admin_notification = Admin_notification::find($id);




                $notification_ids=DB::table("notifications_texts")->orderBy('id', 'asc')->get();
                $notifications_texts=[];
                foreach ($notification_ids as $info){
                    $notifications_texts[$info->id]=$info->{'description_text_'.$lang} ;
                }

                $model_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($model_ids as $info){
                    $users[$info->id]=$info->email;
                }






                return view('backend.admin_notifications.edit',compact('Admin_notification'
                ,'notifications_texts','users' ));
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

            $Admin_notification = Admin_notification::find($id);

            $this->validate($request, [
            'notification_id'=>'required',
                    'model_id'=>'required',

        ]);



                $input["notification_id"]=$request->notification_id;
                $input["model_id"]=$request->model_id;
                $input["is_marked_as_readed"]=$request->is_marked_as_readed;
                $input["is_marked_as_deleted"]=$request->is_marked_as_deleted;


                        if(isset($input['is_marked_as_readed'])){
                        $input['is_marked_as_readed']= 1;
                        }else{
                        $input['is_marked_as_readed']= 0;
                        }

                        if(isset($input['is_marked_as_deleted'])){
                        $input['is_marked_as_deleted']= 1;
                        }else{
                        $input['is_marked_as_deleted']= 0;
                        }







                $Admin_notification->update($input);

                //store images if found
                //store files if found

                return redirect()->route('admin_notifications.index')
                    ->with('success',trans('admin_messages.info_edited'));
            }

            /**
             * Remove the specified resource from storage.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
                $input['is_marked_as_deleted']= 1;
//                Admin_notification::find($id)->delete();
                Admin_notification::find($id)->update($input);
                return redirect()->route('admin_notifications.index')
                    ->with('success',trans('admin_messages.info_deleted'));
            }

            //additional Functions
            public function mark_all_read(){
                Admin_notification::where('is_marked_as_readed',0)
                    ->update([
                        'is_marked_as_readed' => 1
                    ]);
                return redirect()->back();
            }





        }
