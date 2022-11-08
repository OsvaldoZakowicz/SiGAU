<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * *Este controlador determina a que vista de perfil redirigir al
 * usuario segun su rol, cargando la vista de perfil en dashboard
 * o en student.
 */

class ShowProfileController extends Controller
{
    /**
     * Determinar la vista de perfil adecuada segun usuario.
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UserService $userService)
    {

        //TODO refactor
        //TODO compactar mejor los datos.

        //usuario
        $user = Auth()->user();

        //roles del usuario, solo key, contiene el nombre del rol
        $roles = array_values($user->roles->pluck('name','name')->all());

        //roles que son de administrador, solo key, contiene el nombre del rol
        $rolesInternos = array_values($userService->obtenerRolesParaUsuarioInterno());

        for ($i=0; $i < count($roles); $i++) { 
            //?existe en el/los roles del usuario un rol interno?
            if (in_array($roles[$i], $rolesInternos)) {

                //?tiene perfil completo?
                if ($user->people_id !== NULL) {
                    //si
                    $user_profile = $user->people;
                    $user_phone = $user_profile->phone;
                    $user_address = $user_profile->address;
                    $user_location = $user_address->location;
                    $user_province = $user_location->province;
                    $user_gender = $user_profile->gender;
                    
                    return view('profiles.show-admin', compact('user','roles', 'user_profile', 'user_gender', 'user_phone', 'user_address', 'user_location', 'user_province'));
                }

                //no
                return view('profiles.show-admin', compact('user','roles'));

            }
        }

        return view('profiles.show-student', compact('user','roles'));
    }
}
