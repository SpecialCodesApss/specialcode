<?php
                namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class Admin_message extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["user_id","fullname","email","mobile","message_type","image","messages_text","open_status","marked_as_readed","marked_as_deleted"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }