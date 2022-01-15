<?php
namespace Developer\Traits;

use App\Models\Admin_notification;
use App\Models\Notifications_text;

trait admin_notification_traits{

    public function createNotification($notification_data){
        Admin_notification::create($notification_data);
    }

    public function createNotificationText($notification_data){

        //check if its inserted before
        $notification_text=Notifications_text::
        where('description_text_en',$notification_data["description_text_en"])
            ->first();
        if($notification_text == null){
            $notification_text = Notifications_text::create($notification_data);
        }
        return $notification_text->id;
    }

}
