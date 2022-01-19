<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('users-create', fn () => Auth::user()->hasPermission('users-create'));
        Gate::define('users-read', fn () => Auth::user()->hasPermission('users-read'));
        Gate::define('users-update', fn () => Auth::user()->hasPermission('users-update'));
        Gate::define('users-delete', fn () => Auth::user()->hasPermission('users-delete'));

        Gate::define('categories-create', fn () => Auth::user()->hasPermission('categories-create'));
        Gate::define('categories-read', fn () => Auth::user()->hasPermission('categories-read'));
        Gate::define('categories-update', fn () => Auth::user()->hasPermission('categories-update'));
        Gate::define('categories-delete', fn () => Auth::user()->hasPermission('categories-delete'));

        Gate::define('products-create', fn () => Auth::user()->hasPermission('products-create'));
        Gate::define('products-read', fn () => Auth::user()->hasPermission('products-read'));
        Gate::define('products-update', fn () => Auth::user()->hasPermission('products-update'));
        Gate::define('products-delete', fn () => Auth::user()->hasPermission('products-delete'));
    }
}
