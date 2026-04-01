<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class EmployeeRepository
{
    public function paginate($perPage = 10)
    {
        return Employee::paginate($perPage);
    }

    public function getAllEmployees()
    {
        return Employee::all();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $year = date('Y');
            $baseEmail = Str::lower($data['first_name'] . '.' . $data['last_name'] . '.employee' . $year);

            $email = $baseEmail . '@school.com';
            $i = 1;
            while (User::where('email', $email)->exists()) {
                $email = $baseEmail . $i . '@school.com';
                $i++;
            }

            $user = User::create([
                'name'     => $data['first_name'] . ' ' . $data['last_name'],
                'email'    => $email,
                'password' => Hash::make($data['phone']),
            ]);

            $user->assignRole($data['role']);

            $data['user_id'] = $user->id;

           
            unset($data['role']);

            return Employee::create($data);
        });
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
