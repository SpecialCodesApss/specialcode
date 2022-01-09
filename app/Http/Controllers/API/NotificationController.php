<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use Auth;
use Spatie\Permission\Models\Role;
use DB;
use DataTables;
use Illuminate\Support\Facades\App;

class NotificationController extends BaseController
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
        $user_id=$request->user()->id;
        $data = Notification::where('notify_users', 'like', "%\"{$user_id}\"%")
            ->where('users_who_deleted', 'not like', "%\"{$user_id}\"%")
            ->latest()->get();

        foreach ($data as $info){
            $users_who_read=$info->users_who_read;
            $users_who_read=json_decode($users_who_read);

            if(in_array($user_id,$users_who_read)){
                $info->status='read';
                $info->status_text=trans('messages.notify_read');
            }
            else{
                $info->status='unread';
                $info->status_text=trans('messages.notify_unread');
            }

        }
        return $this->sendResponse('data Retrieved successfully.',$data);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unread(Request $request)
    {
        $user_id=$request->user()->id;
        $data = Notification::where('notify_users', 'like', "%\"{$user_id}\"%")
            ->where('users_who_deleted', 'not like', "%\"{$user_id}\"%")
            ->where('users_who_read', 'not like', "%\"{$user_id}\"%")
            ->latest()->get();
        return $this->sendResponse('data Retrieved successfully.',$data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
    public function show($id)
    {
        $Notification = Notification::find($id);
        return view('notifications.show',compact('Notification'));
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
    public function update(Request $request)
    {

        $user_id=$request->user()->id;
                $notifications=Notification::where('notify_users', 'like', "%\"{$user_id}\"%")
                    ->get();

                foreach($notifications as $notification){
                    $notification_users=$notification->notify_users;
                    $notification_users_who_read=$notification->users_who_read;
                    $notification_users=json_decode($notification_users);
                    $notification_users_who_read=json_decode($notification_users_who_read);
                    if(in_array($user_id,$notification_users)){
                        if(!in_array($user_id,$notification_users_who_read)){
                            array_push($notification_users_who_read,"$user_id");
                        }
                    }
                    $notification_users_who_read=json_encode($notification_users_who_read);
                    Notification::where('notify_users', 'like', "%\"{$user_id}\"%")
                        ->where('id',$notification->id)
                        ->update(['users_who_read'=>$notification_users_who_read]);
                }

                return $this->sendResponse(trans('messages.notification_updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $user_id=$request->user()->id;
        $notification=Notification::where('notify_users', 'like', "%\"{$user_id}\"%")
            ->where('id',$id)
            ->first();

        $notification_users=$notification->notify_users;
        $notification_users_who_deleted=$notification->users_who_deleted;
        $notification_users=json_decode($notification_users);
        $notification_users_who_deleted=json_decode($notification_users_who_deleted);
        if(in_array($user_id,$notification_users)){
            if(!in_array($user_id,$notification_users_who_deleted)){
                array_push($notification_users_who_deleted,"$user_id");
            }
        }
        $notification_users_who_deleted=json_encode($notification_users_who_deleted);
        Notification::where('notify_users', 'like', "%\"{$user_id}\"%")
            ->where('id',$id)
            ->update(['users_who_deleted'=>$notification_users_who_deleted]);
        return $this->sendResponse(trans('messages.notification_deleted'));
    }

}
