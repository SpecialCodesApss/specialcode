<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News_comment;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\User;

class News_commentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:News_comment-list', ['only' => ['index','show']]);
        $this->middleware('permission:News_comment-create', ['only' => ['create','store']]);
        $this->middleware('permission:News_comment-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:News_comment-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = News_comment::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                        
                     ->editColumn('user_id', function(News_comment $data) {
                            $user_id_data ='';
                            $info =$data->user_id;
                                $User = User::find($info);
                                $user_id_data.= $User->email ;
                                return $user_id_data;
                        })
                     
                         
                        
                     ->editColumn('active', function(News_comment $data) {
                            if($data->active == "1"){
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
                            $form_id="delete_News_comment_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="news_comments/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="news_comments/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="news_comments/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.news_comments.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = News_comment::all()->count()+1;
            
            
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                return view('backend.news_comments.create',compact('sort_number','users'));
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
                    'comment_text'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                $users_likes_ids=$input["users_likes_ids"];
                $users_likes_ids = str_replace(",","\",\"",$users_likes_ids);
                $users_likes_ids = "[\"".$users_likes_ids."\"]";
                $input["users_likes_ids"]=$users_likes_ids;$users_dislikes_ids=$input["users_dislikes_ids"];
                $users_dislikes_ids = str_replace(",","\",\"",$users_dislikes_ids);
                $users_dislikes_ids = "[\"".$users_dislikes_ids."\"]";
                $input["users_dislikes_ids"]=$users_dislikes_ids;

                


                $News_comment = News_comment::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('news_comments.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('news_comments.index')
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
                $News_comment = News_comment::find($id);
                
                
                
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                 $users_likes_ids = $News_comment->users_likes_ids;
                $users_likes_ids = str_replace("[",'',$users_likes_ids);
                $users_likes_ids = str_replace("]",'',$users_likes_ids);
                $users_likes_ids = str_replace("\"",'',$users_likes_ids);
                $News_comment->users_likes_ids = $users_likes_ids;$users_dislikes_ids = $News_comment->users_dislikes_ids;
                $users_dislikes_ids = str_replace("[",'',$users_dislikes_ids);
                $users_dislikes_ids = str_replace("]",'',$users_dislikes_ids);
                $users_dislikes_ids = str_replace("\"",'',$users_dislikes_ids);
                $News_comment->users_dislikes_ids = $users_dislikes_ids;


                return view('backend.news_comments.show',compact('News_comment'  ,'users' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $News_comment = News_comment::find($id);
                
                
                
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                $users_likes_ids = $News_comment->users_likes_ids;
                $users_likes_ids = str_replace("[",'',$users_likes_ids);
                $users_likes_ids = str_replace("]",'',$users_likes_ids);
                $users_likes_ids = str_replace("\"",'',$users_likes_ids);
                $News_comment->users_likes_ids = $users_likes_ids;$users_dislikes_ids = $News_comment->users_dislikes_ids;
                $users_dislikes_ids = str_replace("[",'',$users_dislikes_ids);
                $users_dislikes_ids = str_replace("]",'',$users_dislikes_ids);
                $users_dislikes_ids = str_replace("\"",'',$users_dislikes_ids);
                $News_comment->users_dislikes_ids = $users_dislikes_ids;
                
                
                
                
                return view('backend.news_comments.edit',compact('News_comment' ,'users' ));
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
            
            $News_comment = News_comment::find($id);
                 
            $this->validate($request, [
            'user_id'=>'required',
                    'comment_text'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                $users_likes_ids=$input["users_likes_ids"];
                $users_likes_ids = str_replace(",","\",\"",$users_likes_ids);
                $users_likes_ids = "[\"".$users_likes_ids."\"]";
                $input["users_likes_ids"]=$users_likes_ids;$users_dislikes_ids=$input["users_dislikes_ids"];
                $users_dislikes_ids = str_replace(",","\",\"",$users_dislikes_ids);
                $users_dislikes_ids = "[\"".$users_dislikes_ids."\"]";
                $input["users_dislikes_ids"]=$users_dislikes_ids;

                

                
                $News_comment->update($input);

                //store images if found
                //store files if found

                return redirect()->route('news_comments.index')
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
        

                News_comment::find($id)->delete();
                return redirect()->route('news_comments.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            public function getusersInfo_for_news_comments_forFieldusers_likes_ids(Request $request){
        $News_comment_id = $request->News_comment_id;
        //get row info
        $News_comment = News_comment::find($News_comment_id);


        $users_info = $News_comment->users_likes_ids;

            $users_info = json_decode($users_info);

            $data = User::orderBy('id', 'desc')->whereIn('email', $users_info)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $module_id = $row->id;
                    $btn = '
                    <div style="display:inline-block; width: 210px;">
                    <a class="btn btn-info" href="users/' . $module_id . '">عرض</a>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
                public function checkusers_for_news_comments_forFieldusers_likes_ids(Request $request){
        $users= $request["email"];
        $User = User::where("email",$users)->first();
        if(isset($User)){
            return "true";
        }
        else{
            return "false";
        }
    }
    public function searchusers_for_news_comments_forFieldusers_likes_ids(Request $request){
        $search_text = $request["search_text"];
        $response_array=[];
        $users = User::where("email",'like','%'.$search_text.'%')->get('email');
        foreach ($users as $User){
            array_push($response_array,$User->email);
        }
        return $response_array;
    }public function getusersInfo_for_news_comments_forFieldusers_dislikes_ids(Request $request){
        $News_comment_id = $request->News_comment_id;
        //get row info
        $News_comment = News_comment::find($News_comment_id);


        $users_info = $News_comment->users_dislikes_ids;

            $users_info = json_decode($users_info);

            $data = User::orderBy('id', 'desc')->whereIn('email', $users_info)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $module_id = $row->id;
                    $btn = '
                    <div style="display:inline-block; width: 210px;">
                    <a class="btn btn-info" href="users/' . $module_id . '">عرض</a>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
                public function checkusers_for_news_comments_forFieldusers_dislikes_ids(Request $request){
        $users= $request["email"];
        $User = User::where("email",$users)->first();
        if(isset($User)){
            return "true";
        }
        else{
            return "false";
        }
    }
    public function searchusers_for_news_comments_forFieldusers_dislikes_ids(Request $request){
        $search_text = $request["search_text"];
        $response_array=[];
        $users = User::where("email",'like','%'.$search_text.'%')->get('email');
        foreach ($users as $User){
            array_push($response_array,$User->email);
        }
        return $response_array;
    }
            
            
            

        }