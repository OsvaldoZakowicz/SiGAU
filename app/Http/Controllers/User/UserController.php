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

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO no retornar usuarios con rol becado o estudiante

        $users = User::paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO no retornar roles de becado y estudiante

        //roles para un usuario
        $roles = Role::pluck('name','name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO verificar email de forma automatica

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        //en $request se recibe un solo rol
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     * getRoleNames() retorna una coleccion de items clave => valor
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //roles del usuario
        $rolesAsignados = $user->getRoleNames();
        return view('users.show', compact('user','rolesAsignados'));
    }

    /**
     * Show the form for editing the specified resource.
     * getRoleNames() retorna una coleccion de items clave => valor
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO no se puede editar al superadministrador
        //TODO no retornar roles de becado y estudiante

        $user = User::find($id);
        //roles
        $roles = Role::pluck('name','name')->all();
        //roles del usuario
        $userRoles = $user->roles->pluck('name','name')->all();

        return view('users.edit', compact('user','roles','userRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
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

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO borrar usuarios? o inhabilitar con un rol por defecto?, en todo caso, se cambia el rol.
        //TODO para borrar, primero quitar roles!
        User::find($id)->delete();
        return redirect()->route('users.index');
    }
}
