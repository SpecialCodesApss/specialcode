<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sponser;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;



class SponserController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Sponser-list', ['only' => ['index','show']]);
        $this->middleware('permission:Sponser-create', ['only' => ['create','store']]);
        $this->middleware('permission:Sponser-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Sponser-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Sponser::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                         
                         
                        
                     ->editColumn('active', function(Sponser $data) {
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
                            $form_id="delete_Sponser_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="sponsers/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="sponsers/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="sponsers/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.sponsers.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Sponser::all()->count()+1;
            
            
                return view('backend.sponsers.create',compact('sort_number'));
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
                        $path = 'storage/images/sponsers/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                    }
                }
                


                $Sponser = Sponser::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('sponsers.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('sponsers.index')
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
                $Sponser = Sponser::find($id);
                
                
                
                
                 


                return view('backend.sponsers.show',compact('Sponser'   ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Sponser = Sponser::find($id);
                
                
                
                
                
                
                
                
                
                return view('backend.sponsers.edit',compact('Sponser'  ));
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
            
            $Sponser = Sponser::find($id);
                 
            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                
                $old_logo_image=Sponser::find($id)->logo_image;
                if ($request->hasFile('logo_image')) {
                    $document = $request->file('logo_image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('logo_image') && $request->file('logo_image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/sponsers/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                        File::delete($old_logo_image);
                    }
                    else{
                    $input['logo_image'] =$old_logo_image;
                    }
                }
                

                
                $Sponser->update($input);

                //store images if found
                //store files if found

                return redirect()->route('sponsers.index')
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
        
                $old_logo_image=Sponser::find($id)->logo_image;
                 File::delete($old_logo_image);
                

                 // delete files and images in sub tables if this module has mutiple files or images
        

                Sponser::find($id)->delete();
                return redirect()->route('sponsers.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }