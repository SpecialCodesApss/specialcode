<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notifications_text;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;



class Notifications_textController extends Controller
{

    use file_type_traits;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

        $this->middleware('permission:Notifications_text_Create', ['only' => ['create','store']]);
        $this->middleware('permission:Notifications_text_Read', ['only' => ['index','show']]);
        $this->middleware('permission:Notifications_text_Update', ['only' => ['update','edit']]);
        $this->middleware('permission:Notifications_text_Delete', ['only' => ['delete','destroy']]);

    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Notifications_text::query();








                    return Datatables::eloquent($data)






                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Notifications_text_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="icon-btn" href="notifications_texts/'.$row_id.'"><i class="fa fa-eye text-view"></i></a>
            <a class="icon-btn" href="notifications_texts/'.$row_id.'/edit"><i class="fa fa-pencil text-edit"></i></a>
            <form id="'.$form_id.'" method="POST" action="notifications_texts/'.$row_id.'" style="display:inline">
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
                return view('backend.notifications_texts.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Notifications_text::all()->count()+1;


                return view('backend.notifications_texts.create',compact('sort_number'));
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
            'description_text_en'=>'required',
                    'description_text_ar'=>'required',
                    'trarget_url'=>'required',
                    'icon'=>'required',

        ]);



                $input["description_text_en"]=$request->description_text_en;
                $input["description_text_ar"]=$request->description_text_ar;
                $input["trarget_url"]=$request->trarget_url;
                $input["icon"]=$request->icon;








                $Notifications_text = Notifications_text::create($input);

                //store images if found
                //store files if found


                if($request->save_type=="save_and_add_new"){
                    return redirect()->route('notifications_texts.create')
                        ->with('success',trans('admin.info_added'));
                }
                else{
                    return redirect()->route('notifications_texts.index')
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
                $Notifications_text = Notifications_text::find($id);







                return view('backend.notifications_texts.show',compact('Notifications_text'   ));

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
                $Notifications_text = Notifications_text::find($id);









                return view('backend.notifications_texts.edit',compact('Notifications_text'
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

            $Notifications_text = Notifications_text::find($id);

            $this->validate($request, [
            'description_text_en'=>'required',
                    'description_text_ar'=>'required',
                    'trarget_url'=>'required',
                    'icon'=>'required',

        ]);



                $input["description_text_en"]=$request->description_text_en;
                $input["description_text_ar"]=$request->description_text_ar;
                $input["trarget_url"]=$request->trarget_url;
                $input["icon"]=$request->icon;








                $Notifications_text->update($input);

                //store images if found
                //store files if found

                return redirect()->route('notifications_texts.index')
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


                Notifications_text::find($id)->delete();
                return redirect()->route('notifications_texts.index')
                    ->with('success',trans('admin.info_deleted'));
            }

            //additional Functions









        }
