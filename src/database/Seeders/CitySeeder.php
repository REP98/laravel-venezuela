<?php

namespace Rep98\Venezuela\Database\Seeders;

use Rep98\Venezuela\Models\State;
use Rep98\Venezuela\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [ 
            ["name" => "Caracas", "is_capital" => true, "state"=>"Distrito Capital"],
            ["name" => "Valencia", "is_capital" => true, "state"=>"Carabobo"],
            ["name" => "Maracaibo", "is_capital" => true, "state"=>"Zulia"],
            ["name" => "Barquisimeto", "is_capital" => true, "state"=>"Lara"],
            ["name" => "Maturín", "is_capital" => true, "state"=>"Monagas"],
            ["name" => "Maracay", "is_capital" => true, "state"=>"Aragua"],
            ["name" => "Barcelona", "is_capital" => true, "state"=>"Anzoategui"],
            ["name" => "Barinas", "is_capital" => true, "state"=>"Barinas"],
            ["name" => "Cumaná", "is_capital" => true, "state"=>"Sucre"],
            ["name" => "San Cristóbal", "is_capital" => true, "state"=>"Tachira"],
            ["name" => "Ciudad Bolívar", "is_capital" => true, "state"=>"Bolivar"],
            ["name" => "Los Teques", "is_capital" => true, "state"=>"Bolivariano De Miranda"],
            ["name" => "Mérida", "is_capital" => true, "state"=>"Merida"],
            ["name" => "Coro", "is_capital" => true, "state"=>"Falcon"],
            ["name" => "Guanare", "is_capital" => true, "state"=>"Portuguesa"],
            ["name" => "San Fernando de Apure", "is_capital" => true, "state"=>"Apure"],
            ["name" => "San Felipe", "is_capital" => true, "state"=>"Yaracuy"],
            ["name" => "San Juan de los Morros", "is_capital" => true, "state"=>"Guarico"],
            ["name" => "San Carlos", "is_capital" => true, "state"=>"Cojedes"],
            ["name" => "Puerto Ayacucho", "is_capital" => true, "state"=>"Anzoategui"],
            ["name" => "Tucupita", "is_capital" => true, "state"=>"Delta Amacuro"],
            ["name" => "Trujillo", "is_capital" => true, "state"=>"Trujillo"],
            ["name" => "La Asunción", "is_capital" => true, "state"=>"Nueva Esparta"],
            ["name" => "La Guaira", "is_capital" => true, "state"=>"La Guaira"],
            ["name" => "Gran Roque", "is_capital" => true, "state"=>"Dependencias Federales"],
            ["name" => "Archipiélago Los Monjes", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Isla la Tortuga y Cayos adyacentes", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Isla La Sola", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Islas Los Testigos", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Islas los Frailes", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Isla de Patos", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Archipiélago Los Roques", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Isla La Blanquilla", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Islas Los Hermanos", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Isla La Orchila", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Archipiélago Las Aves", "is_capital" => false, "state"=>"Dependencias Federales"],
            ["name" => "Isla de Aves", "is_capital" => false, "state"=>"Dependencias Federales"]
        ];

        foreach ($cities as $city) {
            $state = State::where('name', $city['state'])->first();
            City::create([
                "name" => $city['name'],
                "is_capital" => $city['is_capital'],
                "state_id" => $state->id
            ]);
        }
    }
}