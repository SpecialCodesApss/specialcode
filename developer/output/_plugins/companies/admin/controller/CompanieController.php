<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Companie;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\Companies_categorie;use App\Countrie;use App\Country_citie;

class CompanieController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Companie-list', ['only' => ['index','show']]);
        $this->middleware('permission:Companie-create', ['only' => ['create','store']]);
        $this->middleware('permission:Companie-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Companie-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Companie::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)
                        
                        
                     ->editColumn('categories', function(Companie $data) {
                            $categories_data ='';
                            $data_categories =json_decode($data->categories);
                            foreach ($data_categories as $info){
                                $Companies_categorie = Companies_categorie::find($info);
                                $categories_data.= $Companies_categorie->name_ar .' - ';
                            }
                                return $categories_data;
                        })

                        
                     ->editColumn('country_id', function(Companie $data) {
                            $country_id_data ='';
                            $info =$data->country_id;
                                $Countrie = Countrie::find($info);
                                $country_id_data.= $Countrie->name_ar ;
                                return $country_id_data;
                        })
                    
                     ->editColumn('city_id', function(Companie $data) {
                            $city_id_data ='';
                            $info =$data->city_id;
                                $Country_citie = Country_citie::find($info);
                                $city_id_data.= $Country_citie->name_ar ;
                                return $city_id_data;
                        })
                     
                        
                     ->editColumn('is_recommended', function(Companie $data) {
                            if($data->is_recommended != null){
                              return "نعم";  
                            }
                            else{
                                return "لا";
                            }                      
                        })
                     
                        
                     ->editColumn('active', function(Companie $data) {
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
                            $form_id="delete_Companie_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="companies/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="companies/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="companies/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.companies.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Companie::all()->count()+1;
            
            
                $companies_categories=DB::table("companies_categories")->orderBy('id', 'asc')->get();
                
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }

                $city_ids=DB::table("country_cities")->orderBy('id', 'asc')->where("country_id",1)->get();
                $country_cities=[];
                foreach ($city_ids as $info){
                    $country_cities[$info->id]=$info->name_ar;
                }
                
                return view('backend.companies.create',compact('sort_number','companies_categories','countries','country_cities'));
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
            'categories'=>'required',
                    'country_id'=>'required',
                    'city_id'=>'required',
                    'slug'=>'required|unique:companies',
                    'company_name_ar'=>'required',
                    'company_name_en'=>'required',
                    'description_ar'=>'required',
                    'description_en'=>'required',
                    'logo_image'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                        if(isset($input['is_recommended'])){
                        $input['is_recommended']= 1;
                    }
                    
                
                $input['categories']=json_encode($input['categories']);
                    

                
                if ($request->hasFile('logo_image')) {
                    $document = $request->file('logo_image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('logo_image') && $request->file('logo_image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                    }
                }
                


                $Companie = Companie::create($input);

                //store images if found
                //store files if found
                
                
                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('companies.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('companies.index')
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
                $Companie = Companie::find($id);
                

                $companies_categories=DB::table("companies_categories")->orderBy('id', 'asc')->get();
                
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                $city_ids=DB::table("country_cities")->orderBy('id', 'asc')->get();
                $country_cities=[];
                foreach ($city_ids as $info){
                    $country_cities[$info->id]=$info->name_ar;
                }
                
                 $Companie->categories=json_decode($Companie->categories);


                return view('backend.companies.show',compact('Companie'  ,'companies_categories','countries','country_cities' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Companie = Companie::find($id);

                $country_id = $Companie->country_id;

                $companies_categories=DB::table("companies_categories")->orderBy('id', 'asc')->get();
                
                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }
                
                $city_ids=DB::table("country_cities")->orderBy('id', 'asc')->where('country_id',$country_id)->get();
                $country_cities=[];
                foreach ($city_ids as $info){
                    $country_cities[$info->id]=$info->name_ar;
                }
                
                $Companie->categories=json_decode($Companie->categories);
                
                
                
                
                return view('backend.companies.edit',compact('Companie' ,'companies_categories','countries','country_cities' ));
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
            
            $Companie = Companie::find($id);
                 
            $this->validate($request, [
            'categories'=>'required',
                    'country_id'=>'required',
                    'city_id'=>'required',
                    'slug'=>'required|unique:companies,slug,'.$Companie->id.',id',
                    'company_name_ar'=>'required',
                    'company_name_en'=>'required',
                    'description_ar'=>'required',
                    'description_en'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                        if(isset($input['is_recommended'])){
                        $input['is_recommended']= 1;
                    }
                    
                
                $input['categories']=json_encode($input['categories']);
                    

                
                $old_logo_image=Companie::find($id)->logo_image;
                if ($request->hasFile('logo_image')) {
                    $document = $request->file('logo_image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('logo_image') && $request->file('logo_image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/companies/logo_image/';
                        $request->file('logo_image')->move($path, $imageName);
                        $input['logo_image'] = $path.$imageName;
                        File::delete($old_logo_image);
                    }
                    else{
                    $input['logo_image'] =$old_logo_image;
                    }
                }
                

                
                $Companie->update($input);

                //store images if found
                //store files if found

                return redirect()->route('companies.index')
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
        
                $old_logo_image=Companie::find($id)->logo_image;
                 File::delete($old_logo_image);
                

                 // delete files and images in sub tables if this module has mutiple files or images
        

                Companie::find($id)->delete();
                return redirect()->route('companies.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_CountryCites_for_companies_store_Admin(Request $request)
    {
        $country_id = $request->country_id;

        $country_cities=DB::table("country_cities")->where("country_id",$country_id)->orderBy('id', 'asc')->get();
        $city_selector='<select name="city_id" id="city_id" class="form-control chosen-select wide">';
        foreach ($country_cities as $city){
            $city_selector.="<option value=".$city->id.">$city->name_ar</option>";
        }
        $city_selector.='</select>';

        return $city_selector;
    }
            
            
            
            
            
            
            
            

        }