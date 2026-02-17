<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear; // تأكد من استيراد الموديل الصحيح

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = [
            ['name' => '2023/2024', 'is_active' => false],
            ['name' => '2024/2025', 'is_active' => false],
            ['name' => '2025/2026', 'is_active' => true],
        ];

        foreach ($years as $year) {
            AcademicYear::create($year);
        }
    }
}