<?php
namespace Sitehandy\World;

use Illuminate\Support\ServiceProvider;

class WorldServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    // protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishMigrations();
        $this->publishSeeds();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    // public function register()
    // {
    //     $this->registerCommands();
    // }

    /**
     * Publish migration file.
     */
    private function publishMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        // $this->publishes([__DIR__ . '/Database/seeds/' => database_path('migrations')], 'migrations');
    }

    /**
     * Publish seeder file.
     */
    private function publishSeeds()
    {
        $this->publishes([__DIR__ . '/Database/seeds/' => database_path('seeds')], 'seeds');
    }

    // private function registerCommands()
    // {
    //     $this->commands([
    //         \Sitehandy\World\Console\InitCommand::class,
    //     ]);
    // }
}
