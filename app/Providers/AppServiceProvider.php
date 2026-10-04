<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // Define gates for authorization
        Gate::define('manage-employees', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-departments', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-positions', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-roles', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-attendance', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-leave-types', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('approve-leave', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('view-reports', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('view-activity-logs', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-announcements', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('view-notifications', function (User $user) {
            return $user !== null;
        });

        Gate::define('submit-leave', function (User $user) {
            return $user->isEmployee() || $user->isAdmin();
        });

        Gate::define('view-own-attendance', function (User $user) {
            return $user->isEmployee() || $user->isAdmin();
        });
    }
}
