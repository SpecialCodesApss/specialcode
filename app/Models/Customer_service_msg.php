<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer_service_msg extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_name', 'email','mobile','user_message','message_status',
    ];
}
