<?php
namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    // مسمى يعبر عن وظيفة جلب إحصائيات التسجيل
    public function getEnrollmentStats()
    {
        $enrollmentData = Enrollment::with('academicYear')
            ->select('academic_year_id', DB::raw('count(*) as total'))
            ->groupBy('academic_year_id')
            ->get();

        $labels = $enrollmentData->map(fn($item) => $item->academicYear?->name ?? 'not determined')->toArray();
        $values = $enrollmentData->map(fn($item) => (int)$item->total)->toArray();
// dd($labels, $values);
        return view('admin.statistics.chart', compact('labels', 'values'));
    }
}