<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        Blade::component('layouts.components.profile', 'profile');
        Blade::component('layouts.components.usergroup', 'group');
        Blade::component('layouts.components.alert', 'alert');
        Blade::component('layouts.components.label', 'label');
        Blade::component('layouts.components.status', 'status');
        Blade::component('layouts.components.empty-default', 'empty');
        Schema::defaultStringLength(191);
    }
}
