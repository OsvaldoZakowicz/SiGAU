<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//spatie permission
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//DB
use Illuminate\Support\Facades\DB;

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
     * Mostrar lista de roles.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$roles = Role::paginate(15);

        //roles ordenados por fecha de creacion mas reciente
        $roles = DB::table('roles')
            ->orderBy('created_at','desc')
            ->paginate(15);

        return view('roles.index', compact('roles'));
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:65|unique:roles,name',
            'description' => 'required|max:125',
            'permission' => 'required'
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'visibility' => 'readwrite'
        ]);

        //syncPermissions() es un metodo para sincronizar permisos a un usuario, o rol
        //quita todos los permisos y concede los proporcionados en el request permission
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index');
    }

    /**
     * Mostrar rol.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        //permisos del rol
        $rolePermissions = $role->permissions->pluck('name');

        return view('roles.show', compact('role','rolePermissions'));
    }

    /**
     * Editar rol.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        //obtengo permisos aplicables solo a administradores
        $permission = Permission::where('asignable_to','administrador')->get();
        //permisos del rol
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role','permission','rolePermissions'));
    }

    /**
     * Modificar rol.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:65',
            'description' => 'required|max:125',
            'permission' => 'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->visibility = 'readwrite';
        $role->save();

        //sincronizar permisos
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index');
    }

    /**
     * Eliminar rol. 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: No borrar roles que estan asignados a usuarios
        //TODO: ERROR al intentar borrar!!

        DB::table('roles')->where('id', $id)->delete();
        return redirect()->route('roles.index');
    }
}
