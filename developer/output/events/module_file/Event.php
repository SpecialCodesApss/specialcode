<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Event extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["name_ar","name_en","description_html_ar","description_html_en","city","image","date","website","sort","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }