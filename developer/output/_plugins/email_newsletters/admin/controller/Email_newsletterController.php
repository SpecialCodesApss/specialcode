<?php
namespace App\Http\Controllers\admin;
use App\Email_newsletters_user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Email_newsletter;

use Spatie\Permission\Models\Role;
use DB;
use Mail;
use File;
use DataTables;
use Illuminate\Support\Facades\App;



class Email_newsletterController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');
        
        $this->middleware('permission:Email_newsletter-list', ['only' => ['index','show']]);
        $this->middleware('permission:Email_newsletter-create', ['only' => ['create','store']]);
        $this->middleware('permission:Email_newsletter-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Email_newsletter-delete', ['only' => ['destroy']]);
        
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = Email_newsletter::query();
                    
                    
                    
                    
                      
                    
            
                        
                    return Datatables::eloquent($data)



//            <a class="btn btn-primary" href="email_newsletters/'.$row_id.'/edit">تعديل</a>
//            <form id="'.$form_id.'" method="POST" action="email_newsletters/'.$row_id.'" style="display:inline">
//                                        <input name="_method" type="hidden" value="DELETE">
//                                        <input name="_token" type="hidden" value="'.csrf_token().'">
//                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
//                                    </form>

                         
                         
                        ->order(function ($data) {
                            $data->orderBy('id', 'desc');
                        })  
                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_Email_newsletter_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
 <a class="btn btn-info" href="email_newsletters/'.$row_id.'">عرض</a>
          </div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.email_newsletters.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = Email_newsletter::all()->count()+1;
            
            
                return view('backend.email_newsletters.create',compact('sort_number'));
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
            'email_title'=>'required',
                    'news_html'=>'required',
                    
        ]);
        

                $input = $request->all();



                /*Send Emails to users */
//                $emails = Email_newsletters_user::get('email');
                $emails = ['myoneemail@esomething.com', 'myother@esomething.com','myother2@esomething.com'];

                $news_html=$input['news_html'];
                $email_title=$input['email_title'];

                Mail::send(array(), [], function($message) use ($emails , $email_title,$news_html)
                {
                    $message->to($emails)->subject($email_title)->setBody($news_html, 'text/html');;
                });
                var_dump( Mail:: failures());
                exit;
                /*End of send Emails to users*/

                $Email_newsletter = Email_newsletter::create($input);




                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('email_newsletters.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('email_newsletters.index')
                        ->with('success','تم اضافة البيانات بنجاح');
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
                $Email_newsletter = Email_newsletter::find($id);
                
                
                
                
                 


                return view('backend.email_newsletters.show',compact('Email_newsletter'   ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $Email_newsletter = Email_newsletter::find($id);
                
                
                
                
                
                
                
                
                
                return view('backend.email_newsletters.edit',compact('Email_newsletter'  ));
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
            
            $Email_newsletter = Email_newsletter::find($id);
                 
            $this->validate($request, [
            'email_title'=>'required',
                    'news_html'=>'required',
                    
        ]);
        

                $input = $request->all();
                
                
                
                

                

                
                $Email_newsletter->update($input);

                //store images if found
                //store files if found

                return redirect()->route('email_newsletters.index')
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
        

                Email_newsletter::find($id)->delete();
                return redirect()->route('email_newsletters.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions
            
            
            
            
            
            
            
            

        }