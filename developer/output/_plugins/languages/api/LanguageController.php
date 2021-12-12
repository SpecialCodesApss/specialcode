<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Language;

use Validator;
use File;

class LanguageController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $languages = Language:: 
        where(function($q) use ($searchText){
            $q->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("ISO_code","like","%".$searchText."%")->orWhere("language_icon","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("languages.Language_read"),$languages->toArray());
    }


//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        $input = $request->all();
//
//
//        $validator=
//            Validator::make($input, [
//            'name_ar'=>'required',
//                'name_en'=>'required',
//                'ISO_code'=>'required',
//                'active'=>'required',
//
//        ]);
//
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors()->first());
//        }
//
//
//                if ($request->hasFile('language_icon')) {
//                    $document = $request->file('language_icon');
//                    $ext = $document->getClientOriginalExtension();
//                        $imageName = date('YmdHis') . ".$ext";
//                        $path = 'storage/images/languages/language_icon/';
//                        $request->file('language_icon')->move($path, $imageName);
//                        $input['language_icon'] = $path.$imageName;
//                }
//
//
//        $Language = Language::create($input);
//
//
//
//
//        return $this->sendResponse(trans("languages.Language_create"),$Language->toArray());
//    }
//
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id,Request $request)
//    {
//
//
//        $Language = Language::where('id', $id)->first();
//
//        if(isset($Language)){
//
//
//        }
//
//        if (is_null($Language)) {
//            return $this->sendError('Language not found.');
//        }
//
//        return $this->sendResponse(trans("languages.Language_read"),$Language->toArray());
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request,$Language_id)
//    {
//        $input = $request->except('images','files','_method');
//
//
//         $validator=
//            Validator::make($input, [
//            'name_ar'=>'required',
//                'name_en'=>'required',
//                'ISO_code'=>'required',
//                'active'=>'required',
//
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors()->first());
//        }
//
//
//                $old_language_icon=Language::find($Language_id)->language_icon;
//                if ($request->hasFile('language_icon')) {
//                    $document = $request->file('language_icon');
//                    $ext = $document->getClientOriginalExtension();
//                        $imageName = date('YmdHis') . ".$ext";
//                        $path = 'storage/images/languages/language_icon/';
//                        $request->file('language_icon')->move($path, $imageName);
//                        $input['language_icon'] = $path.$imageName;
//                        File::delete($old_language_icon);
//                    }
//                    else{
//                    $input['language_icon'] =$old_language_icon;
//                }
//
//
//        $Language=Language::where(['id'=>$Language_id ])->update($input);
//
//
//
//
//        $Language = Language::where(['id'=>$Language_id , 'user_id' => $user_id ])->get();
//        return $this->sendResponse(trans("languages.Language_update"),$Language->toArray());
//
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Request $request,$Language_id)
//    {
//        //delete files
//         // delete files and images
//
//                $old_language_icon=Language::find($Language_id)->language_icon;
//                 File::delete($old_language_icon);
//
//
//         // delete files and images in sub tables if this module has mutiple files or images
//
//        Language::where(['id'=>$Language_id ])->delete();
//
//
//
//        return $this->sendResponse(trans("languages.Language_delete"));
//
//    }
//
//     //additional Functions
            
            

}
