<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//modelo Role
use Spatie\Permission\Models\Role;
//modelo Permission
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //*roles del sistema
        $administrador = Role::create(['name' => 'administrador']);
        $auditor = Role::create(['name' => 'auditor']);

        //*roles del dominio
        $secretarioGeneral = Role::create(['name' => 'secretario general']);
        $encargadoAlbergue = Role::create(['name' => 'encargado albergues']);
        
        $estudiante = Role::create(['name' => 'estudiante']);
        $becado = Role::create(['name' => 'becado']);
        $delegado = Role::create(['name' => 'delegado']);

        //*permisos a roles del sistema

        //acceso al panel administrativo
        $permisoDashboard = Permission::create(['name' => 'dashboard'])
            ->syncRoles($administrador, $auditor, $encargadoAlbergue, $secretarioGeneral);

        //*permisos a roles del dominio

        //acceso a vistas de estudiante
        $permisoStudent = Permission::create(['name' => 'student'])
            ->syncRoles($estudiante);
    }
}
