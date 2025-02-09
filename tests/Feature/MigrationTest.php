<?php

namespace Rep98\Venezuela\Tests\Feature;

use Rep98\Venezuela\Models\State;
use Rep98\Venezuela\Models\Municipality;
use Rep98\Venezuela\Models\Parish;
use Rep98\Venezuela\Models\City;
use Rep98\Venezuela\Models\Community;
use Rep98\Venezuela\Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Attributes\Test;

class MigrationTest extends TestCase
{
    #[Test]
    public function states_table_is_created_with_correct_columns()
    {
        // Verifica que la tabla exista
        $this->assertTrue(Schema::hasTable('states'));

        // Verifica que las columnas existan
        $this->assertTrue(Schema::hasColumns('states', [
            'id', 'name', 'iso', 'created_at', 'updated_at'
        ]));
    }

    #[Test]
    public function municipalities_table_is_created_with_correct_columns()
    {
        // Verifica que la tabla exista
        $this->assertTrue(Schema::hasTable('municipalities'));

        // Verifica que las columnas existan
        $this->assertTrue(Schema::hasColumns('municipalities', [
            'id', 'state_id', 'name', 'created_at', 'updated_at'
        ]));
    }

    #[Test]
    public function parishes_table_is_created_with_correct_columns()
    {
        // Verifica que la tabla exista
        $this->assertTrue(Schema::hasTable('parishes'));

        // Verifica que las columnas existan
        $this->assertTrue(Schema::hasColumns('parishes', [
            'id', 'municipality_id', 'name', 'created_at', 'updated_at'
        ]));
    }

    #[Test]
    public function cities_table_is_created_with_correct_columns()
    {
        // Verifica que la tabla exista
        $this->assertTrue(Schema::hasTable('cities'));

        // Verifica que las columnas existan
        $this->assertTrue(Schema::hasColumns('cities', [
            'id', 'state_id', 'name', 'created_at', 'updated_at'
        ]));
    }

    #[Test]
    public function communities_table_is_created_with_correct_columns()
    {
        // Verifica que la tabla exista
        $this->assertTrue(Schema::hasTable('communities'));

        // Verifica que las columnas existan
        $this->assertTrue(Schema::hasColumns('communities', [
            'id', 'parish_id', 'name', 'created_at', 'updated_at'
        ]));
    }

    #[Test]
    public function relationships_are_correctly_established()
    {
        // Crear un estado
        $state = State::create([
            'name' => 'Amazonas',
            'iso' => 'VE-X',
        ]);

        // Crear un municipio asociado al estado
        $municipality = Municipality::create([
            'state_id' => $state->id,
            'name' => 'Municipio de Prueba'
        ]);

        // Crear una parroquia asociada al municipio
        $parish = Parish::create([
            'municipality_id' => $municipality->id,
            'name' => 'Parroquia de Prueba'
        ]);

        // Crear una ciudad asociada a la parroquia
        $city = City::create([
            'state_id' => $state->id,
            'name' => 'Ciudad de Prueba'
        ]);

        // Crear una comunidad asociada a la ciudad
        $community = Community::create([
            'parish_id' => $parish->id,
            'name' => 'Comunidad de Prueba'
        ]);

        // Verificar las relaciones
        $this->assertEquals(1, $state->municipalities->count());
        $this->assertEquals(1, $municipality->parishes->count());
        $this->assertEquals(1, $state->cities->count());
        $this->assertEquals(1, $parish->communities->count());
    }
}