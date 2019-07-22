<?php

namespace App\Http\Middleware;

use Auth;
use App\Company;
use Closure;

class AdmminMiddleware
{

    public function handle($request, Closure $next)
    {
        if(Auth::check() && $request->user()->type == 0){
            $company = Company::find(Auth::user()->EmpClientId);
            $company_name = explode(' ', $company->company_name);

            return redirect()->route('company.dashboard', str_replace(' ', '_',strtolower($company->company_name)));
        }
        
         return $next($request);
    }
}
