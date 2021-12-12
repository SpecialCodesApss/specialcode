<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Wallet;

use Validator;
use File;

class WalletController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
//        $searchText=$request->searchText;
//        $wallets = Wallet::
//        where(function($q) use ($searchText){
//            $q->orWhere("user_id","like","%".$searchText."%")->orWhere("wallet_balance","like","%".$searchText."%");})->paginate(20);
//        return $this->sendResponse( 'wallets retrieved successfully.',$wallets->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $input = $request->all();
//
//
//        $validator=
//            Validator::make($input, [
//
//        ]);
//
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors()->first());
//        }
//
//
//
//        $Wallet = Wallet::create($input);
//
//
//
//
//        return $this->sendResponse('Wallet created successfully.',$Wallet->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

         $user_id=$request->user()->id;
            
        $Wallet = Wallet::where(['user_id' => $user_id ])->first();


        if (is_null($Wallet)) {
            return $this->sendError('Wallet not found.');
        }

        $Wallet['wallet_balance']=sprintf("%.2f", $Wallet->wallet_balance);

        return $this->sendResponse( 'Wallet retrieved successfully.',$Wallet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Wallet_id)
    {
//        $input = $request->except('images','files','_method');
//
//
//         $validator=
//            Validator::make($input, [
//
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors()->first());
//        }
//
//
//
//        $Wallet=Wallet::where(['id'=>$Wallet_id ])->update($input);
//
//
//
//
//        $Wallet = Wallet::where(['id'=>$Wallet_id , 'user_id' => $user_id ])->get();
//        return $this->sendResponse( 'Wallet updated successfully.',$Wallet->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Wallet_id)
    {
//        //delete files
//         // delete files and images
//
//
//         // delete files and images in sub tables if this module has mutiple files or images
//
//        Wallet::where(['id'=>$Wallet_id ])->delete();
//
//
//
//        return $this->sendResponse('Wallet deleted successfully.');

    }

     //additional Functions
            
            

}
