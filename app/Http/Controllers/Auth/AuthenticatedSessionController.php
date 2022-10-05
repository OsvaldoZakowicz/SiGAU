<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        /**
         * *redireccion segun el email del login
         * - capturar id de usuario Auth()->user()->id,
         * por que ya esta autenticado a este punto
         */
        
        //id
        $id = Auth()->user()->id;
        //usuario
        $user = User::find($id);
        //rol
        $userRol = $user->getRoleNames(); //$userRol[0] trae el nombre

        //segun el rol
        if ($userRol[0] === "estudiante" || $userRol[0] === "becado" || $userRol === "delegado") {
            //redirigir a student
            return redirect()->route('student');
        } else {
            //redirigir a dashboard
            return redirect()->route('dashboard');
        }

        //return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
