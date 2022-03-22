<?php

namespace App\Traits;
use App\Models\Role;
use App\Models\Permission;

trait HasRolesAndPermissions{

    public function roles(){
        return $this->belongsToMany(Role::class, 'users_roles');
    }
    public function permissions(){
        return $this->belongsToMany(permission::class, 'users_permissions');
    }
}