<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Email_newsletter extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["email_title","news_html"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }