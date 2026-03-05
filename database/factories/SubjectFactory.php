<?php

namespace Database\Factories;
use App\Models\Subject;
use App\Models\Track;
use App\Models\Grade;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
        protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minMark = $this->faker->numberBetween(0, 50);
        $maxMark = $this->faker->numberBetween($minMark + 1, 100);

        return [
             'name' => $this->faker->word(),
            'track_id' => Track::factory(),
            'grade_id' => Grade::factory(), 
            'min_mark' => $minMark,
            'max_mark' => $maxMark,
        ];
    }
}
