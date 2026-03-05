<?php

namespace Database\Factories;
use App\Models\Section;
use App\Models\Grade;
use App\Models\AcademicYear;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
        protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Section ' . $this->faker->unique()->letter(), 
            'grade_id' => Grade::factory(), 
            'academic_year_id' => AcademicYear::factory(),
            'capacity' => $this->faker->numberBetween(20, 40),
        ];
    }
}
