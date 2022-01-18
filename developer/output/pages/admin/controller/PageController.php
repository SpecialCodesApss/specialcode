<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

use Spatie\Permission\Models\Role;
use DB;
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
    function __construct()
    {

        $this->middleware('permission:Page_Create', ['only' => ['create','store']]);
        $this->middleware('permission:Page_Read', ['only' => ['index','show']]);
        $this->middleware('permission:Page_Update', ['only' => ['update','edit']]);
        $this->middleware('permission:Page_Delete', ['only' => ['delete','destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Page::query();








            return Datatables::eloquent($data)






                ->addColumn('action', function($row){
                    $row_id=$row->id;
                    $form_id="delete_Page_form_".$row_id;
                    $btn='<div style="display:inline-block; width: 210px;">
            <a class="icon-btn" href="pages/'.$row_id.'"><i class="fa fa-eye text-view"></i></a>
            <a class="icon-btn" href="pages/'.$row_id.'/edit"><i class="fa fa-pencil text-edit"></i></a>
            <form id="'.$form_id.'" method="POST" action="pages/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')"
                                        class="btn icon-btn"><i class="fa fa-trash text-delete"></i></button>
                                    </form></div>';
                    return $btn;
                })
                ->rawColumns(['action'])

                ->make(true);
        }
        return view('backend.pages.index');

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $lang = App::getLocale();
        $sort_number = Page::all()->count()+1;


        return view('backend.pages.create',compact('sort_number'));
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
            'page_key'=>'required|unique:pages',
            'title_ar'=>'required',
            'title_en'=>'required',
            'html_page_ar'=>'required',
            'html_page_en'=>'required',

        ]);



        $input["page_key"]=$request->page_key;
        $input["title_ar"]=$request->title_ar;
        $input["title_en"]=$request->title_en;
        $input["html_page_ar"]=$request->html_page_ar;
        $input["html_page_en"]=$request->html_page_en;








        $Page = Page::create($input);

        //store images if found
        //store files if found


        if($request->save_type=="save_and_add_new"){
            return redirect()->route('pages.create')
                ->with('success',trans('admin.info_added'));
        }
        else{
            return redirect()->route('pages.index')
                ->with('success',trans('admin.info_added'));
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
        $Page = Page::find($id);







        return view('backend.pages.show',compact('Page'   ));

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
        $Page = Page::find($id);









        return view('backend.pages.edit',compact('Page'
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

        $Page = Page::find($id);

        $this->validate($request, [
            'title_ar'=>'required',
            'title_en'=>'required',
            'html_page_ar'=>'required',
            'html_page_en'=>'required',

        ]);

        $input["title_ar"]=$request->title_ar;
        $input["title_en"]=$request->title_en;
        $input["html_page_ar"]=$request->html_page_ar;
        $input["html_page_en"]=$request->html_page_en;


        $dont_update_pages=["terms","privacy","aboutapp","aboutus",
            "terms_mobile","privacy_mobile","aboutapp_mobile","aboutus_mobile"];
        if(!in_array($Page->page_key,$dont_update_pages)){
            $input["page_key"]=$request->page_key;
//            return redirect()->back()->with('error',trans('admin.cant_update_key_this_page'));
        }


        $Page->update($input);

        //store images if found
        //store files if found

        return redirect()->route('pages.index')
            ->with('success',trans('admin.info_edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete files and images


        // delete files and images in sub tables if this module has mutiple files or images
        $dont_delete_pages=["terms","privacy","aboutapp","aboutus",
            "terms_mobile","privacy_mobile","aboutapp_mobile","aboutus_mobile"];
        $page=Page::find($id);
        if(in_array($page->page_key,$dont_delete_pages)){
            return redirect()->back()
                ->with('error',trans('admin.cant_delete_this_page'));
        }
        $page=Page::find($id)->delete();
        return redirect()->route('pages.index')
            ->with('success',trans('admin.info_deleted'));
    }

    //additional Functions









}
