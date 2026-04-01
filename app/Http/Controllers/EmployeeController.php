<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Semester;
use App\Models\User;
use App\Services\EmployeeService;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    protected $employeeService;

    // Dependency Injection
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index() {
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
    public function show(Employee $employee)
    {

        $semesterId = Semester::where('is_active', true)->value('id');


        $employee->load(['staffAttendances' => function ($query) use ($semesterId) {
            if ($semesterId) {
                $query->where('semester_id', $semesterId);
            }
            $query->orderBy('attendance_date', 'desc');
        }]);

        return view('employees.show', compact('employee'));
    }


    public function destroy(Employee $employee)
    {
        $this->employeeService->deleteEmployee($employee);

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }


    public function create()
    {
        $role =Role::pluck('name');
        return view('employees.create', compact('role'));
    }
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }
}
