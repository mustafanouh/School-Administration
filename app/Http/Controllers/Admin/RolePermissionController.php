<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermissionRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


use App\Repositories\RolePermissionRepository;

class RolePermissionController extends Controller
{

    protected $RolePermissionRepository;
    public function __construct(RolePermissionRepository $RolePermissionRepository)
    {
        $this->RolePermissionRepository = $RolePermissionRepository;
    }


    public function index()
    {
        $users = $this->RolePermissionRepository->getUserWithRolesAndPermissions();
        $roles = $this->RolePermissionRepository->getRole();
        $permissions = $this->RolePermissionRepository->getPermission();

        return view('admin.roles.index', compact('users', 'roles', 'permissions'));
    }

    public function syncUserAccess(RolePermissionRequest $request, User $user)
    {

        $this->RolePermissionRepository->syncRole($request->validated(), $user);
        $this->RolePermissionRepository->syncPermission($request->validated(), $user);

        return back()->with('success', 'success ' . $user->name);
    }
}
