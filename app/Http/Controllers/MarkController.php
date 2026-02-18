<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkRequest;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function index()
    {
        $marks = Mark::with([
            'enrollment.student',
            'exam.subject',
            'exam.semester'
        ])->latest()->paginate(15);

        return view('admin.marks.index', compact('marks'));
    }
    public function create()
    {
        // جلب الطلاب المسجلين مع أسمائهم للسهولة
        $enrollments = Enrollment::with('student')->get();

        // جلب الامتحانات مع المادة والترم
        $exams = Exam::with(['subject', 'semester'])->get();

        return view('admin.marks.create', compact('enrollments', 'exams'));
    }
    public function store(MarkRequest $request)
    {
        Mark::create($request->validated());

        return redirect()->route('marks.index')
            ->with('success', 'Student mark has been recorded successfully.');
    }
    public function edit(Mark $mark)
    {
        $enrollments = Enrollment::with('student')->get();
        $exams = Exam::with(['subject', 'semester'])->get();

        return view('admin.marks.edit', compact('mark', 'enrollments', 'exams'));
    }

    public function update(MarkRequest $request, Mark $mark)
    {
        $mark->update($request->validated());

        return redirect()->route('marks.index')
            ->with('success', 'Student grade updated successfully.');
    }
    public function destroy(Mark $mark)
    {
        try {
            $mark->delete();

            return redirect()->route('marks.index')
                ->with('success', 'Student grade record has been removed.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete the record. It might be linked to other data.');
        }
    }
}
