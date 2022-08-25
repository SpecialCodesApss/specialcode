<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;



class ContentController extends Controller
{

    use file_type_traits;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        
        $this->middleware('permission:Content_Create', ['only' => ['create','store']]);
        $this->middleware('permission:Content_Read', ['only' => ['index','show']]);
        $this->middleware('permission:Content_Update', ['only' => ['update','edit']]);
        $this->middleware('permission:Content_Delete', ['only' => ['delete','destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Content::query();


                    

                    



                    return Datatables::eloquent($data)

                        
                        
                        
                        

                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Content_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="icon-btn" href="contents/'.$row_id.'"><i class="fa fa-eye text-view"></i></a>
            <a class="icon-btn" href="contents/'.$row_id.'/edit"><i class="fa fa-pencil text-edit"></i></a>
            <form id="'.$form_id.'" method="POST" action="contents/'.$row_id.'" style="display:inline">
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
                return view('backend.contents.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Content::all()->count()+1;

            
                return view('backend.contents.create',compact('sort_number'));
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
            'content_key'=>'required',
                    'cp_name'=>'required',
                    'content_ar'=>'required',
                    'content_en'=>'required',
                    
        ]);
        

                
                $input["content_key"]=$request->content_key;
                $input["cp_name"]=$request->cp_name;
                $input["content_ar"]=$request->content_ar;
                $input["content_en"]=$request->content_en;

                

                

                


                $Content = Content::create($input);

                //store images if found
                //store files if found


                if($request->save_type=="save_and_add_new"){
                    return redirect()->route('contents.create')
                        ->with('success',trans('admin.info_added'));
                }
                else{
                    return redirect()->route('contents.index')
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
                $Content = Content::find($id);
                
                

                
                 


                return view('backend.contents.show',compact('Content'   ));

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
                $Content = Content::find($id);
                
                

                
                

                


                return view('backend.contents.edit',compact('Content'
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

            $Content = Content::find($id);
                 
            $this->validate($request, [
            'content_key'=>'required',
                    'cp_name'=>'required',
                    'content_ar'=>'required',
                    'content_en'=>'required',
                    
        ]);
        

                
                $input["content_key"]=$request->content_key;
                $input["cp_name"]=$request->cp_name;
                $input["content_ar"]=$request->content_ar;
                $input["content_en"]=$request->content_en;

                

                

                


                $Content->update($input);

                //store images if found
                //store files if found

                return redirect()->route('contents.index')
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
        

                Content::find($id)->delete();
                return redirect()->route('contents.index')
                    ->with('success',trans('admin.info_deleted'));
            }

            //additional Functions
            
            


            




        }