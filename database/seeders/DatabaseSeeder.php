<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Section;
use App\Models\Enrollment;
use App\Models\AcademicYear;
use App\Models\Track;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(RolesAndPermissionsSeeder::class);

     // 1️⃣ إنشاء معلمين
        $teachers = Teacher::factory(5)->create();

        // 2️⃣ إنشاء مواد (كل مادة مرتبط بمعلم عشوائي)
        Subject::factory(5)->create();

        // 3️⃣ إنشاء سنة دراسية
        $academicYear = AcademicYear::factory()->create([
            'name' => '2023-2024',
        ]);

        // 4️⃣ إنشاء مسارات (Tracks)
        $tracks = Track::factory(3)->create();

        // 5️⃣ إنشاء الشعب
        $sections = Section::factory(3)->create([
            'academic_year_id' => $academicYear->id,
        ]);

        // 6️⃣ إنشاء طلاب
        $students = User::factory(50)->create([
            'role' => 'student', // إذا كان لديك عمود role في users
        ]);

        // 7️⃣ تسجيل الطلاب في الشعب (مع التحقق من capacity)
        foreach ($students as $student) {
            // اختيار شعبة ومسار عشوائي
            $section = $sections->random();
            $track = $tracks->random();

            // عدد الطلاب الحالي في الشعبة
            $enrollmentCount = Enrollment::where('section_id', $section->id)
                ->where('academic_year_id', $academicYear->id)
                ->count();

            if ($enrollmentCount < $section->capacity) {
                Enrollment::create([
                    'student_id' => $student->id,
                    'section_id' => $section->id,
                    'academic_year_id' => $academicYear->id,
                    'track_id' => $track->id,
                    'status' => 'enrolled',
                ]);
            }
        }
    }
}
