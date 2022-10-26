<?php 

namespace Ismail1k\LaravelStatistics\Facades;

use Illuminate\Support\Facades\Facade;

class TrackerFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'tracker';
    }
}