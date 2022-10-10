@extends('reports.report')
@section('report-content')
    <table class="tabla">
        <thead>
            <tr>
                <th>nombre</th>
                <th>correo</th>
                <th>rol activo</th>
                <th>fecha de creacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role_name}}</td>
                <td>{{$user->created_at}}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
@endsection
