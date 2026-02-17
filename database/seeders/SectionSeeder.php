<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('sections')->truncate();

        // 1. جلب الصفوف والعام الدراسي الحالي
        $grades = Grade::all();
        // نفترض وجود عام دراسي رقمه 1 (مثل 2023-2024)
        $academicYearId = DB::table('academic_years')->first()->id ?? 1;

        // 2. إنشاء شعبتين لكل صف
        $sectionNames = ['Section A', 'Section B'];

        foreach ($grades as $grade) {
            foreach ($sectionNames as $name) {
                Section::create([
                    'name' => $name,
                    'grade_id' => $grade->id,
                    'academic_year_id' => $academicYearId,
                    'capacity' => 30, // سعة الفصل الافتراضية
                ]);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}