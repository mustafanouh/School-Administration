<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            
            // تخصيص الأسماء بناءً على الجنس لبيانات أكثر واقعية
            $firstName = ($gender == 'male') ? $faker->firstNameMale() : $faker->firstNameFemale();

            Student::create([
                'first_name'          => $firstName,
                'last_name'           => $faker->lastName(),
                'gender'              => $gender,
                'date_of_birth'       => $faker->date('Y-m-d', '-6 years'), // طلاب أعمارهم فوق 6 سنوات
                'place_of_birth'      => $faker->city(),
                'nationality'         => $faker->country(),
                'address'             => $faker->address(),
                'phone_number'        => $faker->phoneNumber(),
                'mother_name'         => $faker->name('female'),
                'mother_phone_number' => $faker->phoneNumber(),
                'mother_email'        => $faker->safeEmail(),
                'father_name'         => $faker->name('male'),
                'father_phone_number' => $faker->phoneNumber(),
                'father_email'        => $faker->safeEmail(),
                'blood_group'         => $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            ]);
        }
    }
}