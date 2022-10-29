<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Province;
use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Crea localidad.
     * Crea provincia y asigna localidades.
     * Crea pais, y asigna provincias.
     * @return void
     */
    public function run()
    {
        /* Country::factory()
            ->count(5)
            ->has(
                Province::factory()
                    ->count(5)
                    ->has(Location::factory()
                        ->count(10), 'locations'
                    ), 'provinces'
            )
            ->create(); */
    }
}
