@extends('dashboard')
@section('dashboard-content')
<div class="w-full h-max flex flex-col p-1">
    <div class="mx-2 flex flex-col items-start justify-start">
        <h3 class="text-base text-zinc-800 capitalize">usuarios</h3>
        <div class="w-full flex items-center justify-end">
            <span>filtros/busqueda aqui!</span>
            <x-buttons.button-link-zinc>
                
                <span>crear usuario interno</span>
            </x-buttons.button-link-zinc>
        </div>
    </div>
    <table class="table-auto m-2 border border-zinc-300 border-collapse">
        <thead>
            <tr>
                <x-tables.th-cell>id</x-tables.th-cell>
                <x-tables.th-cell>nombre</x-tables.th-cell>
                <x-tables.th-cell>correo</x-tables.th-cell>
                <x-tables.th-cell>fecha de creacion</x-tables.th-cell>
                <x-tables.th-cell>acciones</x-tables.th-cell>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="text-sm text-zinc-800">
                    <x-tables.td-cell>{{$user->id}}</x-tables.td-cell>
                    <x-tables.td-cell>{{$user->name}}</x-tables.td-cell>
                    <x-tables.td-cell>{{$user->email}}</x-tables.td-cell>
                    <x-tables.td-cell>{{$user->created_at}}</x-tables.td-cell>
                    <x-tables.td-cell>
                        <a href="{{route('users.show', $user)}}" class="mr-1 text-xs uppercase hover:text-sky-500">
                            <i class="fa-solid fa-eye"></i>
                            <span>ver</span>
                        </a>
                    </x-tables.td-cell>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mx-2">
        <p>paginacion aqui!</p>
    </div>
</div>
@endsection