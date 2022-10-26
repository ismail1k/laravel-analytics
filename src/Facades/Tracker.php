<?php

namespace Ismail1k\LaravelStatistics\Facades;
use \App\Models\Tracker as Traffic;
use Auth;

class Tracker
{

    public function log($request){
        return Traffic::create([
            'ip' => $request->ip(),
            'user_id' => Auth::user()->id??null,
            'user_agent' => $request->userAgent(),
            'path' => $request->getPathInfo(),
        ]);
    }

    public function sessions($minute){
        //http://ipinfo.io/105.155.157.6/geo
        return $response;
    }

}
