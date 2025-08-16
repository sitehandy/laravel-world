<?php

declare(strict_types=1);

namespace Sitehandy\World\Console;

use Illuminate\Console\Command;

/**
 * Initialize World Database Command
 * 
 * Sets up the world database tables and seeds them with geographical data.
 */
class InitCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'world:init';
    
    /**
     * The console command description.
     */
    protected $description = 'Initialize world database with geographical data';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Running database migrations...');
        $this->call('migrate');
        
        $this->info('Seeding world geographical data...');
        $this->call('db:seed', ['--class' => 'WorldTablesSeeder']);
        
        $this->info('World database initialization completed successfully!');
        
        return self::SUCCESS;
    }
}
