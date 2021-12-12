<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'extension_flag_name', 'extension_module_name','extension_description','additional_extensions',
        'additional_tables','additional_modules'
        ];

}
