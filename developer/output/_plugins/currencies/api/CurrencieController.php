<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Currencie;

use Validator;
use File;

class CurrencieController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $currencies = Currencie:: 
        where(function($q) use ($searchText){
            $q->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("ISO_code","like","%".$searchText."%")->orWhere("value","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("currencies.Currencie_read"),$currencies->toArray());
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
       

        $validator=
            Validator::make($input, [
            'name_ar'=>'required',
                'name_en'=>'required',
                'ISO_code'=>'required',
                'value'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Currencie = Currencie::create($input);

        
        

        return $this->sendResponse(trans("currencies.Currencie_create"),$Currencie->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Currencie = Currencie::where('id', $id)->first();
        
        if(isset($Currencie)){
        
        
        }

        if (is_null($Currencie)) {
            return $this->sendError('Currencie not found.');
        }

        return $this->sendResponse(trans("currencies.Currencie_read"),$Currencie->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Currencie_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'name_ar'=>'required',
                'name_en'=>'required',
                'ISO_code'=>'required',
                'value'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Currencie=Currencie::where(['id'=>$Currencie_id ])->update($input);

        
        

        $Currencie = Currencie::where(['id'=>$Currencie_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("currencies.Currencie_update"),$Currencie->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Currencie_id)
    {
        //delete files
         // delete files and images
        
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Currencie::where(['id'=>$Currencie_id ])->delete();



        return $this->sendResponse(trans("currencies.Currencie_delete"));

    }

     //additional Functions
            
            

}
