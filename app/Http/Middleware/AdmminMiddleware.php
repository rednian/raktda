<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdmminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixeds
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->isAdmin()){
            return $next($request);
        }
       return $next($request);
    }
}
