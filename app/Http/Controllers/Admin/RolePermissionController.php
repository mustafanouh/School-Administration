<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; // إضافة موديل الصلاحيات
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
        // جلب المستخدمين مع أدوارهم وصلاحياتهم المباشرة
        $users = User::with(['roles', 'permissions'])->paginate(10);
        $roles = Role::all();
        $permissions = Permission::all(); // جلب كافة الصلاحيات المتاحة في النظام

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

        // 1. مزامنة الأدوار (مثل: مدير، معلم)
        $user->syncRoles($request->roles ?? []);

        // 2. مزامنة الصلاحيات المباشرة (صلاحيات استثنائية لهذا المستخدم تحديداً)
        $user->syncPermissions($request->permissions ?? []);

        return back()->with('success', 'تم تحديث الأدوار والصلاحيات بنجاح للمستخدم: ' . $user->name);
    }
}