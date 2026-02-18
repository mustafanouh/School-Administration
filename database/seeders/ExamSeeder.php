<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Subject;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        // جلب عينات من الجداول المرتبطة لضمان عمل الـ Foreign Keys
        $subject = Subject::first();
        $semester = Semester::first();

        if (!$subject || !$semester) {
            $this->command->error("Subjects or Semesters table is empty. Please seed them first!");
            return;
        }

        $exams = [
            [
                'subject_id'  => $subject->id,
                'semester_id' => $semester->id,
                'exam_type'   => 'Midterm',
                'max_mark'    => 20.0,
            ],
            [
                'subject_id'  => $subject->id,
                'semester_id' => $semester->id,
                'exam_type'   => 'Final Exam',
                'max_mark'    => 80.0,
            ],
            [
                'subject_id'  => $subject->id,
                'semester_id' => $semester->id,
                'exam_type'   => 'Practical',
                'max_mark'    => 50.0,
            ],
        ];

        foreach ($exams as $exam) {
            // استخدام updateOrCreate بناءً على نوع الامتحان والمادة لضمان عدم التكرار
            Exam::updateOrCreate(
                [
                    'subject_id' => $exam['subject_id'],
                    'semester_id' => $exam['semester_id'],
                    'exam_type' => $exam['exam_type']
                ],
                ['max_mark' => $exam['max_mark']]
            );
        }
    }
}
