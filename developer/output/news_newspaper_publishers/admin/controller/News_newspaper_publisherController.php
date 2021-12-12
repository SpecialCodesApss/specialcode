<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News_newspaper_publisher;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\Countrie;

class News_newspaper_publisherController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:News_newspaper_publisher-list', ['only' => ['index','show']]);
        $this->middleware('permission:News_newspaper_publisher-create', ['only' => ['create','store']]);
        $this->middleware('permission:News_newspaper_publisher-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:News_newspaper_publisher-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = News_newspaper_publisher::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                        
                     ->editColumn('country_id', function(News_newspaper_publisher $data) {
                            $country_id_data ='';
                            $info =$data->country_id;
                                $Countrie = Countrie::find($info);
                                $country_id_data.= $Countrie->name_ar ;
                                return $country_id_data;
                        })
                     
                         
                        
                     ->editColumn('active', function(News_newspaper_publisher $data) {
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
                            $form_id="delete_News_newspaper_publisher_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="news_newspaper_publishers/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="news_newspaper_publishers/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="news_newspaper_publishers/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.news_newspaper_publishers.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = News_newspaper_publisher::all()->count()+1;
            
            
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                return view('backend.news_newspaper_publishers.create',compact('sort_number','countries'));
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
            'country_id'=>'required',
                    'slug'=>'required|unique:news_newspaper_publishers',
                    'newspaper_name_ar'=>'required',
                    'newspaper_name_en'=>'required',
                    'description_ar'=>'required',
                    'description_en'=>'required',
                    'logo_image'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                
                if ($request->hasFile('logo_image')) {
                    $document = $request->file('logo_image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('logo_image') && $request->file('logo_image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_newspaper_publishers/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                    }
                }
                


                $News_newspaper_publisher = News_newspaper_publisher::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('news_newspaper_publishers.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('news_newspaper_publishers.index')
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
                $News_newspaper_publisher = News_newspaper_publisher::find($id);
                
                
                
                
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                 


                return view('backend.news_newspaper_publishers.show',compact('News_newspaper_publisher'  ,'countries' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $News_newspaper_publisher = News_newspaper_publisher::find($id);
                
                
                
                
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                
                
                
                
                
                return view('backend.news_newspaper_publishers.edit',compact('News_newspaper_publisher' ,'countries' ));
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
            
            $News_newspaper_publisher = News_newspaper_publisher::find($id);
                 
            $this->validate($request, [
            'country_id'=>'required',
                    'slug'=>'required|unique:news_newspaper_publishers,slug,'.$News_newspaper_publisher->id.',id',
                    'newspaper_name_ar'=>'required',
                    'newspaper_name_en'=>'required',
                    'description_ar'=>'required',
                    'description_en'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                
                $old_logo_image=News_newspaper_publisher::find($id)->logo_image;
                if ($request->hasFile('logo_image')) {
                    $document = $request->file('logo_image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('logo_image') && $request->file('logo_image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news_newspaper_publishers/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                        File::delete($old_logo_image);
                    }
                    else{
                    $input['logo_image'] =$old_logo_image;
                    }
                }
                

                
                $News_newspaper_publisher->update($input);

                //store images if found
                //store files if found

                return redirect()->route('news_newspaper_publishers.index')
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
        
                $old_logo_image=News_newspaper_publisher::find($id)->logo_image;
                 File::delete($old_logo_image);
                

                 // delete files and images in sub tables if this module has mutiple files or images
        

                News_newspaper_publisher::find($id)->delete();
                return redirect()->route('news_newspaper_publishers.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }