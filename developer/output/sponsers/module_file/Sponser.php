<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Sponser extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["name_ar","name_en","logo_image","website_link","sort","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }