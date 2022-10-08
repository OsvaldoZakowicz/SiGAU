<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Validator;

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

                    return view('users.index', compact('users'));
                } else {

                    //buscar por campos name, email. con orden
                    $users = $userService->buscarUsuariosInternos($validated);

                    return view('users.index', compact('users'));
                };
            } else {
                //no hay busqueda, ordenar por filtro
                $validated = $validator->safe()->only(['filtro', 'orden']);

                //?el filtro es para rol
                if ($request->input('filtro') === "role") {

                    //ordenar por campo rol
                    $users = $userService->ordenarUsuariosInternosPorRol($validated);

                    return view('users.index', compact('users'));
                } else {

                    //ordenar por campos name, email
                    $users = $userService->ordenarUsuariosInternos($validated);

                    return view('users.index', compact('users'));
                };
            };
        } else {
            
            //*si no se recibe request
            $users = $userService->listarUsuariosInternos();

            return view('users.index', compact('users'));
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
            'name' => 'required',
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

        $rolesAsignados = $user->getRoleNames();

        return view('users.show', compact('user', 'rolesAsignados'));
    }

    /**
     * Editar usuario.
     * getRoleNames() retorna una coleccion de items clave => valor
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UserService $userService, $id)
    {
        $user = User::find($id);

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
    public function update(Request $request, UserService $userService, $id)
    {
        //TODO solo cambiar el rol

        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
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
        //!Borrar un usuario se realizara en otro controlador, a cargo del propio usuario

        //?estoy inhabilitando mi propia cuenta?
        if (Auth()->user()->id === $user->id) {
            return redirect()
                ->route('users.show', $user)
                ->with('error', 'no puedes inhabilitarte a ti mismo');
        };

        //*Inhabilitar cuenta dejando solo permisos para ver dashboard.
        $user = $userService->inhabilitarUsuarioInterno($user);

        return redirect()
            ->route('users.index')
            ->with('exito', 'la cuenta del usuario ' . $user->name . ' ha sido inhabilitada');
    }
}
