<?php

namespace App\Services;

use App\Models\Enrollment;
use App\Models\Semester;
use App\Models\Mark;
use Illuminate\Support\Facades\DB;

class AcademicProcessService
{
    /**
     * Calculate the average for a specific student enrollment in a specific semester.
     */
    public function calculateSemesterAverage(Enrollment $enrollment, Semester $semester): float
    {
        // Retrieve marks for this enrollment that belong to exams in the targeted semester
        $marks = Mark::where('enrollment_id', $enrollment->id)
            ->whereHas('exam', function ($query) use ($semester) {
                $query->where('semester_id', $semester->id);
            })->get();

        if ($marks->isEmpty()) {
            return 0.0;
        }

        $totalScore = $marks->sum('score');
        $totalMaxPossible = $marks->sum('max_mark');

        // Return percentage average
        return ($totalMaxPossible > 0) ? ($totalScore / $totalMaxPossible) * 100 : 0.0;
    }
    
    public function calculateYearlyAverage(Enrollment $enrollment)
    {
        $allMarks = $enrollment->marks()->with('exam.semester')->get();

        if ($allMarks->isEmpty()) {
            return 0;
        }

        $semesterAverages = $allMarks->groupBy('exam.semester_id')
            ->map(function ($marks) {
                return $marks->avg('score'); 
            });

        if ($semesterAverages->count() > 0) {
            return $semesterAverages->avg();
        }

        return 0;
    }

    /**
     * Finalize student results at the end of the second semester.
     * Calculates the year-end average and updates the enrollment status.
     */
    public function finalizeYearlyStatus(Enrollment $enrollment)
    {
        $semesters = Semester::where('academic_year_id', $enrollment->academic_year_id)->get();

        $sumOfAverages = 0;
        $semesterCount = 0;

        foreach ($semesters as $semester) {
            $average = $this->calculateSemesterAverage($enrollment, $semester);
            if ($average > 0) {
                $sumOfAverages += $average;
                $semesterCount++;
            }
        }

        $finalYearlyAverage = ($semesterCount > 0) ? ($sumOfAverages / $semesterCount) : 0;

        $newStatus = ($finalYearlyAverage >= 60) ? 'passed' : 'failed';

        $enrollment->update([
             'average' => $finalYearlyAverage,
            'status' => $newStatus
        ]);

        return $enrollment->refresh();
    }
}
