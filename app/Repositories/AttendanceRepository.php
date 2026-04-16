<?php

namespace App\Repositories;

use App\Models\Section;
use App\Models\StudentAttendance;

class AttendanceRepository
{

    public function getSectionsWithAttendanceStatus($date)
    {
        return  Section::withCount('enrollments')
            ->withExists(['attendances as isAttendanceTaken' => function ($query) use ($date) {
                $query->whereDate('attendance_date', $date);
            }])
            ->whereHas('academicYear', function ($query) {
                $query->where('is_active', true);
            })
            ->with('grade')
            ->get();
    }

    public function getSectionWithAttendance($sectionId, $date)
    {
        return Section::with([
            'enrollments.student.media',
            'enrollments.student.attendances' => function ($query) use ($date) {
                $query->whereDate('attendance_date', $date);
            }
        ])->findOrFail($sectionId);
    }

    public function isAttendanceTaken($sectionId, $date)
    {
        return StudentAttendance::where('section_id', $sectionId)
            ->whereDate('attendance_date', $date)
            ->exists();
    }
}
