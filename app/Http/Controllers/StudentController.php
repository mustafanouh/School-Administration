<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {

        $students = Student::latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }


    public function store(StudentRequest $request)
    {

        Student::create($request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'Student has been registered successfully.');
    }


    public function show(Student $student)
    {
        
        $student->load(['enrollments' => function ($query) {
            $query->orderBy('academic_year_id', 'desc');
        }, 'enrollments.academicYear', 'enrollments.section.grade', 'enrollments.marks.exam.subject']);

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }


    public function update(StudentRequest $request, Student $student)
    {

        $student->update($request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'Student information updated successfully.');
    }


    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student record deleted successfully.');
    }
}
