<?php

namespace Database\Factories;

use App\Models\Enrollment;
use App\Models\User;
use App\Models\Section;
use App\Models\AcademicYear;
use App\Models\Track;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
        protected $model = Enrollment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'student_id' => User::factory(), // ينشئ مستخدم جديد (طالب)
            'section_id' => Section::factory(), // ينشئ قسم جديد
            'academic_year_id' => AcademicYear::factory(), // ينشئ سنة دراسية جديدة
            'track_id' => Track::factory(), // ينشئ مسار جديد
            'status' => $this->faker->randomElement(['enrolled', 'graduated', 'dropped']),
        ];
    }
}
