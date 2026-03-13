<?php

namespace App\Services;

use App\Models\Semester;
use App\Models\Enrollment;
use App\Jobs\ProcessStudentGradesJob;
use Illuminate\Support\Facades\DB;

class SemesterService
{
   
    public function updateSemester(Semester $semester, array $data): Semester
    {
        return DB::transaction(function () use ($semester, $data) {
            $isActive = $data['is_active'] ?? false;
            $previouslyActiveSemester = null;

            if ($isActive) {
             
                $previouslyActiveSemester = Semester::where('is_active', true)
                    ->where('id', '!=', $semester->id)
                    ->first();

                if ($previouslyActiveSemester) {
                    $previouslyActiveSemester->update(['is_active' => false]);
                    $this->dispatchReportJobs($previouslyActiveSemester);
                }
            }

          
            $semester->update($data);

         
            if ($semester->wasChanged('is_active') && !$semester->is_active) {
                $this->dispatchReportJobs($semester);
            }

            return $semester;
        });
    }

    
    public function dispatchReportJobs(Semester $semester): void
    {
        Enrollment::where('academic_year_id', $semester->academic_year_id)
            ->whereIn('status', ['enrolled', 'failed'])
            ->chunk(100, function ($enrollments) use ($semester) {
                foreach ($enrollments as $enrollment) {
                    ProcessStudentGradesJob::dispatch($enrollment, $semester);
                }
            });
    }
}
