<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Companies_review;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\Companie;use App\User;

class Companies_reviewController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Companies_review-list', ['only' => ['index','show']]);
        $this->middleware('permission:Companies_review-create', ['only' => ['create','store']]);
        $this->middleware('permission:Companies_review-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Companies_review-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Companies_review::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                        
                     ->editColumn('rate_stars_count', function(Companies_review $data) {
                                
                            if($data->rate_stars_count=="1"){
                            return '1';
                            }
                            if($data->rate_stars_count=="2"){
                            return '2';
                            }
                            if($data->rate_stars_count=="3"){
                            return '3';
                            }
                            if($data->rate_stars_count=="4"){
                            return '4';
                            }
                            if($data->rate_stars_count=="5"){
                            return '5';
                            }
                        })
                       
                        
                     ->editColumn('company_id', function(Companies_review $data) {
                            $company_id_data ='';
                            $info =$data->company_id;
                                $Companie = Companie::find($info);
                                $company_id_data.= $Companie->company_name_ar ;
                                return $company_id_data;
                        })
                    
                     ->editColumn('user_id', function(Companies_review $data) {
                            $user_id_data ='';
                            $info =$data->user_id;
                                $User = User::find($info);
                                $user_id_data.= $User->email ;
                                return $user_id_data;
                        })
                     
                         
                        
                     ->editColumn('active', function(Companies_review $data) {
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
                            $form_id="delete_Companies_review_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="companies_reviews/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="companies_reviews/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="companies_reviews/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.companies_reviews.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Companies_review::all()->count()+1;
            
            
                $company_ids=DB::table("companies")->orderBy('id', 'asc')->get();
                $companies=[];
                foreach ($company_ids as $info){
                    $companies[$info->id]=$info->company_name_ar;
                }
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                return view('backend.companies_reviews.create',compact('sort_number','companies','users'));
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
            'company_id'=>'required',
                    'user_id'=>'required',
                    'rate_stars_count'=>'required',
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

                


                $Companies_review = Companies_review::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('companies_reviews.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('companies_reviews.index')
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
                $Companies_review = Companies_review::find($id);
                
                
                
                
                $company_ids=DB::table("companies")->orderBy('id', 'asc')->get();
                $companies=[];
                foreach ($company_ids as $info){
                    $companies[$info->id]=$info->company_name_ar;
                }
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                 $users_likes_ids = $Companies_review->users_likes_ids;
                $users_likes_ids = str_replace("[",'',$users_likes_ids);
                $users_likes_ids = str_replace("]",'',$users_likes_ids);
                $users_likes_ids = str_replace("\"",'',$users_likes_ids);
                $Companies_review->users_likes_ids = $users_likes_ids;$users_dislikes_ids = $Companies_review->users_dislikes_ids;
                $users_dislikes_ids = str_replace("[",'',$users_dislikes_ids);
                $users_dislikes_ids = str_replace("]",'',$users_dislikes_ids);
                $users_dislikes_ids = str_replace("\"",'',$users_dislikes_ids);
                $Companies_review->users_dislikes_ids = $users_dislikes_ids;


                return view('backend.companies_reviews.show',compact('Companies_review'  ,'companies','users' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Companies_review = Companies_review::find($id);
                
                
                
                
                $company_ids=DB::table("companies")->orderBy('id', 'asc')->get();
                $companies=[];
                foreach ($company_ids as $info){
                    $companies[$info->id]=$info->company_name_ar;
                }
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                $users_likes_ids = $Companies_review->users_likes_ids;
                $users_likes_ids = str_replace("[",'',$users_likes_ids);
                $users_likes_ids = str_replace("]",'',$users_likes_ids);
                $users_likes_ids = str_replace("\"",'',$users_likes_ids);
                $Companies_review->users_likes_ids = $users_likes_ids;$users_dislikes_ids = $Companies_review->users_dislikes_ids;
                $users_dislikes_ids = str_replace("[",'',$users_dislikes_ids);
                $users_dislikes_ids = str_replace("]",'',$users_dislikes_ids);
                $users_dislikes_ids = str_replace("\"",'',$users_dislikes_ids);
                $Companies_review->users_dislikes_ids = $users_dislikes_ids;
                
                
                
                
                return view('backend.companies_reviews.edit',compact('Companies_review' ,'companies','users' ));
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
            
            $Companies_review = Companies_review::find($id);
                 
            $this->validate($request, [
            'company_id'=>'required',
                    'user_id'=>'required',
                    'rate_stars_count'=>'required',
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

                

                
                $Companies_review->update($input);

                //store images if found
                //store files if found

                return redirect()->route('companies_reviews.index')
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
        

                Companies_review::find($id)->delete();
                return redirect()->route('companies_reviews.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            public function getusersInfo_for_companies_reviews_forFieldusers_likes_ids(Request $request){
        $Companies_review_id = $request->Companies_review_id;
        //get row info
        $Companies_review = Companies_review::find($Companies_review_id);


        $users_info = $Companies_review->users_likes_ids;

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
                public function checkusers_for_companies_reviews_forFieldusers_likes_ids(Request $request){
        $users= $request["email"];
        $User = User::where("email",$users)->first();
        if(isset($User)){
            return "true";
        }
        else{
            return "false";
        }
    }
    public function searchusers_for_companies_reviews_forFieldusers_likes_ids(Request $request){
        $search_text = $request["search_text"];
        $response_array=[];
        $users = User::where("email",'like','%'.$search_text.'%')->get('email');
        foreach ($users as $User){
            array_push($response_array,$User->email);
        }
        return $response_array;
    }public function getusersInfo_for_companies_reviews_forFieldusers_dislikes_ids(Request $request){
        $Companies_review_id = $request->Companies_review_id;
        //get row info
        $Companies_review = Companies_review::find($Companies_review_id);


        $users_info = $Companies_review->users_dislikes_ids;

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
                public function checkusers_for_companies_reviews_forFieldusers_dislikes_ids(Request $request){
        $users= $request["email"];
        $User = User::where("email",$users)->first();
        if(isset($User)){
            return "true";
        }
        else{
            return "false";
        }
    }
    public function searchusers_for_companies_reviews_forFieldusers_dislikes_ids(Request $request){
        $search_text = $request["search_text"];
        $response_array=[];
        $users = User::where("email",'like','%'.$search_text.'%')->get('email');
        foreach ($users as $User){
            array_push($response_array,$User->email);
        }
        return $response_array;
    }
            
            
            

        }