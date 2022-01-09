<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        if(app()->Config::get('languages')[app()->getLocale()] == "Arabic"){
//            $lang = "ar" ;
//        }else{$lang = "en" ;}

        $local =
            ($request->hasHeader('language')) ? $request->header('language') : "en";
        // set laravel localization
        app()->setLocale($local);
        return $next($request);
    }
}
