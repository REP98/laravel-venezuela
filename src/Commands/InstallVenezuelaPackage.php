<?php

namespace Rep98\Venezuela\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallVenezuelaPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'venezuela:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Geographic data of Venezuela in your database with their respective seeds';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Publishing configurations.....");
        Artisan::call("vendor:publish", ['--tag', 'venezuela-config']);

        $this->info("Publishing migrations.....");
        Artisan::call("vendor:publish", ['--tag', 'venezuela-migrations']);
        
        $this->info("Running migrations....");
        Artisan::call('migrate');

        $this->info('Planting Seeds....');
        Artisan::call('db:seed', ['--class', 'Rep98\\Venezuela\\Database\\Seeders\\DatabaseSeeder']);

        $this->info('Geographic Data of Venezuela Installed and configured successfully.');
    }
}
