<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country_citie;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\Countrie;

class Country_citieController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Country_citie-list', ['only' => ['index','show']]);
        $this->middleware('permission:Country_citie-create', ['only' => ['create','store']]);
        $this->middleware('permission:Country_citie-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Country_citie-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Country_citie::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                        
                     ->editColumn('country_id', function(Country_citie $data) {
                            $country_id_data ='';
                            $info =$data->country_id;
                                $Countrie = Countrie::find($info);
                                $country_id_data.= $Countrie->name_ar ;
                                return $country_id_data;
                        })
                     
                         
                        
                     ->editColumn('active', function(Country_citie $data) {
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
                            $form_id="delete_Country_citie_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="country_cities/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="country_cities/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="country_cities/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.country_cities.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Country_citie::all()->count()+1;
            
            
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                return view('backend.country_cities.create',compact('sort_number','countries'));
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
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'slug'=>'required|unique:country_cities',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                


                $Country_citie = Country_citie::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('country_cities.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('country_cities.index')
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
                $Country_citie = Country_citie::find($id);
                
                
                
                
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                 


                return view('backend.country_cities.show',compact('Country_citie'  ,'countries' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Country_citie = Country_citie::find($id);
                
                
                
                
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                
                
                
                
                
                return view('backend.country_cities.edit',compact('Country_citie' ,'countries' ));
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
            
            $Country_citie = Country_citie::find($id);
                 
            $this->validate($request, [
            'country_id'=>'required',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'slug'=>'required|unique:country_cities,slug,'.$Country_citie->id.',id',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                

                
                $Country_citie->update($input);

                //store images if found
                //store files if found

                return redirect()->route('country_cities.index')
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
        

                Country_citie::find($id)->delete();
                return redirect()->route('country_cities.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }