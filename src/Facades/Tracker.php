<?php

namespace Ismail1k\LaravelStatistics\Facades;
use \App\Models\Tracker as Traffic;
use \Carbon\Carbon;
use Browser;
use Auth;

class Tracker
{
    private static function find($array, $callback){
        foreach($array as $key => $value){
            if($callback($value)){
                return [
                    'key' => $key,
                    'value' => $value,
                ];
            }
        }
        return false;
    }

    public function log($request){
        return Traffic::create([
            'ip' => $request->ip(),
            'user_id' => Auth::user()->id??null,
            'user_agent' => $request->userAgent(),
            'path' => $request->getPathInfo(),
        ]);
    }

    public function sessions($minutes = 60*24){
        $sessions = [];
        $traffics = Traffic::whereBetween('created_at', [Carbon::now()->subMinutes($minutes), Carbon::now()])->get();
        foreach($traffics as $traffic){
            $session = self::find($sessions, function($session) use ($traffic){
                if($session['ip'] == $traffic->ip) return $session;
            });
            if($session){
                array_push($sessions[$session['key']]['traffic'], [
                    'path' => $traffic->path,
                    'created_at' => $traffic->created_at
                ]);
                continue;
            }
            $location = json_decode(file_get_contents("http://ipinfo.io/$traffic->ip/geo"));
            if(@$location->bogon) continue;
            $agent = Browser::parse($traffic->user_agent);
            array_push($sessions, [
                'ip' => $traffic->ip,
                'user' => $traffic->user??'Guest',
                'Country' => $location->country,
                'City' => $location->city,
                'Region' => $location->region,
                'location' => $location->loc,
                'device' => $agent->deviceType(),
                'platform' => $agent->platformName(),
                'browser' => $agent->browserName(),
                'traffic' => [
                    ['path' => $traffic->path, 'created_at' => $traffic->created_at],
                ],
            ]);
        }
        return $sessions;
    }

    public function traffic($minutes = 60*24){
        $sessions = [];
        $traffics = Traffic::whereBetween('created_at', [Carbon::now()->subMinutes($minutes), Carbon::now()])->get();
        foreach($traffics as $traffic){
            $session = self::find($sessions, function($session) use ($traffic){
                if($session['ip'] == $traffic->ip) return $session;
            });
            if($session) continue;
            array_push($sessions, [
                'ip' => $traffic->ip,
            ]);
        }
        return count($sessions);
    }

}
