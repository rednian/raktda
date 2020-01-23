<?php
namespace App\Http\Middleware;

use App\Event;
use App\Permit;
use Auth;
use App\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Closure;

class AdminMiddleware
{

    public function handle($request, Closure $next)
    {
         Permit::where('permit_status', 'active')->whereDate('expired_date', '<',Carbon::now()->format('Y-m-d'))->update(['permit_status'=>'expired']);
         Event::whereDate('expired_date', '<', Carbon::now())->where('status', 'active')->update(['status'=>'expired']);
         Company::whereDate('trade_license_expired_date', '<', Carbon::now())->where('status', 'active')->update(['status'=>'blocked']);

        if (Auth::check() && $request->user()->type != 4) {
            $company = Company::find(Auth::user()->EmpClientId);
            if ($company->status != 'active') {
                return redirect(URL::signedRoute('company.edit', ['company' => $company->company_id]));
            }
            else{
                return redirect()->route('company.dashboard', str_replace(' ', '_', strtolower($company->name_en)));
            }
        }

    

        // if(Auth::check() && $request->user()->type == 4 && $request->user()->roles()->where('roles.role_id', 4)->exists()){
        // 	return redirect()->route('inspector.dashboard');
        // }

        return $next($request);
    }
}

