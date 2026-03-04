<?php

namespace App\Repositories;

use App\Models\{Enrollment, AcademicYear, Section, Student, Track, Grade};

class EnrollmentRepository
{
    public function getAllPaginated($perPage = 10)
    {
        return Enrollment::with(['student', 'section.grade', 'academicYear', 'track', 'marks.exam'])
            ->whereHas('academicYear', function ($query) {
                $query->where('is_active', true);
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getActiveYear()
    {
        return AcademicYear::where('is_active', true)->first();
    }

    public function getSectionsGroupedByGrade($yearId)
    {
        return Section::where('academic_year_id', $yearId)
            ->with('grade')
            ->get()
            ->groupBy(fn($item) => $item->grade->name);
    }

    public function getStudentsNotEnrolledInYear($yearId)
    {
        return Student::whereDoesntHave('enrollments', function ($query) use ($yearId) {
            $query->where('academic_year_id', $yearId);
        })->get();
    }


    public function create(array $data)
    {
        return Enrollment::create($data);
    }
    public function update($enrollment, array $data)
    {
        return $enrollment->update($data);
    }
    public function delete($enrollment)
    {
        return $enrollment->delete();
    }
}
