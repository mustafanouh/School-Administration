<?php

namespace Database\Factories;
use App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'employee_id' => Employee::factory(),
          'speciality' => $this->faker->randomElement(['الرياضيات', 'العلوم', 'العربية', 'الإنجليزية','دراسات الاجتماعية']),
 // تخصص عشوائي
    
        ];
    }
}
