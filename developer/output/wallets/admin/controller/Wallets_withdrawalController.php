<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wallets_withdrawal;
use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;


class Wallets_withdrawalController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Wallets_withdrawal-list', ['only' => ['index','show']]);
        $this->middleware('permission:Wallets_withdrawal-create', ['only' => ['create','store']]);
        $this->middleware('permission:Wallets_withdrawal-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Wallets_withdrawal-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Wallets_withdrawal::latest()->get();
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
                            $form_id="delete_Wallets_withdrawal_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="wallets_withdrawals/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="wallets_withdrawals/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="wallets_withdrawals/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('wallets_withdrawals.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Wallets_withdrawal::all()->count()+1;
            
            
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get('id');
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->id;
                }
                
                return view('wallets_withdrawals.create',compact('sort_number','users'));
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
            'user_id'=>'required',
                'bank_name'=>'required',
                'account_owner_name'=>'required',
                'iban_number'=>'required',
                'account_number'=>'required',
                'withdrawal_amount_required'=>'required',
                'money_withdrawal_status'=>'required',
                
        ]);
        

                $input = $request->all();

                


                $Wallets_withdrawal = Wallets_withdrawal::create($input);

                //store images if found
                //store files if found

                return redirect()->route('wallets_withdrawals.index')
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
                $Wallets_withdrawal = Wallets_withdrawal::find($id);
                
                

                return view('wallets_withdrawals.show',compact('Wallets_withdrawal'  ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Wallets_withdrawal = Wallets_withdrawal::find($id);
                
                
                
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get('id');
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->id;
                }
                
                
                return view('wallets_withdrawals.edit',compact('Wallets_withdrawal' ,'users' ));
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
            'user_id'=>'required',
                'bank_name'=>'required',
                'account_owner_name'=>'required',
                'iban_number'=>'required',
                'account_number'=>'required',
                'withdrawal_amount_required'=>'required',
                'money_withdrawal_status'=>'required',
                
        ]);
        

                $input = $request->all();

                

                $Wallets_withdrawal = Wallets_withdrawal::find($id);
                $Wallets_withdrawal->update($input);

                //store images if found
                //store files if found

                return redirect()->route('wallets_withdrawals.index')
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
        

                Wallets_withdrawal::find($id)->delete();
                return redirect()->route('wallets_withdrawals.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            

        }