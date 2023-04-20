<?php 

namespace Ismail1k\LaravelAnalytics\Facades;

use Illuminate\Support\Facades\Facade;

class TrackerFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'tracker';
    }
}