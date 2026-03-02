<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use App\Models\Student;

class StudentService
{
    protected $repo;

    public function __construct(StudentRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAllStudents()
    {
        return $this->repo->paginate(10);
    }

    public function getStudentProfile(Student $student)
    {
        return $this->repo->findWithFullDetails($student);
    }

    public function registerStudent(array $data)
    {

        return $this->repo->create($data);
    }

    public function updateStudent(Student $student, array $data)
    {
        return $this->repo->update($student, $data);
    }

   
    public function deleteStudent(Student $student)
    {
       
        if ($student->enrollments()->exists()) {
            throw new \Exception('Cannot delete this student because they have active or past enrollments.');
        }

        try {
            return $this->repo->delete($student);
        } catch (\Exception $e) {
            throw new \Exception('A database error occurred while deleting the student.');
        }
    }
}
