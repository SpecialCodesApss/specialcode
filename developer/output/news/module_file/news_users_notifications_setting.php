<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class News_users_notifications_setting extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["user_id","active_notification","notification_type"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }