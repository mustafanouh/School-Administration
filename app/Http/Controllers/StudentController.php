<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StudentRequest;
use App\Services\StudentService;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        $students = $this->studentService->getAllStudents();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(StudentRequest $request)
    {

        $student = $this->studentService->registerStudent($request->validated());
        return redirect()->route('students.index')->with('success', 'Student registered successfully :' .$student->user->email);
    }

    public function show(Student $student)
    { 


        $student = $this->studentService->getStudentProfile($student);
        


        return view('students.show', compact('student'));
    }
   

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(StudentRequest $request, Student $student)
    {
        $this->studentService->updateStudent($student, $request->validated());
        return redirect()->route('students.index')->with('success', 'Information updated.');
    }

    public function destroy(Student $student)
    {
        try {
            $this->studentService->deleteStudent($student);

            return redirect()
                ->route('students.index')
                ->with('success', 'Student record deleted successfully.');
        } catch (\Exception $e) {

            return back()->with('error', 'Action failed: ' . $e->getMessage());
        }
    }
}
