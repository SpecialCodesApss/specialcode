<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Test;
use App\User;
use App\Admin_section;
use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;



class TestController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');

        $this->middleware('permission:Test-list', ['only' => ['index','show']]);
        $this->middleware('permission:Test-create', ['only' => ['create','store']]);
        $this->middleware('permission:Test-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Test-delete', ['only' => ['destroy']]);

    }


    public function checkusername(Request $request){
        $user_email = $request["email"];
        $user = User::where("email",$user_email)->first();
        if(isset($user)){
            return "true";
        }
        else{
            return "false";
        }

    }

    public function searchusername(Request $request){
        $search_text = $request["search_text"];
        $search_text = "adm";
        $response_Array=[];
        $users = User::where("email",'like','%'.$search_text.'%')->get('email');
        foreach ($users as $user){
            array_push($response_Array,$user->email);
        }
        return $response_Array;
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Test::query();








                    return Datatables::eloquent($data)



                        ->order(function ($data) {
                            $data->orderBy('id', 'desc');
                        })
                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Test_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="tests/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="tests/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="tests/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.tests.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Test::all()->count()+1;


                return view('backend.tests.create',compact('sort_number'));
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
            'users_ids'=>'required',

        ]);


                $input = $request->all();






                $Test = Test::create($input);

                //store images if found
                //store files if found

                return redirect()->route('tests.index')
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
                $Test = Test::find($id);







                return view('backend.tests.show',compact('Test'   ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Test = Test::find($id);







                return view('backend.tests.edit',compact('Test'  ));
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
            'users_ids'=>'required',

        ]);


                $input = $request->all();




                $Test = Test::find($id);
                $Test->update($input);

                //store images if found
                //store files if found

                return redirect()->route('tests.index')
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


                Test::find($id)->delete();
                return redirect()->route('tests.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions




            public function getadmin_sectionsInfo_for_tests(Request $request){
        $Test_id = $request->Test_id;
        //get row info
        $Test = Test::find($Test_id);


        $admin_sections_info = $Test->admin_sections_ids;

            $admin_sections_info = json_decode($admin_sections_info);

            $data = Admin_section::orderBy('id', 'desc')->whereIn('id', $admin_sections_info)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $user_id = $row->id;
                    $btn = '
                    <div style="display:inline-block; width: 210px;">
                    <a class="btn btn-info" href="admin_sections/' . $user_id . '">عرض</a>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }





        }