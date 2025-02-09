<?php

namespace Rep98\Venezuela;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Rep98\Venezuela\Commands\InstallVenezuelaPackage;

class DPTServiceProvider extends ServiceProvider {
    public function boot(){
        $this->startPublishes();

        if($this->app->runningInConsole()) {
            $this->commands([
                InstallVenezuelaPackage::class
            ]);
        }
    }

    public function register()
    {
        // Cargar la configuración
        $this->mergeConfigFrom(
            __DIR__ . '/../config/VenezuelaDPT.php',
            'VenezuelaDPT'
        );
    }

    protected function startPublishes() {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes($this->getMigrationFileNames(), 'venezuela-migrations');

        // Publica el archivo de configuración
        $this->publishes([
            __DIR__ . '/../config/VenezuelaDPT.php' => config_path('VenezuelaDPT.php'),
        ], 'venezuela-config');
        // Publica las semillas
        $this->publishes([
            __DIR__ . '/database/Seeders/' => database_path('seeders'),
        ], 'venezuela-seeders');
    }

    protected function getMigrationFileNames() {
        $filesystem = $this->app->make(Filesystem::class);
        $timestamp = date('Y_m_d_His');

        return Collection::make($filesystem->allFiles(__DIR__ . '/../database/migrations'))
            ->mapWithKeys(function ($file) use ($timestamp) {
                $filename = $timestamp . '_' . $file->getFilename();
                return [__DIR__ . '/../database/migrations/' . $file->getFilename() => database_path('migrations/' . $filename)];
            })->toArray();
    }
}