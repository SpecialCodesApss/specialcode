<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Countrie;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\Language;use App\Currencie;

class CountrieController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Countrie-list', ['only' => ['index','show']]);
        $this->middleware('permission:Countrie-create', ['only' => ['create','store']]);
        $this->middleware('permission:Countrie-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Countrie-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Countrie::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                        
                     ->editColumn('languages', function(Countrie $data) {
                            $languages_data ='';
                            $data_languages =json_decode($data->languages);
                            foreach ($data_languages as $info){
                                $Language = Language::find($info);
                                $languages_data.= $Language->name_ar .' - ';
                            }
                                return $languages_data;
                        })
                    
                     ->editColumn('currencies', function(Countrie $data) {
                            $currencies_data ='';
                            $data_currencies =json_decode($data->currencies);
                            foreach ($data_currencies as $info){
                                $Currencie = Currencie::find($info);
                                $currencies_data.= $Currencie->name_ar .' - ';
                            }
                                return $currencies_data;
                        })
                       
                         
                         
                        
                     ->editColumn('active', function(Countrie $data) {
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
                            $form_id="delete_Countrie_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="countries/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="countries/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="countries/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.countries.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Countrie::all()->count()+1;
            
            
                $languages=DB::table("languages")->orderBy('id', 'asc')->get();
                
                $currencies=DB::table("currencies")->orderBy('id', 'asc')->get();
                
                return view('backend.countries.create',compact('sort_number','languages','currencies'));
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
                    'slug'=>'required|unique:countries',
                    'country_flag'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                $input['languages']=json_encode($input['languages']);
                    $input['currencies']=json_encode($input['currencies']);
//                    $input['created_at']=$input['created_at_date'].' '.$input['created_at_time'];$input['updated_at']=$input['updated_at_date'].' '.$input['updated_at_time'];

                
                if ($request->hasFile('country_flag')) {
                    $document = $request->file('country_flag');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('country_flag') && $request->file('country_flag')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/countries/country_flag/';
                        $request->file('country_flag')->move($path, $imageName);
                        $input['country_flag'] = $path.$imageName;
                    }
                }
                


                $Countrie = Countrie::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('countries.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('countries.index')
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
                $Countrie = Countrie::find($id);
                
                
                
                
                $languages=DB::table("languages")->orderBy('id', 'asc')->get();
                
                $currencies=DB::table("currencies")->orderBy('id', 'asc')->get();
                
                 $Countrie->languages=json_decode($Countrie->languages);$Countrie->currencies=json_decode($Countrie->currencies);


                return view('backend.countries.show',compact('Countrie'  ,'languages','currencies' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Countrie = Countrie::find($id);
                
                
                
                
                $languages=DB::table("languages")->orderBy('id', 'asc')->get();
                
                $currencies=DB::table("currencies")->orderBy('id', 'asc')->get();
                
                $Countrie->languages=json_decode($Countrie->languages);$Countrie->currencies=json_decode($Countrie->currencies);
                
                
                
                
                return view('backend.countries.edit',compact('Countrie' ,'languages','currencies' ));
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
            
            $Countrie = Countrie::find($id);
                 
            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'slug'=>'required|unique:countries,slug,'.$Countrie->id.',id',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                $input['languages']=json_encode($input['languages']);
                    $input['currencies']=json_encode($input['currencies']);
//                    $input['created_at']=$input['created_at_date'].' '.$input['created_at_time'];$input['updated_at']=$input['updated_at_date'].' '.$input['updated_at_time'];

                
                $old_country_flag=Countrie::find($id)->country_flag;
                if ($request->hasFile('country_flag')) {
                    $document = $request->file('country_flag');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('country_flag') && $request->file('country_flag')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/countries/country_flag/';
                        $request->file('country_flag')->move($path, $imageName);
                        $input['country_flag'] = $path.$imageName;
                        File::delete($old_country_flag);
                    }
                    else{
                    $input['country_flag'] =$old_country_flag;
                    }
                }
                

                
                $Countrie->update($input);

                //store images if found
                //store files if found

                return redirect()->route('countries.index')
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
        
                $old_country_flag=Countrie::find($id)->country_flag;
                 File::delete($old_country_flag);
                

                 // delete files and images in sub tables if this module has mutiple files or images
        

                Countrie::find($id)->delete();
                return redirect()->route('countries.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }