<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Services\Audit\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditController extends Controller
{
    //TODO constructor con middleware

    /**
     * *listar registros de auditoria.
     * NOTA: No funciona si declaro un archivo request aparte!
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AuditService $auditService)
    {

        if($request->hasAny('event','table','responsible','search','order')){
            
            //*request
            $validator = Validator::make($request->all(), [
                'event' => 'nullable|string|max:45',
                'table' => 'nullable|string|max:45',
                'responsible' => 'nullable|string|max:45',
                'search' => 'nullable|string|max:45',
                'order' => 'nullable|string|max:45'
            ]);

            //?existe valor de busqueda en el request?
            if ($request->input('search') !== NULL) {
                
                //hay busqueda
                $validated = $validator->validated();

            } else {

                //no hay busqueda, ordenar por tabla, evento, responsable.
                $validated = $validator->safe()->except('search');

                //obtener registros
                $audits = $auditService->buscarRegistrosAuditoriaGlobal($validated);

                //*tablas auditadas
                $tables = $auditService->obtenerTablasAuditadas();

                //*obtener roles responsables
                $roles = $auditService->obtenerRolesResponsables();

                return view('audits.index', compact('audits','validated','tables','roles'));

            }

        } else {

            //*si no se recibe request
            $validated = [
                'event' => 'all',
                'table' => 'all',
                'responsible' => 'all',
                'order' => 'desc'
            ];

            //*lista por defecto
            $audits = $auditService->obtenerRegistrosAuditoriaGlobal();

            //*tablas auditadas
            $tables = $auditService->obtenerTablasAuditadas();

            //*obtener roles responsables
            $roles = $auditService->obtenerRolesResponsables();

            return view('audits.index', compact('audits','validated','tables','roles'));
        }
        

    }

    /**
     * *mostrar un registro de auditoria.
     */
    public function show(AuditService $auditService, $id)
    {
        $audit = $auditService->obtenerRegistroAuditoria($id);

        $responsable = $auditService->obtenerResponsableDelEvento($id);

        return view('audits.show', compact('audit','responsable'));
    }
}
