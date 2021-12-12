<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Spatie\Permission\Models\Role;
use DB;
use DataTables;
use Illuminate\Support\Facades\App;

class ContactController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Contact-show')->only('show');
        $this->middleware('permission:Contact-list')->only('index');
        $this->middleware('permission:Contact-create')->only('create','store');
        $this->middleware('permission:Contact-edit')->only('edit','update');
        $this->middleware('permission:Contact-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Contact::latest()->get();
            foreach ($data as $info ){
                if($info->active == '1'){
                    $info->active='مفعل';
                }
                else{
                    $info->active='غير مفعل';
                }
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $row_id=$row->id;
                    $form_id="delete_Contact_form_".$row_id;
                    $btn='
                    <div style="display:inline-block; width: 210px;">
                    <a class="btn btn-info" href="contacts/'.$row_id.'">عرض</a>
                            <a class="btn btn-primary" href="contacts/'.$row_id.'/edit">تعديل</a>
                            <form id="'.$form_id.'" method="POST" action="contacts/'.$row_id.'" style="display:inline">
                                <input name="_method" type="hidden" value="DELETE">
                                <input name="_token" type="hidden" value="'.csrf_token().'">
                                <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                            </form>
                    </div>
                    ';
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

            $this->validate($request, [
            'flag'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
                'icon_text'=>'required',
                'image'=>'required',
                'value_ar'=>'required',
                'value_en'=>'required',

        ]);


        $input = $request->all();

        if ($request->hasFile('image')) {
            $document = $request->file('image');
            $ext = $document->getClientOriginalExtension();
            if ($request->file('image') && $request->file('image')->isValid()) {
                $imageName = date('YmdHis') . ".$ext";
                $path = 'storage/images/contacts/';
                $request->file('image')->move($path, $imageName);
                $input['image'] = $path.$imageName;
            }
        }


        $Contact = Contact::create($input);

        return redirect()->route('contacts.index')
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
        $Contact = Contact::find($id);
        return view('backend.contacts.show',compact('Contact'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Contact = Contact::find($id);
        return view('backend.contacts.edit',compact('Contact'));
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
            'flag'=>'required',
                'name_ar'=>'required',
                'name_en'=>'required',
                'icon_text'=>'required',
                'value_ar'=>'required',
                'value_en'=>'required',

        ]);


        $input = $request->all();
        $old_image=Contact::find($id)->image;
        if ($request->hasFile('image')) {
            $document = $request->file('image');
            $ext = $document->getClientOriginalExtension();
            if ($request->file('image') && $request->file('image')->isValid()) {
                $imageName = date('YmdHis') . ".$ext";
                $path = 'storage/images/contacts/';
                $request->file('image')->move($path, $imageName);
                $input['image'] = $path.$imageName;
            }
        }
        else{
            $input['image'] =$old_image;
        }

        $Contact = Contact::find($id);
        $Contact->update($input);

        return redirect()->route('contacts.index')
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
        Contact::find($id)->delete();
        return redirect()->route('contacts.index')
            ->with('success','تم حذف البيانات بنجاح');
    }

}
