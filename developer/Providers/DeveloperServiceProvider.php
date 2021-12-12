<?php namespace Developer\Providers;

use Illuminate\Support\ServiceProvider;

class DeveloperServiceProvider extends ServiceProvider {

    public function register() {
        //
    }

    public function boot() {
        \View::addNamespace('developer', __DIR__ . '/../views/');
    }
}