<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Country_cities_area extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["city_id","name_ar","name_en","slug","sort","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }