<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use App\Models\Permissions\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach ($this->listPermissions() as $permission) {
            Gate::define($permission->name, function($user) use($permission){
                return  $user->existPermission($permission->id) || $user->isSuperAdmin();
            });
        }
    }

    public function listPermissions()
    {
        return App::runninginConsole() ? [] : (Schema::hasTable('permissions') ? Permission::get() : []);
    }
}
