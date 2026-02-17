<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    public function run(): void
    {

    // 1. إيقاف التحقق من العلاقات الأجنبية
        Schema::disableForeignKeyConstraints();

        // 2. تصفير الجدول تماماً
        DB::table('users')->truncate();
        // مسح الجدول لتجنب التكرار عند إعادة التشغيل
        DB::table('users')->delete();

        // مصفوفة المستخدمين - يمكنك إضافة العدد الذي تريده هنا
        $users = [
            ['name' => 'Admin Manager', 'email' => 'admin@school.com'],
            ['name' => 'Ahmed Ali', 'email' => 'ahmed@school.com'],
            ['name' => 'Sami Mansour', 'email' => 'sami@school.com'],
            ['name' => 'Mona Hassan', 'email' => 'mona@school.com'],
            ['name' => 'Laila Omar', 'email' => 'laila@school.com'],
            ['name' => 'Omar Khaled', 'email' => 'omar@school.com'],
            ['name' => 'Zaid Salem', 'email' => 'zaid@school.com'],
            ['name' => 'Huda Karim', 'email' => 'huda@school.com'],
            ['name' => 'Sara Mahmoud', 'email' => 'sara@school.com'],
            ['name' => 'Yassin Taha', 'email' => 'yassin@school.com'],
            ['name' => 'Rana Fawzi', 'email' => 'rana@school.com'],
            ['name' => 'Majd Issa', 'email' => 'majd@school.com'],
        ];

        foreach ($users as $userData) {
            User::create([
                'name'     => $userData['name'],
                'email'    => $userData['email'],
                'password' => Hash::make('password123'), // كلمة مرور موحدة للكل لتسهيل التجربة
            ]);
        }
    }
}
