<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        //Add this custom validation rule.
        Validator::extend('alpha_spaces', function ($attribute, $value) {

            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value);

        });

        Blade::if('non_user', function () {
            if (auth()->user()) {
                return 0;
            }
            return 1;
        });

        Blade::if('admin', function () {
            if (auth()->user() && auth()->user()->role_id == 1) {
                return 1;
            }
            return 0;
        });

        Blade::if('counselor', function () {
            if (auth()->user() && auth()->user()->role_id == 3) {
                return 1;
            }
            return 0;
        });

        Blade::if('writer', function () {
            if (auth()->user() && auth()->user()->role_id == 4) {
                return 1;
            }
            return 0;
        });

        Blade::if('admin_writer', function () {
            if (auth()->user() && (auth()->user()->role_id == 4 || auth()->user()->role_id == 1)) {
                return 1;
            }
            return 0;
        });

        Blade::if('admin_authorities', function () {
            if (auth()->user() && (auth()->user()->role_id == 5 || auth()->user()->role_id == 1)) {
                return 1;
            }
            return 0;
        });

        Blade::if('admin_writer_authorities', function () {
            if (auth()->user() && (auth()->user()->role_id == 1 || auth()->user()->role_id == 4 || auth()->user()->role_id == 5)) {
                return 1;
            }
            return 0;
        });

        Blade::if('user', function () {
            if (auth()->user() && (auth()->user()->role_id == 2)) {
                return 1;
            }
            return 0;
        });

    }
}
