<?php
                namespace App;
                use Illuminate\Database\Eloquent\Model;

                class Wallets_withdrawal extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = ["user_id","bank_name","account_owner_name","iban_number","account_number","withdrawal_amount_required","money_withdrawal_status"];


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = [];

                }