@extends('voyager::master')

@section('content')
<div class="container">
    @if(Auth::user()->role_id == 1)
    <h2>Editar Conexión Idempiere</h2>
    <form action="{{ route('connection.update', $connection->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Token</label>
            <input type="text" name="token" class="form-control" value="{{ $connection->token }}" required>
        </div>

        <div class="form-group">
            <label>URL</label>
            <input type="url" name="url" class="form-control" value="{{ $connection->url }}" required>
        </div>

        <div class="form-group">
            <label>Cliente</label>
            <input type="text" name="ftu_app_client_id" class="form-control" value="{{ $connection->ftu_app_client_id }}" required>
        </div>

        <div class="form-group">
            <label>Organización</label>
            <input type="text" name="ftu_app_org_id" class="form-control" value="{{ $connection->ftu_app_org_id }}" required>
        </div>

        <div class="form-group">
            <label>Rol</label>
            <input type="text" name="ftu_app_role_id" class="form-control" value="{{ $connection->ftu_app_role_id }}" required>
        </div>

        <div class="form-group">
            <label>Almacén</label>
            <input type="text" name="ftu_app_warehouse_id" class="form-control" value="{{ $connection->ftu_app_warehouse_id }}" required>
        </div>

        <div class="form-group">
            <label>Idioma</label>
            <input type="text" name="ad_language" class="form-control" value="{{ $connection->ad_language }}" required>
        </div>

        <div class="form-group">
            <label>Usuario</label>
            <input type="text" name="user" class="form-control" value="{{ $connection->user }}" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="{{ $connection->password }}" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('idempiere.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    @else
    <H1>Sin acceso a esta sección</H1>
    @endif

</div>
@endsection