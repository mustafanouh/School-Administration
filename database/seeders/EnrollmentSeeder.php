<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Section;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        // 1. جلب كافة الطلاب والشعب
        $students = Student::all();
        $sections = Section::all();

        if ($students->isEmpty() || $sections->isEmpty()) {
            $this->command->warn("Ensure you have students and sections before seeding enrollments.");
            return;
        }

        // نقوم بعمل "خلط" عشوائي للطلاب لتوزيعهم
        $shuffledStudents = $students->shuffle();
        $studentIndex = 0;

        // 2. توزيع الطلاب على الشعب بناءً على سعة كل شعبة
        foreach ($sections as $section) {

            // نحدد عدد الطلاب الذين سنضيفهم لهذه الشعبة (عشوائياً بين 5 وسعة الشعبة)
            $fillCount = rand(5, $section->capacity);

            for ($i = 0; $i < $fillCount; $i++) {

                if (isset($shuffledStudents[$studentIndex])) {

                    $student = $shuffledStudents[$studentIndex];

                    Enrollment::create([
                        'student_id'       => $student->id,
                        'section_id'       => $section->id,
                        'academic_year_id' => $section->academic_year_id,
                        'track_id'         => $section->grade->track_id ?? 1, // تأكد من وجود track_id إذا كان مطلوباً
                        'enrollment_date'  => now()->subMonths(rand(1, 5)),
                        'status'           => 'enrolled', // تم التغيير من active إلى enrolled
                    ]);

                    $studentIndex++;
                }
            }
        }

        $this->command->info("Successfully enrolled " . $studentIndex . " students across sections.");
    }
}
