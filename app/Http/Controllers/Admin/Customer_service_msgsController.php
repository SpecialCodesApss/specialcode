<?php


namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer_service_msg;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;

class Customer_service_msgsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Customer_service_msg-show')->only('show');
        $this->middleware('permission:Customer_service_msg-list')->only('index');
        $this->middleware('permission:Customer_service_msg-create')->only('create','store');
        $this->middleware('permission:Customer_service_msg-edit')->only('edit','update');
        $this->middleware('permission:Customer_service_msg-delete')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Customer_service_msg::orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $row_id=$row->id;
                    $form_id="delete_Customer_service_msg_form_".$row_id;
                    $btn='
                    <div style="display:inline-block; width: 210px;">
                    <a class="btn btn-info" href="Customer_service_msgs/'.$row_id.'">عرض</a>
                            <a class="btn btn-primary" href="Customer_service_msgs/'.$row_id.'/edit">تعديل</a>
                            <form id="'.$form_id.'" method="POST" action="Customer_service_msgs/'.$row_id.'" style="display:inline">
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


        return view('backend.Customer_service_msgs.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Customer_service_msgs.create');
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
            'email' => 'required_if:mobile,==,null|email',
            'mobile' => 'required_if:email,==,null',
            'user_message' => 'required',
        ]);

        $input = $request->all();
        $Customer_service_msg = Customer_service_msg::create($input);

        return redirect()->route('Customer_service_msgs.index')
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
        $Customer_service_msg = Customer_service_msg::find($id);
        return view('backend.Customer_service_msgs.show',compact('Customer_service_msg'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Customer_service_msg = Customer_service_msg::find($id);
        return view('backend.Customer_service_msgs.edit',compact('Customer_service_msg'));
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
            'email' => 'required_if:mobile,==,null|email',
            'mobile' => 'required_if:email,==,null',
            'user_message' => 'required',
        ]);

        $input = $request->all();
        $Customer_service_msg = Customer_service_msg::find($id);
        $Customer_service_msg->update($input);

        return redirect()->route('Customer_service_msgs.index')
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
        Customer_service_msg::find($id)->delete();
        return redirect()->route('Customer_service_msgs.index')
            ->with('success','تم حذف البيانات بنجاح');
    }
}
