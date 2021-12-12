<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News_auther;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\Countrie;

class News_autherController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:News_auther-list', ['only' => ['index','show']]);
        $this->middleware('permission:News_auther-create', ['only' => ['create','store']]);
        $this->middleware('permission:News_auther-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:News_auther-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = News_auther::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                        
                     ->editColumn('country_id', function(News_auther $data) {
                            $country_id_data ='';
                            $info =$data->country_id;
                                $Countrie = Countrie::find($info);
                                $country_id_data.= $Countrie->name_ar ;
                                return $country_id_data;
                        })
                     
                         
                        
                     ->editColumn('active', function(News_auther $data) {
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
                            $form_id="delete_News_auther_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="news_authers/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="news_authers/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="news_authers/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.news_authers.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = News_auther::all()->count()+1;
            
            
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                return view('backend.news_authers.create',compact('sort_number','countries'));
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
            'slug'=>'required|unique:news_authers',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                
                if ($request->hasFile('profile_image')) {
                    $document = $request->file('profile_image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('profile_image') && $request->file('profile_image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_authers/profile_image/';
                        $request->file('profile_image')->move($path, $imageName);
                        $input['profile_image'] = $path.$imageName;
                    }
                }
                


                $News_auther = News_auther::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('news_authers.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('news_authers.index')
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
                $News_auther = News_auther::find($id);
                
                
                
                
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                 


                return view('backend.news_authers.show',compact('News_auther'  ,'countries' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $News_auther = News_auther::find($id);
                
                
                
                
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                
                
                
                
                
                return view('backend.news_authers.edit',compact('News_auther' ,'countries' ));
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
            
            $News_auther = News_auther::find($id);
                 
            $this->validate($request, [
            'slug'=>'required|unique:news_authers,slug,'.$News_auther->id.',id',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                
                $old_profile_image=News_auther::find($id)->profile_image;
                if ($request->hasFile('profile_image')) {
                    $document = $request->file('profile_image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('profile_image') && $request->file('profile_image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_authers/profile_image/';
                        $request->file('profile_image')->move($path, $imageName);
                        $input['profile_image'] = $path.$imageName;
                        File::delete($old_profile_image);
                    }
                    else{
                    $input['profile_image'] =$old_profile_image;
                    }
                }
                

                
                $News_auther->update($input);

                //store images if found
                //store files if found

                return redirect()->route('news_authers.index')
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
        
                $old_profile_image=News_auther::find($id)->profile_image;
                 File::delete($old_profile_image);
                

                 // delete files and images in sub tables if this module has mutiple files or images
        

                News_auther::find($id)->delete();
                return redirect()->route('news_authers.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }