<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

//*servicios de reporte de usuarios

class UserReportService {
  /**
     * *listar usuarios internos, sin paginar
     * retorna una paginacion de 15 usuarios, sin roles
     * estudiante, becado y delegado.
     */
    public function listarUsuariosInternos()
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.email','users.email_verified_at', 'users.created_at', 'roles.id as role_id', 'roles.name as role_name')
            ->whereNotIn('roles.name', ['estudiante', 'becado', 'delegado'])
            ->orderBy('users.created_at', 'desc')
            ->get();
        
        //formato de fecha
        foreach($users as $user) {
            $user->created_at = Carbon::parse($user->created_at)->locale('es_ES')->format('d-m-Y H:i');
            if ($user->email_verified_at !== NULL) {
                $user->email_verified_at = Carbon::parse($user->email_verified_at)->locale('es_ES')->format('d-m-Y H:i');
            }
        };

        return $users;
    }

    /**
     * *listar usuarios internos filtrando por valor de busqueda, sin paginar
     * con filtros de usuario con orden recibidos desde un request.
     */
    public function buscarUsuariosInternos($parametros)
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.email','users.email_verified_at', 'users.created_at', 'roles.id as role_id', 'roles.name as role_name')
            ->where('users.' . $parametros['filtro'], 'LIKE', '%' . $parametros['valor'] . '%')
            ->whereNotIn('roles.name', ['estudiante', 'becado', 'delegado'])
            ->orderBy('users.' . $parametros['filtro'], $parametros['orden'])
            ->get();

        //formato de fecha
        foreach($users as $user) {
            $user->created_at = Carbon::parse($user->created_at)->locale('es_ES')->format('d-m-Y H:i');
            if ($user->email_verified_at !== NULL) {
                $user->email_verified_at = Carbon::parse($user->email_verified_at)->locale('es_ES')->format('d-m-Y H:i');
            }
        };

        return $users;
    }

    /**
     * *buscar usuarios internos cuando se recibe una busqueda por
     * filtros de rol con orden recibidos desde un request, sin paginar
     */
    public function buscarUsuariosInternosPorRol($parametros)
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.email','users.email_verified_at', 'users.created_at', 'roles.id as role_id', 'roles.name as role_name')
            ->where('roles.name', 'LIKE', '%' . $parametros['valor'] . '%')
            ->whereNotIn('roles.name', ['estudiante', 'becado', 'delegado'])
            ->orderBy('roles.name', $parametros['orden'])
            ->get();
        
        //formato de fecha
        foreach($users as $user) {
            $user->created_at = Carbon::parse($user->created_at)->locale('es_ES')->format('d-m-Y H:i');
            if ($user->email_verified_at !== NULL) {
                $user->email_verified_at = Carbon::parse($user->email_verified_at)->locale('es_ES')->format('d-m-Y H:i');
            }
        };

        return $users;
    }

    /**
     * *ordenar usuarios internos filtrando por columnas usuario, y orden
     * recibidos desde un request, sin paginar
     */
    public function ordenarUsuariosInternos($parametros)
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.email','users.email_verified_at', 'users.created_at', 'roles.id as role_id', 'roles.name as role_name')
            ->whereNotIn('roles.name', ['estudiante', 'becado', 'delegado'])
            ->orderBy('users.' . $parametros['filtro'], $parametros['orden'])
            ->get();

        //formato de fecha
        foreach($users as $user) {
            $user->created_at = Carbon::parse($user->created_at)->locale('es_ES')->format('d-m-Y H:i');
            if ($user->email_verified_at !== NULL) {
                $user->email_verified_at = Carbon::parse($user->email_verified_at)->locale('es_ES')->format('d-m-Y H:i');
            }
        };

        return $users;
    }

    /**
     * *ordenar usuarios internos filtrando por columnas rol y orden, sin paginar
     */
    public function ordenarUsuariosInternosPorRol($parametros)
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.email','users.email_verified_at', 'users.created_at', 'roles.id as role_id', 'roles.name as role_name')
            ->whereNotIn('roles.name', ['estudiante', 'becado', 'delegado'])
            ->orderBy('roles.name', $parametros['orden'])
            ->get();
        
        //formato de fecha
        foreach($users as $user) {
            $user->created_at = Carbon::parse($user->created_at)->locale('es_ES')->format('d-m-Y H:i');
            if ($user->email_verified_at !== NULL) {
                $user->email_verified_at = Carbon::parse($user->email_verified_at)->locale('es_ES')->format('d-m-Y H:i');
            }
        };

        return $users;
    }
}