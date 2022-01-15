<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;



class FaqController extends Controller
{

    use file_type_traits;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        
        $this->middleware('permission:Faq_Create', ['only' => ['create','store']]);
        $this->middleware('permission:Faq_Read', ['only' => ['index','show']]);
        $this->middleware('permission:Faq_Update', ['only' => ['update','edit']]);
        $this->middleware('permission:Faq_Delete', ['only' => ['delete','destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Faq::query();


                    

                    



                    return Datatables::eloquent($data)

                        
                        
                        
                        
                     ->editColumn('active', function(Faq $data) {
                            if($data->active == "1"){
                              return trans("admin_messages.active");
                            }
                            else{
                                return trans("admin_messages.inactive");
                            }
                        })
                    

                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Faq_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="icon-btn" href="faqs/'.$row_id.'"><i class="fa fa-eye text-view"></i></a>
            <a class="icon-btn" href="faqs/'.$row_id.'/edit"><i class="fa fa-pencil text-edit"></i></a>
            <form id="'.$form_id.'" method="POST" action="faqs/'.$row_id.'" style="display:inline">
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
                return view('backend.faqs.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Faq::all()->count()+1;

            
                return view('backend.faqs.create',compact('sort_number'));
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
            'question_ar'=>'required',
                    'question_en'=>'required',
                    'answer_ar'=>'required',
                    'answer_en'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                
                $input["question_ar"]=$request->question_ar;
                $input["question_en"]=$request->question_en;
                $input["answer_ar"]=$request->answer_ar;
                $input["answer_en"]=$request->answer_en;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;

                

                

                


                $Faq = Faq::create($input);

                //store images if found
                //store files if found


                if($request->save_type=="save_and_add_new"){
                    return redirect()->route('faqs.create')
                        ->with('success',trans('admin_messages.info_added'));
                }
                else{
                    return redirect()->route('faqs.index')
                        ->with('success',trans('admin_messages.info_added'));
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
                $Faq = Faq::find($id);
                
                

                
                 


                return view('backend.faqs.show',compact('Faq'   ));

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
                $Faq = Faq::find($id);
                
                

                
                

                


                return view('backend.faqs.edit',compact('Faq'
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

            $Faq = Faq::find($id);
                 
            $this->validate($request, [
            'question_ar'=>'required',
                    'question_en'=>'required',
                    'answer_ar'=>'required',
                    'answer_en'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                
                $input["question_ar"]=$request->question_ar;
                $input["question_en"]=$request->question_en;
                $input["answer_ar"]=$request->answer_ar;
                $input["answer_en"]=$request->answer_en;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;

                

                

                


                $Faq->update($input);

                //store images if found
                //store files if found

                return redirect()->route('faqs.index')
                    ->with('success',trans('admin_messages.info_edited'));
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
        

                Faq::find($id)->delete();
                return redirect()->route('faqs.index')
                    ->with('success',trans('admin_messages.info_deleted'));
            }

            //additional Functions
            
            


            




        }