<?php

namespace berthott\Targetable\Tests\BasicTargetable;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CrudableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // bind singletons
        $this->app->singleton('CrudableFacade', function () {
            return new CrudableService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // add routes
        Route::get('api/users', function () {
            return CrudableFacade::getTarget();
        });
    }
}
