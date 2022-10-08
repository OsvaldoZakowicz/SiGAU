<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * *servicios para usuarios
 */
class UserService
{

    /**
     * *crear usuario interno
     */
    public function crearUsuarioInterno($parametros)
    {
        $parametros['password'] = Hash::make($parametros['password']);

        $user = User::create([
            'name' => $parametros['name'],
            'email' => $parametros['email'],
            'password' => $parametros['password']
        ]);

        $user->assignRole($parametros['roles']);

        return $user;
    }

    /**
     * *actualizar el usuario interno
     */
    public function actualizarUsuarioInterno(User $user, $parametros)
    {
        if (!empty($parametros['password'])) {
            //si no esta vacio el campo password, crear hash
            $parametros['password'] = Hash::make($parametros['password']);
        } else {
            //si esta vacio, quitamos el item 'password' del array
            $parametros = Arr::except($parametros, array('password'));
        };

        $user->update($parametros);
        //eliminar su rol
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        //nuevo rol
        $user->assignRole($parametros['roles']);

        return $user;
    }

    /**
     * *inhabilitar usuario interno
     * asignando un rol especial 'inhabilitado'
     */
    public function inhabilitarUsuarioInterno(User $user)
    {
        //quitar rol anterior
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        //asignar rol nuevo
        $user->assignRole('inhabilitado');

        return $user;
    }

    /**
     * *obtener roles para usuarios internos
     */
    public function obtenerRolesParaUsuarioInterno()
    {
        $roles = DB::table('roles')
            ->whereNotIn('name', ['estudiante', 'becado', 'delegado'])
            ->pluck('name', 'name')
            ->all();

        return $roles;
    }

    /**
     * *obtener roles actuales del usuario interno
     */
    public function obtenerRolesDelUsuarioInterno(User $user)
    {
        return $user->roles->pluck('name', 'name')->all();
    }

    /**
     * *listar usuarios internos
     * retorna una paginacion de 15 usuarios, sin roles
     * estudiante, becado y delegado.
     */
    public function listarUsuariosInternos()
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'roles.id as role_id', 'roles.name as role_name')
            ->whereNotIn('roles.name', ['estudiante', 'becado', 'delegado'])
            ->orderBy('users.created_at', 'desc')
            ->paginate(15);

        return $users;
    }

    /**
     * *listar usuarios internos filtrando por valor de busqueda, 
     * con filtros de usuario con orden recibidos desde un request.
     */
    public function buscarUsuariosInternos($parametros)
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'roles.id as role_id', 'roles.name as role_name')
            ->where('users.' . $parametros['filtro'], 'LIKE', '%' . $parametros['valor'] . '%')
            ->whereNotIn('roles.name', ['estudiante', 'becado', 'delegado'])
            ->orderBy('users.' . $parametros['filtro'], $parametros['orden'])
            ->paginate(15);

        return $users;
    }

    /**
     * *buscar usuarios internos cuando se recibe una busqueda por
     * filtros de rol con orden recibidos desde un request.
     */
    public function buscarUsuariosInternosPorRol($parametros)
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'roles.id as role_id', 'roles.name as role_name')
            ->where('roles.name', 'LIKE', '%' . $parametros['valor'] . '%')
            ->whereNotIn('roles.name', ['estudiante', 'becado', 'delegado'])
            ->orderBy('roles.name', $parametros['orden'])
            ->paginate(15);

        return $users;
    }

    /**
     * *ordenar usuarios internos filtrando por columnas usuario, y orden
     * recibidos desde un request.
     */
    public function ordenarUsuariosInternos($parametros)
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'roles.id as role_id', 'roles.name as role_name')
            ->whereNotIn('roles.name', ['estudiante', 'becado', 'delegado'])
            ->orderBy('users.' . $parametros['filtro'], $parametros['orden'])
            ->paginate(15);

        return $users;
    }

    /**
     * *ordenar usuarios internos filtrando por columnas rol y orden
     */
    public function ordenarUsuariosInternosPorRol($parametros)
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'roles.id as role_id', 'roles.name as role_name')
            ->whereNotIn('roles.name', ['estudiante', 'becado', 'delegado'])
            ->orderBy('roles.name', $parametros['orden'])
            ->paginate(15);

        return $users;
    }
}
