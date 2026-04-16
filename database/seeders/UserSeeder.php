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

        $users = [
            ['name' => 'Admin Manager', 'email' => 'admin@school.com'], 
        ];

        foreach ($users as $userData) {
            User::create([
                'name'     => $userData['name'],
                'email'    => $userData['email'],
                'password' => Hash::make('password123'), 
            ]);
        }
    }
}
