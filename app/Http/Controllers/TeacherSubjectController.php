<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherSubjectRequest;
use App\Models\TeacherSubject;
use App\Services\TeacherSubjectService;
use Illuminate\Http\Request;
use Exception;

class TeacherSubjectController extends Controller
{
    protected $service;

    public function __construct(TeacherSubjectService $service)
    {
        $this->service = $service;
    }

    
    public function create(Request $request)
    {
        $data = $this->service->getCreateData($request->all());
        dd($data);
        return view('admin.teacher_subjects.create', $data);
    }

    public function store(StoreTeacherSubjectRequest $request)
    {
        try {
            $assignment = $this->service->assignTeacher($request->validated());

            return redirect()->route('sections.show', $assignment->section_id)
                ->with('success', 'Teacher assigned to subject successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to assign teacher.');
        }
    }

    public function edit(TeacherSubject $teacherSubject)
    {
        $data = $this->service->getEditData($teacherSubject);
        return view('admin.teacher_subjects.edit', $data);
    }

    public function update(StoreTeacherSubjectRequest $request, TeacherSubject $teacherSubject)
    {
        try {
            $this->service->updateAssignment($teacherSubject, $request->validated());

            return redirect()->route('sections.show', $teacherSubject->section_id)
                ->with('success', 'Assignment updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Update failed.');
        }
    }

    public function destroy(TeacherSubject $teacherSubject)
    {
        try {
            $sectionId = $teacherSubject->section_id;
            $this->service->removeAssignment($teacherSubject);

            return redirect()->route('sections.show', $sectionId)
                ->with('success', 'Assignment deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Could not delete assignment.');
        }
    }
}
