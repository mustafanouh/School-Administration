<?php

namespace App\Services;

use App\Repositories\SectionRepository;
use App\Models\{Grade, AcademicYear, Section};
use Exception;

class SectionService
{
    protected $repo;

    public function __construct(SectionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getSectionsForIndex()
    {
        return $this->repo->getActiveSections();
    }

    public function getSectionDetails($sectionId)
    {
        $activeYear = AcademicYear::where('is_active', true)->first();
        if (!$activeYear) {
            throw new Exception('Please activate an academic year first.');
        }

        return $this->repo->getSectionWithActiveStudents($sectionId, $activeYear->id);
    }

    public function getFormData()
    {
        return [
            'grades' => Grade::all(),
            'academicYears' => AcademicYear::all(),
        ];
    }

    public function storeSection(array $data)
    {
        return $this->repo->create($data);
    }

    public function updateSection(Section $section, array $data)
    {
        return $this->repo->update($section, $data);
    }

    public function deleteSection(Section $section)
    {
        
        if ($section->enrollments()->exists()) {
            throw new Exception('Cannot delete section because it has enrolled students.');
        }
        return $this->repo->delete($section);
    }
}
