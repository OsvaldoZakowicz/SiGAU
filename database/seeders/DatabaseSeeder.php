<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        $this->call([
            //orden de sembrado

            #1 roles y permisos
            PermissionSeeder::class,
            RoleSeeder::class,

            #2 usuario (cuentas)
            UserSeeder::class,

            #3 tipos de id, generos
            PersonalIdentificationTypeSeeder::class,
            GenderSeeder::class,

            #4 pais, provincias, localidades ARG
            CountryArgSeeder::class,

        ]);
    }
}
