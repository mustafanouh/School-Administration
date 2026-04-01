<?php

namespace App\Http\Controllers;

use App\Http\Requests\SemesterRequest;
use App\Models\Semester;
use App\Services\SemesterService;

class SemesterController extends Controller
{
    protected $semesterService;


    public function __construct(SemesterService $semesterService)
    {
        $this->semesterService = $semesterService;
    }

  
    public function edit($id)
    {
        $semester = $this->semesterService->getSemesterData($id);
        return view('admin.semesters.edit', compact('semester'));
    }

    public function update(SemesterRequest $request, Semester $semester)
    {
        try {

            $this->semesterService->updateSemester($semester, $request->validated());

            return redirect()->route('academic_years.index')
                ->with('success', 'successfully updated and reports are being generated if needed!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', ' missing data: ' . $e->getMessage());
        }
    }
}
