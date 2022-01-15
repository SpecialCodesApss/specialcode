<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Faq;

use Validator;
use File;

class FaqController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $faqs = Faq:: 
        where(function($q) use ($searchText){
            $q->orWhere("question_ar","like","%".$searchText."%")->orWhere("question_en","like","%".$searchText."%")->orWhere("answer_ar","like","%".$searchText."%")->orWhere("answer_en","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("faqs.Faq_read"),$faqs->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
                $input["question_ar"]=$request->question_ar;
                $input["question_en"]=$request->question_en;
                $input["answer_ar"]=$request->answer_ar;
                $input["answer_en"]=$request->answer_en;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;


       

        $validator=
            Validator::make($input, [
            'question_ar'=>'required',
                'question_en'=>'required',
                'answer_ar'=>'required',
                'answer_en'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        


        $sort_number = Faq::all()->count()+1;
        $input['sort'] = $sort_number;

        $Faq = Faq::create($input);

        
        

        return $this->sendResponse(trans("faqs.Faq_create"),$Faq->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Faq = Faq::where('id', $id)->first();

        if(isset($Faq)){
        
        
        }

        if (is_null($Faq)) {
            return $this->sendError(trans("messages.data not found"));
        }

        return $this->sendResponse(trans("faqs.Faq_read"),$Faq->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Faq_id)
    {
       
                $input["question_ar"]=$request->question_ar;
                $input["question_en"]=$request->question_en;
                $input["answer_ar"]=$request->answer_ar;
                $input["answer_en"]=$request->answer_en;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;

        

         $validator=
            Validator::make($input, [
            'question_ar'=>'required',
                'question_en'=>'required',
                'answer_ar'=>'required',
                'answer_en'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        

        $Faq=Faq::where(['id'=>$Faq_id ])->update($input);

        
        

        $Faq = Faq::where(['id'=>$Faq_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("faqs.Faq_update"),$Faq->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //delete files
         // delete files and images
        
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Faq::where(['id'=>$id ])->delete();



        return $this->sendResponse(trans("faqs.Faq_delete"));

    }

     //additional Functions
            
            

}
