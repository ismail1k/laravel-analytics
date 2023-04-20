<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tracker;

class TrackerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $record = Tracker::where('session_id', $request->session()->getId())
            ->where('path', url()->current())
            ->first();
        if($record){
            $record->update([
                'ip' => $request->ip(),
                'views' => $record->views+1,
            ]);
            if(Auth::check()) $record->update([
                'user_id' => Auth::user()->id,
            ]);
            return $next($request);
        }
        Tracker::create([
            'ip' => $request->ip(),
            'path' => url()->current(),
            'source' => @url()->previous()??null,
            'session_id' => $request->session()->getId(),
            'user_id' => Auth::check()?Auth::user()->id:null,
            'agent' => $request->header('user-agent'),
        ]);
        return $next($request);
    }
}
