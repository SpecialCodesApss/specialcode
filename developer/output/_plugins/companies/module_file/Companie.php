<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Companie extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["categories","country_id","city_id","slug","company_name_ar","company_name_en","description_ar","description_en","logo_image","email","phone_number","whatsapp_number","website_link","address","lat","lng","facebook","twitter","linkedin","youtube","SEO_company_page_title","SEO_company_page_metatags","is_recommended","views_count","sort","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }