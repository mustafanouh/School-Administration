<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use App\Models\Employee;

class EmployeeService
{
    protected $repository;

    // Dependency Injection
    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllEmployees()
    {
        return $this->repository->paginate(10);
    }

    public function storeEmployee(array $data)
    {
        


        return $this->repository->create($data);
    }


    public function updateProfilePhoto(Employee $employee, $file)
    {
        if ($file) {
            return $employee->addMedia($file)
                ->toMediaCollection('employee_profile_photos');
        }

        return null;
    }

    public function updateEmployee(Employee $employee, array $data)
    {
        return $this->repository->update($employee, $data);
    }

    public function deleteEmployee(Employee $employee)
    {
        return $this->repository->delete($employee);
    }
}
