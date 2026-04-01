<?php

namespace App\Services;

use App\Repositories\TeacherSubjectRepository;
use App\Models\TeacherSubject;

class TeacherSubjectService
{
    protected $repo;

    public function __construct(TeacherSubjectRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getCreateData($requestData)
    {
        $data = $this->repo->getAllFormData();
        
        $selectedYearId = $requestData['academic_year_id'] ?? null;
        $data['targetYearId'] = $selectedYearId ?? $this->repo->getActiveYearId();
        $data['selectedSectionId'] = $requestData['section_id'] ?? null;

        return $data;
    }

    public function getEditData(TeacherSubject $teacherSubject)
    {
        $data = $this->repo->getAllFormData();
        $data['teacherSubject'] = $teacherSubject;
        return $data;
    }

    public function assignTeacher(array $data)
    {
       
        return $this->repo->create($data);
    }

    public function updateAssignment(TeacherSubject $teacherSubject, array $data)
    {
        return $this->repo->update($teacherSubject, $data);
    }

    public function removeAssignment(TeacherSubject $teacherSubject)
    {
        return $this->repo->delete($teacherSubject);
    }
}
