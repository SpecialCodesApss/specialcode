<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wallet;
use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;


class WalletController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Wallet-list', ['only' => ['index','show']]);
        $this->middleware('permission:Wallet-create', ['only' => ['create','store']]);
        $this->middleware('permission:Wallet-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Wallet-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Wallet::latest()->get();
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
                            $form_id="delete_Wallet_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="wallets/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="wallets/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="wallets/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('wallets.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Wallet::all()->count()+1;
            
            
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get('id');
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->id;
                }
                
                return view('wallets.create',compact('sort_number','users'));
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
            'user_id'=>'required|unique:wallets',
                'wallet_balance'=>'required',
                'active'=>'required',
                
        ]);
        

                $input = $request->all();

                


                $Wallet = Wallet::create($input);

                //store images if found
                //store files if found

                return redirect()->route('wallets.index')
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
                $Wallet = Wallet::find($id);



                return view('wallets.show',compact('Wallet'  ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Wallet = Wallet::find($id);
                
                
                
                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get('id');
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->id;
                }
                
                
                return view('wallets.edit',compact('Wallet' ,'users' ));
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
                'wallet_balance'=>'required',
                'active'=>'required',
                
        ]);
        

                $input = $request->all();

                

                $Wallet = Wallet::find($id);
                $Wallet->update($input);

                //store images if found
                //store files if found

                return redirect()->route('wallets.index')
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


                Wallet::find($id)->delete();
                return redirect()->route('wallets.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions

            

        }