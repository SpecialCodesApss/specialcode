<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Spatie\Permission\Models\Role;
use DB;
use DataTables;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Page-show')->only('show');
        $this->middleware('permission:Page-list')->only('index');
        $this->middleware('permission:Page-create')->only('create','store');
        $this->middleware('permission:Page-edit')->only('edit','update');
        $this->middleware('permission:Page-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Page::latest()->get();
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
                    $form_id="delete_Page_form_".$row_id;
                    $btn='
                    <div style="display:inline-block; width: 210px;">
                    <a class="btn btn-info" href="pages/'.$row_id.'">عرض</a>
                            <a class="btn btn-primary" href="pages/'.$row_id.'/edit">تعديل</a>
                            <form id="'.$form_id.'" method="POST" action="pages/'.$row_id.'" style="display:inline">
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
        return view('backend.pages.index');

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort_number = Page::all()->count()+1;
        return view('backend.pages.create',compact('sort_number'));
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
            'page_key'=>'required',
                'title_ar'=>'required',
                'title_en'=>'required',
                'html_page_ar'=>'required',
                'html_page_en'=>'required',

        ]);


        $input = $request->all();

        if ($request->hasFile('image')) {
            $document = $request->file('image');
            $ext = $document->getClientOriginalExtension();
            if ($request->file('image') && $request->file('image')->isValid()) {
                $imageName = date('YmdHis') . ".$ext";
                $path = 'storage/images/pages/';
                $request->file('image')->move($path, $imageName);
                $input['image'] = $path.$imageName;
            }
        }


        $Page = Page::create($input);

        return redirect()->route('pages.index')
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
        $Page = Page::find($id);
        return view('backend.pages.show',compact('Page'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Page = Page::find($id);
        return view('backend.pages.edit',compact('Page'));
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
            'page_key'=>'required',
                'title_ar'=>'required',
                'title_en'=>'required',
                'html_page_ar'=>'required',
                'html_page_en'=>'required',

        ]);


        $input = $request->all();
        $old_image=Page::find($id)->image;
        if ($request->hasFile('image')) {
            $document = $request->file('image');
            $ext = $document->getClientOriginalExtension();
            if ($request->file('image') && $request->file('image')->isValid()) {
                $imageName = date('YmdHis') . ".$ext";
                $path = 'storage/images/pages/';
                $request->file('image')->move($path, $imageName);
                $input['image'] = $path.$imageName;
            }
        }
        else{
            $input['image'] =$old_image;
        }

        $Page = Page::find($id);
        $Page->update($input);

        return redirect()->route('pages.index')
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
        Page::find($id)->delete();
        return redirect()->route('pages.index')
            ->with('success','تم حذف البيانات بنجاح');
    }

}
