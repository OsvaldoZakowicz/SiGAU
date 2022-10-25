<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\UserFactory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Services\User\RoleService;
use App\Services\User\UserService;

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
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);

        //administrador base
        User::create([
            'email' => 'administrador@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('administrador');

        //auditor
        User::create([
            'email' => 'auditor@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('auditor');

        //encargado de albergues
        User::create([
            'email' => 'encargado@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('encargado albergues');

        //secretario general
        User::create([
            'email' => 'secretario@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('secretario general');

        //estudiante
        User::create([
            'email' => 'estudiante@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('estudiante');

        //becado
        User::create([
            'email' => 'becado@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('becado');

        //delegado
        User::create([
            'email' => 'delegado@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->assignRole('delegado');

        //10 usuarios mas
        $users = User::factory()
            ->count(10)
            ->create();
            
        foreach ($users as $user) {
            $user->assignRole('inhabilitado');
        };

    }
}
