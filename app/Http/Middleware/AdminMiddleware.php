<?php
namespace App\Http\Middleware;

use Auth;
use App\Company;
use Closure;

class AdminMiddleware
{

    public function handle($request, Closure $next)
    {
        if (Auth::check() && $request->user()->type != 4) {
            $company = Company::find(Auth::user()->EmpClientId);
            return redirect()->route('company.dashboard', str_replace(' ', '_', strtolower($company->name_en)));
        }

        if(Auth::check() && $request->user()->type == 4 && $request->user()->roles()->where('roles.role_id', 4)->exists()){
        	return redirect()->route('inspector.dashboard');
        }

        return $next($request);
    }
}
