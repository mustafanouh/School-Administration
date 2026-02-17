<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إيقاف القيود ومسح الجدول للبدء من جديد
        Schema::disableForeignKeyConstraints();
        DB::table('teachers')->truncate();

        // 2. جلب الموظفين الذين تم تحديد وظيفتهم كمدرسين في الـ EmployeeSeeder
        $employeeTeachers = Employee::where('job_title', 'Teacher')->get();

        // 3. مصفوفة تخصصات لتوزيعها بشكل عشوائي أو دوري
        $specializations = [
            'Mathematics', 
            'English Language', 
            'Arabic Language', 
            'Physics', 
            'Chemistry', 
            'History'
        ];

        foreach ($employeeTeachers as $index => $employee) {
            Teacher::create([
                'employee_id'    => $employee->id,
                // توزيع التخصصات بناءً على ترتيب الموظف
                'specialization' => $specializations[$index % count($specializations)],
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}