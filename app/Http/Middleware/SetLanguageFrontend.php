<?php

namespace App\Http\Middleware;

use Closure;

class SetLanguageFrontend
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
        if ($request->user()->LanguageId != 1) {
            \App::setLocale('arFront');
        }
        return $next($request);
    }
}
