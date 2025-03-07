<?php

namespace App\Http\Controllers;

use TCG\Voyager\Http\Controllers\VoyagerRoleController as BaseVoyagerRoleController;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\Permission;

class VoyagerRoleController extends BaseVoyagerRoleController
{
    // Sobrescribimos el método update para manejar la actualización de permisos
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        
        // Actualiza el rol (si es necesario)
        $role->name = $request->name;
        $role->save();
        
        // Eliminar permisos actuales
        $role->permissions()->detach();
        
        // Asignar nuevos permisos
        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }
        
        // Redirigir después de la actualización
        return redirect()->route('voyager.roles.index')->with('success', 'Rol actualizado correctamente');
    }
}