<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Companies_categorie;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;


class Companies_categorieController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Companies_categorie-list', ['only' => ['index','show']]);
        $this->middleware('permission:Companies_categorie-create', ['only' => ['create','store']]);
        $this->middleware('permission:Companies_categorie-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Companies_categorie-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Companies_categorie::query();
                    return Datatables::eloquent($data)

                     ->editColumn('parent_category_id', function(Companies_categorie $data) {
                            $parent_category_id_data ='';
                            if($data->parent_category_id != null){
                                $info =$data->parent_category_id;
                                $Companies_categorie = Companies_categorie::find($info);
                                $parent_category_id_data.= $Companies_categorie->name_ar ;
                                return $parent_category_id_data;
                            }
                            else{

                                return "---";
                            }

                        })
                     
                         
                        
                     ->editColumn('active', function(Companies_categorie $data) {
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
                            $form_id="delete_Companies_categorie_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="companies_categories/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="companies_categories/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="companies_categories/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.companies_categories.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Companies_categorie::all()->count()+1;
            
            
                $parent_category_ids=DB::table("companies_categories")->orderBy('id', 'asc')->get();
                $companies_categories=[];
                $companies_categories[""]="بدون تصنيف رئيسي";
                foreach ($parent_category_ids as $info){
                    $companies_categories[$info->id]=$info->name_ar;
                }
                
                return view('backend.companies_categories.create',compact('sort_number','companies_categories'));
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
            'slug'=>'required|unique:companies_categories',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'description_ar'=>'required',
                    'description_en'=>'required',
                    'category_image'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                
                if ($request->hasFile('category_image')) {
                    $document = $request->file('category_image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('category_image') && $request->file('category_image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies_categories/category_image/';
                        $request->file('category_image')->move($path, $imageName);
                        $input['category_image'] = $path.$imageName;
                    }
                }
                
                if ($request->hasFile('category_icon')) {
                    $document = $request->file('category_icon');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('category_icon') && $request->file('category_icon')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies_categories/category_icon/';
                        $request->file('category_icon')->move($path, $imageName);
                        $input['category_icon'] = $path.$imageName;
                    }
                }
                


                $Companies_categorie = Companies_categorie::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('companies_categories.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('companies_categories.index')
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
                $Companies_categorie = Companies_categorie::find($id);
                
                
                
                
                $parent_category_ids=DB::table("companies_categories")->orderBy('id', 'asc')->get();
                $companies_categories=[];
                foreach ($parent_category_ids as $info){
                    $companies_categories[$info->id]=$info->name_ar;
                }
                
                 


                return view('backend.companies_categories.show',compact('Companies_categorie'  ,'companies_categories' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Companies_categorie = Companies_categorie::find($id);
                
                
                
                
                $parent_category_ids=DB::table("companies_categories")->orderBy('id', 'asc')->get();
                $companies_categories=[];
                foreach ($parent_category_ids as $info){
                    $companies_categories[$info->id]=$info->name_ar;
                }
                
                
                
                
                
                
                return view('backend.companies_categories.edit',compact('Companies_categorie' ,'companies_categories' ));
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
            
            $Companies_categorie = Companies_categorie::find($id);
                 
            $this->validate($request, [
            'slug'=>'required|unique:companies_categories,slug,'.$Companies_categorie->id.',id',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'description_ar'=>'required',
                    'description_en'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                
                $old_category_image=Companies_categorie::find($id)->category_image;
                if ($request->hasFile('category_image')) {
                    $document = $request->file('category_image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('category_image') && $request->file('category_image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies_categories/category_image/';
                        $request->file('category_image')->move($path, $imageName);
                        $input['category_image'] = $path.$imageName;
                        File::delete($old_category_image);
                    }
                    else{
                    $input['category_image'] =$old_category_image;
                    }
                }
                
                $old_category_icon=Companies_categorie::find($id)->category_icon;
                if ($request->hasFile('category_icon')) {
                    $document = $request->file('category_icon');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('category_icon') && $request->file('category_icon')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies_categories/category_icon/';
                        $request->file('category_icon')->move($path, $imageName);
                        $input['category_icon'] = $path.$imageName;
                        File::delete($old_category_icon);
                    }
                    else{
                    $input['category_icon'] =$old_category_icon;
                    }
                }
                

                
                $Companies_categorie->update($input);

                //store images if found
                //store files if found

                return redirect()->route('companies_categories.index')
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
        
                $old_category_image=Companies_categorie::find($id)->category_image;
                 File::delete($old_category_image);
                
                $old_category_icon=Companies_categorie::find($id)->category_icon;
                 File::delete($old_category_icon);
                

                 // delete files and images in sub tables if this module has mutiple files or images
        

                Companies_categorie::find($id)->delete();
                return redirect()->route('companies_categories.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }