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
        //*roles del sistema

        $adminPermissions = DB::table('permissions')
            ->where('asignable_to','administrador')
            ->pluck('name','name')
            ->all();

        $administrador = Role::create([
            'name' => 'administrador',
            'description' => 'administrador del sistema',
            'visibility' => 'readonly'
        ])->syncPermissions($adminPermissions);

        $auditor = Role::create([
            'name' => 'auditor',
            'description' => 'auditor del sistema',
            'visibility' => 'readonly'
        ])->syncPermissions([
            'ver-pagina-dashboard',
            'ver-seccion-auditoria'
        ]);

        //*roles del dominio

        $secretarioGeneral = Role::create([
            'name' => 'secretario general',
            'description' => 'secretario general de la secretaria de bienestar estudiantil',
            'visibility' => 'readonly'
        ])->syncPermissions([
            'ver-pagina-dashboard',
            'ver-seccion-beca',
            'ver-seccion-becados',
            'ver-seccion-casas'
        ]);

        $encargadoAlbergue = Role::create([
            'name' => 'encargado albergues',
            'description' => 'encargado de albergues de la secretaria de bienestar estudiantil',
            'visibility' => 'readonly'
        ])->syncPermissions([
            'ver-pagina-dashboard',
            'ver-seccion-becados',
            'ver-seccion-casas',
            'ver-seccion-mantenimiento',
            'ver-seccion-planificaciones'
        ]);

        $becadoSecretariaDeBienestar = Role::create([
            'name' => 'becado de secretaria',
            'description' => 'estudiante becado como ayudante de la secretria de bienestar estudiantil',
            'visibility' => 'readonly'
        ])->syncPermissions([
            'ver-pagina-dashboard',
            'ver-seccion-becados',
            'ver-seccion-beca'
        ]);

        $rolInhabilitado = Role::create([
            'name' => 'inhabilitado',
            'description' => 'rol por defecto de una cuenta interna inhabilitada',
            'visibility' => 'readonly'
        ])->syncPermissions(['ver-pagina-dashboard']);


        //*roles de estudiante

        $estudiantePermission = DB::table('permissions')
            ->where('asignable_to','estudiante')
            ->pluck('name','name')
            ->all();

        $estudiante = Role::create([
            'name' => 'estudiante',
            'description' => 'estudiante de la universidad',
            'visibility' => 'readonly'
        ])->syncPermissions($estudiantePermission);

        $becado = Role::create([
            'name' => 'becado',
            'description' => 'estudiante becado con albergue universitario',
            'visibility' => 'readonly'
        ])->syncPermissions($estudiantePermission);

        $delegado = Role::create([
            'name' => 'delegado',
            'description' => 'estudiante becado con albergue universitario, y delegado de su casa',
            'visibility' => 'readonly'
        ])->syncPermissions($estudiantePermission);

    }
}
