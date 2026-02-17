<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        // جلب كل السنوات الدراسية لإنشاء فصول لكل منها
        $academicYears = AcademicYear::all();

        if ($academicYears->isEmpty()) {
            $this->command->error("No Academic Years found. Please seed AcademicYearSeeder first!");
            return;
        }

        foreach ($academicYears as $year) {
            // إنشاء الفصل الأول
            Semester::create([
                'academic_year_id' => $year->id,
                'name' => 'First Semester',
            ]);

            // إنشاء الفصل الثاني
            Semester::create([
                'academic_year_id' => $year->id,
                'name' => 'Second Semester',
            ]);
        }

        $this->command->info("Semesters (First & Second) created for each academic year.");
    }
}
