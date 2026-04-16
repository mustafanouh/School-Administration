<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionRepository
{
 
    public function getUserWithRolesAndPermissions()
    {
        return User::with(['roles', 'permissions', 'employee.media'])
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'student');
            })->latest()
            ->paginate(10);
    }
    public function getRole()
    {
        return Role::where('name', '!=', 'student')->get();    
    }
    public function getPermission()
    {
        return Permission::all();
    }

    public function syncRole($data , User $user)
    {
        return $user->syncRoles($data['roles'] ?? []);

    }
    public function syncPermission($data , User $user)
    {
        return $user->syncPermissions($data['permissions'] ?? []);
    }

}
