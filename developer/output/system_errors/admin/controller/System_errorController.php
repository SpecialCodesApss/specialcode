<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\System_error;
use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;



class System_errorController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:System_error-list', ['only' => ['index','show']]);
        $this->middleware('permission:System_error-create', ['only' => ['create','store']]);
        $this->middleware('permission:System_error-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:System_error-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = System_error::latest()->get();
                    
                    
                    foreach ($data as $info ){
                        if($info->active == '1'){
                            $info->active=trans("messages.active");
                        }
                        else{
                            $info->active=trans("messages.inactive");
                        }


                        $info->error_title =
                        substr($info->error_title,0,130);

                        
                        
                        
                        
                        
                        
                        
                    }
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_System_error_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="system_errors/'.$row_id.'">عرض</a></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('system_errors.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = System_error::all()->count()+1;
                return view('system_errors.create',compact('sort_number'));
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
            'error_title'=>'required',
                    'error_text'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                

                


                $System_error = System_error::create($input);

                //store images if found
                //store files if found

                return redirect()->route('system_errors.index')
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
                $System_error = System_error::find($id);
                
                
                
                
                 


                return view('system_errors.show',compact('System_error'   ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $System_error = System_error::find($id);
                
                
                
                
                
                
                
                return view('system_errors.edit',compact('System_error'  ));
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
            'error_title'=>'required',
                    'error_text'=>'required',
                    
        ]);
        

                $input = $request->all();
                

                

                $System_error = System_error::find($id);
                $System_error->update($input);

                //store images if found
                //store files if found

                return redirect()->route('system_errors.index')
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
        

                System_error::find($id)->delete();
                return redirect()->route('system_errors.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            

        }