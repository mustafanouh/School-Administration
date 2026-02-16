<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Http\Requests\TeacherRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('employee')->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $employees = Employee::all();
        
        return view('teachers.create', compact('employees'));
    }

    public function store(TeacherRequest $request)
    {
        Teacher::create($request->validated());
        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');
    }

    public function edit(Teacher $teacher)
    {
        $employees = Employee::all();
        return view('teachers.edit', compact('teacher', 'employees'));
    }

    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return back()->with('success', 'Teacher deleted successfully!');
    }
}
