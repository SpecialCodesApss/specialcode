<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class B_test extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["users_ids","pages_id","table_ids","page_html","test_2","email","image","type"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }