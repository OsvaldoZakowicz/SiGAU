<?php

namespace App\Services\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleService
{
    /**
     * *crear rol
     */
    public function crearRol($parametros)
    {
        $role = Role::create([
            'name' => $parametros['name'],
            'description' => $parametros['description'],
            'visibility' => 'readwrite'
        ]);

        //syncPermissions() es un metodo para sincronizar permisos a un usuario, o rol
        //quita todos los permisos y concede los proporcionados en el request permission
        $role->syncPermissions($parametros['permission']);

        return $role;
    }

    /**
     * *actualizar rol
     */
    public function actualizarRol(Role $role, $parametros)
    {
        //se usara save()
        $role->name = $parametros['name'];
        $role->description = $parametros['description'];
        $role->visibility = 'readwrite';
        $role->save();

        //sincronizar permisos
        $role->syncPermissions($parametros['permission']);

        return $role;
    }

    /**
     * *buscar rol por id
     */
    public function buscarRol($id)
    {
        return Role::find($id);
    }

    /**
     * *cantidad de modelos asociados al rol
     */
    public function contarModelosAsociados($role)
    {
        return DB::table('model_has_roles')->where('role_id', '=', $role->id)->count();
    }

    /**
     * *borrar un rol
     */
    public function borrarRol($role)
    {
        return $role->delete();
    }

    /**
     * *obtener permisos aplicables solo a administradore
     */
    public function obtenerPermisosAdministradores()
    {
        return Permission::where('asignable_to', 'administrador')->get();
    }

    /**
     * *obtener permisos de un rol segun su id
     */
    public function obtenerPermisosDelRol($id)
    {
        return DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
    }

    /**
     * *listar roles por fecha de creacion descendente, paginado.
     */
    public function listarRoles()
    {
        $roles = DB::table('roles')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        //formato de fecha
        foreach ($roles as $role) {
            $role->created_at = Carbon::parse($role->created_at)->locale('es_ES')->format('d-m-Y H:i');
        }

        return $roles;
    }

    /**
     * *buscar roles por nombre o descripcion, paginado,
     * cuando se recibe una busqueda, con orden.
     */
    public function buscarRoles($parametros)
    {
        $roles = DB::table('roles')
            ->where('roles.' . $parametros['filtro'], 'LIKE', '%' . $parametros['valor'] . '%')
            ->orderBy('roles.' . $parametros['filtro'], $parametros['orden'])
            ->paginate(15);

        //formato de fecha
        foreach ($roles as $role) {
            $role->created_at = Carbon::parse($role->created_at)->locale('es_ES')->format('d-m-Y H:i');
        }

        return $roles;
    }

    /**
     * *ordenar roles por nombre o descripcion, paginado.
     */
    public function ordenarRoles($parametros)
    {
        $roles = DB::table('roles')
            ->orderBy('roles.' . $parametros['filtro'], $parametros['orden'])
            ->paginate(15);

        //formato de fecha
        foreach ($roles as $role) {
            $role->created_at = Carbon::parse($role->created_at)->locale('es_ES')->format('d-m-Y H:i');
        }

        return $roles;
    }
}
