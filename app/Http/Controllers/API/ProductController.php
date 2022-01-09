<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Product;

use Validator;
use File;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $products = Product:: 
        where(function($q) use ($searchText){
            $q->orWhere("type_selector","like","%".$searchText."%")->orWhere("user_id","like","%".$searchText."%")->orWhere("is_checkbox","like","%".$searchText."%")->orWhere("week_check","like","%".$searchText."%")->orWhere("week_select","like","%".$searchText."%")->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("product_file","like","%".$searchText."%")->orWhere("description_ar","like","%".$searchText."%")->orWhere("description_en","like","%".$searchText."%")->orWhere("html_text_ar","like","%".$searchText."%")->orWhere("html_text_en","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("products.Product_read"),$products->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
       $user_id=$request->user()->id;
             $input['user_id']=$user_id;
            

        $validator=
            Validator::make($input, [
            'type_selector'=>'required',
                'user_id'=>'required',
                'is_checkbox'=>'required',
                'week_check'=>'required',
                'week_select'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
                'product_file'=>'required',
                'description_ar'=>'required',
                'description_en'=>'required',
                'html_text_ar'=>'required',
                'html_text_en'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                if ($request->hasFile('product_file')) {
                    $document = $request->file('product_file');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/products/product_file/';
                        $request->file('product_file')->move($path, $imageName);
                        $input['product_file'] = $path.$imageName;
                }
                

        $Product = Product::create($input);

        
        

        return $this->sendResponse(trans("products.Product_create"),$Product->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Product = Product::where('id', $id)->first();

        if(isset($Product)){
        
        
        }

        if (is_null($Product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(trans("products.Product_read"),$Product->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Product_id)
    {
        $input = $request->except('images','files','_method');
        $user_id=$request->user()->id;
             $input['user_id']=$user_id;
            

         $validator=
            Validator::make($input, [
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
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                $old_product_file=Product::find($Product_id)->product_file;
                if ($request->hasFile('product_file')) {
                    $document = $request->file('product_file');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/products/product_file/';
                        $request->file('product_file')->move($path, $imageName);
                        $input['product_file'] = $path.$imageName;
                        File::delete($old_product_file);
                    }
                    else{
                    $input['product_file'] =$old_product_file;
                }
                

        $Product=Product::where(['id'=>$Product_id ])->where(['user_id' => $user_id ])->update($input);

        
        

        $Product = Product::where(['id'=>$Product_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("products.Product_update"),$Product->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Product_id)
    {
        //delete files
         // delete files and images
        
                $old_product_file=Product::find($Product_id)->product_file;
                 File::delete($old_product_file);
                
        $user_id=$request->user()->id;
            
         // delete files and images in sub tables if this module has mutiple files or images
        
        Product::where(['id'=>$Product_id ])->where(['user_id' => $user_id ])->delete();



        return $this->sendResponse(trans("products.Product_delete"));

    }

     //additional Functions
            
            

}
