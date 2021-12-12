<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Companies_review;

use Validator;
use File;

class Companies_reviewController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $companies_reviews = Companies_review::
            where('active',1)->
        where(function($q) use ($searchText){
            $q->orWhere("company_id","like","%".$searchText."%")->orWhere("user_id","like","%".$searchText."%")->orWhere("rate_stars_count","like","%".$searchText."%")->orWhere("comment","like","%".$searchText."%")->orWhere("users_likes_ids","like","%".$searchText."%")->orWhere("users_dislikes_ids","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("companies_reviews.Companies_review_read"),$companies_reviews->toArray());
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
            'company_id'=>'required',
                'user_id'=>'required',
                'rate_stars_count'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
        $input['active']=0;
        $Companies_review = Companies_review::create($input);

        
        

        return $this->sendResponse(trans("companies_reviews.Companies_review_create"),$Companies_review->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Companies_review = Companies_review::where('id', $id)->first();
        
        if(isset($Companies_review)){
        
        
        }

        if (is_null($Companies_review)) {
            return $this->sendError('Companies_review not found.');
        }

        return $this->sendResponse(trans("companies_reviews.Companies_review_read"),$Companies_review->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Companies_review_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'company_id'=>'required',
                'user_id'=>'required',
                'rate_stars_count'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Companies_review=Companies_review::where(['id'=>$Companies_review_id ])->update($input);

        
        

        $Companies_review = Companies_review::where(['id'=>$Companies_review_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("companies_reviews.Companies_review_update"),$Companies_review->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Companies_review_id)
    {
        //delete files
         // delete files and images
        
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Companies_review::where(['id'=>$Companies_review_id ])->delete();



        return $this->sendResponse(trans("companies_reviews.Companies_review_delete"));

    }

     //additional Functions
            
            

}
