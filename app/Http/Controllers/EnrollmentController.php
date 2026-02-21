<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentRequest;
use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        // جلب البيانات مع العلاقات لتجنب مشكلة N+1
        $enrollments = Enrollment::with(['student', 'section.grade', 'academicYear', 'track', 'marks.exam'])
            ->latest()
            ->paginate(10); // تقسيم الصفحات
        return view('admin.enrollments.index', compact('enrollments'));
    }


    public function create()
    {

        $students = Student::all();
        $sections = Section::all();
        $tracks = Track::all();
        $grades = Grade::all();
        $academicYears = AcademicYear::all();

        return view('admin.enrollments.create', compact('students', 'sections', 'tracks', 'academicYears', 'grades'));
    }

    public function store(EnrollmentRequest $request)
    {
        try {

            $data = $request->validated();


            Enrollment::create($data);


            return redirect()
                ->route('enrollments.index')
                ->with('success', 'Student has been successfully enrolled in the system.');
        } catch (\Exception $e) {

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    public function destroy(Enrollment $enrollment)
    {
        try {
            $enrollment->delete();
            return redirect()->route('enrollments.index')
                ->with('success', 'Enrollment record deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error occurred while deleting the record.');
        }
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $sections = Section::all();
        $tracks = Track::all();
        $academicYears = AcademicYear::all();
        $grades = Grade::all();

        return view('admin.enrollments.edit', compact('enrollment', 'students', 'sections', 'tracks', 'academicYears', 'grades'));
    }
    public function update(EnrollmentRequest $request, Enrollment $enrollment)
    {
        try {
            $enrollment->update($request->validated());

            return redirect()->route('enrollments.index')
                ->with('success', 'Enrollment details updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Update failed.');
        }
    }
}
