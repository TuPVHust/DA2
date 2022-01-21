<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
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

        Gate::define('update-driver', function (User $user, User $driver) {
            $check = false;
            if($user->role === 2 && $driver->role !== 2)
            {
                $check = true;
            }
            else{
                if($user->role === 1 && $driver->role === 0)
                {
                    $check = true;
                }
                else{
                    $check = false;
                }
            }
            return $check;
        });
    }
}
