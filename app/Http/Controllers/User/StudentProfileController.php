<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentProfileRequest;
use App\Http\Requests\UpdateStudentProfileRequest;
use App\Models\User;
use App\Services\User\ProfileService;

class StudentProfileController extends Controller
{
    //TODO constructor con middleware

    /**
     * *crear un perfil de usuario.
     * para el usuario actualmente autenticado.
     */
    public function create(User $user, ProfileService $profileService)
    {
        $idTypes = $profileService->obtenerTiposIdentificacion();

        $genders = $profileService->obtenerGeneros();
        
        return view('profiles.create-student-profile', compact('user', 'idTypes', 'genders'));
    }

    /**
     * *guardar un perfil de usuario.
     * para el usuario actualmente autenticado.
     */
    public function store(StoreStudentProfileRequest $request, ProfileService $profileService)
    {
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
        $idTypes = $profileService->obtenerTiposIdentificacion();

        $genders = $profileService->obtenerGeneros();

        $profile = $profileService->obtenerPerfilCompleto($user);

        $localidad = $profileService->obtenerLocalidadActual($user);

        return view('profiles.edit-student-profile', compact('user','profile','localidad','idTypes', 'genders'));
    }

    /**
     * *actualizar un perfil de usuario.
     * para el usuario actualmente autenticado.
     */
    public function update(UpdateStudentProfileRequest $request, ProfileService $profileService)
    {
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
