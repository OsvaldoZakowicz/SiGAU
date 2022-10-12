<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\RoleReportService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class RoleReportController extends Controller
{
    /**
     * *crear un reporte.
     */
    public function crear(Request $request, RoleReportService $roleReportService)
    {
        //dompdf wrapper
        $pdf = app('dompdf.wrapper');

        //fecha de reporte
        $fechaReporte = Carbon::parse(Carbon::now())
                                ->locale('es_AR')
                                ->format('d-m-Y H:i');

        //usuario que reporta
        $cabeceraReporte = [
            'titulo' => 'reporte de roles',
            'fecha' => $fechaReporte,
            'nombre-usuario' => Auth()->user()->name,
            'email-usuario' => Auth()->user()->email,
            'rol-usuario' => Auth()->user()->getRoleNames()
        ];

        //?tiene el request algun campo?
        if ($request->hasAny('filtro', 'valor', 'orden')) {

            /**
             * *se recibe request
             * filtro = name | description
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
                $roles = $roleReportService->buscarRoles($validated);

            } else {

                //no hay busqueda, ordenar por filtro
                $validated = $validator->safe()->only(['filtro', 'orden']);
                $roles = $roleReportService->ordenarRoles($validated);

            };

            $pdf->loadView('reports.roles.report-index', compact('roles', 'validated', 'cabeceraReporte', 'pdf'));
            return $pdf->stream('reporte-roles');

        } else {

            return redirect()->route('roles.index');
        };
    }
}
