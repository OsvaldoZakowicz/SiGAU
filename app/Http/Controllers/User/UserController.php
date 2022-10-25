<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class UserController extends Controller
{

    //* controlador protegido por middleware
    //middleware permission configurado en kernel.php

    function __construct()
    {
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario', ['only' => ['index']]);
        $this->middleware('permission:crear-usuario', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-usuario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-usuario', ['only' => ['destroy']]);
    }

    /**
     * Listar usuarios.
     * Recibe $request especial de formulario de busqueda.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserService $userService)
    {
        //*se recibe un request
        //?tiene el request algun campo?
        if ($request->hasAny('filtro', 'valor', 'orden')) {

            /**
             * *se recibe request
             * filtro = email | role
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
                } else {
                    //buscar por campos name, email. con orden
                    $users = $userService->buscarUsuariosInternos($validated);
                };
            } else {
                //no hay busqueda, ordenar por filtro
                $validated = $validator->safe()->only(['filtro', 'orden']);

                //?el filtro es para rol
                if ($request->input('filtro') === "role") {
                    //ordenar por campo rol
                    $users = $userService->ordenarUsuariosInternosPorRol($validated);
                } else {
                    //ordenar por campos name, email
                    $users = $userService->ordenarUsuariosInternos($validated);
                };

            };

            return view('users.index', compact('users', 'validated'));
            
        } else {

            //*si no se recibe request
            $validated = ['filtro' => 'created_at', 'orden' => 'desc'];

            //*lista por defecto
            $users = $userService->listarUsuariosInternos();

            return view('users.index', compact('users', 'validated'));
        };
    }

    /**
     * Crear usuario
     * @return \Illuminate\Http\Response
     */
    public function create(UserService $userService)
    {
        $roles = $userService->obtenerRolesParaUsuarioInterno();

        return view('users.create', compact('roles'));
    }

    /**
     * Guardar usuario.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserService $userService)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $user = $userService->crearUsuarioInterno($request->all());

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

        $user->created_at = Carbon::parse($user->created_at)
            ->locale('es_ES')
            ->format('d-m-Y H:i');

        $rolesAsignados = $user->getRoleNames();

        return view('users.show', compact('user', 'rolesAsignados'));
    }

    /**
     * Editar usuario.
     * Un administrador edita una cuenta, siempre que está aún no haya sido
     * verificada por el usuario en cuestion. Luego de eso, el propio usuario tiene
     * control sobre su cuenta.
     * getRoleNames() retorna una coleccion de items clave => valor
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UserService $userService, User $user)
    {
        $roles = $userService->obtenerRolesParaUsuarioInterno();

        $userRoles = $userService->obtenerRolesDelUsuarioInterno($user);

        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Modificar usuario.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserService $userService, User $user)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $user = $userService->actualizarUsuarioInterno($user, $request->all());

        return redirect()
            ->route('users.index')
            ->with('exito', 'usuario actualizado');
    }

    /**
     * Inhabilitar usuario.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, UserService $userService)
    {
        #code
    }
}
