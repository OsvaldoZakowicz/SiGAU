<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\UserReportService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class UserReportController extends Controller
{
    /**
     * *crear un reporte
     */
    public function crear(Request $request, UserReportService $userReportService)
    {
        //dompdf wrapper
        $pdf = app('dompdf.wrapper');

        //fecha de reporte
        $fechaReporte = Carbon::parse(Carbon::now())
                                ->locale('es_AR')
                                ->format('d-m-Y H:i');

        //usuario que reporta
        $cabeceraReporte = [
            'titulo' => 'reporte de usuarios',
            'fecha' => $fechaReporte,
            'nombre-usuario' => Auth()->user()->name,
            'email-usuario' => Auth()->user()->email,
            'rol-usuario' => Auth()->user()->getRoleNames()
        ];

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
                    $users = $userReportService->buscarUsuariosInternosPorRol($validated);
                } else {
                    $users = $userReportService->buscarUsuariosInternos($validated);
                };

            } else {

                //no hay busqueda, ordenar por filtro
                $validated = $validator->safe()->only(['filtro', 'orden']);

                //?el filtro es para rol?
                if ($request->input('filtro') === "role") {
                    $users = $userReportService->ordenarUsuariosInternosPorRol($validated);
                } else {
                    $users = $userReportService->ordenarUsuariosInternos($validated);
                };

            };

            $pdf->loadView('reports.users.report-index', compact('users','validated','cabeceraReporte','pdf'));
            return $pdf->stream('reporte-usuarios');

        } else {

            return redirect()->route('users.index');
        };
    }
}
