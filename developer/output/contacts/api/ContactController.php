<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Contact;
use App\Customer_service_msg;
use Spatie\Permission\Models\Role;
use DB;
use DataTables;
use Illuminate\Support\Facades\App;
use Validator;
class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $data = Contact::latest()->get();
            foreach ($data as $info ){
                if($info->active == '1'){
                    $info->active_text='مفعل';
                }
                else{
                    $info->active_text='غير مفعل';
                }
            }
        return $this->sendResponse('data Retrieved successfully.',$data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // send New Contact us message

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        $Contact = Contact::where('flag',$key)->first();
        if($Contact->active == '1'){
            $Contact->active=trans('messages.active');
        }
        else{
            $Contact->active=trans('messages.inactive');
        }
        return $this->sendResponse('data retrieved successfully.',$Contact);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }



}
