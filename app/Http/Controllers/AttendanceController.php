<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Models\StaffAttendance;
use App\Models\Section;
use App\Models\Employee;

class AttendanceController extends Controller
{
    /**
     * حفظ حضور الطلاب للشعبة المختارة
     */
    public function storeStudentAttendance(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array', // مصفوفة تحتوي على enrollment_id و الحالة
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

        return back()->with('success', 'تم تسجيل حضور الطلاب بنجاح');
    }

    /**
     * حفظ حضور الموظفين
     */
    public function storeStaffAttendance(Request $request)
    {
        $request->validate([
            'attendance_date' => 'required|date',
            'attendance' => 'required|array', // مصفوفة تحتوي على employee_id و الحالة
        ]);

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

        return back()->with('success', 'تم تسجيل حضور الموظفين بنجاح');
    }
}
