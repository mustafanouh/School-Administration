<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Models\Exam;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {

        $exams = Exam::with(['subject', 'semester'])->latest()->paginate(10);

        return view('admin.exams.index', compact('exams'));
    }
    public function create()
    {
        $subjects = Subject::all();
        $semesters = Semester::all();

        return view('admin.exams.create', compact('subjects', 'semesters'));
    }
    public function store(ExamRequest $request)
    {

        $validated = $request->validated();


        Exam::create($validated);

        return redirect()->route('exams.index')
            ->with('success', 'New exam type has been defined successfully.');
    }
    public function edit(Exam $exam)
    {

        $subjects = Subject::all();
        $semesters = Semester::all();

        return view('admin.exams.edit', compact('exam', 'subjects', 'semesters'));
    }

    public function update(ExamRequest $request, Exam $exam)
    {

        $exam->update($request->validated());

        return redirect()->route('exams.index')
            ->with('success', 'Exam definition updated successfully.');
    }
    public function destroy(Exam $exam)
    {
        try {
        
            if ($exam->marks()->exists()) {
                return back()->with('error', 'Cannot delete this exam because it already has student marks recorded.');
            }

            $exam->delete();

            return redirect()->route('exams.index')
                ->with('success', 'Exam definition has been deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while trying to delete the exam.');
        }
    }
}
