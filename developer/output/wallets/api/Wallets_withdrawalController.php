<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Wallets_withdrawal;

use Validator;
use File;

class Wallets_withdrawalController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id=$request->user()->id;
        $searchText=$request->searchText;
        $wallets_withdrawals = Wallets_withdrawal::where(['user_id' => $user_id ])-> 
        where(function($q) use ($searchText){
            $q->orWhere("user_id","like","%".$searchText."%")->orWhere("bank_name","like","%".$searchText."%")->orWhere("account_owner_name","like","%".$searchText."%")->orWhere("iban_number","like","%".$searchText."%")->orWhere("withdrawal_amount_required","like","%".$searchText."%")->orWhere("money_withdrawal_status","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse( 'wallets_withdrawals retrieved successfully.',$wallets_withdrawals->toArray());
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
            'bank_name'=>'required',
                'account_owner_name'=>'required',
                'iban_number'=>'required',
                'withdrawal_amount_required'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Wallets_withdrawal = Wallets_withdrawal::create($input);

        
        

        return $this->sendResponse('Wallets_withdrawal created successfully.',$Wallets_withdrawal->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         $user_id=$request->user()->id;
            
        $Wallets_withdrawal = Wallets_withdrawal::where('id', $id)->where(['user_id' => $user_id ])->first();
        
        if(isset($Wallets_withdrawal)){
        
        
        }

        if (is_null($Wallets_withdrawal)) {
            return $this->sendError('Wallets_withdrawal not found.');
        }

        return $this->sendResponse( 'Wallets_withdrawal retrieved successfully.',$Wallets_withdrawal->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Wallets_withdrawal_id)
    {
        $input = $request->except('images','files','_method');
        $user_id=$request->user()->id;
             $input['user_id']=$user_id;
            

         $validator=
            Validator::make($input, [
            'bank_name'=>'required',
                'account_owner_name'=>'required',
                'iban_number'=>'required',
                'withdrawal_amount_required'=>'required',
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Wallets_withdrawal=Wallets_withdrawal::where(['id'=>$Wallets_withdrawal_id ])->where(['user_id' => $user_id ])->first();

        if($Wallets_withdrawal->money_withdrawal_status == 'قيد المراجعة'){
            $Wallets_withdrawal->update($input);
        }
        else{
            return $this->sendError( 'Can\'t Edit Withdrawal request after start processing');
        }


        $Wallets_withdrawal = Wallets_withdrawal::where(['id'=>$Wallets_withdrawal_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse( 'Wallets_withdrawal updated successfully.',$Wallets_withdrawal->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Wallets_withdrawal_id)
    {
        //delete files
         // delete files and images
        
        $user_id=$request->user()->id;
            
         // delete files and images in sub tables if this module has mutiple files or images
        
        Wallets_withdrawal::where(['id'=>$Wallets_withdrawal_id ])->where(['user_id' => $user_id ])->delete();



        return $this->sendResponse('Wallets_withdrawal deleted successfully.');

    }

     //additional Functions
            
            

}
