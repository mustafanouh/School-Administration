<?php

namespace App\Repositories;

use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Mark;
use Illuminate\Pagination\LengthAwarePaginator;

class MarkRepository
{
    /**
     *  get paginated list of marks for active academic year and semester, with eager loading of related data
     */
    public function getActiveMarksPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return Mark::query()
            ->with([
                'enrollment.student',
                'exam.subject',
                'exam.semester'
            ])
            ->whereHas('enrollment.academicYear', fn($q) => $q->where('is_active', true))
            ->whereHas('exam.semester', fn($q) => $q->where('is_active', true))
            ->latest()
            ->paginate($perPage);
    }



    public function getActiveEnrollmentsForSelection()
    {
        return Enrollment::query()
            ->whereHas('academicYear', fn($q) => $q->where('is_active', true))
            ->with([
                'student:id,first_name,last_name',
                'section:id,name,grade_id',
                'section.grade:id,name'
            ])
            ->get(['id', 'student_id', 'section_id']);
    }

    public function getActiveExamsForSelection()
    {
        return Exam::query()
            ->whereHas('semester', fn($q) => $q->where('is_active', true))
            ->with(['subject:id,name'])
            ->get(['id', 'subject_id', 'exam_type', 'max_mark']);
    }

    public function create(array $data): Mark
    {
        return Mark::create($data);
    }
    public function delete(Mark $mark): bool
    {
        return $mark->delete();
    }
}
