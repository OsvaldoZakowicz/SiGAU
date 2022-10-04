<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//permissions
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * *estudiante: engloba permisos asigables a los roles estudiante, becado, delegado
         * *administrador: engloba permisos asignables a los roles administrador, auditor, secretarios, encargados
         * y otros roles definidos por un administrador.
         */

        /**
         * *Permisos sobre rutas iniciales
         */
        Permission::create(['name' => 'ver-pagina-estudiante','asignable_to' => 'estudiante']);
        Permission::create(['name' => 'ver-pagina-dashboard','asignable_to' => 'administrador']);

        Permission::create(['name' => 'ver-seccion-beca','asignable_to' => 'administrador']);
        Permission::create(['name' => 'ver-seccion-becados','asignable_to' => 'administrador']);
        Permission::create(['name' => 'ver-seccion-casas','asignable_to' => 'administrador']);
        Permission::create(['name' => 'ver-seccion-planificaciones','asignable_to' => 'administrador']);
        Permission::create(['name' => 'ver-seccion-mantenimiento','asignable_to' => 'administrador']);

        Permission::create(['name' => 'ver-seccion-usuarios','asignable_to' => 'administrador']);
        Permission::create(['name' => 'ver-seccion-auditoria','asignable_to' => 'administrador']);
        Permission::create(['name' => 'ver-seccion-parametros','asignable_to' => 'administrador']);

        /**
         * *Permisos sobre roles y usuarios
         */
        Permission::create(['name' => 'ver-usuario','asignable_to' => 'administrador']);
        Permission::create(['name' => 'crear-usuario','asignable_to' => 'administrador']);
        Permission::create(['name' => 'editar-usuario','asignable_to' => 'administrador']);
        Permission::create(['name' => 'borrar-usuario','asignable_to' => 'administrador']);

        Permission::create(['name' => 'ver-rol','asignable_to' => 'administrador']);
        Permission::create(['name' => 'crear-rol','asignable_to' => 'administrador']);
        Permission::create(['name' => 'editar-rol','asignable_to' => 'administrador']);
        Permission::create(['name' => 'borrar-rol','asignable_to' => 'administrador']);

    }
}
