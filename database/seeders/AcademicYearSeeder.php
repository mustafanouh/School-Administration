<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear; 

class AcademicYearSeeder extends Seeder
{
    
    public function run(): void
    {
        $years = [
            
            ['name' => '2025/2026', 'is_active' => true],
        ];

        foreach ($years as $year) {
            AcademicYear::create($year);
        }
    }
}