<?php

namespace Rep98\Venezuela\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            StateSeeder::class,
            MunicipalitySeeder::class,
            ParishSeeder::class,
            CitySeeder::class,
        ]);
    }
}