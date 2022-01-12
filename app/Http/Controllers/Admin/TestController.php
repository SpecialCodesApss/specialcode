<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;



class TestController extends Controller
{

    use file_type_traits;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        
        $this->middleware('permission:Test_Create', ['only' => ['create','store']]);
        $this->middleware('permission:Test_Read', ['only' => ['index','show']]);
        $this->middleware('permission:Test_Update', ['only' => ['update','edit']]);
        $this->middleware('permission:Test_Delete', ['only' => ['delete','destroy']]);
        
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

                        
                        
                        
                        
                     ->editColumn('active', function(Test $data) {
                            if($data->active == "1"){
                              return trans("admin_messages.active");
                            }
                            else{
                                return trans("admin_messages.inactive");
                            }
                        })
                    

                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Test_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="icon-btn" href="tests/'.$row_id.'"><i class="fa fa-eye text-view"></i></a>
            <a class="icon-btn" href="tests/'.$row_id.'/edit"><i class="fa fa-pencil text-edit"></i></a>
            <form id="'.$form_id.'" method="POST" action="tests/'.$row_id.'" style="display:inline">
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
                return view('backend.tests.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
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

                $lang = App::getLocale();
                
            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'number'=>'required',
                    'image'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                $input = $request->all();

                

                

                
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/tests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                    }
                }
                


                $Test = Test::create($input);

                //store images if found
                //store files if found


                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('tests.create')
                        ->with('success',trans('admin_messages.info_added'));
                }
                else{
                    return redirect()->route('tests.index')
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

            $lang = App::getLocale();
                $Test = Test::find($id);
                
                

                
                

                


                return view('backend.tests.edit',compact('Test'
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

            $Test = Test::find($id);
                 
            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'number'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                $input = $request->all();

                

                

                
                $old_image=Test::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/tests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }
                


                $Test->update($input);

                //store images if found
                //store files if found

                return redirect()->route('tests.index')
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
        
                $old_image=Test::find($id)->image;
                 File::delete($old_image);
                

                 // delete files and images in sub tables if this module has mutiple files or images
        

                Test::find($id)->delete();
                return redirect()->route('tests.index')
                    ->with('success',trans('admin_messages.info_deleted'));
            }

            //additional Functions
            
            


            




        }