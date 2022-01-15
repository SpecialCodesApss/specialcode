<?php
                namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class Page extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["page_key","title_ar","title_en","html_page_ar","html_page_en"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }