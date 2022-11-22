<?php

namespace App\Services\Audit;

use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * *servicios de auditoria
 */
class AuditService
{
    //*constructor
    function __construct() {}

    /**
     * *obtener los ultimos registros globales de auditoria del sistema
     * registros mas nuevos de auditoria, todos los generados hasta el momento.
     * ?NOTA la paginacion limita recuperar registros de forma controlada
     * por pagina, recarga al pasar cada pagina.
     */
    public function obtenerRegistrosAuditoriaGlobal()
    {
        $audits = DB::table('audits')
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
            )
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        foreach ($audits as $audit) {
            $audit->created_at = Carbon::parse($audit->created_at)
                ->locale('es_AR')
                ->format('d-m-Y H:i');
            
            $audit->users_user_created_at = Carbon::parse($audit->users_user_created_at)
                ->locale('es_AR')
                ->format('d-m-Y H:i');
        }

        return $audits;
    }

    /**
     * *buscar registros de auditoria.
     * - por evento, tabla, responsable.
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
        if ($parametros['event'] !== NULL) {
            $queryBuilder->where('audits.event','like','%'.$parametros['event'].'%');
        }

        //?hay filtro de tablas?
        if ($parametros['table'] !== NULL) {
            $queryBuilder->where('audits.auditable_type','like','%'.$parametros['table']);
        }

        //?hay filtro de rol?
        if ($parametros['responsible'] !== NULL) {
            $queryBuilder->where('roles.name','like','%'.$parametros['responsible'].'%');
        }
            
        //dd($queryBuilder);

        //en este punto se resuelve la query
        $audits = $queryBuilder
            ->orderBy('created_at', $parametros['order'])
            ->paginate(15);
        
        return $audits;
    }


    /**
     * *obtener un registro de auditoria.
     * un unico registro, desde la tabla de auditorias.
     * - id de evento.
     */
    public function obtenerRegistroAuditoria($id)
    {
        $audit = Audit::findOrFail($id);
        return $audit;
    }

    /**
     * *obtener un responsable del registro de auditoria.
     * una cuenta de acceso responsable de llevar a cabo el evento.
     * - id de evento.
     */
    public function obtenerResponsableDelEvento($id)
    {
        $responsable = DB::table('users')
            ->join('audits','users.id','=','audits.user_id')
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->join('roles','model_has_roles.role_id','=','roles.id')
            ->leftJoin('people','users.people_id','=','people_id')
            ->select('users.id','users.email','people.first_name','people.last_name','roles.name as role_name')
            ->where('audits.id','=',$id)
            ->first();
        
        //dd($responsable);

        return $responsable;
    }

    /**
     * *obtener las tablas auditables.
     * lista de las tablas que se están auditando, siempre
     * que de ellas existan al menos un registro.
     * Necesito:
     * [$key => $value] tal que:
     * [
     *  "User" => "users",
     *  "--Modelosingular--" => "--modeloplural--",
     * ]
     * 
     * substr($valor, 11) ya que todos los modelos se guardan en
     * App\Models\ y eso ocupa 11 caracteres.
     */
    public function obtenerTablasAuditadas()
    {
        $data = DB::table('audits')
            ->select('auditable_type')
            ->distinct()
            ->pluck('auditable_type', 'auditable_type')
            ->toArray();

        //dd($data); //['App/Models/User' => 'App/Models/User', ...]

        //array nuevo
        $tables = [];
        foreach ($data as $key => $value) {
            //eliminar $key => $value original
            unset($data[$key]);
            //nueva $key
            $new_key = Str::substr($value, 11);
            //nuevo $value
            $new_value = Str::plural(Str::lower(Str::substr($value, 11)));
            //insertar en array $new_key => $new_value
            $tables[$new_key] = $new_value;
        };

        //dd($tables); //["User" => "users",...]

        return $tables;
    }

    /**
     * *obtener roles de usuarios
     * roles que podrian ser de usuarios que esten
     * en registros de auditoria
     */
    public function obtenerRolesResponsables()
    {
        $roles = DB::table('roles')
            ->whereNotIn('name', ['inhabilitado'])
            ->pluck('name', 'name')
            ->all();

        return $roles;
    }

}