<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
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
                // 'subjects' => [],
                // 'sections' => [],

            ]);
        }


        $students = Student::search($query)->take(5)->get();
        $employees = Employee::search($query)->take(5)->get();
        // $subjects = Subject::search($query)->take(2)->get();
        // $sections = Section::search($query)->take(5)->get();


        return response()->json([
            'results' => [
                'students' => $students,
                'employees' => $employees,
                // 'subjects' => $subjects,
                // 'sections' => $sections,
            ],

        ]);
    }
}
