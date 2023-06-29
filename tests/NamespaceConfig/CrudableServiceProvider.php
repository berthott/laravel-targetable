<?php

namespace berthott\Targetable\Tests\NamespaceConfig;

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
    }
}
