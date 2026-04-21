<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffAttendanceRequest;
use App\Http\Requests\StudentAttendanceRequest;
use App\Repositories\AttendanceRepository;
use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Models\StaffAttendance;
use App\Models\Section;
use App\Models\Employee;
use App\Models\Enrollment;
use App\Models\Semester;
use App\Notifications\RealTimeNotification;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected $attendanceService;
    protected $attendanceRepository;
    public function __construct(AttendanceService $attendanceService, AttendanceRepository $attendanceRepository)
    {
        $this->attendanceService = $attendanceService;
        $this->attendanceRepository = $attendanceRepository;
    }


    //   show section attendance 
    public function index()
    {
        $date = now()->format('Y-m-d');

        $sections = $this->attendanceRepository->getSectionsWithAttendanceStatus($date);

        return view('attendance.sections_index', compact('sections'));
    }


    public function showSectionAttendance($id)
    {
        $date = now()->format('Y-m-d');

        $section = $this->attendanceRepository->getSectionWithAttendance($id, $date);

        $isAttendanceTaken = $this->attendanceRepository->isAttendanceTaken($id, $date);

        return view('attendance.students', compact('section', 'date', 'isAttendanceTaken'));
    }


    public function storeStudentAttendance(StudentAttendanceRequest $request)
    {

        $request->validated();
        
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

        $staff = Employee::with(['media', 'staffAttendances' => function ($query) use ($date) {
            $query->whereDate('attendance_date', $date);
        }])->get();
        $isAttendanceTaken = StaffAttendance::whereDate('attendance_date', $date)->exists();

        return view('attendance.staff_show', compact('staff', 'date', 'isAttendanceTaken'));
    }

    public function storeStaffAttendance(StaffAttendanceRequest $request)
    {

        $activeSemester = Semester::where('is_active', true)->first();
        if (! $activeSemester) {
            return redirect()->back()->with('error', 'No active semester found. Please activate a semester before recording attendance.');
        }

        if (!$activeSemester) {
            return redirect()->back()->with('error', 'No active semester found. Please activate a semester before recording attendance.');
        }
        $request->validated();

        foreach ($request->attendance as $employeeId => $status) {
            StaffAttendance::updateOrCreate(
                [
                    'employee_id' => $employeeId,
                    'attendance_date' => $request->attendance_date,
                ],
                [
                    'semester_id'     => $activeSemester->id,

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
