<?php

namespace Ismail1k\LaravelAnalytics;

use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('tracker', function(){
            return new Facades\Tracker;
        });

        $this->publishes([__DIR__.'/../database/migrations/' => database_path('migrations'),], 'laravel-assets');
        $this->publishes([__DIR__.'/../app/Http/Middleware/' => app_path('Http/Middleware'),], 'laravel-assets');
        $this->publishes([__DIR__.'/../app/Models/' => app_path('Models'),], 'laravel-assets');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
