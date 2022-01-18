<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Admin_message;

use Validator;
use File;


class Admin_messageController extends BaseController
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $searchText=$request->searchText;
        $admin_messages = Admin_message::
        where(function($q) use ($searchText){
            $q->orWhere("user_id","like","%".$searchText."%")->orWhere("fullname","like","%".$searchText."%")->orWhere("email","like","%".$searchText."%")->orWhere("mobile","like","%".$searchText."%")->orWhere("message_type","like","%".$searchText."%")->orWhere("image","like","%".$searchText."%")->orWhere("messages_text","like","%".$searchText."%")->orWhere("open_status","like","%".$searchText."%")->orWhere("marked_as_readed","like","%".$searchText."%")->orWhere("marked_as_deleted","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("admin_messages.Admin_message_read"),$admin_messages->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


                $input["fullname"]=$request->fullname;
                $input["email"]=$request->email;
                $input["mobile"]=$request->mobile;
                $input["message_type"]=$request->message_type;
                $input["messages_text"]=$request->messages_text;





        $validator=
            Validator::make($input, [
            'fullname'=>'required',
                'email'=>'required',
                'mobile'=>'required',
                'message_type'=>'required',
                'messages_text'=>'required',

        ]);


        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }


                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/admin_messages/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                }



        $sort_number = Admin_message::all()->count()+1;
        $input['sort'] = $sort_number;

        $input["open_status"]="open";
        $input["marked_as_readed"]=0;
        $input["marked_as_deleted"]=0;

        $Admin_message = Admin_message::create($input);






        return $this->sendResponse(trans("admin_messages.Admin_message_create"),$Admin_message->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {


        $Admin_message = Admin_message::where('id', $id)->first();

        if(isset($Admin_message)){


        }

        if (is_null($Admin_message)) {
            return $this->sendError(trans("messages.data not found"));
        }

        return $this->sendResponse(trans("admin_messages.Admin_message_read"),$Admin_message->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Admin_message_id)
    {

                $input["fullname"]=$request->fullname;
                $input["email"]=$request->email;
                $input["mobile"]=$request->mobile;
                $input["message_type"]=$request->message_type;
                $input["messages_text"]=$request->messages_text;
                $input["open_status"]=$request->open_status;
                $input["marked_as_readed"]=$request->marked_as_readed;
                $input["marked_as_deleted"]=$request->marked_as_deleted;



         $validator=
            Validator::make($input, [
            'fullname'=>'required',
                'email'=>'required',
                'mobile'=>'required',
                'message_type'=>'required',
                'messages_text'=>'required',

        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }


                $old_image=Admin_message::find($Admin_message_id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/admin_messages/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                }


        $Admin_message=Admin_message::where(['id'=>$Admin_message_id ])->update($input);




        $Admin_message = Admin_message::where(['id'=>$Admin_message_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("admin_messages.Admin_message_update"),$Admin_message->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //delete files
         // delete files and images

                $old_image=Admin_message::find($id)->image;
                 File::delete($old_image);


         // delete files and images in sub tables if this module has mutiple files or images

        Admin_message::where(['id'=>$id ])->delete();



        return $this->sendResponse(trans("admin_messages.Admin_message_delete"));

    }

     //additional Functions



}
