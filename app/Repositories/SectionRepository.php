<?php

namespace App\Repositories;

use App\Models\Section;
use App\Models\AcademicYear;

class SectionRepository
{
    public function getActiveSections()
    {
        return Section::whereHas('academicYear', function ($query) {
            $query->where('is_active', true);
        })->with('grade')->get();
    }

    public function getSectionWithActiveStudents($sectionId, $activeYearId)
    {
        return Section::with([
            'enrollments' => function ($query) use ($activeYearId) {
                $query->where('academic_year_id', $activeYearId)->with('student');
            }
        ])->findOrFail($sectionId);
    }

    public function create(array $data)
    {
        return Section::create($data);
    }
    public function update(Section $section, array $data)
    {
        return $section->update($data);
    }
    public function delete(Section $section)
    {
        return $section->delete();
    }
}
