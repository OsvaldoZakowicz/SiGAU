<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\User\UserService;

/**
 * *Este controlador maneja el apartado de cuenta
 * de usuarios, mostrando en las vistas de perfil los
 * datos de la cuenta actual y las opciones de edicion y eliminacion.
 */

class UserAccountController extends Controller
{
    //TODO constructor con middleware

    /**
     * Editar usuario interno.
     * Esta edición la lleva acabo el propio usuario, solo puede
     * editar nombre de usuario y cambiar password.
     * TODO: nombre, apellido, imagen de perfil ...
     */
    public function edit(User $user, UserService $userService)
    {
        //retornar vista de edicion de cuenta de acceso.
        return view('profiles.edit-admin', compact('user'));
    }

    /**
     * Modificar perfil de usuario interno.
     */
    public function update(Request $request, User $user, UserService $userService)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'same:confirm-password'
        ]);

        $user = $userService->actualizarMiUsuario($user,$request->all());

        return redirect()
            ->route('show-profile')
            ->with('exito', 'perfil actualizado!');
    }

    /**
     * Eliminar mi cuenta.
     */
    public function destroy(User $user)
    {
        //TODO Eliminar datos de perfil.
        //TODO Identificar cuentas, remover roles.
        //TODO Eliminacion segura de todas las cuentas, cierre de sesion.

        //?eliminar todas las cuentas o eliminar solo una?

        return redirect()
            ->route('show-profile')
            ->with('error', 'NO IMPLEMENTADO AUN');
    }
}
