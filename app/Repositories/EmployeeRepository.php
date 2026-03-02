<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function paginate($perPage = 10)
    {
        return Employee::paginate($perPage);
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function update(Employee $employee, array $data)
    {
        return $employee->update($data);
    }

    public function delete(Employee $employee)
    {
        return $employee->delete();
    }
}
