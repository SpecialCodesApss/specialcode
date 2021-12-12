<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class News_categorie extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["parent_category_id","slug","name_ar","name_en","description_ar","description_en","category_image","category_icon","sort","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }