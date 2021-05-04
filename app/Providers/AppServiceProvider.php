<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer(
            '*',
            'App\Http\Controllers\AppSettingController@shareSettings'
        );
        view()->composer(
            'frontLayout.header',
            'App\Http\Controllers\CartController@shareCart'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
