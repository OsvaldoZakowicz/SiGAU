<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\User\RoleService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Carbon;

class RoleController extends Controller
{

    //* controlador protegido por middleware
    //middleware permission configurado en kernel.php

    function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol',['only' => ['index']]);
        $this->middleware('permission:crear-rol',['only' => ['create','store']]);
        $this->middleware('permission:editar-rol',['only' => ['edit','update']]);
        $this->middleware('permission:borrar-rol',['only' => ['destroy']]);
    }

    /**
     * Listar roles.
     * Recibe $request especial de formulario de busqueda.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, RoleService $roleService)
    {
        //*se recibe un request
        //?tiene el request algun campo?
        if ($request->hasAny('filtro','valor','orden')) {
            
            /**
             * *se recibe request
             * filtro = name | description
             * valor = busqueda para sql LIKE
             * orden = asc | desc
             */
            $validator = Validator::make($request->all(),[
                'filtro' => 'required',
                'valor' => 'max:65',
                'orden' => 'required'
            ]);

            //?existe valor de busqueda en el request?
            if ($request->input('valor') !== NULL) {
                //hay busqueda
                $validated = $validator->validated();
                $roles = $roleService->buscarRoles($validated);
            } else {
                //no hay busqueda, ordenar por filtro
                $validated = $validator->safe()->only(['filtro','orden']);
                $roles = $roleService->ordenarRoles($validated);
            };

            return view('roles.index', compact('roles','validated'));

        } else {

            //*si no se recibe request
            $validated = ['filtro' => 'created_at', 'orden' => 'desc'];

            //*lista por defecto
            $roles = $roleService->listarRoles();

            return view('roles.index', compact('roles','validated'));
        };
        
    }

    /**
     * Mostrar formulario de creacion de roles.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtengo permisos aplicables solo a administradores
        $permission = Permission::where('asignable_to','administrador')->get();
        return view('roles.create', compact('permission'));
    }

    /**
     * Guardar rol.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, RoleService $roleService)
    {
        $this->validate($request, [
            'name' => 'required|max:65|unique:roles,name',
            'description' => 'required|max:125',
            'permission' => 'required'
        ]);

        $role = $roleService->crearRol($request->all());

        return redirect()
            ->route('roles.index')
            ->with('exito','rol creado');
    }

    /**
     * Mostrar rol.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        $rolePermissions = $role->permissions->pluck('name');

        return view('roles.show', compact('role','rolePermissions'));
    }

    /**
     * Editar rol.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleService $roleService,$id)
    {
        $role = $roleService->buscarRol($id);

        $permission = $roleService->obtenerPermisosAdministradores();
        
        $rolePermissions = $roleService->obtenerPermisosDelRol($role->id);

        return view('roles.edit', compact('role','permission','rolePermissions'));
    }

    /**
     * Modificar rol.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleService $roleService, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:65',
            'description' => 'required|max:125',
            'permission' => 'required'
        ]);

        $role = $roleService->buscarRol($id);

        $role = $roleService->actualizarRol($role, $request->all());

        return redirect()
            ->route('roles.index')
            ->with('exito','rol actualizado');
    }

    /**
     * Eliminar rol. 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, RoleService $roleService)
    {

        //?se puede borrar el rol?
        if ($role->visibility === "readonly") {
            return redirect()
                ->route('roles.show', compact('role'))
                ->with('error', 'no se puede borrar, el rol '.$role->name.' es de solo lectura');
        };

        //?el rol esta asociado a usuarios, o algun modelo?
        //si tiene usuarios asociados, redirect con error
        if ($roleService->contarModelosAsociados($role) !== 0) {
            return redirect()
                ->route('roles.show', compact('role'))
                ->with('error', 'no se puede borrar el rol '.$role->name.' existen usuarios con ese rol');
        };

        //?el rol tiene permisos
        //si no tiene usuarios, se puede borrar, quitar permisos, si tiene
        if ($role->permissions->count() !== 0) {
            //sincronizar con array vacio, quita permisos
            $role->syncPermissions([]);
        };

        //*borrar rol
        $status = $roleService->borrarRol($role);

        return redirect()
            ->route('roles.index')
            ->with('exito', 'rol eliminado');
    }
}
