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

        // جلب الصفوف من قاعدة البيانات لضمان دقة الـ IDs
        $grades = Grade::all()->keyBy('name');

        // تعريف المسارات (افترضنا أن IDs المسارات هي: 1 للعالم، 2 للعلمي، 3 للأدبي)
        $tracks = ['general' => 1, 'scientific' => 2, 'literary' => 3];

        // 1. المواد الأساسية لجميع الصفوف (1-12)
        $basicSubjects = ['Math', 'English', 'French', 'Arabic', 'Art', 'Music'];

        foreach ($grades as $gradeName => $grade) {
            foreach ($basicSubjects as $subName) {
                // استثناء الرياضيات للعاشر والحادي عشر والثاني عشر أدبي (سيتم إضافتها لاحقاً للعلمي فقط)
                if ($subName == 'Math' && $grade->stage_id == 3) continue;

                $this->createSubjectPair($subName, $grade->id, $grade->stage_id);
            }
        }

        // 2. مواد الابتدائي (1-6) - عام
        for ($i = 1; $i <= 6; $i++) {
            $grade = Grade::where('name', $this->getGradeName($i))->first();
            if ($grade) {
                $this->createSubjectPair('General Science', $grade->id, 1);
                $this->createSubjectPair('Geography', $grade->id, 1);
            }
        }

        // 3. مواد الإعدادي (7-9) - عام
        for ($i = 7; $i <= 9; $i++) {
            $grade = Grade::where('name', $this->getGradeName($i))->first();
            if ($grade) {
                foreach (['Science', 'Physics', 'Chemistry', 'National Education', 'History', 'Geography'] as $sub) {
                    $this->createSubjectPair($sub, $grade->id, 1);
                }
            }
        }

        // 4. مواد الثانوي (10-12) - علمي وأدبي
        for ($i = 10; $i <= 12; $i++) {
            $grade = Grade::where('name', $this->getGradeName($i))->first();
            if ($grade) {
                // مواد العلمي (Track 2)
                foreach (['Math', 'Physics', 'Chemistry'] as $sub) {
                    $this->createSubjectPair($sub, $grade->id, 2);
                }
                // مواد الأدبي (Track 3)
                foreach (['Geography', 'History', 'National Education'] as $sub) {
                    $this->createSubjectPair($sub, $grade->id, 3);
                }
            }
        }
    }

    // دالة مساعدة لإنشاء المادة للفصلين الأول والثاني
    private function createSubjectPair($name, $gradeId, $trackId)
    {
        $semesters = ['Semester 1', 'Semester 2'];
        foreach ($semesters as $sem) {
            Subject::create([
                'name' => "$name - $sem",
                'track_id' => $trackId,
                'grade_id' => $gradeId,
                'min_mark' => 50,
                'max_mark' => 100,
            ]);
        }
    }

    // دالة مساعدة لجلب اسم الصف بناءً على الرقم (يجب أن يطابق الأسماء في GradeSeeder)
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
