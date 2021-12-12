<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News_users_notifications_setting;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\User;

class News_users_notifications_settingController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:News_users_notifications_setting-list', ['only' => ['index','show']]);
        $this->middleware('permission:News_users_notifications_setting-create', ['only' => ['create','store']]);
        $this->middleware('permission:News_users_notifications_setting-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:News_users_notifications_setting-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = News_users_notifications_setting::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                        
                     ->editColumn('notification_type', function(News_users_notifications_setting $data) {
                                
                            if($data->notification_type=="every day"){
                            return 'كل يوم';
                            }
                            if($data->notification_type=="every week"){
                            return 'كل اسبوع';
                            }
                            if($data->notification_type=="every month"){
                            return 'كل شهر';
                            }
                        })
                       
                        
                     ->editColumn('user_id', function(News_users_notifications_setting $data) {
                            $user_id_data ='';
                            $info =$data->user_id;
                                $User = User::find($info);
                                $user_id_data.= $User->email ;
                                return $user_id_data;
                        })
                     
                         
                        
                     ->editColumn('active_notification', function(News_users_notifications_setting $data) {
                            if($data->active_notification == "1"){
                              return "مفعل";  
                            }
                            else{
                                return "غير مفعل";
                            }                      
                        })
                     
                        ->order(function ($data) {
                            $data->orderBy('id', 'desc');
                        })  
                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_News_users_notifications_setting_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="news_users_notifications_settings/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="news_users_notifications_settings/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="news_users_notifications_settings/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.news_users_notifications_settings.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = News_users_notifications_setting::all()->count()+1;
            
            
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                return view('backend.news_users_notifications_settings.create',compact('sort_number','users'));
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
            'user_id'=>'required',
                    'active_notification'=>'required',
                    'notification_type'=>'required',
                    
        ]);
        

                $input = $request->all();
                $user_id=$input['user_id'];

                $secured_input=[];
                $secured_input['user_id']=$input['user_id'];
                $secured_input['active_notification']=$input['active_notification'];
                $secured_input['notification_type']=$input['notification_type'];

                //check if this inserted before
                $is_inserted = News_users_notifications_setting::where('user_id',$user_id)->first();

                if(isset($is_inserted)){
                    News_users_notifications_setting::where('user_id',$user_id)->
                    update($secured_input);
                }
                else{
                    $News_users_notifications_setting = News_users_notifications_setting::create($secured_input);
                }



                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('news_users_notifications_settings.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('news_users_notifications_settings.index')
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
                $News_users_notifications_setting = News_users_notifications_setting::find($id);
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }

                return view('backend.news_users_notifications_settings.show',compact('News_users_notifications_setting'  ,'users' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $News_users_notifications_setting = News_users_notifications_setting::find($id);
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }

                return view('backend.news_users_notifications_settings.edit',compact('News_users_notifications_setting' ,'users' ));
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
            
            $News_users_notifications_setting = News_users_notifications_setting::find($id);
                 
            $this->validate($request, [
            'user_id'=>'required',
                    'active_notification'=>'required',
                    'notification_type'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                

                
                $News_users_notifications_setting->update($input);

                //store images if found
                //store files if found

                return redirect()->route('news_users_notifications_settings.index')
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
        

                News_users_notifications_setting::find($id)->delete();
                return redirect()->route('news_users_notifications_settings.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }