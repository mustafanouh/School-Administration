<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('subjects')->delete();

   
        $grades = Grade::all()->keyBy('name');

      
        $tracks = ['general' => 1, 'scientific' => 2, 'literary' => 3];

      
        $basicSubjects = ['Math', 'English', 'French', 'Arabic', 'Art', 'Music'];

        foreach ($grades as $gradeName => $grade) {
            foreach ($basicSubjects as $subName) {
             
                if ($subName == 'Math' && $grade->stage_id == 3) continue;

                $this->createSubjectPair($subName, $grade->id, $grade->stage_id);
            }
        }


        for ($i = 1; $i <= 6; $i++) {
            $grade = Grade::where('name', $this->getGradeName($i))->first();
            if ($grade) {
                $this->createSubjectPair('General Science', $grade->id, 1);
                $this->createSubjectPair('Geography', $grade->id, 1);
            }
        }

       
        for ($i = 7; $i <= 9; $i++) {
            $grade = Grade::where('name', $this->getGradeName($i))->first();
            if ($grade) {
                foreach (['Science', 'Physics', 'Chemistry', 'National Education', 'History', 'Geography'] as $sub) {
                    $this->createSubjectPair($sub, $grade->id, 1);
                }
            }
        }

        for ($i = 10; $i <= 12; $i++) {
            $grade = Grade::where('name', $this->getGradeName($i))->first();
            if ($grade) {
            
                foreach (['Math', 'Physics', 'Chemistry'] as $sub) {
                    $this->createSubjectPair($sub, $grade->id, 2);
                }
               
                foreach (['Geography', 'History', 'National Education'] as $sub) {
                    $this->createSubjectPair($sub, $grade->id, 3);
                }
            }
        }
    }

  
    private function createSubjectPair($name, $gradeId, $trackId)
    {
        $semesters = ['First Semester', 'Second Semester'];
        foreach ($semesters as $sem) {
            Subject::create([
                'name' => "$name - $sem",
                'semester' => $sem,
                'track_id' => $trackId,
                'grade_id' => $gradeId,
                'min_mark' => 50,
                'max_mark' => 100,
            ]);
        }
    }

    private function getGradeName($number)
    {
        $map = [
            1 => 'First Grade',
            2 => 'Second Grade',
            3 => 'Third Grade',
            4 => 'Fourth Grade',
            5 => 'Fifth Grade',
            6 => 'Sixth Grade',
            7 => 'Seventh Grade',
            8 => 'Eighth Grade',
            9 => 'Ninth Grade',
            10 => 'Tenth Grade',
            11 => 'Eleventh Grade',
            12 => 'Twelfth Grade'
        ];
        return $map[$number];
    }
}
