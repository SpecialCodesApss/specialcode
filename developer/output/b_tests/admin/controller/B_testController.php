<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\B_test;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\Banner;use App\Language;

class B_testController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:B_test-list', ['only' => ['index','show']]);
        $this->middleware('permission:B_test-create', ['only' => ['create','store']]);
        $this->middleware('permission:B_test-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:B_test-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = B_test::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                         
                        ->order(function ($data) {
                            $data->orderBy('id', 'desc');
                        })  
                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_B_test_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="b_tests/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="b_tests/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="b_tests/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.b_tests.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = B_test::all()->count()+1;
            
            
                return view('backend.b_tests.create',compact('sort_number'));
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
            'users_ids'=>'required',
                    'pages_id'=>'required',
                    'table_ids'=>'required',
                    'page_html'=>'required',
                    'test_2'=>'required',
                    'email'=>'required',
                    'image'=>'required',
                    'type'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                $users_ids=$input["users_ids"];
                $users_ids = str_replace(",","\",\"",$users_ids);
                $users_ids = "[\"".$users_ids."\"]";
                $input["users_ids"]=$users_ids;$table_ids=$input["table_ids"];
                $table_ids = str_replace(",","\",\"",$table_ids);
                $table_ids = "[\"".$table_ids."\"]";
                $input["table_ids"]=$table_ids;

                
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/b_tests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                    }
                }
                


                $B_test = B_test::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('b_tests.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('b_tests.index')
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
                $B_test = B_test::find($id);
                
                
                
                
                 $users_ids = $B_test->users_ids;
                $users_ids = str_replace("[",'',$users_ids);
                $users_ids = str_replace("]",'',$users_ids);
                $users_ids = str_replace("\"",'',$users_ids);
                $B_test->users_ids = $users_ids;$table_ids = $B_test->table_ids;
                $table_ids = str_replace("[",'',$table_ids);
                $table_ids = str_replace("]",'',$table_ids);
                $table_ids = str_replace("\"",'',$table_ids);
                $B_test->table_ids = $table_ids;


                return view('backend.b_tests.show',compact('B_test'   ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $B_test = B_test::find($id);
                
                
                
                
                $users_ids = $B_test->users_ids;
                $users_ids = str_replace("[",'',$users_ids);
                $users_ids = str_replace("]",'',$users_ids);
                $users_ids = str_replace("\"",'',$users_ids);
                $B_test->users_ids = $users_ids;$table_ids = $B_test->table_ids;
                $table_ids = str_replace("[",'',$table_ids);
                $table_ids = str_replace("]",'',$table_ids);
                $table_ids = str_replace("\"",'',$table_ids);
                $B_test->table_ids = $table_ids;
                
                
                
                
                return view('backend.b_tests.edit',compact('B_test'  ));
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
            'users_ids'=>'required',
                    'pages_id'=>'required',
                    'table_ids'=>'required',
                    'page_html'=>'required',
                    'test_2'=>'required',
                    'email'=>'required',
                    'type'=>'required',
                    
        ]);
        

                $input = $request->all();
                $users_ids=$input["users_ids"];
                $users_ids = str_replace(",","\",\"",$users_ids);
                $users_ids = "[\"".$users_ids."\"]";
                $input["users_ids"]=$users_ids;$table_ids=$input["table_ids"];
                $table_ids = str_replace(",","\",\"",$table_ids);
                $table_ids = "[\"".$table_ids."\"]";
                $input["table_ids"]=$table_ids;

                
                $old_image=B_test::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/b_tests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }
                

                $B_test = B_test::find($id);
                $B_test->update($input);

                //store images if found
                //store files if found

                return redirect()->route('b_tests.index')
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
        
                $old_image=B_test::find($id)->image;
                 File::delete($old_image);
                

                 // delete files and images in sub tables if this module has mutiple files or images
        

                B_test::find($id)->delete();
                return redirect()->route('b_tests.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            public function getbannersInfo_for_b_tests(Request $request){
        $B_test_id = $request->B_test_id;
        //get row info
        $B_test = B_test::find($B_test_id);


        $banners_info = $B_test->banners_ids;

            $banners_info = json_decode($banners_info);

            $data = Banner::orderBy('id', 'desc')->whereIn('id', $banners_info)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $user_id = $row->id;
                    $btn = '
                    <div style="display:inline-block; width: 210px;">
                    <a class="btn btn-info" href="banners/' . $user_id . '">عرض</a>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
                public function checkbanners_for_b_tests(Request $request){
        $banners= $request["id"];
        $Banner = Banner::where("id",$banners)->first();
        if(isset($Banner)){
            return "true";
        }
        else{
            return "false";
        }
    }
    public function searchbanners_for_b_tests(Request $request){
        $search_text = $request["search_text"];
        $response_array=[];
        $banners = Banner::where("id",'like','%'.$search_text.'%')->get('id');
        foreach ($banners as $Banner){
            array_push($response_array,$Banner->id);
        }
        return $response_array;
    }public function getlanguagesInfo_for_b_tests(Request $request){
        $B_test_id = $request->B_test_id;
        //get row info
        $B_test = B_test::find($B_test_id);


        $languages_info = $B_test->languages_ids;

            $languages_info = json_decode($languages_info);

            $data = Language::orderBy('id', 'desc')->whereIn('id', $languages_info)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $user_id = $row->id;
                    $btn = '
                    <div style="display:inline-block; width: 210px;">
                    <a class="btn btn-info" href="languages/' . $user_id . '">عرض</a>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
                public function checklanguages_for_b_tests(Request $request){
        $languages= $request["id"];
        $Language = Language::where("id",$languages)->first();
        if(isset($Language)){
            return "true";
        }
        else{
            return "false";
        }
    }
    public function searchlanguages_for_b_tests(Request $request){
        $search_text = $request["search_text"];
        $response_array=[];
        $languages = Language::where("id",'like','%'.$search_text.'%')->get('id');
        foreach ($languages as $Language){
            array_push($response_array,$Language->id);
        }
        return $response_array;
    }
            
            
            

        }