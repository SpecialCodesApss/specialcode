<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class News_types_tag extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["slug","name_ar","name_en","sort","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }