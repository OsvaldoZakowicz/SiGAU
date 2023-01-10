<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmbientTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ambient_types')->insert([
            ['name' => 'cocina', 'description' => 'cocina, cocina de una casa, area donde se cocina', 'created_at' => now()],
            ['name' => 'comedor', 'description' => 'comedor, comedor de una casa, generalmente espacio junto a la cocina', 'created_at' => now()],
            ['name' => 'baño', 'description' => 'baño, sanitario, baño de una casa', 'created_at' => now()],
            ['name' => 'habitacion', 'description' => 'habitaciones, dormitorios de una casa, area donde se alojan personas para dormir', 'created_at' => now()],
        ]);
    }
}
