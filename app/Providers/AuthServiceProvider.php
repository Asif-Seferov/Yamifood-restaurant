<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\Permission' => 'App\Policies\PermissionPolicy',
         'App\Models\Slider' => 'App\Policies\SliderPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function (User $user) {
            return $user->roles->first()->slug == "admin";
        });
        Gate::define('isUser', function(User $user){
            return $user->roles->first()->slug == "user";
        });
        Gate::define('isAuthor', function(User $user){
            return $user->roles->first()->slug == "author";
        });
        Gate::define('isEditor', function(User $user){
            return $user->roles->first()->slug == "editor";
        });
    }
}
