<?php

namespace Rep98\Venezuela\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Rep98\Venezuela\DPTServiceProvider;

class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * Carga los service providers del paquete.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            DPTServiceProvider::class,
        ];
    }

    /**
     * Define las migraciones para las pruebas.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}