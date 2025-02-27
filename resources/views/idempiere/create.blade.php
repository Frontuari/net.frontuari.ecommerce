@extends('voyager::master')



@section('content')
<div class="container">
    <h2>Nueva Conexión Idempiere</h2>
    <form action="{{ route('idempiere.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="token" class="form-label">Token</label>
            <input type="text" class="form-control" name="token" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="url" class="form-control" name="url" required>
        </div>
        <div class="mb-3">
            <label for="ftu_app_client_id" class="form-label">Cliente</label>
            <input type="text" class="form-control" name="ftu_app_client_id" required>
        </div>
        <div class="mb-3">
            <label for="ftu_app_org_id" class="form-label">Organización</label>
            <input type="text" class="form-control" name="ftu_app_org_id" required>
        </div>
        <div class="mb-3">
            <label for="ftu_app_role_id" class="form-label">Rol</label>
            <input type="text" class="form-control" name="ftu_app_role_id" required>
        </div>
        <div class="mb-3">
            <label for="ftu_app_warehouse_id" class="form-label">Almacén</label>
            <input type="text" class="form-control" name="ftu_app_warehouse_id" required>
        </div>
        <div class="mb-3">
            <label for="ad_languajes" class="form-label">Idioma</label>
            <input type="text" class="form-control" name="ad_languajes" required>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="user" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña (Opcional)</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection