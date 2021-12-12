<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Currencie;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;



class CurrencieController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Currencie-list', ['only' => ['index','show']]);
        $this->middleware('permission:Currencie-create', ['only' => ['create','store']]);
        $this->middleware('permission:Currencie-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Currencie-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Currencie::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                         
                         
                        
                     ->editColumn('active', function(Currencie $data) {
                            if($data->active == "1"){
                              return "مفعل";  
                            }
                            else{
                                return "غير مفعل";
                            }                      
                        })
                     
//                        ->order(function ($data) {
//                            $data->orderBy('id', 'desc');
//                        })
                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Currencie_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="currencies/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="currencies/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="currencies/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.currencies.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Currencie::all()->count()+1;
            
            
                return view('backend.currencies.create',compact('sort_number'));
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
                    'ISO_code'=>'required|unique:currencies',
                    'value'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                


                $Currencie = Currencie::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('currencies.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('currencies.index')
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
                $Currencie = Currencie::find($id);
                
                
                
                
                 


                return view('backend.currencies.show',compact('Currencie'   ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Currencie = Currencie::find($id);
                
                
                
                
                
                
                
                
                
                return view('backend.currencies.edit',compact('Currencie'  ));
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
            
            $Currencie = Currencie::find($id);
                 
            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'ISO_code'=>'required|unique:currencies,ISO_code,'.$Currencie->id.',id',
                    'value'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                

                
                $Currencie->update($input);

                //store images if found
                //store files if found

                return redirect()->route('currencies.index')
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
        

                Currencie::find($id)->delete();
                return redirect()->route('currencies.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }