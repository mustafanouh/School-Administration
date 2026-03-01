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

        $enrollments = Enrollment::with(['student', 'section.grade', 'academicYear', 'track', 'marks.exam'])
            ->latest()
            ->paginate(10);
        return view('admin.enrollments.index', compact('enrollments'));
    }


    public function create()
    {

        $activeYear = AcademicYear::where('is_active', true)->first();

        if (!$activeYear) {
            return redirect()->back()->with('error', 'Please activate an academic year first.');
        }

        if ($activeYear) {
            $sectionsGroupedByGrade = Section::where('academic_year_id', $activeYear->id)
                ->with('grade')
                ->get()
                ->groupBy(function ($item) {
                    return $item->grade->name; // التجميع حسب اسم الصف
                });
        } else {
            $sectionsGroupedByGrade = collect();
        }

        $tracks = Track::all();
        // $grades = Grade::with('nextGrade')->get();

        $students = Student::whereDoesntHave('enrollments', function ($query) use ($activeYear) {
            $query->where('academic_year_id', $activeYear->id);
        })->get();

        return view('admin.enrollments.create', [
            'students' => $students,
            'sectionsGroupedByGrade' => $sectionsGroupedByGrade,
            'tracks' => $tracks,
            'activeYear' => $activeYear
        ]);
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
