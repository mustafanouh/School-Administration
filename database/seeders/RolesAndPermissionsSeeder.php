<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إعادة تعيين الكاش الخاص بالصلاحيات (مهم جداً)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. إنشاء الصلاحيات
        $permissions = [
            'register student',
            'dismiss student',
            'create exam',
            'edit marks',
            'manage staff',
            'view financial reports',
            'archive records'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // 3. إنشاء الأدوار وإسناد الصلاحيات لها
        
        // مدير النظام (Admin) - له كل الصلاحيات
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // المشرف (Supervisor)
        $supervisorRole = Role::create(['name' => 'supervisor']);
        $supervisorRole->givePermissionTo(['register student', 'dismiss student', 'create exam']);

        // المحاسب (Accountant)
        $accountantRole = Role::create(['name' => 'accountant']);
        $accountantRole->givePermissionTo(['view financial reports']);

        // المدرس (Teacher)
        $teacherRole = Role::create(['name' => 'teacher']);
        $teacherRole->givePermissionTo(['create exam', 'edit marks']);

        // أمين السر (Secretary)
        $secretaryRole = Role::create(['name' => 'secretary']);
        $secretaryRole->givePermissionTo(['register student', 'archive records']);

        // 4. إنشاء مستخدمين تجريبيين وإسناد الأدوار لهم
        
        // إنشاء الأدمن
        $admin = User::create([
            'name' => 'System Admin',
            'email' => 'admin@school.com',
            'password' => Hash::make('password'), // يفضل تغييره لاحقاً
        ]);
        $admin->assignRole($adminRole);

        // إنشاء مدرس تجريبي
        $teacher = User::create([
            'name' => 'Ahmed Teacher',
            'email' => 'teacher@school.com',
            'password' => Hash::make('password'),
        ]);
        $teacher->assignRole($teacherRole);

        $this->command->info('Roles, Permissions, and Demo Users created successfully!');
    }
}