@extends('dashboard')
@section('dashboard-content')
<div class="w-full h-max flex flex-col p-1">
    <div class="mx-2 flex flex-col items-start justify-start">
        <h3 class="text-base text-zinc-800 capitalize">roles</h3>
        <span>filtros/busqueda aqui!</span>
    </div>
    <table class="table-auto m-2 border border-zinc-300 border-collapse">
        <thead>
            <tr>
                <x-tables.th-cell>texto</x-tables.th-cell>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($users as $user)
                <tr class="text-sm text-zinc-800">
                    <x-tables.td-cell>dato</x-tables.td-cell>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
    <div class="mx-2">
        <p>paginacion aqui!</p>
    </div>
</div>
@endsection
