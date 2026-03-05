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
             'student_id' => User::factory(), 
            'section_id' => Section::factory(), 
            'academic_year_id' => AcademicYear::factory(), 
            'track_id' => Track::factory(),
            'status' => $this->faker->randomElement(['enrolled', 'graduated', 'dropped']),
        ];
    }
}
