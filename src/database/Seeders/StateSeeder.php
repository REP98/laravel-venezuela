<?php

namespace Rep98\Venezuela\Database\Seeders;

use Rep98\Venezuela\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run()
    {
        $states = [
			["name"=>"Distrito Capital","iso"=>"VE-A"],
			["name"=>"Amazonas","iso"=>"VE-Z"],
			["name"=>"Anzoategui","iso"=>"VE-B"],
			["name"=>"Apure","iso"=>"VE-C"],
			["name"=>"Aragua","iso"=>"VE-D"],
			["name"=>"Barinas","iso"=>"VE-E"],
			["name"=>"Bolivar","iso"=>"VE-F"],
			["name"=>"Carabobo","iso"=>"VE-G"],
			["name"=>"Cojedes","iso"=>"VE-H"],
			["name"=>"Delta Amacuro","iso"=>"VE-Y"],
			["name"=>"Falcon","iso"=>"VE-I"],
			["name"=>"Guarico","iso"=>"VE-J"],
			["name"=>"Lara","iso"=>"VE-K"],
			["name"=>"Merida","iso"=>"VE-L"],
			["name"=>"Bolivariano De Miranda","iso"=>"VE-M"],
			["name"=>"Monagas","iso"=>"VE-N"],
			["name"=>"Nueva Esparta","iso"=>"VE-O"],
			["name"=>"Portuguesa","iso"=>"VE-P"],
			["name"=>"Sucre","iso"=>"VE-R"],
			["name"=>"Tachira","iso"=>"VE-S"],
			["name"=>"Trujillo","iso"=>"VE-T"],
			["name"=>"Yaracuy","iso"=>"VE-U"],
			["name"=>"Zulia","iso"=>"VE-V"],
			["name"=>"La Guaira","iso"=>"VE-X"],
			["name"=>"Dependencias Federales","iso"=>"VE-W"]
		];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}