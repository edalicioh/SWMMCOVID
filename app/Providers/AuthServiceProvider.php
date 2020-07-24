<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin', function () {
            $c = Company::where('id', Auth::user()->companies_id)->first();
            return $c->company_type == Config::get( 'constants.TYPE_COMPANY.ADMIN' );
        });
        Gate::define('company', function () {
            $c = Company::where('id', Auth::user()->companies_id)->first();
            return $c->company_type == Config::get( 'constants.TYPE_COMPANY.EMPRESA' );
        });
        //
    }
}
