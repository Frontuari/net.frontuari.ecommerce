<?php

namespace TCG\Voyager\Models;


use Illuminate\Database\Eloquent\Model;



class Permission extends Model
{
    // La relación de muchos a muchos con los roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}