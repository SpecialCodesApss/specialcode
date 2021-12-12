<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class News_users_newspapers_follow extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["user_id","newspaper_id"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }