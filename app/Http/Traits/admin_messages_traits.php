<?php
namespace App\Http\Traits;

use App\Models\Admin_message;

trait admin_messages_traits{



    public static function getLatestUnreadedMessages(){
        $admin_messages = Admin_message::where([
            'marked_as_readed' => 0,
            'marked_as_deleted' => 0,
        ])
        ->get();

        return $admin_messages;
    }




}
