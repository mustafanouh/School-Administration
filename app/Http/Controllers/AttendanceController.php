<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Models\StaffAttendance;
use App\Models\Section;
use App\Models\Employee;

class AttendanceController extends Controller
{


    public function index()
    {
        $sections = Section::withCount('enrollments')->whereHas('academicYear', function ($query) {
            $query->where('is_active', true);
        })->with('grade')
            ->get();

        return view('attendance.sections_index', compact('sections'));
    }
    public function showSectionAttendance($id)
    {
       
        $section = Section::with(['enrollments.student'])->findOrFail($id);

        $date = now()->format('Y-m-d');

        return view('attendance.students', compact('section', 'date'));
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
        }

        return  redirect()->route('attendance.sections.index')->with('success', 'Student attendance recorded successfully.');
    }

    public function showStaffAttendance()
    {
       
        $staff = Employee::all();
        $date = now()->format('Y-m-d');

        return view('attendance.staff_show', compact('staff', 'date'));
    }

    public function storeStaffAttendance(Request $request)
    {
        foreach ($request->attendance as $employeeId => $status) {
            StaffAttendance::updateOrCreate(
                [
                    'employee_id' => $employeeId,
                    'attendance_date' => $request->attendance_date,
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
