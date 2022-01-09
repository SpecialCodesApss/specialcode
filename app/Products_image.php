<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Products_image extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["Product_id","image"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }