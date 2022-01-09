<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;



class ProductController extends Controller
{

    use file_type_traits;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        
        $this->middleware('permission:Product_Create', ['only' => ['create','store']]);
        $this->middleware('permission:Product_Read', ['only' => ['index','show']]);
        $this->middleware('permission:Product_Update', ['only' => ['update','edit']]);
        $this->middleware('permission:Product_Delete', ['only' => ['delete','destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Product::query();


                    

                    



                    return Datatables::eloquent($data)

                        
                     ->editColumn('type_selector', function(Product $data) {
                                
                            if($data->type_selector=="active"){
                            return trans('products.active');
                            }
                            if($data->type_selector=="inactive"){
                            return trans('products.inactive');
                            }
                            if($data->type_selector=="submit"){
                            return trans('products.submit');
                            }
                            if($data->type_selector=="role"){
                            return trans('products.role');
                            }
                        })
                    
                        
                        
                     ->editColumn('is_checkbox', function(Product $data) {
                            if($data->is_checkbox != null){
                              return trans("admin_messages.yes");
                            }
                            else{
                                return trans("admin_messages.no");
                            }
                        })
                    
                        
                     ->editColumn('active', function(Product $data) {
                            if($data->active == "1"){
                              return trans("admin_messages.active");
                            }
                            else{
                                return trans("admin_messages.inactive");
                            }
                        })
                    

                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Product_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="icon-btn" href="products/'.$row_id.'"><i class="fa fa-eye text-view"></i></a>
            <a class="icon-btn" href="products/'.$row_id.'/edit"><i class="fa fa-pencil text-edit"></i></a>
            <form id="'.$form_id.'" method="POST" action="products/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')"
                                        class="btn icon-btn"><i class="fa fa-trash text-delete"></i></button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.products.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Product::all()->count()+1;

            
                return view('backend.products.create',compact('sort_number'));
            }

            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {

                $lang = App::getLocale();
                
            $this->validate($request, [
            'type_selector'=>'required',
                    'user_id'=>'required',
                    'week_check'=>'required',
                    'week_select'=>'required',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'product_file'=>'required',
                    'description_ar'=>'required',
                    'description_en'=>'required',
                    'html_text_ar'=>'required',
                    'html_text_en'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();

                
                        if(isset($input['is_checkbox'])){
                        $input['is_checkbox']= 1;
                        }else{
                        $input['is_checkbox']= 0;
                        }
                    

                

                
                if ($request->hasFile('product_file')) {
                    $document = $request->file('product_file');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('product_file') && $request->file('product_file')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/products/product_file/';
                        $request->file('product_file')->move($path, $imageName);
                        $input['product_file'] = $path.$imageName;
                    }
                }
                


                $Product = Product::create($input);

                //store images if found
                //store files if found


                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('products.create')
                        ->with('success',trans('admin_messages.info_added'));
                }
                else{
                    return redirect()->route('products.index')
                        ->with('success',trans('admin_messages.info_added'));
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
            $lang = App::getLocale();
                $Product = Product::find($id);
                
                

                
                 


                return view('backend.products.show',compact('Product'   ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {

            $lang = App::getLocale();
                $Product = Product::find($id);
                
                

                
                

                
            $product_file_filetype = $this->getFileTypeByLink($Product->product_file);
            


                return view('backend.products.edit',compact('Product'
                ,'product_file_filetype' ));
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

            $Product = Product::find($id);
                 
            $this->validate($request, [
            'type_selector'=>'required',
                    'user_id'=>'required',
                    'is_checkbox'=>'required',
                    'week_check'=>'required',
                    'week_select'=>'required',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'description_ar'=>'required',
                    'description_en'=>'required',
                    'html_text_ar'=>'required',
                    'html_text_en'=>'required',
                    'sort'=>'required',
                    'active'=>'required',
                    
        ]);
        

                $input = $request->all();

                
                        if(isset($input['is_checkbox'])){
                        $input['is_checkbox']= 1;
                        }else{
                        $input['is_checkbox']= 0;
                        }
                    

                

                
                $old_product_file=Product::find($id)->product_file;
                if ($request->hasFile('product_file')) {
                    $document = $request->file('product_file');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('product_file') && $request->file('product_file')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/products/product_file/';
                        $request->file('product_file')->move($path, $imageName);
                        $input['product_file'] = $path.$imageName;
                        File::delete($old_product_file);
                    }
                    else{
                    $input['product_file'] =$old_product_file;
                    }
                }
                


                $Product->update($input);

                //store images if found
                //store files if found

                return redirect()->route('products.index')
                    ->with('success',trans('admin_messages.info_edited'));
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
        
                $old_product_file=Product::find($id)->product_file;
                 File::delete($old_product_file);
                

                 // delete files and images in sub tables if this module has mutiple files or images
        

                Product::find($id)->delete();
                return redirect()->route('products.index')
                    ->with('success',trans('admin_messages.info_deleted'));
            }

            //additional Functions
            
            


            




        }