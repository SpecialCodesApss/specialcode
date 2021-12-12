<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Countrie extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["name_ar","name_en","slug","country_flag","country_alpha2_code","country_alpha3_code","languages","currencies","active","sort"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }