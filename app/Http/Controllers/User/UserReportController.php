<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class UserReportController extends Controller
{
    /**
     * Crear reporte.
     */
    public function crear(Request $request, UserService $userService)
    {
        //dompdf wrapper
        $pdf = app('dompdf.wrapper');

        //?tiene el request algun campo?
        if ($request->hasAny('filtro', 'valor', 'orden')) {

            /**
             * *se recibe request
             * filtro = name | email | role
             * valor = busqueda para sql LIKE
             * orden = asc | desc
             */
            $validator = Validator::make($request->all(), [
                'filtro' => 'required',
                'valor' => 'max:65',
                'orden' => 'required'
            ]);

            //?existe valor de busqueda en el request?
            if ($request->input('valor') !== NULL) {

                //hay busqueda
                $validated = $validator->validated();

                //?el filtro es para rol?
                if ($request->input('filtro') === "role") {

                    //buscar por rol
                    $users = $userService->buscarUsuariosInternosPorRol($validated);

                    //return view('reports.report', compact('users', 'validated'));
                    $pdf->loadView('reports.users.report-index', compact('users'));
                    return $pdf->download('reporte-de-usuarios');
                } else {

                    //buscar por campos name, email. con orden
                    $users = $userService->buscarUsuariosInternos($validated);

                    //return view('reports.report', compact('users', 'validated'));
                    $pdf->loadView('reports.users.report-index', compact('users'));
                    return $pdf->download('reporte-de-usuarios');
                };
            } else {
                //no hay busqueda, ordenar por filtro
                $validated = $validator->safe()->only(['filtro', 'orden']);

                //?el filtro es para rol
                if ($request->input('filtro') === "role") {

                    //ordenar por campo rol
                    $users = $userService->ordenarUsuariosInternosPorRol($validated);

                    //return view('reports.report', compact('users', 'validated'));
                    $pdf->loadView('reports.users.report-index', compact('users'));
                    return $pdf->download('reporte-de-usuarios');
                } else {

                    //ordenar por campos name, email
                    $users = $userService->ordenarUsuariosInternos($validated);

                    //return view('reports.report', compact('users', 'validated'));
                    $pdf->loadView('reports.users.report-index', compact('users'));
                    return $pdf->download('reporte-de-usuarios');
                };
            };
        } else {
            return redirect()->route('users.index');
        }
    }
}
