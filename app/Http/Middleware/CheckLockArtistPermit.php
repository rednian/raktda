<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class CheckLockArtistPermit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $permit = $request->route('permit');

        if(!is_null($permit->lock)){

            $to = Carbon::createFromFormat('Y-m-d H:i:s', $permit->lock);
            $from = Carbon::now();

            $diff_in_minutes = $from->diffInMinutes($to);

            if($diff_in_minutes < 5 && $permit->lock_user_id != $request->user()->user_id){
                
                // $request->session()->flash('lock', $permit);
                return redirect()->back()->with('message', ['danger', 'Opps! Someone is currently checking the permit. Please try again later.', 'Information']);
            }
        }

        return $next($request);
    }
}
