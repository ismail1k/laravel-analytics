<?php

namespace Ismail1k\LaravelStatistics;

use Illuminate\Support\ServiceProvider as Provider;
use Illuminate\Http\Request;
use Tracker;

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
        $this->publishes([__DIR__.'/../app/Models/' => app_path('Models'),], 'laravel-assets');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Tracker::log(Request::class);
    }
}
