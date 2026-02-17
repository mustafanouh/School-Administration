<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. تنظيف جدول الموظفين قبل البدء لتجنب تكرار البيانات
        DB::table('employees')->delete();

        // 2. جلب جميع المستخدمين الذين تم إنشاؤهم في UserSeeder
        $users = User::all();

        // 3. تعريف مصفوفة للمناصب الوظيفية لتوزيعها على الموظفين
        $jobTitles = ['Teacher', 'Accountant', 'Librarian', 'IT Support', 'Administrator'];

        foreach ($users as $index => $user) {
            
            // استثناء حساب المدير العام من أن يكون موظفاً (حسب رغبتك)
            if ($user->email === 'admin@school.com') {
                continue;
            }

            // تقسيم الاسم الكامل (مثلاً: Ahmed Ali) إلى اسم أول واسم عائلة
            $nameParts = explode(' ', $user->name);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? 'Family';

            // تحديد الجنس بشكل يدوي بسيط: 
            // الأسماء التي تنتهي بـ "a" أو الموجودة في قائمة النساء نعتبرها Female
            $femaleNames = ['Mona', 'Laila', 'Huda', 'Sara', 'Rana'];
            $gender = in_array($firstName, $femaleNames) ? 'Female ' : 'Male';

            Employee::create([
                'first_name'  => $firstName,
                'last_name'   => $lastName,
                'gender'      => $gender,
                'phone'       => '05' . (500000000 + $user->id), // توليد رقم هاتف شبه حقيقي
                'address'     => 'City Center, Street ' . ($index + 1),
                'notional_id' => 'NID' . (100000 + $user->id), // رقم وطني فريد لكل موظف
                'salary'      => 1200.00 + ($index * 50), // رواتب متدرجة بسيطة
                'birth_date'  => '1990-05-15',
                'status'      => 'active',
                'user_id'     => $user->id, // الربط مع جدول المستخدمين
                'hire_data'   => now(),
                'job_title'   => $jobTitles[$index % count($jobTitles)], // توزيع الوظائف بالترتيب
            ]);
        }
    }
}