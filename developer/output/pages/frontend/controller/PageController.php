<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

use Spatie\Permission\Models\Role;
use DB;
use Auth;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;



class PageController extends Controller
{

    use file_type_traits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index(Request $request)
//    {
//
//        $searchText=$request->searchText;
//        $pages = Page::paginate(20);
//        return view("frontend.pages.index",compact('pages'));
//    }
//
//
//    /**
//             * Show the form for creating a new resource.
//             *
//             * @return \Illuminate\Http\Response
//             */
//            public function create()
//            {
//
//                $lang = App::getLocale();
//                $sort_number = Page::all()->count()+1;
//
//
//                return view('frontend.pages.create',compact('sort_number'));
//            }
//
//            /**
//             * Store a newly created resource in storage.
//             *
//             * @param  \Illuminate\Http\Request  $request
//             * @return \Illuminate\Http\Response
//             */
//            public function store(Request $request)
//            {
//
//                $lang = App::getLocale();
//
//            $this->validate($request, [
//            'page_key'=>'required|unique:pages',
//                    'title_ar'=>'required',
//                    'title_en'=>'required',
//                    'html_page_ar'=>'required',
//                    'html_page_en'=>'required',
//
//        ]);
//
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
//
//
//
//
//
//
//
//                $Page = Page::create($input);
//
//                //store images if found
//                //store files if found
//
//
//                if($request->save_type=="save_and_add_new"){
//                    return redirect('pages/create')
//                        ->with('success',trans('admin_messages.info_added'));
//                }
//                else{
//                    return redirect('pages')
//                        ->with('success',trans('admin_messages.info_added'));
//                }
//
//            }


            /**
             * Display the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
            $lang = App::getLocale();



               $Page = Page::where('id',$id)->orWhere('page_key',$id)->first();

        if(isset($Page)){


        }

        if (is_null($Page)) {
            return view('errors.404');
//            return back()->with('error',trans('admin_messages.Page not found.'));
//            return $this->sendError('Page not found.');
        }





                return view('frontend.pages.show',compact('Page'   ));

            }

//
//            /**
//             * Show the form for editing the specified resource.
//             *
//             * @param  int  $id
//             * @return \Illuminate\Http\Response
//             */
//            public function edit($id)
//            {
//
//            $lang = App::getLocale();
//                $Page = Page::find($id);
//
//
//
//
//
//
//
//
//
//                return view('frontend.pages.edit',compact('Page'
//                 ));
//            }
//
//
//            /**
//             * Update the specified resource in storage.
//             *
//             * @param  \Illuminate\Http\Request  $request
//             * @param  int  $id
//             * @return \Illuminate\Http\Response
//             */
//            public function update(Request $request, $id)
//            {
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
//            $this->validate($request, [
//            'title_ar'=>'required',
//                    'title_en'=>'required',
//                    'html_page_ar'=>'required',
//                    'html_page_en'=>'required',
//
//        ]);
//
//
//
//
//
//
//
//
//
//
//                 $Page=Page::where(['id'=>$id ])->update($input);
//
//        //store images if found
//        //store files if found
//
//        $Page = Page::where(['id'=>$id , 'user_id' => $user_id ])->get();
//
//                return redirect('pages')
//                    ->with('success',trans('admin_messages.info_edited'));
//            }
//
//            /**
//             * Remove the specified resource from storage.
//             *
//             * @param  int  $id
//             * @return \Illuminate\Http\Response
//             */
//            public function destroy($id)
//            {
//
//        //delete files
//         // delete files and images
//
//
//         // delete files and images in sub tables if this module has mutiple files or images
//
//
//        Page::where(['id'=>$id])->delete();
//
//                return redirect('pages')
//                    ->with('success',trans('admin_messages.info_deleted'));
//            }
//
//            //additional Functions
//
//



}
