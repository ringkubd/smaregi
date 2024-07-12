<?php
namespace Anwar\Smaregi;

use Anwar\Smaregi\Interface\Connection;
use Illuminate\Support\ServiceProvider;

class SmaregiProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'smaregi'
        );
        $this->app->singleton(Connection::class, function ($app) {
            return new SmaregiConnection($app['config']);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([__DIR__.'/../config/config.php' => config_path('smaregi.php')], 'smaregi-config');
        $this->loadRoutesFrom(__DIR__.'/../route.php');
    }
}
