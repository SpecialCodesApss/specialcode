<?php
                namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class Product extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["name_ar","name_en"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }