<?php

namespace App\Observers;

use App\Models\Semester;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class SemesterObserver
{
    public function updated(Semester $semester)
    {

        if ($semester->name === 'Second Semester' && $semester->is_active == false) {

            $academicYearId = $semester->academic_year_id;


            $enrollments = Enrollment::where('academic_year_id', $academicYearId)->get();

            foreach ($enrollments as $enrollment) {
                $this->calculateYearlyResult($enrollment);
            }
        }
    }

    private function calculateYearlyResult(Enrollment $enrollment)
    {

        $s1Average = DB::table('marks')
            ->join('exams', 'marks.exam_id', '=', 'exams.id')
            ->join('semesters', 'exams.semester_id', '=', 'semesters.id')
            ->where('marks.enrollment_id', $enrollment->id)
            ->where('semesters.name', 'First Semester')
            ->avg('marks.score');


        $s2Average = DB::table('marks')
            ->join('exams', 'marks.exam_id', '=', 'exams.id')
            ->join('semesters', 'exams.semester_id', '=', 'semesters.id')
            ->where('marks.enrollment_id', $enrollment->id)
            ->where('semesters.name', 'Second Semester')
            ->avg('marks.score');


        $finalAverage = ($s1Average + $s2Average) / 2;

        $status = ($finalAverage >= 60) ? 'passed' : 'failed';

        $enrollment->update([
            'average' => $finalAverage,
            'status' => $status
        ]);
    }
}
