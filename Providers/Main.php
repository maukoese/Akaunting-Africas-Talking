<?php

namespace Modules\AfricasTalking\Providers;

use Illuminate\Support\ServiceProvider as Provider;
use Modules\AfricasTalking\Override\Phone\PhoneServiceProvider;
use Modules\AfricasTalking\Services\AfricasTalking;

class Main extends Provider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViews();
        $this->loadTranslations();
        $this->loadMigrations();
        //$this->loadConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutes();
        $this->registerDependencies();
    }

    public function registerDependencies()
    {
        $this->app->singleton(AfricasTalking::class, function ($app) {
            return new AfricasTalking(
                setting('africas-talking.key'),
                setting('africas-talking.username'),
                setting('africas-talking.from')
            );
        });

        $this->app->register(PhoneServiceProvider::class);
    }

    /**
     * Load views.
     *
     * @return void
     */
    public function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'africas-talking');
    }

    /**
     * Load translations.
     *
     * @return void
     */
    public function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'africas-talking');
    }

    /**
     * Load migrations.
     *
     * @return void
     */
    public function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Load config.
     *
     * @return void
     */
    public function loadConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/config.php', 'africas-talking');
    }

    /**
     * Load routes.
     *
     * @return void
     */
    public function loadRoutes()
    {
        if (app()->routesAreCached()) {
            return;
        }

        $routes = [
            'admin.php',
        ];

        foreach ($routes as $route) {
            $this->loadRoutesFrom(__DIR__ . '/../Routes/' . $route);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
