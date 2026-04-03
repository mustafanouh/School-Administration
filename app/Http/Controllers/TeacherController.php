<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Http\Requests\TeacherRequest;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use App\Repositories\TeacherRepository;
use App\Services\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected  TeacherRepository $teacherRepository;
    protected EmployeeRepository $employeeRepository;
    protected TeacherService $teacherService;
    public function __construct(TeacherRepository $teacherRepository, TeacherService $teacherService, EmployeeRepository $employeeService)
    {
        $this->teacherRepository =  $teacherRepository;
        $this->employeeRepository = $employeeService;
        $this->teacherService = $teacherService;
    }
    public function index()
    {
        $teachers = $this->teacherRepository->getAllTeachers();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $employees = $this->employeeRepository->getAllEmployees();

        return view('teachers.create', compact('employees'));
    }

    public function store(TeacherRequest $request)
    {
        try {

            $this->teacherService->storeTeacher($request->validated());

            return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to add teacher: ' . $e->getMessage());
        }
    }


    public function edit(Teacher $teacher)
    {

        $teacher =  $this->teacherRepository->getTeacherForEdit($teacher);

        return view('teachers.edit', compact('teacher'));
    }

    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        try {
            $this->teacherRepository->destroy($teacher);
            return back()->with('success', 'Teacher deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete teacher: ' . $e->getMessage());
        }
    }
}
