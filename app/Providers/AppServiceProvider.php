<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Pegawai;
use App\Models\Log;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserGroup;
use App\Observers\ModelActivityObserver;

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
        Pegawai::observe(ModelActivityObserver::class);
        Log::observe(ModelActivityObserver::class);
        Role::observe(ModelActivityObserver::class);
        RolePermission::observe(ModelActivityObserver::class);
        User::observe(ModelActivityObserver::class);
        UserGroup::observe(ModelActivityObserver::class);
    }
}
