<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    /**
     * Editar la cuenta de usuario.
     * en este caso retorna una vista solo para cambiar el rol.
     */
    public function edit(User $user, UserService $userService)
    {
        $roles = $userService->obtenerRolesParaUsuarioInterno();

        $userRoles = $userService->obtenerRolesDelUsuarioInterno($user);

        return view('users.edit-role', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Asignar un nuevo rol al usuario.
     */
    public function assignUserRole(User $user, Request $request)
    {
        //?estoy cambiando mi propio rol?
        if (Auth()->user()->id === $user->id) {
            return redirect()
                ->route('users.show', $user)
                ->with('error', 'no puedes cambiar tu propio rol en el sistema');
        };

        $this->validate($request, [
            'roles' => 'required'
        ]);

        //eliminar su rol
        DB::table('model_has_roles')
            ->where('model_id', $user->id)
            ->delete();
            
        //nuevo rol
        $user->assignRole($request['roles']);

        return redirect()
            ->route('users.index')
            ->with('exito', 'nuevo rol asignado');
    }

    /**
     * Revocar rol al usuario, inhabilitar la cuenta.
     */
    public function disableUserRole(User $user, UserService $userService)
    {
        //!Borrar un usuario se realizara en otro controlador, a cargo del propio usuario

        //?estoy inhabilitando mi propia cuenta?
        if (Auth()->user()->id === $user->id) {
            return redirect()
                ->route('users.show', $user)
                ->with('error', 'no puedes inhabilitarte a ti mismo');
        };

        //*Inhabilitar cuenta dejando solo permisos para ver dashboard.
        $user = $userService->inhabilitarUsuarioInterno($user);

        return redirect()
            ->route('users.index')
            ->with('exito', 'la cuenta del usuario ' . $user->email . ' ha sido inhabilitada');
    }
}
