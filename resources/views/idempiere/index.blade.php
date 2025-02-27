@extends('voyager::master')



@section('content')
<div class="container">
    
      {{-- Verificar si el usuario tiene el rol de superadmin o el rol ID 1 --}}
    @if(Auth::user()->role_id == 1)
    <h2 class="text-center">Conexiones Idempiere</h2>

       <a href="{{ route('getProducts') }}" class="btn btn-primary">Consulta Idempiere</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Token</th>
                <th>URL</th>
                <th>Cliente</th>
                <th>Organización</th>
                <th>Rol</th>
                <th>Almacén</th>
                <th>Idioma</th>
                <th>Usuario</th>
                <th>Password</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($connections as $connection)
            <tr>

         
                <td>{{ $connection->id }}</td>
                <td>{{ $connection->token }}</td>
                <td>{{ $connection->url }}</td>
                <td>{{ $connection->ftu_app_client_id }}</td>
                <td>{{ $connection->ftu_app_org_id }}</td>
                <td>{{ $connection->ftu_app_role_id }}</td>
                <td>{{ $connection->ftu_app_warehouse_id }}</td>
                <td>{{ $connection->ad_language }}</td>
                <td>{{ $connection->user }}</td>
                <td>{{ $connection->password }}</td>
            
                <td>  <a href="{{ route('connection.edit', $connection->id) }}" class="btn btn-sm btn-warning">Editar</a></td>
            </tr>
            
            @endforeach
        </tbody>
    </table>



    @else
    <H1>Sin acceso a esta sección</H1>
    @endif

    
 
</div>
@endsection