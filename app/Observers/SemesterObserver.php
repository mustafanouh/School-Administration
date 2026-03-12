<?php
namespace App\Observers;

use App\Models\Semester;
use App\Models\Enrollment;
use App\Jobs\ProcessStudentGradesJob;

class SemesterObserver
{
    /**
     * Handle the Semester "updated" event.
     */
    public function updated(Semester $semester)
    {
        // Detect if the semester was deactivated (end of semester)
        if ($semester->wasChanged('is_active') && !$semester->is_active) {
            
            // Process all students enrolled in this academic year
            Enrollment::where('academic_year_id', $semester->academic_year_id)
                ->whereIn('status', ['enrolled', 'failed']) // Process only active or re-evaluating students
                ->chunk(100, function ($enrollments) use ($semester) {
                    foreach ($enrollments as $enrollment) {
                        ProcessStudentGradesJob::dispatch($enrollment, $semester);
                    }
                });
        }
    }
}
