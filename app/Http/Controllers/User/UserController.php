<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//necesito el modelo User
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
//necesito el modelo Role
use Spatie\Permission\Models\Role;
//dompdf
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{

    //* controlador protegido por middleware
    //middleware permission configurado en kernel.php

    function __construct()
    {
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario',['only' => ['index']]);
        $this->middleware('permission:crear-usuario',['only' => ['create','store']]);
        $this->middleware('permission:editar-usuario',['only' => ['edit','update']]);
        $this->middleware('permission:borrar-usuario',['only' => ['destroy']]);
    }

    /**
     * Listar usuarios.
     * Recibe $request de formulario de busqueda.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $busqueda)
    {

        /**
         * *NOTA: el superadmin se crea por seeder, no tiene rol como tal,
         * por ello no es tomado en el join multiple.
         * !cuidado al cambiar el join por otra consulta, el super admin sera listado
         */

        if ($busqueda->filtro !== null && $busqueda->orden !== null && $busqueda->valor !== null) {

            //buscar por nombre o email
            if ($busqueda->filtro === 'name' || $busqueda->filtro === 'email') {
                $users = DB::table('users')
                    ->join('model_has_roles','users.id','=','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','=','roles.id')
                    ->select('users.id','users.name','users.email','users.created_at','roles.id as role_id','roles.name as role_name') 
                    ->where('users.'.$busqueda->filtro,'LIKE', '%' . $busqueda->valor . '%')
                    ->whereNotIn('roles.name',['estudiante','becado','delegado'])
                    ->orderBy('users.'.$busqueda->filtro, $busqueda->orden)
                    ->paginate(15);
            };

            //buscar por rol
            if ($busqueda->filtro === "role") {
                $users = DB::table('users')
                    ->join('model_has_roles','users.id','=','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','=','roles.id')
                    ->select('users.id','users.name','users.email','users.created_at','roles.id as role_id','roles.name as role_name') 
                    ->where('roles.name','LIKE', '%' . $busqueda->valor . '%')
                    ->whereNotIn('roles.name',['estudiante','becado','delegado'])
                    ->orderBy('roles.name', $busqueda->orden)
                    ->paginate(15);
            };

            //filtros de busqueda
            $input = $busqueda->all();

            //retornar busqueda con filtros
            return view('users.index', compact('users','input'));

        };

        if ($busqueda->filtro !== null && $busqueda->orden !== null) {
            
            //buscar por nombre o email
            if ($busqueda->filtro === 'name' || $busqueda->filtro === 'email') {
                $users = DB::table('users')
                    ->join('model_has_roles','users.id','=','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','=','roles.id')
                    ->select('users.id','users.name','users.email','users.created_at','roles.id as role_id','roles.name as role_name') 
                    ->whereNotIn('roles.name',['estudiante','becado','delegado'])
                    ->orderBy('users.'.$busqueda->filtro, $busqueda->orden)
                    ->paginate(15);
            };

            //buscar por rol
            if ($busqueda->filtro === "role") {
                $users = DB::table('users')
                    ->join('model_has_roles','users.id','=','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','=','roles.id')
                    ->select('users.id','users.name','users.email','users.created_at','roles.id as role_id','roles.name as role_name') 
                    ->whereNotIn('roles.name',['estudiante','becado','delegado'])
                    ->orderBy('roles.name', $busqueda->orden)
                    ->paginate(15);
            };

            //filtros de busqueda
            $input = $busqueda->all();

            //retornar busqueda con filtros
            return view('users.index', compact('users','input'));

        }

        $users = DB::table('users')
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->join('roles','model_has_roles.role_id','=','roles.id')
            ->select('users.id','users.name','users.email','users.created_at','roles.id as role_id','roles.name as role_name')
            ->whereNotIn('roles.name',['estudiante','becado','delegado'])
            ->orderBy('users.created_at','desc')
            ->paginate(15);

        //filtros por defecto
        $input = ['filtro'=>'created_at','valor' => 'null',"orden"=>'desc'];

        return view('users.index', compact('users','input'));
    }

    /**
     * Dscargar reporte de index.
     */
    public function reporte(Request $busqueda)
    {
        //*pdf
        $pdf = app('dompdf.wrapper');

        //?tengo filtros nulos
        if ($busqueda->filtro !== null && $busqueda->orden !== null && $busqueda->valor !== null) {
            
            //buscar por nombre o email
            if ($busqueda->filtro === 'name' || $busqueda->filtro === 'email') {
                $users = DB::table('users')
                    ->join('model_has_roles','users.id','=','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','=','roles.id')
                    ->select('users.id','users.name','users.email','users.created_at','roles.id as role_id','roles.name as role_name') 
                    ->where('users.'.$busqueda->filtro,'LIKE', '%' . $busqueda->valor . '%')
                    ->whereNotIn('roles.name',['estudiante','becado','delegado'])
                    ->orderBy('users.'.$busqueda->filtro, $busqueda->orden)
                    ->get();
            };

            //buscar por rol
            if ($busqueda->filtro === "role") {
                $users = DB::table('users')
                    ->join('model_has_roles','users.id','=','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','=','roles.id')
                    ->select('users.id','users.name','users.email','users.created_at','roles.id as role_id','roles.name as role_name') 
                    ->where('roles.name','LIKE', '%' . $busqueda->valor . '%')
                    ->whereNotIn('roles.name',['estudiante','becado','delegado'])
                    ->orderBy('roles.name', $busqueda->orden)
                    ->get();
            };

            $pdf->loadView('reports.report', compact('users'));
            return $pdf->stream();

        };
        
        $users = DB::table('users')
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->join('roles','model_has_roles.role_id','=','roles.id')
            ->select('users.id','users.name','users.email','users.created_at','roles.id as role_id','roles.name as role_name')
            ->whereNotIn('roles.name',['estudiante','becado','delegado'])
            ->orderBy('users.created_at','desc')
            ->get();

        $pdf->loadView('reports.report', compact('users'));
        return $pdf->stream();
    }

    /**
     * Crear usuario
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //roles para un usuario
        //$roles = Role::pluck('name','name')->all();

        //roles disponibles para usuarios internos
        $roles = DB::table('roles')
            ->whereNotIn('name',['estudiante','becado','delegado'])
            ->pluck('name','name')
            ->all();

        return view('users.create', compact('roles'));
    }

    /**
     * Guardar usuario.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * *NOTA: la verificacion de correo se solicitara
         * al primer inicio de sesion.
         */

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password']
        ]);

        //en $request se recibe un solo rol
        $user->assignRole($request->input('roles'));

        return redirect()
            ->route('users.index')
            ->with('exito', 'usuario creado');
    }

    /**
     * Mostrar usuario.
     * getRoleNames() retorna una coleccion de items clave => valor
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        //roles del usuario
        $rolesAsignados = $user->getRoleNames();
        return view('users.show', compact('user','rolesAsignados'));
    }

    /**
     * Editar usuario.
     * getRoleNames() retorna una coleccion de items clave => valor
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        //roles
        $roles = DB::table('roles')
            ->whereNotIn('name',['estudiante','becado','delegado'])
            ->pluck('name','name')
            ->all();
        //roles del usuario
        $userRoles = $user->roles->pluck('name','name')->all();

        return view('users.edit', compact('user','roles','userRoles'));
    }

    /**
     * Modificar usuario.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //TODO solo cambiar el rol

        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            //si no esta vacio el campo password, significa que cambio la password, entonces
            //hacemos un hash para encriptarla.
            $input['password'] = Hash::make($input['password']);
        } else {
            //si esta vacio, no tomamos el valor vacio, quitamos del array input.
            $input = Arr::except($input, array('password'));
        }

        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()
            ->route('users.index')
            ->with('exito', 'usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //!Borrar un usuario se realizara en otro controlador, a cargo del propio usuario
        
        //?estoy inhabilitando mi propia cuenta?
        if (Auth()->user()->id === $user->id) {
            return redirect()
                ->route('users.show', $user)
                ->with('error', 'no puedes inhabilitarte a ti mismo');
        };
        
        //*Inhabilitar cuenta dejando solo permisos para ver dashboard.

        //quitar rol anterior
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        //asignar rol nuevo
        $user->assignRole('inhabilitado');

        return redirect()
            ->route('users.index')
            ->with('exito', 'la cuenta del usuario '.$user->name.' ha sido inhabilitada');
    }
}
