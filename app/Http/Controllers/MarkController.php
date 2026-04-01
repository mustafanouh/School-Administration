<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkRequest;
use App\Models\AcademicYear;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Mark;
use App\Notifications\RealTimeNotification;
use App\Repositories\MarkRepository;
use App\Services\MarkService;
use Illuminate\Http\Request;


class MarkController extends Controller
{

    protected MarkRepository $markRepository;
    protected MarkService $markService;

    public function __construct(MarkRepository $markRepository, MarkService $markService)
    {
        $this->markRepository = $markRepository;
        $this->markService = $markService;
    }

    public function index()
    {
        $marks = $this->markRepository->getActiveMarksPaginated(15);

        return view('admin.marks.index', compact('marks'));
    }



    public function create()
    {
        $enrollments = $this->markRepository->getActiveEnrollmentsForSelection();
        $exams = $this->markRepository->getActiveExamsForSelection();

        return view('admin.marks.create', compact('enrollments', 'exams'));
    }

    public function store(MarkRequest $request)
    {
        try {
            $this->markService->storeMarkEntry($request->validated());

            return redirect()->route('marks.index')
                ->with('success', 'Student mark has been recorded successfully.');
        } catch (\Exception $e) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while recording the mark.');
        }
    }

    public function edit(Mark $mark)
    {
        $enrollments = $this->markRepository->getActiveEnrollmentsForSelection();
        $exams = $this->markRepository->getActiveExamsForSelection();
        $mark->load(['enrollment.student', 'exam.subject']);
        return view('admin.marks.edit', compact('mark', 'enrollments', 'exams'));
    }

    public function update(MarkRequest $request, Mark $mark)
    {
        try {
            $this->markService->updateMarkEntry($mark, $request->validated());

            return redirect()->route('marks.index')
                ->with('success', 'Student grade updated successfully.');
        } catch (\Exception $e) {
          

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update the mark. Please try again.');
        }
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
