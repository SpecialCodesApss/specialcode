<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News_favorite;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\News;
use App\User;

class News_favoriteController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:News_favorite-list', ['only' => ['index','show']]);
        $this->middleware('permission:News_favorite-create', ['only' => ['create','store']]);
        $this->middleware('permission:News_favorite-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:News_favorite-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = News_favorite::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                        
                     ->editColumn('news_id', function(News_favorite $data) {
                            $news_id_data ='';
                            $info =$data->news_id;
                                $New = News::find($info);
                                $news_id_data.= $New->title_ar ;
                                return $news_id_data;
                        })
                    
                     ->editColumn('user_id', function(News_favorite $data) {
                            $user_id_data ='';
                            $info =$data->user_id;
                                $User = User::find($info);
                                $user_id_data.= $User->email ;
                                return $user_id_data;
                        })
                     
                         
                         
                        ->order(function ($data) {
                            $data->orderBy('id', 'desc');
                        })  
                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_News_favorite_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="news_favorites/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="news_favorites/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="news_favorites/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.news_favorites.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = News_favorite::all()->count()+1;
            
            
                $news_ids=DB::table("news")->orderBy('id', 'asc')->get();
                $news=[];
                foreach ($news_ids as $info){
                    $news[$info->id]=$info->title_ar;
                }
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                return view('backend.news_favorites.create',compact('sort_number','news','users'));
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
            'news_id'=>'required',
                    'user_id'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                


                $News_favorite = News_favorite::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('news_favorites.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('news_favorites.index')
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
                $News_favorite = News_favorite::find($id);
                
                
                
                
                $news_ids=DB::table("news")->orderBy('id', 'asc')->get();
                $news=[];
                foreach ($news_ids as $info){
                    $news[$info->id]=$info->title_ar;
                }
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                 


                return view('backend.news_favorites.show',compact('News_favorite'  ,'news','users' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $News_favorite = News_favorite::find($id);
                
                
                
                
                $news_ids=DB::table("news")->orderBy('id', 'asc')->get();
                $news=[];
                foreach ($news_ids as $info){
                    $news[$info->id]=$info->title_ar;
                }
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                
                
                
                
                
                return view('backend.news_favorites.edit',compact('News_favorite' ,'news','users' ));
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
            
            $News_favorite = News_favorite::find($id);
                 
            $this->validate($request, [
            'news_id'=>'required',
                    'user_id'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                

                
                $News_favorite->update($input);

                //store images if found
                //store files if found

                return redirect()->route('news_favorites.index')
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
        

                News_favorite::find($id)->delete();
                return redirect()->route('news_favorites.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }