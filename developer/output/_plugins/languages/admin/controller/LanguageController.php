<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Language;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;



class LanguageController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Language-list', ['only' => ['index','show']]);
        $this->middleware('permission:Language-create', ['only' => ['create','store']]);
        $this->middleware('permission:Language-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Language-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Language::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                         
                         
                        
                     ->editColumn('active', function(Language $data) {
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
                            $form_id="delete_Language_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="languages/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="languages/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="languages/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.languages.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Language::all()->count()+1;
            
            
                return view('backend.languages.create',compact('sort_number'));
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
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'ISO_code'=>'required|unique:languages',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                
                if ($request->hasFile('language_icon')) {
                    $document = $request->file('language_icon');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('language_icon') && $request->file('language_icon')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/languages/language_icon/';
                        $request->file('language_icon')->move($path, $imageName);
                        $input['language_icon'] = $path.$imageName;
                    }
                }
                


                $Language = Language::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('languages.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('languages.index')
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
                $Language = Language::find($id);
                
                
                
                
                 


                return view('backend.languages.show',compact('Language'   ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Language = Language::find($id);
                
                
                
                
                
                
                
                
                
                return view('backend.languages.edit',compact('Language'  ));
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
            
            $Language = Language::find($id);
                 
            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'ISO_code'=>'required|unique:languages,ISO_code,'.$Language->id.',id',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                
                $old_language_icon=Language::find($id)->language_icon;
                if ($request->hasFile('language_icon')) {
                    $document = $request->file('language_icon');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('language_icon') && $request->file('language_icon')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/languages/language_icon/';
                        $request->file('language_icon')->move($path, $imageName);
                        $input['language_icon'] = $path.$imageName;
                        File::delete($old_language_icon);
                    }
                    else{
                    $input['language_icon'] =$old_language_icon;
                    }
                }
                

                
                $Language->update($input);

                //store images if found
                //store files if found

                return redirect()->route('languages.index')
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
        
                $old_language_icon=Language::find($id)->language_icon;
                 File::delete($old_language_icon);
                

                 // delete files and images in sub tables if this module has mutiple files or images
        

                Language::find($id)->delete();
                return redirect()->route('languages.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }