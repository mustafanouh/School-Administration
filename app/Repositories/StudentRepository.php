<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    public function paginate($perPage = 10)
    {
        return Student::latest()->paginate($perPage);
    }

    public function findWithFullDetails(Student $student)
    {
       
        return $student->load([
            'enrollments' => function ($query) {
                $query->orderBy('academic_year_id', 'desc');
            },
            'enrollments.academicYear',
            'enrollments.section.grade',
            'enrollments.marks.exam.subject'
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
