<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $adminPermissions = DB::table('permissions')
            ->where('asignable_to','administrador')
            ->pluck('name','name')
            ->all();

        //*roles del sistema
        $administrador = Role::create([
            'name' => 'administrador',
            'description' => 'accede a todos los modulos del dashboard',
            'visibility' => 'readonly'
        ])->syncPermissions($adminPermissions);

        $auditor = Role::create([
            'name' => 'auditor',
            'description' => 'accede al modulo de auditoria',
            'visibility' => 'readonly'
        ])->syncPermissions([
            'ver-pagina-dashboard',
            'ver-seccion-auditoria'
        ]);

        //*roles del dominio
        $secretarioGeneral = Role::create([
            'name' => 'secretario general',
            'description' => 'accede al modulo de beca, becados, y casas',
            'visibility' => 'readonly'
        ])->syncPermissions([
            'ver-pagina-dashboard',
            'ver-seccion-beca',
            'ver-seccion-becados',
            'ver-seccion-casas'
        ]);

        $encargadoAlbergue = Role::create([
            'name' => 'encargado albergues',
            'description' => 'accede al modulo de becados, casas, planificaciones, y mantenimiento',
            'visibility' => 'readonly'
        ])->syncPermissions([
            'ver-pagina-dashboard',
            'ver-seccion-becados',
            'ver-seccion-casas',
            'ver-seccion-mantenimiento',
            'ver-seccion-planificaciones'
        ]);

        $estudiantePermission = DB::table('permissions')
            ->where('asignable_to','estudiante')
            ->pluck('name','name')
            ->all();

        $estudiante = Role::create([
            'name' => 'estudiante',
            'description' => 'accede a las vistas de invitado, y estudiante para solicitud de beca',
            'visibility' => 'readonly'
        ])->syncPermissions($estudiantePermission);

        $becado = Role::create([
            'name' => 'becado',
            'description' => 'accede a las vistas de becado, y estudiante',
            'visibility' => 'readonly'
        ])->syncPermissions($estudiantePermission);

        $delegado = Role::create([
            'name' => 'delegado',
            'description' => 'accede a las vistas de delegado, becado, y estudiante',
            'visibility' => 'readonly'
        ])->syncPermissions($estudiantePermission);

    }
}
