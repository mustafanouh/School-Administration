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
        $this->call([
            // الأساسيات (التي لا تعتمد على غيرها)
            RolesAndPermissionsSeeder::class,
            AcademicYearSeeder::class,
            SemesterSeeder::class,
            StageSeeder::class,
            TrackSeeder::class,
            GradeSeeder::class,

            // 2. الكيانات البشرية الأساسية (Users)
            UserSeeder::class,

      
            SubjectSeeder::class,
            EmployeeSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,

            // 4. الهيكل التنظيمي (الربط بين الصفوف والمدرسين والسنوات)
            SectionSeeder::class,

            // 5. العمليات (لب المشروع - الربط النهائي)
            EnrollmentSeeder::class,
            ExamSeeder::class,
            MarkSeeder::class,
        ]);
    }
}
