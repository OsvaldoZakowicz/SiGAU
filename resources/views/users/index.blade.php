@extends('dashboard')
@section('dashboard-content')
<div class="w-full h-max flex flex-col p-1">
    <div class="mx-2 flex flex-col items-start justify-start">
        <h3 class="text-base text-gray-800 capitalize">usuarios</h3>
        <span>filtros/busqueda aqui!</span>
    </div>
    <table class="table-auto m-2 border border-gray-300 border-collapse">
        <thead class="uppercase font-semibold bg-gray-600 text-white">
            <tr class="text-xs">
                <th class="border border-gray-300">id</th>
                <th class="border border-gray-300">nombre</th>
                <th class="border border-gray-300">email</th>
                <th class="border border-gray-300">fecha de creacion</th>
                <th class="border border-gray-300">acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="text-sm text-gray-800">
                    <td class="px-1 border border-gray-300">{{$user->id}}</td>
                    <td class="px-1 border border-gray-300">{{$user->name}}</td>
                    <td class="px-1 border border-gray-300">{{$user->email}}</td>
                    <td class="px-1 border border-gray-300">{{$user->created_at}}</td>
                    <td class="px-1 border border-gray-300">
                        <a href="{{route('users.show', $user)}}" class="mr-1 text-xs uppercase hover:text-blue-500">
                            <i class="fa-solid fa-eye"></i>
                            <span>ver</span>
                        </a>
                        {{-- <a href="{{route('users.edit', $user)}}" class="mr-1 text-xs uppercase hover:text-green-500">
                            <i class="fa-solid fa-pen"></i>
                            <span>editar</span>
                        </a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mx-2">
        <p>paginacion aqui!</p>
    </div>
</div>
@endsection