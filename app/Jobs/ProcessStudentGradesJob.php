<?php

namespace App\Jobs;

use App\Models\Enrollment;
use App\Models\Semester;
use App\Services\AcademicProcessService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Illuminate\Support\Facades\Storage;

class ProcessStudentGradesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $enrollment;
    protected $semester;

    public function __construct(Enrollment $enrollment, Semester $semester)
    {
        $this->enrollment = $enrollment;
        $this->semester = $semester;
    }



    public function handle(AcademicProcessService $service)
    {
        //  Current Semester Average
        $currentSemesterMarks = $this->enrollment->marks()
            ->whereHas('exam', function ($q) {
                $q->where('semester_id', $this->semester->id);
            })->get();

        $semesterAverage = $currentSemesterMarks->avg('score') ?? 0;

        $isFinalReport = ($this->semester->name === 'Second Semester');
        $finalYearAverage = 0;
        $marksToDisplay = $currentSemesterMarks;

        if ($isFinalReport) {

        $this->enrollment = $service->finalizeYearlyStatus($this->enrollment);

            $marksToDisplay = $this->enrollment->marks()->with('exam.subject')->get();
            $finalYearAverage = $service->calculateYearlyAverage($this->enrollment);

        }
        
        $pdf = PDF::loadView('pdf.final_report', [
            'enrollment'       => $this->enrollment,
            'semester'         => $this->semester,
            'marks'            => $marksToDisplay,
            'semester_average' => $semesterAverage,
            'final_average'    => $isFinalReport ? $finalYearAverage : null,
            ]);
            
            $directory = "reports/{$this->semester->academic_year_id}";
            $fileName = "report_{$this->semester->id}_{$this->enrollment->id}.pdf";
            $path = "{$directory}/{$fileName}";
            
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
                }
                
        Storage::disk('public')->put($path, $pdf->output());
    }
}
