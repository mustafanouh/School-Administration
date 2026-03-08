<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;


class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        $query = $request->input('query');


        if (empty($query)) {
            return response()->json([
                'students' => [],
                'employees' => [],

            ]);
        }


        $students = Student::search($query)->take(5)->get();
        $employees = Employee::search($query)->take(5)->get();


        return response()->json([
            'results' => [
                'students' => $students,
                'employees' => $employees,
            ],

        ]);
    }
}
