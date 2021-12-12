<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Route extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_method_type','router_name','controller_name','controller_method','type','middleware','parameters',
        'expect_from_CSRF','active',
    ];


}
