<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Track; // تأكد من وجود الموديل Track

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tracks = [
            ['name' => 'Scientific'],
            ['name' => 'Literature'],
            ['name' => 'General'],
        ];

        foreach ($tracks as $track) {
            Track::create($track);
        }
    }
}