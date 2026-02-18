<?php

namespace Database\Seeders;

use App\Models\Mark;
use App\Models\Exam;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class MarkSeeder extends Seeder
{
    public function run(): void
    {
        $enrollments = Enrollment::all();
        $exams = Exam::all();

        if ($enrollments->isEmpty() || $exams->isEmpty()) {
            $this->command->warn("Please seed Enrollments and Exams first!");
            return;
        }

        foreach ($enrollments as $enrollment) {
            // سنعطي كل طالب درجة في امتحانين عشوائيين على الأقل
            $randomExams = $exams->random(rand(1, 2));

            foreach ($randomExams as $exam) {
                // توليد درجة عشوائية بين 0 والدرجة العظمى للامتحان
                $score = fake()->randomFloat(1, 0, $exam->max_mark);

                // تحديد الحالة تلقائياً: ناجح إذا حصل على 50% أو أكثر
                $status = ($score >= ($exam->max_mark / 2)) ? 'passed' : 'failed';

                Mark::updateOrCreate(
                    [
                        'enrollment_id' => $enrollment->id,
                        'exam_id'       => $exam->id,
                    ],
                    [
                        'score'    => $score,
                        'max_mark' => $exam->max_mark, // ننسخها من جدول الامتحانات للتوثيق
                        'status'   => $status,
                    ]
                );
            }
        }
    }
}
