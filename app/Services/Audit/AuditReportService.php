<?php

namespace App\Services\Audit;

use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Models\Audit;

class AuditReportService
{
    //*constructor
    function __construct() {}

    /**
     * *buscar registros de auditoria.
     * - por evento, tabla, responsable, busqueda.
     */
    public function buscarRegistrosAuditoriaGlobal($parametros)
    {
        //query builder
        $queryBuilder = DB::table('audits')
            ->leftJoin('users','audits.user_id','=','users.id')
            ->leftjoin('model_has_roles','users.id','=','model_has_roles.model_id')
            ->leftjoin('roles','model_has_roles.role_id','=','roles.id')
            ->select(
                'audits.id',
                'audits.user_id',
                'audits.user_type',
                'audits.event',
                'audits.auditable_type',
                'audits.auditable_id',
                'audits.old_values',
                'audits.new_values',
                'audits.url',
                'audits.created_at',
                'users.id as users_user_id',
                'users.email as users_user_email',
                'users.created_at as users_user_created_at',
                'roles.name as role_name'
            );
        
        //?hay filtro de eventos?
        if ($parametros['event'] !== 'all') {
            $queryBuilder->where('audits.event','like','%'.$parametros['event'].'%');
        }

        //?hay filtro de tablas?
        if ($parametros['table'] !== 'all') {
            $queryBuilder->where('audits.auditable_type','like','%'.$parametros['table']);
        }

        //?hay filtro de rol?
        if ($parametros['responsible'] !== 'all') {
            $queryBuilder->where('roles.name','like','%'.$parametros['responsible'].'%');
        }

        //?hay busqueda por id?
        if (array_key_exists('search', $parametros)) {
            if ($parametros['search'] !== NULL) {
                $queryBuilder->where('audits.auditable_id','=',$parametros['search']);
            }
        }

        //en este punto se resuelve la query
        $audits = $queryBuilder
            ->orderBy('created_at', $parametros['order'])
            ->get();
        
        return $audits;
    }

    public function buscarRegistroAuditoriaIndividual($id)
    {
        $audit = Audit::findOrFail($id);
        return $audit;
    }

    public function buscarResponsableAuditoriaIndividual($id)
    {
        $responsable = DB::table('users')
            ->join('audits','users.id','=','audits.user_id')
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->join('roles','model_has_roles.role_id','=','roles.id')
            ->leftJoin('people','users.people_id','=','people_id')
            ->select('users.id','users.email','people.first_name','people.last_name','roles.name as role_name')
            ->where('audits.id','=',$id)
            ->first();

        return $responsable;
    }
}