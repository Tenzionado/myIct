<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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

        //define operator user
        Gate::define('isOperator', function($user){
            return $user->role == 'operator';
        });

        Gate::define('isTechnician', function($user){
            return $user->role == 'technician';
        });

        Gate::define('isSupervisor', function($user){
            return $user->role == 'supervisor';
        });
        
    }
}
