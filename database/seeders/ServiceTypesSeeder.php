<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_types')->insert([
            ['name' => 'luz', 'description' => 'suministro electrico del hogar', 'created_at' => now()],
            ['name' => 'agua', 'description' => 'suministro de agua del hogar', 'created_at' => now()],
            ['name' => 'internet', 'description' => 'suministro de internet del hogar', 'created_at' => now()]
        ]);
    }
}
