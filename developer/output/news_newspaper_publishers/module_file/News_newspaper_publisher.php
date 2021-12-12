<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class News_newspaper_publisher extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["country_id","slug","newspaper_name_ar","newspaper_name_en","description_ar","description_en","logo_image","email","website_link","facebook","twitter","linkedin","SEO_newspaper_page_title","SEO_newspaper_page_metatags","sort","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }