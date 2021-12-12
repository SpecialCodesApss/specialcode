<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Companies_review extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["company_id","user_id","rate_stars_count","comment","users_likes_ids","users_dislikes_ids","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }