<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\User\UserService;

/**
 * *Este controlador maneja el apartado de cuenta
 * de usuarios estudiantes (u otro rol academico), mostrando en las vistas de perfil los
 * datos de la cuenta actual y las opciones de edicion y eliminacion.
 */
class StudentAccountController extends Controller
{
    //TODO constructor con middleware

   /**
     * *editar cuenta usuario estudiante
     * Esta edición la lleva acabo el propio usuario, solo puede
     * editar email y cambiar password.
     */
    public function edit(User $user, UserService $userService)
    {
        return view('profiles.edit-student', compact('user'));
    }

    /**
     * *actualizar cuenta usuario estudiante
     * Esta edición la lleva acabo el propio usuario, solo puede
     * editar email y cambiar password.
     */
    public function update(Request $request, User $user, UserService $userService)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'same:confirm-password'
        ]);

        $user = $userService->actualizarMiUsuario($user,$request->all());

        return redirect()
            ->route('show-profile')
            ->with('exito', 'cuenta actualizada!');
    }

    /**
     * *eliminar cuenta usuario.
     */
    public function destroy(User $user)
    {
        //TODO Eliminacion segura, cierre de sesion.

        return redirect()
            ->route('show-profile')
            ->with('error', 'NO IMPLEMENTADO AUN');
    }
}
