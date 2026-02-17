<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->gender(),
            'date_of_birth' => $this->faker->date('Y-m-d', '2008-01-01'), // تغيير حسب عمر الطلاب
            'place_of_birth' => $this->faker->city(),
            'nationality' => $this->faker->country(),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'mother_name' => $this->faker->name('female'),
            'mother_phone_number' => $this->faker->phoneNumber(),
            'mother_email' => $this->faker->optional()->safeEmail(),
            'father_name' => $this->faker->name('male'),
            'father_phone_number' => $this->faker->phoneNumber(),
            'father_email' => $this->faker->optional()->safeEmail(),
            'blood_group' => $this->faker->optional()->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            
        ];
    }
}
