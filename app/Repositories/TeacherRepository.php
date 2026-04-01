<?php

namespace App\Repositories;

use App\Models\Teacher;

class TeacherRepository
{
    public function getAllTeachers()
    {
        return   Teacher::with('employee')->paginate(10);
    }




    public function getTeacherForEdit(Teacher $teacher): Teacher
    {

        return $teacher->load(['employee' => function ($query) {
            $query->select('id', 'first_name', 'last_name');
        }]);
    }

    public function create(array $data): Teacher
    {
        $teacher = Teacher::create($data);
        return $teacher->load('employee.user');
    }
    public function update(Teacher $teacher, array $data): Teacher
    {
        $teacher->update($data);
        return $teacher->load('employee.user');
    }

    public function destroy(Teacher $teacher): void
    {
        $teacher->delete();
    }
}
