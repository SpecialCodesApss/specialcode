<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class News_auther extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["country_id","slug","name_ar","name_en","work_title","Biographical_info_ar","Biographical_info_en","profile_image","email","website_link","facebook","twitter","linkedin","SEO_auther_page_title","SEO_auther_page_metatags","sort","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }