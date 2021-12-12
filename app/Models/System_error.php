<?php
                namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class System_error extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["error_title","error_text"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }
