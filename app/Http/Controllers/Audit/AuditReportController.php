<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Services\Audit\AuditReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AuditReportController extends Controller
{
    public function crear(Request $request, AuditReportService $auditReportService)
    {
        //dompdf wrapper
        $pdf = app('dompdf.wrapper');

        //fecha de reporte
        $fechaReporte = Carbon::parse(Carbon::now())
                                ->locale('es_AR')
                                ->format('d-m-Y H:i');

        //usuario que reporta
        $cabeceraReporte = [
            'titulo' => 'reporte de auditoria',
            'fecha' => $fechaReporte,
            'nombre-usuario' => Auth()->user()->name,
            'email-usuario' => Auth()->user()->email,
            'rol-usuario' => Auth()->user()->getRoleNames()
        ];

        //?tiene el request algun campo?
        if($request->hasAny('event','table','responsible','search','order')){
            
            //*request
            $validator = Validator::make($request->all(), [
                'event' => 'nullable|string|max:45',
                'table' => 'nullable|string|max:45',
                'responsible' => 'nullable|string|max:45',
                'search' => 'nullable|numeric|max_digits:45',
                'order' => 'nullable|string|max:45'
            ]);

            //error en validaciones
            if ($validator->fails()) {
                return redirect('audits')
                    ->withErrors($validator)
                    ->withInput();
            }

            //validaciones correctas
            $validated = $validator->validated();

            //obtener registros
            $audits = $auditReportService->buscarRegistrosAuditoriaGlobal($validated);

            $pdf->loadView('reports.audits.report-index', compact('audits','validated','cabeceraReporte','pdf'));
            return $pdf->stream('reporte-auditoria');

        } else {

            return redirect()->route('audits.index');
        }
    }

    public function crearIndividual(AuditReportService $auditReportService,$id)
    {
        //dompdf wrapper
        $pdf = app('dompdf.wrapper');

        //fecha de reporte
        $fechaReporte = Carbon::parse(Carbon::now())
                                ->locale('es_AR')
                                ->format('d-m-Y H:i');

        //usuario que reporta
        $cabeceraReporte = [
            'titulo' => 'reporte de auditoria individual',
            'fecha' => $fechaReporte,
            'nombre-usuario' => Auth()->user()->name,
            'email-usuario' => Auth()->user()->email,
            'rol-usuario' => Auth()->user()->getRoleNames()
        ];

        $audit = $auditReportService->buscarRegistroAuditoriaIndividual($id);

        $responsable = $auditReportService->buscarResponsableAuditoriaIndividual($id);

        $pdf->loadView('reports.audits.report-show', compact('audit','responsable','cabeceraReporte','pdf'));
        return $pdf->stream('reporte-auditoria-individual');
    }
}
