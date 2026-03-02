<?php
namespace App\Repositories;

use App\Models\AcademicYear;

class AcademicYearRepository
{
    public function paginate($perPage = 10)
    {
        return AcademicYear::paginate($perPage);
    }

    public function create(array $data)
    {
        return AcademicYear::create($data);
    }

    public function deactivateOthers($exceptId = null)
    {
        $query = AcademicYear::query();
        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }
        return $query->update(['is_active' => false]);
    }

    public function delete(AcademicYear $year)
    {
        return $year->delete();
    }
}