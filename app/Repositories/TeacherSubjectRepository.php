<?php

namespace App\Repositories;

use App\Models\{TeacherSubject, Teacher, Subject, Section, AcademicYear};

class TeacherSubjectRepository
{
    public function getAllFormData()
    {
        return [
            'teachers'      => Teacher::with('employee')->get(),
            'subjects'      => Subject::all(),
            'sections'      => Section::all(),
        ];
    }

    public function getActiveYearId()
    {
        $activeYear = AcademicYear::where('is_active', true)->first();
        return $activeYear ? $activeYear->id : null;
    }

    public function create(array $data)
    {
        return TeacherSubject::create($data);
    }

    public function update(TeacherSubject $teacherSubject, array $data)
    {
        return $teacherSubject->update($data);
    }

    public function delete(TeacherSubject $teacherSubject)
    {
        return $teacherSubject->delete();
    }
}
