<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkRequest;
use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Mark;
use App\Notifications\RealTimeNotification;
use App\Services\MarkService;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function index()
    {
        $marks = Mark::with([
            'enrollment.student',
            'exam.subject',
            'exam.semester'
        ])
            ->whereHas('enrollment.academicYear', function ($query) {
                $query->where('is_active', true);
            })
            ->whereHas('exam.semester', function ($query) {
                $query->where('is_active', true);
            })
            ->latest()
            ->paginate(15);
        return view('admin.marks.index', compact('marks'));
    }

    public function create()
    {

        $enrollments = Enrollment::with(['student', 'section.grade', 'academicYear'])
            ->whereHas('academicYear', function ($query) {
                $query->where('is_active', true);
            })
            ->get();

        $exams = Exam::with(['subject', 'semester'])->whereHas('semester', function ($query) {
            $query->where('is_active', true);
        })->get();

        return view('admin.marks.create', compact('enrollments', 'exams'));
    }
    public function store(MarkRequest $request)
    {
        $mark = Mark::create($request->validated());


        $enrollment = Enrollment::with('student.user')->find($request->enrollment_id);

        if ($enrollment && $enrollment->student && $enrollment->student->user) {
            $studentUser = $enrollment->student->user;

            $message = "A new mark has been recorded for you: {$mark->score} degree in your {$mark->exam->subject->name} exam.";
            $studentUser->notify(new RealTimeNotification($message));
        }

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


        $enrollment = Enrollment::with('student.user')->find($request->enrollment_id);

        if ($enrollment && $enrollment->student && $enrollment->student->user) {
            $studentUser = $enrollment->student->user;

            $message = "Your mark has been updated: {$mark->score} degree in your {$mark->exam->subject->name} exam.";
            $studentUser->notify(new RealTimeNotification($message));
        }

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
