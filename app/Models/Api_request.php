<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Api_request extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'list_authorization_status','create_authorization_status','update_authorization_status',
        'view_authorization_status','delete_authorization_status','controller_name','Mobile_List','Mobile_Create'
        ,'Mobile_Update','Mobile_View','Mobile_Delete','parameters',
    ];

}
