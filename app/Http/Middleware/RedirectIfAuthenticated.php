<?php

namespace App\Http\Middleware;

use App\Company;
use App\Permit;
use App\Event;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {
            return redirect()->route('admin.dashboard');
        }

        Permit::where('permit_status', 'active')->whereDate('expired_date', '<',Carbon::now()->format('Y-m-d'))->update(['permit_status'=>'expired']);
        Event::whereDate('expired_date', '<', Carbon::now())->where('status', 'active')->update(['status'=>'expired']);
        Company::whereDate('trade_license_expired_date', '<', Carbon::now())->where('status', 'active')->update(['status'=>'blocked']);


        return $next($request);
    }
}
