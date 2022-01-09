<?php

    namespace App\Http\Middleware;
    use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

    class VerifyCsrfToken extends Middleware
    {
        /**
         * Indicates whether the XSRF-TOKEN cookie should be set on the response.
         *
         * @var bool
         */
        protected $addHttpCookie = true;

        /**
         * The URIs that should be excluded from CSRF verification.
         *
         * @var array
         */
        protected $except = ['developer/create_extension_table','developer/create_extension','admin/getusersInfo_for_products_forFielduser_id','admin/checkusers_for_products_forFielduser_id','admin/searchusers_for_products_forFielduser_id','admin/checkweekdays_for_products_forFieldweek_select','admin/searchweekdays_for_products_forFieldweek_select','admin/deleteProductimages','admin/deleteProductfiles',];
    }
                