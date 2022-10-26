<?php

namespace Ismail1k\LaravelStatistics\Facades;
use \App\Models\Tracker as Traffic;

class Tracker
{

    public function log($request){
        $traffic = Traffic::create([
            'ip' => '127.0.0.1',
            'user_id' => 1,
            'user_agent' => 1,
            'path' => '/product',
        ]);
        return $traffic;
    }

    public function sessions($minute){
        //http://ipinfo.io/105.155.157.6/geo
        return $response;
    }

}
