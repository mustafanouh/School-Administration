<?php

namespace App\Repositories;

use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        return DB::transaction(function () use ($data) {

            $year = date('Y');
            $baseEmail = Str::lower($data['first_name'] . '.' . $data['last_name'] . $year);
            $email = $baseEmail . '@school.com';

            $count = User::where('email', 'LIKE', $baseEmail . '%')->count();
            if ($count > 0) {
                $email = $baseEmail . $count . '@school.com';
            }

            $user = User::create([
                'name'     => $data['first_name'] . ' ' . $data['last_name'],
                'email'    => $email,
                'password' => Hash::make($data['phone_number']),
            ]);

            $user->assignRole('student');

            $data['user_id'] = $user->id;
            
            $photoFile = $data['photo'] ?? null;
            unset($data['photo']);
            $student = Student::create($data);
            // instanceof \Illuminate\Http\UploadedFile  للتاكد من انه ملف 
            if ($photoFile && $photoFile instanceof UploadedFile) {
                $student->addMedia($photoFile)
                    ->toMediaCollection('student_profile_photos');
            }

            return $student;
        });
    }

    public function update(Student $student, array $data)
    {

        $data['user_id'] = $student->user_id;
        return $student->update($data);
    }

    public function delete(Student $student)
    {
        return $student->delete();
    }
}
