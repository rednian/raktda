<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
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
        if (!Auth::check()) { return redirect()->route('login'); }

        if ($request->user()->company()->exists()) {
            if ($request->user()->company->trade_license_expired_date < Carbon::now()) {

                return redirect(URL::signedRoute('company.show', ['company' => $request->user()->company->company_id]));
            }

            if  ( in_array($request->user()->company->status, ['draft', 'new', 'pending','back']) && !empty($request->user()->company->registered_by) ) {

              return redirect(URL::signedRoute('company.show', ['company' => $request->user()->company->company_id]));
            }


           return $next($request);
        }
        else{
            return redirect()->route('login');
        }

    }
}
