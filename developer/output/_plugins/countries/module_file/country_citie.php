<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Country_citie extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["country_id","name_ar","name_en","slug","sort","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }