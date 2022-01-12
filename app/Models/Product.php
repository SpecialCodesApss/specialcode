<?php
                namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class Product extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["type_selector","user_id","is_checkbox","week_check","week_select","name_ar","name_en","product_file","description_ar","description_en","html_text_ar","html_text_en","sort","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }