<?php
                namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class Admin_notification extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["notification_id","module_id",
                        "is_marked_as_readed","is_marked_as_deleted"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }
