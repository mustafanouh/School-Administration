<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.index', compact('employees'));
    }
    public function create()
    {
        return view('employees.create');
    }
    public function store(EmployeeRequest $request)
    {

        Employee::create($request->validated());

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully with all details!');
    }
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }
    public function update(EmployeeRequest $request, Employee $employee)
    {

        $employee->update($request->validated());

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }
}
