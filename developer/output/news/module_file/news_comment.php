<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class News_comment extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["user_id","comment_text","users_likes_ids","users_dislikes_ids","active"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }