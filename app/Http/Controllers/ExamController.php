<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Models\Exam;
use App\Services\ExamService;

class ExamController extends Controller
{
    protected $examService;

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    public function index()
    {
        $exams = $this->examService->getIndexData();
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
      
        $data = $this->examService->getFormData();
        return view('admin.exams.create', $data);
    }

    public function store(ExamRequest $request)
    {
        $this->examService->storeExam($request->validated());
        return redirect()->route('exams.index')->with('success', 'New exam created successfully.');
    }

    public function edit(Exam $exam)
    {
        $data = $this->examService->getFormData();
        $data['exam'] = $exam;
        return view('admin.exams.edit', $data);
    }

    public function update(ExamRequest $request, Exam $exam)
    {
        $this->examService->updateExam($exam, $request->validated());
        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        try {
            $this->examService->deleteExam($exam);
            return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');
        } catch (\Exception $e) {
          
            return back()->with('error', $e->getMessage());
        }
    }
}
