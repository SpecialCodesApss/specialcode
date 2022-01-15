<?php
namespace App\Http\Traits;

use App\Models\Admin_notification;
use App\Models\Notifications_text;

trait admin_notification_traits{

    public function createNotification($notification_data){
        Admin_notification::create($notification_data);
    }

    public static function getLatestUnreadedNotifications(){
        $admin_notifications=Admin_notification::
        where('is_marked_as_readed','0')->orderBy('admin_notifications.id','desc')
            ->leftjoin('notifications_texts','notifications_texts.id','admin_notifications.notification_id')
            ->select('*','admin_notifications.created_at as created_at')
            ->paginate(5);
//        foreach ($admin_notifications as $notification){
//            //get module name
//            $target_url=$notification->target_url;
//            $target_url=str_replace('##module_id##',$notification->module_id,$target_url);
//            $notification->target_url=$target_url;
//        }


        //get count of all unreaded notifications
        $unreaded_notifications=Admin_notification::where('is_marked_as_readed','0')
            ->get()->count();
        $admin_notifications->unreaded_notifications=$unreaded_notifications;
        return $admin_notifications;
    }



    public function createNotificationText($notification_data){
        Notifications_text::create($notification_data);
    }

}
