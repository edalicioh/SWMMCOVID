<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Support\Facades\Config;

class AuthByType
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

        $c = Company::where('id', $request->user()->companies_id)->first();
        if ($c->company_type == Config::get( 'constants.TYPE_COMPANY.EMPRESA' )) {
            return redirect('company/home');
        }
        return $next($request);
    }
}
