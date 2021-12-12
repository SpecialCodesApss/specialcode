<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News_users_newspapers_follow;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\User;use App\News_newspaper_publisher;

class News_users_newspapers_followController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:News_users_newspapers_follow-list', ['only' => ['index','show']]);
        $this->middleware('permission:News_users_newspapers_follow-create', ['only' => ['create','store']]);
        $this->middleware('permission:News_users_newspapers_follow-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:News_users_newspapers_follow-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = News_users_newspapers_follow::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                        
                     ->editColumn('user_id', function(News_users_newspapers_follow $data) {
                            $user_id_data ='';
                            $info =$data->user_id;
                                $User = User::find($info);
                                $user_id_data.= $User->email ;
                                return $user_id_data;
                        })
                    
                     ->editColumn('newspaper_id', function(News_users_newspapers_follow $data) {
                            $newspaper_id_data ='';
                            $info =$data->newspaper_id;
                                $News_newspaper_publisher = News_newspaper_publisher::find($info);
                                $newspaper_id_data.= $News_newspaper_publisher->newspaper_name_ar ;
                                return $newspaper_id_data;
                        })
                     
                         
                         
                        ->order(function ($data) {
                            $data->orderBy('id', 'desc');
                        })  
                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_News_users_newspapers_follow_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="news_users_newspapers_follows/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="news_users_newspapers_follows/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="news_users_newspapers_follows/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.news_users_newspapers_follows.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = News_users_newspapers_follow::all()->count()+1;
            
            
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                $newspaper_ids=DB::table("news_newspaper_publishers")->orderBy('id', 'asc')->get();
                $news_newspaper_publishers=[];
                foreach ($newspaper_ids as $info){
                    $news_newspaper_publishers[$info->id]=$info->newspaper_name_ar;
                }
                
                return view('backend.news_users_newspapers_follows.create',compact('sort_number','users','news_newspaper_publishers'));
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
                    'newspaper_id'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                


                $News_users_newspapers_follow = News_users_newspapers_follow::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('news_users_newspapers_follows.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('news_users_newspapers_follows.index')
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
                $News_users_newspapers_follow = News_users_newspapers_follow::find($id);
                
                
                
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                $newspaper_ids=DB::table("news_newspaper_publishers")->orderBy('id', 'asc')->get();
                $news_newspaper_publishers=[];
                foreach ($newspaper_ids as $info){
                    $news_newspaper_publishers[$info->id]=$info->newspaper_name_ar;
                }
                
                 


                return view('backend.news_users_newspapers_follows.show',compact('News_users_newspapers_follow'  ,'users','news_newspaper_publishers' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $News_users_newspapers_follow = News_users_newspapers_follow::find($id);
                
                
                
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                $newspaper_ids=DB::table("news_newspaper_publishers")->orderBy('id', 'asc')->get();
                $news_newspaper_publishers=[];
                foreach ($newspaper_ids as $info){
                    $news_newspaper_publishers[$info->id]=$info->newspaper_name_ar;
                }
                
                
                
                
                
                
                return view('backend.news_users_newspapers_follows.edit',compact('News_users_newspapers_follow' ,'users','news_newspaper_publishers' ));
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
            
            $News_users_newspapers_follow = News_users_newspapers_follow::find($id);
                 
            $this->validate($request, [
            'user_id'=>'required',
                    'newspaper_id'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                

                
                $News_users_newspapers_follow->update($input);

                //store images if found
                //store files if found

                return redirect()->route('news_users_newspapers_follows.index')
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
        

                News_users_newspapers_follow::find($id)->delete();
                return redirect()->route('news_users_newspapers_follows.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }