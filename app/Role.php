<?php

namespace App\Permission;



use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Role as VoyagerRole;

class Role extends VoyagerRole
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');

    }
}