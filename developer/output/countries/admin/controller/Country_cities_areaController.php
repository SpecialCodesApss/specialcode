<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country_cities_area;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\Country_citie;

class Country_cities_areaController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Country_cities_area-list', ['only' => ['index','show']]);
        $this->middleware('permission:Country_cities_area-create', ['only' => ['create','store']]);
        $this->middleware('permission:Country_cities_area-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Country_cities_area-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Country_cities_area::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                           
                        
                     ->editColumn('city_id', function(Country_cities_area $data) {
                            $city_id_data ='';
                            $info =$data->city_id;
                                $Country_citie = Country_citie::find($info);
                                $city_id_data.= $Country_citie->name_ar ;
                                return $city_id_data;
                        })
                     
                         
                        
                     ->editColumn('active', function(Country_cities_area $data) {
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
                            $form_id="delete_Country_cities_area_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="country_cities_areas/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="country_cities_areas/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="country_cities_areas/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.country_cities_areas.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Country_cities_area::all()->count()+1;
            
            
                $city_ids=DB::table("country_cities")->orderBy('id', 'asc')->get();
                $country_cities=[];
                foreach ($city_ids as $info){
                    $country_cities[$info->id]=$info->name_ar;
                }
                
                return view('backend.country_cities_areas.create',compact('sort_number','country_cities'));
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
            'city_id'=>'required',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'slug'=>'required|unique:country_cities_areas',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                


                $Country_cities_area = Country_cities_area::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('country_cities_areas.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('country_cities_areas.index')
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
                $Country_cities_area = Country_cities_area::find($id);
                
                
                
                
                $city_ids=DB::table("country_cities")->orderBy('id', 'asc')->get();
                $country_cities=[];
                foreach ($city_ids as $info){
                    $country_cities[$info->id]=$info->name_ar;
                }
                
                 


                return view('backend.country_cities_areas.show',compact('Country_cities_area'  ,'country_cities' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Country_cities_area = Country_cities_area::find($id);
                
                
                
                
                $city_ids=DB::table("country_cities")->orderBy('id', 'asc')->get();
                $country_cities=[];
                foreach ($city_ids as $info){
                    $country_cities[$info->id]=$info->name_ar;
                }
                
                
                
                
                
                
                return view('backend.country_cities_areas.edit',compact('Country_cities_area' ,'country_cities' ));
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
            
            $Country_cities_area = Country_cities_area::find($id);
                 
            $this->validate($request, [
            'city_id'=>'required',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'slug'=>'required|unique:country_cities_areas,slug,'.$Country_cities_area->id.',id',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                

                
                $Country_cities_area->update($input);

                //store images if found
                //store files if found

                return redirect()->route('country_cities_areas.index')
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
        

                Country_cities_area::find($id)->delete();
                return redirect()->route('country_cities_areas.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }