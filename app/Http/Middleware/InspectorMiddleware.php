<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class InspectorMiddleware
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
        if(Auth::check() && $request->user()->type == 4 && !$request->user()->roles()->where('roles.role_id', 4)->exists()){
            return abort(404);
        }

        return $next($request);
    }
}
