<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

use Spatie\Permission\Models\Role;
use DB;
use Auth;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;

use App\User;

class ProductController extends Controller
{

    use file_type_traits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id=Auth::user()->id;
        $searchText=$request->searchText;
        $products = Product::where(['user_id' => $user_id ])->paginate(20);
        return view("frontend.products.index",compact('products'));
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

            
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                return view('frontend.products.create',compact('sort_number','users'));
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
        

                
                $input["type_selector"]=$request->type_selector;
                $input["is_checkbox"]=$request->is_checkbox;
                $input["week_check"]=$request->week_check;
                $input["week_select"]=$request->week_select;
                $input["name_ar"]=$request->name_ar;
                $input["name_en"]=$request->name_en;
                $input["description_ar"]=$request->description_ar;
                $input["description_en"]=$request->description_en;
                $input["html_text_ar"]=$request->html_text_ar;
                $input["html_text_en"]=$request->html_text_en;
                $input["sort"]=$request->sort;
                $input["active"]=$request->active;
                $input["save_type"]=$request->save_type;


                 $user_id=Auth::user()->id;
             $input['user_id']=$user_id;
            

                
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
                    return redirect('products/create')
                        ->with('success',trans('admin_messages.info_added'));
                }
                else{
                    return redirect('products')
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

            $user_id=Auth::user()->id;
            

               $Product = Product::where('id', $id)->where(['user_id' => $user_id ])->first();

        if(isset($Product)){
        
        
        }

        if (is_null($Product)) {
            return $this->sendError('Product not found.');
        }

                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                 


                return view('frontend.products.show',compact('Product'  ,'users' ));

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
                
                

                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                

                
            $product_file_filetype = $this->getFileTypeByLink($Product->product_file);
            


                return view('frontend.products.edit',compact('Product'
                ,'users','product_file_filetype' ));
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

            
                $input["type_selector"]=$request->type_selector;
                $input["is_checkbox"]=$request->is_checkbox;
                $input["week_check"]=$request->week_check;
                $input["week_select"]=$request->week_select;
                $input["name_ar"]=$request->name_ar;
                $input["name_en"]=$request->name_en;
                $input["description_ar"]=$request->description_ar;
                $input["description_en"]=$request->description_en;
                $input["html_text_ar"]=$request->html_text_ar;
                $input["html_text_en"]=$request->html_text_en;
                $input["sort"]=$request->sort;
                $input["active"]=$request->active;
            $user_id=Auth::user()->id;
             $input['user_id']=$user_id;
            


              
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
                

                 $Product=Product::where(['id'=>$id ])->where(['user_id' => $user_id ])->update($input);

        //store images if found
        //store files if found

        $Product = Product::where(['id'=>$id , 'user_id' => $user_id ])->get();

                return redirect('products')
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

        //delete files
         // delete files and images
        
                $old_product_file=Product::find($id)->product_file;
                 File::delete($old_product_file);
                
        $user_id=Auth::user()->id;
            
         // delete files and images in sub tables if this module has mutiple files or images
        

        Product::where(['id'=>$Product_id ])->where(['user_id' => $user_id ])->delete();

                return redirect('products')
                    ->with('success',trans('admin_messages.info_deleted'));
            }

            //additional Functions
            
            


            
}
