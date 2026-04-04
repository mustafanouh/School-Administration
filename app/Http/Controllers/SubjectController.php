<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected  SubjectRepository $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $subjects = $this->subjectRepository->getAllSubject();
        return view('subjects.index', compact('subjects'));
    }

    function create()
    {
        $grades = $this->subjectRepository->getGrades();
        $tracks = $this->subjectRepository->getTracks();

        return view('subjects.create', compact('grades', 'tracks'));
    }

    function store(Request $request)
    {

        try {
            $this->subjectRepository->subjectCreate($request->all());
            return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('subjects.index')->with('error', 'Unable to create subject.');
        }
    }
    function edit(Subject $subject)
    {
        $grades = $this->subjectRepository->getGrades();
        $tracks = $this->subjectRepository->getTracks();

        return view('subjects.edit', compact('subject', 'grades', 'tracks'));
    }

    function update(SubjectRequest $request, Subject $subject)
    {
        try {
            $this->subjectRepository->subjectUpdate($subject, $request->validated());
            return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('subjects.index')->with('error', 'Unable to update subject.');
        }
    }

    public function show(Subject $subject)
    {


        return view('subjects.show', compact('subject'));
    }

    public function destroy(Subject $subject)
    {
        try {
            $this->subjectRepository->subjectDestroy($subject->id);
            return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('subjects.index')->with('error', 'Unable to delete subject. It may be associated with other records.');
        }
    }
}
