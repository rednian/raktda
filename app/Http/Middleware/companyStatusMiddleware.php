<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
class companyStatusMiddleware
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
        if($request->user()->company->exists()){
            if(in_array($request->user()->company->status, ['draft', 'new', 'pending']) || $request->user()->company->trade_license_expired_date < Carbon::now()){
                    return redirect(URL::signedRoute('company.edit', ['company' => $request->user()->company->company_id]));
            }
             return $next($request);
        }
        else {
            return redirect()->route('login');
        }
  
       
    }
}
