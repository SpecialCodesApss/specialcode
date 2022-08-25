<?php

namespace App\Providers;

use App\Http\Traits\Admin_sections_traits;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    use Admin_sections_traits;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //make bootstrape pagination is default
        Paginator::useBootstrap();

        $admin_sections=$this->getAdminSections();
        view()->share('admin_sections', $admin_sections);

        //get installed theme name
        $theme_name=Setting::where('setting_key','admin_theme_name')->first()->setting_value;
        view()->share('theme_name', $theme_name);

//        $lang = app()->getLocale();
//        view()->share('lang', $lang);

        view()->addNamespace('themes', app_path('../themes'));


        $lang = app()->getLocale();
        view()->share('lang', $lang);

        $contacts = [];
        $contacts["email"] = Contact::where('flag','email')->first();
        $contacts["mobile"]= Contact::where('flag','mobile')->first();
        view()->share('contacts', $contacts);


    }
}
