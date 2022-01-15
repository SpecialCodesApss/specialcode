<?php
                namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class Notifications_text extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["description_text_en","description_text_ar","target_url","icon"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }
