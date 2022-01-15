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


use App\Http\Traits\admin_notification_traits;


class ProductController extends Controller
{

    use file_type_traits;
    use admin_notification_traits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $products = Product::paginate(20);
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

            
                return view('frontend.products.create',compact('sort_number'));
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
            'name_ar'=>'required',
                    'name_en'=>'required',
                    
        ]);
        

                
                $input["name_ar"]=$request->name_ar;
                $input["name_en"]=$request->name_en;


                 $user_id=Auth::user()->id;
             $input['user_id']=$user_id;
            

                

                

                


                $Product = Product::create($input);

                
         //create admin notification
        $notification_input=[];
        $notification_input["notification_id"]=5;
        $notification_input["module_id"]=$Product->id;
        $this->createNotification($notification_input);
        


                //store images if found
                //store files if found




                if($request->save_type=="save_and_add_new"){
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

            

               $Product = Product::where('id', $id)->first();

        if(isset($Product)){
        
        
        }

        if (is_null($Product)) {
            return back()->with('error',trans('admin_messages.Page not found.'));
        }

                
                 


                return view('frontend.products.show',compact('Product'   ));

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
                
                

                
                

                


                return view('frontend.products.edit',compact('Product'
                 ));
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

            
                $input["name_ar"]=$request->name_ar;
                $input["name_en"]=$request->name_en;
            $user_id=Auth::user()->id;
             $input['user_id']=$user_id;
            


              
            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    
        ]);
        

 

                

                

                

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
        
        $user_id=Auth::user()->id;
            
         // delete files and images in sub tables if this module has mutiple files or images
        

        Product::where(['id'=>$id])->where(['user_id' => $user_id ])->delete();

                return redirect('products')
                    ->with('success',trans('admin_messages.info_deleted'));
            }

            //additional Functions
            
            


            
}
