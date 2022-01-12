<?php
                namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class Abtest extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["user_id","name_ar","name_en","number","image","active","sort"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }