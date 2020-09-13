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

        Gate::define('manage-users', function ($user) {
            return count(array_intersect(["ADMIN", "KASIR"], json_decode($user->roles)));
        });

        Gate::define('manage-outlets', function ($user) {
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('manage-members', function ($user) {
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('manage-packets', function ($user) {
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('manage-invoice', function ($user) {
            return count(array_intersect(["ADMIN", "KASIR", "OWNER"], json_decode($user->roles)));
        });
    }
}
