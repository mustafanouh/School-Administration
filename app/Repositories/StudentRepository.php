<?php

namespace App\Repositories;

use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\Student;

class StudentRepository
{
    public function paginate($perPage = 10)
    {
        return Student::latest()->paginate($perPage);
    }

    // public function findWithFullDetails(Student $student)
    // {

    //     return $student->load([
    //         'enrollments' => function ($query) {
    //             $query->orderBy('academic_year_id', 'desc');

    //         },
    //         'enrollments.academicYear',
    //         'enrollments.section.grade',
    //         'enrollments.marks.exam.subject'
    //     ]);
    // }


    public function findWithFullDetails(Student $student)
{
    $yearId = AcademicYear::where('is_active', true)->value('id');
    $semesterName = Semester::where('is_active', true)->value('name');

    return $student->load([
        'enrollments' => function ($query) {
            $query->orderBy('academic_year_id', 'desc');
        },
        'enrollments.academicYear',
        'enrollments.section.grade',
        'enrollments.marks.exam.subject',
    
        'enrollments.attendances' => function ($query) use ($yearId, $semesterName) {
            $query
            ->whereHas('enrollment.academicYear', function ($q) use ($yearId) {
                if ($yearId) $q->where('id', $yearId);
            })
            ->whereHas('enrollment.academicYear.semesters', function ($q) use ($semesterName) {
                if ($semesterName) $q->where('name', $semesterName);
            });
        }
    ]);
}


    public function create(array $data)
    {
        return Student::create($data);
    }

    public function update(Student $student, array $data)
    {
        return $student->update($data);
    }

    public function delete(Student $student)
    {
        return $student->delete();
    }
}
