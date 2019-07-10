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
    
        if($request->user() && $request->user()->type == 1){
            return $next($request);
        }
       return $next($request);
    }
}
