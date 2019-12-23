<?php

namespace App\Http\Middleware;

use Closure;
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
        if(in_array($request->user()->company->status, ['draft', 'new', 'pending'])){
             return redirect(URL::signedRoute('company.edit', ['company' => $request->user()->company->company_id]));
        }
        return $next($request);
    }
}
