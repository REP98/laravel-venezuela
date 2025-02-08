<?php

namespace Rep98\Venezuela;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class DPTServiceProvider extends ServiceProvider {
    public function boot(){
        $this->startPublishes();
    }

    public function register()
    {
        
    }

    protected function startPublishes() {
        if (! $this->app->runningInConsole()) {
            return;
        }
        $migratios = $this->getMigrationFileName();
        
        $this->publishes($migratios, 'venezula-migrations');

        // Publica el archivo de configuración
        $this->publishes([
            __DIR__ . '/../config/VenezuelaDPT.php' => config_path('VenezuelaDPT.php'),
        ], 'config');
        
        // Cargar la configuración
        $this->mergeConfigFrom(
            __DIR__ . '/../config/VenezuelaDPT.php',
            'VenezuelaDPT'
        );
    }

    protected function getMigrationFileName() {
        $filesystem = $this->app->make(Filesystem::class);
        $timestamp = date('Y_m_d_His');
        
        return Collection::make($filesystem->allFiles(__DIR__."/../database/migrations"))
            ->mapWithKeys(function($file) use ($timestamp) {
                $newMigrations = $timestamp . "_" . $file->getFileName();
                return [$this->app->databasePath()."/migrations/{$newMigrations}"];
            })->toArray();
    }
}