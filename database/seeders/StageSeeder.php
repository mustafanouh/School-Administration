<?php

namespace Database\Seeders;

use App\Models\Stage;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    public function run(): void
    {
      
        $semester = Semester::first();

        if (!$semester) {
            $this->command->error("Please seed Semesters first!");
            return;
        }

        $stages = [
            ['name' => 'Primary', 'semester_id' => $semester->id],
            ['name' => 'Middle',  'semester_id' => $semester->id],
            ['name' => 'High',    'semester_id' => $semester->id],
        ];

        foreach ($stages as $stage) {
            Stage::create($stage);
        }

        $this->command->info("Stages (Primary, Middle, High) seeded successfully!");
    }
}