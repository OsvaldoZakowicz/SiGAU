<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//modelo User
use App\Models\User;
//modelo Role
use Spatie\Permission\Models\Role;
//modelo Permission
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //*crear un super arministrador
        User::create([
            'name' => 'super admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);

        //administrador base
        User::create([
            'name' => 'jose',
            'email' => 'jose@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('administrador');

        //auditor
        User::create([
            'name' => 'maria',
            'email' => 'maria@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('auditor');

        //encargado de albergues
        User::create([
            'name' => 'pepe',
            'email' => 'pepe@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('encargado albergues');

        //secretario general
        User::create([
            'name' => 'miranda',
            'email' => 'miranda@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('secretario general');

        //estudiante
        User::create([
            'name' => 'carlos',
            'email' => 'carlos@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('estudiante');

        //becado
        User::create([
            'name' => 'laura',
            'email' => 'laura@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('becado');

        //delegado
        User::create([
            'name' => 'osvaldo',
            'email' => 'osvaldo@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('delegado');

    }
}
