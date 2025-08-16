<?php

declare(strict_types=1);

namespace Sitehandy\World;

use Illuminate\Support\ServiceProvider;
use Sitehandy\World\Console\InitCommand;

/**
 * World Service Provider
 * 
 * Provides Laravel service provider functionality for the Sitehandy World package.
 */
class WorldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishMigrations();
        $this->publishSeeds();
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->registerCommands();
    }

    /**
     * Publish migration files.
     */
    private function publishMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/');
        // $this->publishes([__DIR__ . '/../database/migrations/' => base_path('database/migrations')], 'migrations');
    }

    /**
     * Publish seeder files.
     */
    private function publishSeeds(): void
    {
        $this->publishes([__DIR__ . '/../database/seeders/' => base_path('database/seeders')], 'seeders');
    }

    /**
     * Register console commands.
     */
    private function registerCommands(): void
    {
        $this->commands([
            InitCommand::class,
        ]);
    }
}
