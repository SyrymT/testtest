<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Define your policies here
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('submit-article', function (User $user) {
            return $user->hasRole('author');
        });

        Gate::define('review-article', function (User $user) {
            return $user->hasRole('reviewer');
        });

        Gate::define('edit-article', function (User $user) {
            return $user->hasRole('editor');
        });

        Gate::define('manage-journal', function (User $user) {
            return $user->hasRole('admin');
        });
    }
}