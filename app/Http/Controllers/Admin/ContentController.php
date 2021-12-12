<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Spatie\Permission\Models\Role;
use DB;
use DataTables;
use Illuminate\Support\Facades\App;

class ContentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Content-show')->only('show');
        $this->middleware('permission:Content-list')->only('index');
        $this->middleware('permission:Content-create')->only('create','store');
        $this->middleware('permission:Content-edit')->only('edit','update');
        $this->middleware('permission:Content-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Content::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $row_id=$row->id;
                    $form_id="delete_Content_form_".$row_id;
                    $btn='
                    <div style="display:inline-block; width: 210px;">
                    <a class="btn btn-info" href="contents/'.$row_id.'">عرض</a>
                            <a class="btn btn-primary" href="contents/'.$row_id.'/edit">تعديل</a>
                            <form id="'.$form_id.'" method="POST" action="contents/'.$row_id.'" style="display:inline">
                                <input name="_method" type="hidden" value="DELETE">
                                <input name="_token" type="hidden" value="'.csrf_token().'">
                            </form>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])

                ->make(true);
            return $data;
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

            $this->validate($request, [
            'content_key'=>'required',
                'cp_name'=>'required',
                'content_ar'=>'required',
                'content_en'=>'required',

        ]);


        $input = $request->all();

        if ($request->hasFile('image')) {
            $document = $request->file('image');
            $ext = $document->getClientOriginalExtension();
            if ($request->file('image') && $request->file('image')->isValid()) {
                $imageName = date('YmdHis') . ".$ext";
                $path = 'storage/images/contents/';
                $request->file('image')->move($path, $imageName);
                $input['image'] = $path.$imageName;
            }
        }


        $Content = Content::create($input);

        return redirect()->route('contents.index')
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
        $Content = Content::find($id);
        return view('backend.contents.show',compact('Content'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Content = Content::find($id);
        return view('backend.contents.edit',compact('Content'));
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

                'cp_name'=>'required',
                'content_ar'=>'required',
                'content_en'=>'required',

        ]);


        $input = $request->all();
        $old_image=Content::find($id)->image;
        if ($request->hasFile('image')) {
            $document = $request->file('image');
            $ext = $document->getClientOriginalExtension();
            if ($request->file('image') && $request->file('image')->isValid()) {
                $imageName = date('YmdHis') . ".$ext";
                $path = 'storage/images/contents/';
                $request->file('image')->move($path, $imageName);
                $input['image'] = $path.$imageName;
            }
        }
        else{
            $input['image'] =$old_image;
        }

        $Content = Content::find($id);
        $Content->update($input);

        return redirect()->route('contents.index')
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
        Content::find($id)->delete();
        return redirect()->route('contents.index')
            ->with('success','تم حذف البيانات بنجاح');
    }

}
