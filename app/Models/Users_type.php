<?php
namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class Users_type extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["type_name_ar","type_name_en"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }
