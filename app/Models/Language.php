<?php
namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class Language extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["name_ar","name_en","ISO_code","language_icon","active","sort"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }
