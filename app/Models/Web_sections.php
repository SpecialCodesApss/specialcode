<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Web_sections extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_section_id', 'section_name_ar','section_name_en','section_icon',
        'section_flag','is_notification_able','is_drop_menu','sort','controller_name','module_name',
    ];

}
