<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Page;

use Validator;
use File;

class PageController extends BaseController
{
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index(Request $request)
//    {
//
//        $searchText=$request->searchText;
//        $pages = Page::
//        where(function($q) use ($searchText){
//            $q->orWhere("page_key","like","%".$searchText."%")->orWhere("title_ar","like","%".$searchText."%")->orWhere("title_en","like","%".$searchText."%")->orWhere("html_page_ar","like","%".$searchText."%")->orWhere("html_page_en","like","%".$searchText."%");})->paginate(20);
//        return $this->sendResponse(trans("pages.Page_read"),$pages->toArray());
//    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//
//
//                $input["page_key"]=$request->page_key;
//                $input["title_ar"]=$request->title_ar;
//                $input["title_en"]=$request->title_en;
//                $input["html_page_ar"]=$request->html_page_ar;
//                $input["html_page_en"]=$request->html_page_en;
//
//
//
//
//        $validator=
//            Validator::make($input, [
//            'page_key'=>'required',
//                'title_ar'=>'required',
//                'title_en'=>'required',
//                'html_page_ar'=>'required',
//                'html_page_en'=>'required',
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
//
//        $sort_number = Page::all()->count()+1;
//        $input['sort'] = $sort_number;
//
//        $Page = Page::create($input);
//
//
//
//
//        return $this->sendResponse(trans("pages.Page_create"),$Page->toArray());
//    }
//

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $Page = Page::where('id', $id)->orWhere('page_key',$id)->first();
        if(isset($Page)){
        }
        if (is_null($Page)) {
            return $this->sendError(trans('admin.Page not found.'));
        }
        return $this->sendResponse(trans("pages.Page_read"),$Page->toArray());
    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request,$Page_id)
//    {
//
//                $input["page_key"]=$request->page_key;
//                $input["title_ar"]=$request->title_ar;
//                $input["title_en"]=$request->title_en;
//                $input["html_page_ar"]=$request->html_page_ar;
//                $input["html_page_en"]=$request->html_page_en;
//
//
//
//         $validator=
//            Validator::make($input, [
//            'title_ar'=>'required',
//                'title_en'=>'required',
//                'html_page_ar'=>'required',
//                'html_page_en'=>'required',
//
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError($validator->errors()->first());
//        }
//
//
//
//        $Page=Page::where(['id'=>$Page_id ])->update($input);
//
//
//
//
//        $Page = Page::where(['id'=>$Page_id , 'user_id' => $user_id ])->get();
//        return $this->sendResponse(trans("pages.Page_update"),$Page->toArray());
//
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Request $request,$id)
//    {
//        //delete files
//         // delete files and images
//
//
//         // delete files and images in sub tables if this module has mutiple files or images
//
//        Page::where(['id'=>$id ])->delete();
//
//
//
//        return $this->sendResponse(trans("pages.Page_delete"));
//
//    }
//
//     //additional Functions
//


}
