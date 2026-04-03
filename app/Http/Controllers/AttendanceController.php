<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Models\StaffAttendance;
use App\Models\Section;
use App\Models\Employee;
use App\Models\Enrollment;
use App\Models\Semester;
use App\Notifications\RealTimeNotification;

class AttendanceController extends Controller
{


  
    public function index()
    {
        $date = now()->format('Y-m-d');

        $sections = Section::withCount('enrollments')
            ->withExists(['attendances as isAttendanceTaken' => function ($query) use ($date) {
                $query->whereDate('attendance_date', $date);
            }])
            ->whereHas('academicYear', function ($query) {
                $query->where('is_active', true);
            })
            ->with('grade')
            ->get();

        return view('attendance.sections_index', compact('sections'));
    }

   
    public function showSectionAttendance($id)
    {
        $date = now()->format('Y-m-d');

        $section = Section::with(['enrollments.student.media',
            'enrollments.student.attendances' => function ($query) use ($date) {
                $query->whereDate('attendance_date', $date);
            }
        ])->findOrFail($id);

        $isAttendanceTaken = StudentAttendance::where('section_id', $id)
            ->whereDate('attendance_date', $date)
            ->exists();

        return view('attendance.students', compact('section', 'date', 'isAttendanceTaken'));
    }
    

    public function storeStudentAttendance(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $enrollmentId => $status) {
            StudentAttendance::updateOrCreate(
                [
                    'enrollment_id' => $enrollmentId,
                    'section_id' => $request->section_id,
                    'attendance_date' => $request->attendance_date,
                ],
                [
                    'status' => $status,
                    'notes' => $request->notes[$enrollmentId] ?? null,
                ]
            );

            $enrollment = Enrollment::with('student.user')->find($enrollmentId);

            if ($enrollment && $enrollment->student && $enrollment->student->user) {
                $studentUser = $enrollment->student->user;

                $statusText = match ($status) {
                    'present' => 'Present',
                    'absent'  => 'Absent',
                    'late'    => 'Late',
                };

                $message = "Attendance marked: You were marked as {$statusText} for the date {$request->attendance_date}.";

                $studentUser->notify(new RealTimeNotification($message));
            }
        }

        return  redirect()->route('attendance.sections.index')->with('success', 'Student attendance recorded successfully.');
    }

    public function showStaffAttendance()
    {
        $date = now()->format('Y-m-d');

        $staff = Employee::with(['media','staffAttendances' => function ($query) use ($date) {
            $query->whereDate('attendance_date', $date);
        }])->get();
        $isAttendanceTaken = StaffAttendance::whereDate('attendance_date', $date)->exists();

        return view('attendance.staff_show', compact('staff', 'date', 'isAttendanceTaken'));
    }

    public function storeStaffAttendance(Request $request)
    {

        $activeSemester = Semester::where('is_active', true)->first();
        if (! $activeSemester) {
            return redirect()->back()->with('error', 'No active semester found. Please activate a semester before recording attendance.');
        }

        if (!$activeSemester) {
            return redirect()->back()->with('error', 'No active semester found. Please activate a semester before recording attendance.');
        }
        $request->validate([
            'attendance_date' => 'required|date',
            'attendance'      => 'required|array',
            'attendance.*'    => 'required|string',
            'check_in.*'      => 'nullable|',
            'check_out.*'     => 'nullable|',
        ]);

        foreach ($request->attendance as $employeeId => $status) {
            StaffAttendance::updateOrCreate(
                [
                    'employee_id' => $employeeId,
                    'attendance_date' => $request->attendance_date,
                    'semester_id'     => $activeSemester->id,
                ],
                [
                    'status' => $status,
                    'check_in' => $request->check_in[$employeeId] ?? null,
                    'check_out' => $request->check_out[$employeeId] ?? null,
                    'notes' => $request->notes[$employeeId] ?? null,
                ]
            );
        }

        return redirect()->route('attendance.staff.show')->with('success', 'Staff attendance updated successfully.');
    }
}
