<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IdempiereConnection;

class IdempiereConnectionController extends Controller
{
    public function index()
    {
        $connections = IdempiereConnection::all();
        return view('idempiere.index', compact('connections'));
    }

    public function create()
    {
        return view('idempiere.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'url' => 'required|url',
            'ftu_app_client_id' => 'required',
            'ftu_app_org_id' => 'required',
            'ftu_app_role_id' => 'required',
            'ftu_app_warehouse_id' => 'required',
            'ad_languajes' => 'required',
            'user' => 'required',
            'password' => 'nullable', // No es obligatorio encriptarlo
        ]);

        IdempiereConnection::create($request->all());

        return redirect()->route('idempiere.index')->with('success', 'Conexión creada correctamente.');
    }

    public function edit($id)
{
    $connection = IdempiereConnection::findOrFail($id);
    return view('idempiere.edit', compact('connection'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'token' => 'required',
        'url' => 'required|url',
        'ftu_app_client_id' => 'required',
        'ftu_app_org_id' => 'required',
        'ftu_app_role_id' => 'required',
        'ftu_app_warehouse_id' => 'required',
        'ad_language' => 'required',
        'user' => 'required',
        'password' => 'required',
    ]);

    $connection = IdempiereConnection::findOrFail($id);
    $connection->update($request->all());

    return redirect()->route('idempiere.index')->with('success', 'Conexión actualizada correctamente');
}
}
