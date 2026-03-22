<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Services\StudentService;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        $user = auth()->user();

        if (!$user->student) {
            return redirect()->route('dashboard')->with('error', 'Access Denied.');
        }

        $student = $user->student;

        $data = $this->studentService->getStudentProfile($student);

        return view('portal.index', compact('student', 'data'));
    }


    public function marks()
    {
        $user = auth()->user();

        if (!$user->student) {
            return redirect()->route('dashboard')->with('error', 'Access Denied: Student profile not found.');
        }

        $student = $user->student;
        $data = $this->studentService->getStudentProfile($student);
        return view('portal.marks', compact('student', 'data'));
    }


    public function attendance()
    {
        $user = auth()->user();

        $student = $user->student()->with([
            'enrollments' => function ($query) {
                $query->orderBy('created_at', 'desc');
            },
            'enrollments.academicYear',
            'enrollments.section.grade',
            'enrollments.attendances' => function ($query) {
                $query->orderBy('attendance_date', 'desc');
            }
        ])->firstOrFail();

        return view('portal.attendance', compact('student'));
    }
}
