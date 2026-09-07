<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-admin', function (User $user) {
            return $user->isAdmin() ? Response::allow() : Response::denyAsNotFound();

            // if ($user->id===2) {
            //     return Response::allow();
            // }
            // else {
            //     return Response::denyAsNotFound();
            // }

            // return $user->isAdmin();
            // return $user->role === 'admin';
            // return $user->id===3;
        });
    }
}
