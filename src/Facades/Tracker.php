<?php

namespace Ismail1k\LaravelAnalytics\Facades;
use App\Models\Tracker as Traffic;
use Carbon\Carbon;
use Auth;

class Tracker
{
    public function __construct(){
        $this->offset = Carbon::now();
        $this->sessions = null;
    }

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

    public function sessions($minutes = 60*24, $offset = null){
        if($offset) $this->offset = $offset;
        $this->sessions = Traffic::whereBetween('created_at', [
            $this->offset->subMinutes($minutes),
            $this->offset
        ])->get();
        return $this->sessions;
    }

}
