<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;



class ContactController extends Controller
{

    use file_type_traits;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

        $this->middleware('permission:Contact_Create', ['only' => ['create','store']]);
        $this->middleware('permission:Contact_Read', ['only' => ['index','show']]);
        $this->middleware('permission:Contact_Update', ['only' => ['update','edit']]);
        $this->middleware('permission:Contact_Delete', ['only' => ['delete','destroy']]);

    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Contact::query();








                    return Datatables::eloquent($data)





                     ->editColumn('active', function(Contact $data) {
                            if($data->active == "1"){
                              return trans("admin.active");
                            }
                            else{
                                return trans("admin.inactive");
                            }
                        })


                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Contact_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="icon-btn" href="contacts/'.$row_id.'"><i class="fa fa-eye text-view"></i></a>
            <a class="icon-btn" href="contacts/'.$row_id.'/edit"><i class="fa fa-pencil text-edit"></i></a>
            <form id="'.$form_id.'" method="POST" action="contacts/'.$row_id.'" style="display:inline">
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
                return view('backend.contacts.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Contact::all()->count()+1;


                return view('backend.contacts.create',compact('sort_number'));
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
            'flag'=>'required|unique:contacts',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'value_ar'=>'required',
                    'value_en'=>'required',
                    'active'=>'required',
                    'sort'=>'required',

        ]);



                $input["flag"]=$request->flag;
                $input["name_ar"]=$request->name_ar;
                $input["name_en"]=$request->name_en;
                $input["icon_text"]=$request->icon_text;
                $input["value_ar"]=$request->value_ar;
                $input["value_en"]=$request->value_en;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;






                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/contacts/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                    }
                }



                $Contact = Contact::create($input);

                //store images if found
                //store files if found


                if($request->save_type=="save_and_add_new"){
                    return redirect()->route('contacts.create')
                        ->with('success',trans('admin.info_added'));
                }
                else{
                    return redirect()->route('contacts.index')
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
                $Contact = Contact::find($id);







                return view('backend.contacts.show',compact('Contact'   ));

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
                $Contact = Contact::find($id);









                return view('backend.contacts.edit',compact('Contact'
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

            $Contact = Contact::find($id);

            $this->validate($request, [
            'flag'=>'required|unique:contacts,flag,'.$Contact->id.',id',
                    'name_ar'=>'required',
                    'name_en'=>'required',
                    'value_ar'=>'required',
                    'value_en'=>'required',
                    'active'=>'required',
                    'sort'=>'required',

        ]);



//                $input["flag"]=$request->flag;
                $input["name_ar"]=$request->name_ar;
                $input["name_en"]=$request->name_en;
                $input["icon_text"]=$request->icon_text;
                $input["value_ar"]=$request->value_ar;
                $input["value_en"]=$request->value_en;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;






                $old_image=Contact::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/contacts/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }


                $dont_update_flags=["email","mobile","address","facebook",
                    "twitter","instagram","snapchat","googleplay","appstore"];
                if(!in_array($Contact->flag,$dont_update_flags)){
                    $input["flag"]=$request->flag;
                }


                $Contact->update($input);

                //store images if found
                //store files if found

                return redirect()->route('contacts.index')
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

                $old_image=Contact::find($id)->image;
                 File::delete($old_image);


                 // delete files and images in sub tables if this module has mutiple files or images

                $contact=Contact::find($id);
                $dont_update_flags=["email","mobile","address","facebook",
                    "twitter","instagram","snapchat","googleplay","appstore"];
                if(in_array($contact->flag,$dont_update_flags)){
                    return redirect()->back()
                        ->with('error',trans('admin.cant_delete_this_contact'));
                }

                $contact->delete();
                return redirect()->route('contacts.index')
                    ->with('success',trans('admin.info_deleted'));
            }

            //additional Functions









        }
