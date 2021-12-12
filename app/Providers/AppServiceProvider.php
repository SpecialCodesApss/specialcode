<?php

namespace App\Providers;

use App\Http\Traits\Admin_sections_traits;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

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

        $admin_sections=$this->getAdminSections();
        view()->share('admin_sections', $admin_sections);

        //get installed theme name
        $theme_name=Setting::where('setting_key','admin_theme_name')->first()->setting_value;
        view()->share('theme_name', $theme_name);

        view()->addNamespace('themes', app_path('../themes'));
    }
}
