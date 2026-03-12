<?php

namespace App\Services;

use App\Repositories\AcademicYearRepository;
use Illuminate\Support\Facades\DB;
use Exception;

class AcademicYearService
{
    protected $repo;

    public function __construct(AcademicYearRepository $repo)
    {
        $this->repo = $repo;
    }


    public function storeYearWithSemesters(array $data)
    {
        return DB::transaction(function () use ($data) {
            $previouslyActiveYear = null;
// if the new year is set to active, we need to deactivate the currently active year and its semesters, then generate final reports for that year
            if (!empty($data['is_active'])) {
                $previouslyActiveYear = \App\Models\AcademicYear::where('is_active', true)->first();
                $this->repo->deactivateOthers();
            }

             
            \App\Models\Semester::query()->update(['is_active' => false]);

          
            $year = $this->repo->create($data);
            $year->semesters()->createMany([
                ['name' => 'First Semester', 'is_active' => true],
                ['name' => 'Second Semester', 'is_active' => false],
            ]);

           
            if ($previouslyActiveYear) {
                $this->generateFinalYearReports($previouslyActiveYear);
            }

            return $year;
        });
    }

   
    private function generateFinalYearReports($academicYear)
    {
        $finalSemester = $academicYear->semesters()->where('name', 'Second Semester')->first();

        if ($finalSemester) {
            $enrollments = \App\Models\Enrollment::where('academic_year_id', $academicYear->id)->get();

            foreach ($enrollments as $enrollment) {
                \App\Jobs\ProcessStudentGradesJob::dispatchSync($enrollment, $finalSemester);
            }
        }
    }

    public function updateYear($academicYear, array $data)
    {
        return DB::transaction(function () use ($academicYear, $data) {
            if (!empty($data['is_active'])) {
                $this->repo->deactivateOthers($academicYear->id);
            }
            return $academicYear->update($data);
        });
    }

    public function deleteYear($academicYear)
    {
        if ($academicYear->enrollments()->exists()) {
            throw new Exception('Cannot delete year because it has active enrollments.');
        }
        return $this->repo->delete($academicYear);
    }
}
