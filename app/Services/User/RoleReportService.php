<?php

namespace App\Services\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RoleReportService
{
  /**
   * *listar roles, por fecha de creacion descendente, sin paginar.
   */
  public function listarRoles()
  {
    $roles = DB::table('roles')
                    ->orderBy('created_at','desc')
                    ->get();
    
    //formato de fecha
    foreach ($roles as $role) {
        $role->created_at = Carbon::parse($role->created_at)->locale('es_ES')->format('d-m-Y H:i');
    }

    return $roles;
  }

  /**
   * *buscar roles por nombre o descripcion, sin paginar
   * cuando se recibe una busqueda, con orden.
   */
  public function buscarRoles($parametros)
  {
    $roles = DB::table('roles')
                    ->where('roles.'.$parametros['filtro'],'LIKE','%' . $parametros['valor'] . '%')
                    ->orderBy('roles.'.$parametros['filtro'], $parametros['orden'])
                    ->get();
    
    //formato de fecha
    foreach ($roles as $role) {
        $role->created_at = Carbon::parse($role->created_at)->locale('es_ES')->format('d-m-Y H:i');
    }

    return $roles;
  }

  /**
   * *ordenar roles por nombre o descripcion, sin paginar.
   */
  public function ordenarRoles($parametros)
  {
    $roles = DB::table('roles')
                    ->orderBy('roles.'.$parametros['filtro'], $parametros['orden'])
                    ->get();
    
    //formato de fecha
    foreach ($roles as $role) {
        $role->created_at = Carbon::parse($role->created_at)->locale('es_ES')->format('d-m-Y H:i');
    }

    return $roles;
  }
}