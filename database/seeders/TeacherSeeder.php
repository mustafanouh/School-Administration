<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
    
        Schema::disableForeignKeyConstraints();
        DB::table('teachers')->truncate();

       
        $employeeTeachers = Employee::where('job_title', 'Teacher')->get();

    
        $specializations = [
            'Mathematics', 
            'English Language', 
            'Arabic Language', 
            'Physics', 
            'Chemistry', 
            'History'
        ];
        $stages = ['Primary', 'Middle', 'High'];

        foreach ($employeeTeachers as $index => $employee) {
            Teacher::create([
                'employee_id'    => $employee->id,
                'specialization' => $specializations[$index % count($specializations)],
                'stage'           => $stages[$index % count($stages)],
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}