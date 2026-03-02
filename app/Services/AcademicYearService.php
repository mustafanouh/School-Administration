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

            if (!empty($data['is_active'])) {
                $this->repo->deactivateOthers();
            }
            \App\Models\Semester::query()->update(['is_active' => false]);
            $year = $this->repo->create($data);

            $year->semesters()->createMany([
                ['name' => 'First Semester', 'is_active' => true],
                ['name' => 'Second Semester', 'is_active' => false],
            ]);

            return $year;
        });
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
