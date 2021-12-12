<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class New extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["category_id","publisher_newspaper_id","auther_id","country_id","city_id","title_ar","sub_title_ar","content_ar_html","title_en","sub_title_en","content_en_html","image","image_caption","is_video_news","video","published","publish_date","archive_date","news_types_tags","permalink_tag","SEO_tags","is_comment_allowed","is_breaking_news","is_slider_news","is_company_news","company_id","news_languages","views_count","comments_count","sort"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }