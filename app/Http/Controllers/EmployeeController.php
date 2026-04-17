<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\AcademicYear;
use App\Models\Employee;
use App\Models\Semester;
use App\Models\User;
use App\Services\EmployeeService;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        return view('employees.index', compact('employees'));
    }


    public function store(EmployeeRequest $request)
    {
        $this->employeeService->storeEmployee($request->validated());

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully!');
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {

        $this->employeeService->updateEmployee($employee, $request->validated());

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }


    public function updatePhoto(UpdatePhotoRequest $request, Employee $employee)
    {

        $this->employeeService->updateProfilePhoto($employee, $request->file('photo'));

        return back()->with('success', 'Profile photo updated successfully!');
    }

    public function show(Employee $employee)
    {
        $activeYearId = AcademicYear::where('is_active', true)->value('id');
        $semesterId = Semester::where('is_active', true)->value('id');

        $employee->load(['staffAttendances' => function ($query) use ($semesterId) {
            if ($semesterId) {
                $query->where('semester_id', $semesterId);
            }
            $query->orderBy('attendance_date', 'desc');
        }]);

        if ($employee->teacher) {

            $employee->load([
                'teacher.teacherSubjects',
                'teacher.teacherSubjects.subject',
                'teacher.teacherSubjects.academicYear',
                'teacher.teacherSubjects.section.grade'
            ]);
        }

        return view('employees.show', compact('employee', 'activeYearId'));
    }







    public function destroy(Employee $employee)
    {
        $this->employeeService->deleteEmployee($employee);

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }


    public function create()
    {
        $role = Role::where('name', '!=', 'student')->pluck('name');
        return view('employees.create', compact('role'));
    }
    public function edit(Employee $employee)
    {
        $role = Role::where('name', '!=', 'student')->pluck('name');
        return view('employees.edit', compact('employee', 'role'));
    }
}
