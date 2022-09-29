@extends('dashboard')
@section('dashboard-content')
    <div class="w-full h-max flex flex-col p-1">
        <div class="mx-2 flex flex-col items-start justify-start">
            <h3 class="text-base text-gray-800 capitalize">usuarios: ver usuario</h3>
            <div class="w-full flex items-center justify-end">
                <a href="{{route('users.edit', $user)}}" class="mr-2 flex items-center justify-center px-2 py-1 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-800 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fa-solid fa-user-shield mr-1"></i>
                    <span>editar/asignar rol</span>
                </a>
                <a href="#" class="flex items-center justify-center px-2 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fa-solid fa-lock mr-1"></i>
                    <span>inhabilitar cuenta</span>
                </a>
            </div>
        </div>
        <table class="m-2 border border-gray-300 border-collapse">
            <tr>
                <th class="text-xs uppercase text-left px-1 w-1/3 font-bold bg-gray-600 text-white border border-gray-300">
                    nombre de usuario:
                </th>
                <td class="text-sm px-1 border border-gray-300">
                    {{$user->name}}
                </td>
            </tr>
            <tr>
                <th class="text-xs uppercase text-left px-1 w-1/3 font-bold bg-gray-600 text-white border border-gray-300">
                    email:
                </th>
                <td class="text-sm px-1 border border-gray-300">
                    {{$user->email}}
                </td>
            </tr>
            <tr>
                <th class="text-xs uppercase text-left px-1 w-1/3 font-bold bg-gray-600 text-white border border-gray-300">
                    cuenta creada en:
                </th>
                <td class="text-sm px-1 border border-gray-300">
                    {{$user->created_at}}
                </td>
            </tr>
            <tr>
                <th class="text-xs uppercase text-left px-1 w-1/3 font-bold bg-gray-600 text-white border border-gray-300">
                    roles activos:
                </th>
                <td class="text-sm px-1 border border-gray-300">
                    @if ($rolesAsignados->count())
                        @foreach ($rolesAsignados as $role)
                            <span class="bg-green-300 px-1 text-gray-600">{{$role}}</span>
                        @endforeach
                    @else
                        <span class="text-red-600">sin roles</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
@endsection
