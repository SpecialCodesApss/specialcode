<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Currencie extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["name_ar","name_en","ISO_code","value","active","sort"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }