<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    //TODO constructor con middleware?

    /**
     * Editar usuario interno.
     * Esta edición la lleva acabo el propio usuario, solo puede
     * editar nombre de usuario y cambiar password.
     * TODO: nombre, apellido, imagen de perfil ...
     */
    public function edit(User $user, UserService $userService)
    {
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

        $user = $userService->actualizarMiPerfil($user,$request->all());

        return redirect()
            ->route('show-profile')
            ->with('exito', 'perfil actualizado!');
    }

    /**
     * Eliminar mi cuenta.
     */
    public function destroy(User $user)
    {
        //TODO Eliminacion segura, cierre de sesion.

        return redirect()
            ->route('show-profile')
            ->with('error', 'NO IMPLEMENTADO AUN');
    }
}
