<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\ProfileService;
use App\Http\Requests\StoreUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;

/**
 * *Este controlador maneja el apartado de perfil
 * de un usuario interno del sistema.
 */
class UserProfileController extends Controller
{
    //TODO constructor con middleware?

    /**
     * *crear un perfil de usuario.
     * para el usuario actualmente autenticado.
     */
    public function create(User $user, ProfileService $profileService)
    {
        $idTypes = $profileService->obtenerTiposIdentificacion();

        $genders = $profileService->obtenerGeneros();
        
        return view('profiles.create-admin-profile', compact('user', 'idTypes', 'genders'));
    }

    /**
     * *almacenar un perfil de usuario.
     * para el usuario actualmente autenticado.
     * - valida el request con restricciones basicas.
     */
    public function store(StoreUserProfileRequest $request, ProfileService $profileService)
    {
        //TODO validar tipos de id personal

        //usuario actual
        $user = User::find(Auth()->user()->id);

        //validaciones basicas
        $validated = $request->validated();

        $people = $profileService->crearPerfil($validated, $user);

        $phone = $profileService->crearTelefono($validated, $people);

        $address = $profileService->crearDireccion($validated, $people);

        return redirect()->route('show-profile')->with('exito','perfil creado');
    }

    /**
     * *editar un perfil de usuario.
     * para el usuario actualmente autenticado.
     */
    public function edit(User $user, ProfileService $profileService)
    {
        //TODO retornar tipo de id y genero del perfil.
        //TODO retornar los demas tipos de id y genero para cambiarlos. 
        
        $idTypes = $profileService->obtenerTiposIdentificacion();

        $genders = $profileService->obtenerGeneros();

        $profile = $profileService->obtenerPerfilCompleto($user);

        $localidad = $profileService->obtenerLocalidadActual($user);

        return view('profiles.edit-admin-profile', compact('user','profile','localidad','idTypes', 'genders'));
    }

    /**
     * *actualizar un perfil de usuario.
     * para el usuario actualmente autenticado.
     */
    public function update(UpdateUserProfileRequest $request, ProfileService $profileService)
    {
        //TODO validar tipos de id personal
        
        //usuario actual
        $user = User::find(Auth()->user()->id);

        //validaciones basicas
        $validated = $request->validated();

        $people = $profileService->actualizarPerfil($validated, $user);

        $phone = $profileService->actualizarTelefono($validated, $people);

        $address = $profileService->actualizarDireccion($validated, $people);

        return redirect()->route('show-profile')->with('exito','perfil actualizado');
    }
}
