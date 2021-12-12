<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users_type;
use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;



class Users_typeController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Users_types-show')->only('show');
        $this->middleware('permission:Users_types-list')->only('index');
        $this->middleware('permission:Users_types-create')->only('create','store');
        $this->middleware('permission:Users_types-edit')->only('edit','update');
        $this->middleware('permission:Users_types-delete')->only('destroy');
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Users_type::orderBy('id','desc')->get();


                    foreach ($data as $info ){
                        if($info->active == '1'){
                            $info->active=trans("messages.active");
                        }
                        else{
                            $info->active=trans("messages.inactive");
                        }

                    }
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Users_type_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="users_types/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="users_types/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="users_types/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.users_types.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Users_type::all()->count()+1;


                return view('backend.users_types.create',compact('sort_number'));
            }

            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {

            $this->validate($request, [
            'type_name_ar'=>'required',
                    'type_name_en'=>'required',

        ]);


                $input = $request->all();






                $Users_type = Users_type::create($input);

                //store images if found
                //store files if found

                return redirect()->route('users_types.index')
                    ->with('success','تم اضافة البيانات بنجاح');
            }


            /**
             * Display the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $Users_type = Users_type::find($id);







                return view('backend.users_types.show',compact('Users_type'   ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Users_type = Users_type::find($id);







                return view('backend.users_types.edit',compact('Users_type'  ));
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

            $this->validate($request, [
            'type_name_ar'=>'required',
                    'type_name_en'=>'required',

        ]);


                $input = $request->all();




                $Users_type = Users_type::find($id);
                $Users_type->update($input);

                //store images if found
                //store files if found

                return redirect()->route('users_types.index')
                    ->with('success','تم تحديث البيانات بنجاح');
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


                Users_type::find($id)->delete();
                return redirect()->route('users_types.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions



        }
