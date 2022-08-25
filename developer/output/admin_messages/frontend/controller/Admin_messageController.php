<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin_message;

use Spatie\Permission\Models\Role;
use DB;
use Auth;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;

use App\User;



class Admin_messageController extends Controller
{

    use file_type_traits;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $admin_messages = Admin_message::paginate(20);
        return view("frontend.admin_messages.index",compact('admin_messages'));
    }


    /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Admin_message::all()->count()+1;

            
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                return view('frontend.admin_messages.create',compact('sort_number','users'));
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
            'fullname'=>'required',
                    'email'=>'required',
                    'mobile'=>'required',
                    'message_type'=>'required',
                    'messages_text'=>'required',
                    
        ]);
        

                
                $input["fullname"]=$request->fullname;
                $input["email"]=$request->email;
                $input["mobile"]=$request->mobile;
                $input["message_type"]=$request->message_type;
                $input["messages_text"]=$request->messages_text;
                $input["open_status"]=$request->open_status;
                $input["marked_as_readed"]=$request->marked_as_readed;
                $input["marked_as_deleted"]=$request->marked_as_deleted;


                 

                
                        if(isset($input['marked_as_readed'])){
                        $input['marked_as_readed']= 1;
                        }else{
                        $input['marked_as_readed']= 0;
                        }
                    
                        if(isset($input['marked_as_deleted'])){
                        $input['marked_as_deleted']= 1;
                        }else{
                        $input['marked_as_deleted']= 0;
                        }
                    

                

                
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/admin_messages/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                    }
                }
                


                $Admin_message = Admin_message::create($input);

                


                //store images if found
                //store files if found




                if($request->save_type=="save_and_add_new"){
                    return redirect('admin_messages/create')
                        ->with('success',trans('admin.info_added'));
                }
                else{
                    return redirect('admin_messages')
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

            

               $Admin_message = Admin_message::where('id', $id)->first();

        if(isset($Admin_message)){
        
        
        }

        if (is_null($Admin_message)) {
            return back()->with('error',trans('admin.Page not found.'));
        }

                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                 


                return view('frontend.admin_messages.show',compact('Admin_message'  ,'users' ));

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
                $Admin_message = Admin_message::find($id);
                
                

                
                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }
                
                

                


                return view('frontend.admin_messages.edit',compact('Admin_message'
                ,'users' ));
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

            
                $input["fullname"]=$request->fullname;
                $input["email"]=$request->email;
                $input["mobile"]=$request->mobile;
                $input["message_type"]=$request->message_type;
                $input["messages_text"]=$request->messages_text;
                $input["open_status"]=$request->open_status;
                $input["marked_as_readed"]=$request->marked_as_readed;
                $input["marked_as_deleted"]=$request->marked_as_deleted;
            


              
            $this->validate($request, [
            'fullname'=>'required',
                    'email'=>'required',
                    'mobile'=>'required',
                    'message_type'=>'required',
                    'messages_text'=>'required',
                    
        ]);
        

 
                $old_image=Admin_message::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/admin_messages/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }
                

                
                        if(isset($input['marked_as_readed'])){
                        $input['marked_as_readed']= 1;
                        }else{
                        $input['marked_as_readed']= 0;
                        }
                    
                        if(isset($input['marked_as_deleted'])){
                        $input['marked_as_deleted']= 1;
                        }else{
                        $input['marked_as_deleted']= 0;
                        }
                    

                

                
                $old_image=Admin_message::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/admin_messages/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }
                

                 $Admin_message=Admin_message::where(['id'=>$id ])->update($input);

        //store images if found
        //store files if found

        $Admin_message = Admin_message::where(['id'=>$id , 'user_id' => $user_id ])->get();

                return redirect('admin_messages')
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

        //delete files
         // delete files and images
        
                $old_image=Admin_message::find($id)->image;
                 File::delete($old_image);
                
        
         // delete files and images in sub tables if this module has mutiple files or images
        

        Admin_message::where(['id'=>$id])->delete();

                return redirect('admin_messages')
                    ->with('success',trans('admin.info_deleted'));
            }

            //additional Functions
            
            


            
}
