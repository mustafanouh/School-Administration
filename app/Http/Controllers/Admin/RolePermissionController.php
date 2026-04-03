<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'permissions','employee.media'])
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'student');
            })
            ->paginate(10);
        $roles = Role::where('name', '!=', 'student')->get();
        $permissions = Permission::all();

        return view('admin.roles.index', compact('users', 'roles', 'permissions'));
    }

    public function syncUserAccess(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);


        $user->syncRoles($request->roles ?? []);

        $user->syncPermissions($request->permissions ?? []);

        return back()->with('success', 'success ' . $user->name);
    }
}
