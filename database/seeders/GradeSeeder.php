<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        // تنظيف الجدول قبل البدء
        DB::table('grades')->delete();

        $gradeNames = [
            'First Grade', 'Second Grade', 'Third Grade', 
            'Fourth Grade', 'Fifth Grade', 'Sixth Grade', // من 1 إلى 6 -> stage 1
            'Seventh Grade', 'Eighth Grade', 'Ninth Grade', // من 7 إلى 9 -> stage 2
            'Tenth Grade', 'Eleventh Grade', 'Twelfth Grade' // من 10 إلى 12 -> stage 3
        ];

        $createdGrades = [];

        // المرحلة الأولى: إنشاء الصفوف وتوزيع الـ stage_id
        foreach ($gradeNames as $index => $name) {
            $currentOrder = $index + 1; // الترتيب الفعلي (1, 2, 3...)

            // تحديد stage_id بناءً على الترتيب
            if ($currentOrder <= 6) {
                $stageId = 1;
            } elseif ($currentOrder <= 9) {
                $stageId = 2;
            } else {
                $stageId = 3;
            }

            $createdGrades[] = Grade::create([
                'name' => $name,
                'stage_id' => $stageId,
                'Next_Grade_id' => null,
            ]);
        }

        // المرحلة الثانية: ربط كل صف بالصف الذي يليه (Self-join)
        for ($i = 0; $i < count($createdGrades) - 1; $i++) {
            $createdGrades[$i]->update([
                'Next_Grade_id' => $createdGrades[$i + 1]->id
            ]);
        }
    }
}