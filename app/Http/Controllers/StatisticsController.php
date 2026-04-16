<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    private function getEnrollmentData()
    {
        $data = Enrollment::with('academicYear')
            ->select('academic_year_id', DB::raw('count(*) as total'))
            ->groupBy('academic_year_id')
            ->get();

         
        return [
            'labels' => $data->map(fn($item) => $item->academicYear?->name ?? 'N/A')->toArray(),
            'values' => $data->map(fn($item) => (int)$item->total)->toArray(),
        ];
    }

    private function getGpaData()
    {
        $data = Enrollment::with('academicYear')
            ->select('academic_year_id', DB::raw('avg(average) as avg_grade'))
            ->groupBy('academic_year_id')
            ->get();

        return [
            'labels' => $data->map(fn($item) => $item->academicYear?->name ?? 'N/A')->toArray(),
            'values' => $data->map(fn($item) => round((float)$item->avg_grade, 2))->toArray(),
        ];
    }

    public function showCharts()
    {
        $enrollment = $this->getEnrollmentData();
        $gpa = $this->getGpaData();

        return view('admin.statistics.chart', [
            'enrollmentLabels' => $enrollment['labels'],
            'enrollmentValues' => $enrollment['values'],
            'gpaLabels'        => $gpa['labels'],
            'gpaValues'        => $gpa['values'],
        ]);
    }
}
