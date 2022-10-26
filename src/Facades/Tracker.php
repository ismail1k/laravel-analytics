<?php

namespace Ismail1k\LaravelStatistics\Facades;
use \App\Models\Tracker as Traffic;

class Tracker
{

    public function log($request){
        $traffic = Traffic::create([
            'ip' => $request->ip(),
            'user_id' => Auth::user()->id??null,
            'user_agent' => $request->userAgent(),
            'path' => $request->getPathInfo(),
        ]);
        return $traffic;
    }

    public function sessions($minute){
        //http://ipinfo.io/105.155.157.6/geo
        return $response;
    }

}
