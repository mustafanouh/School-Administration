<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherSubjectRequest;
use App\Models\AcademicYear;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
{

    public function index()
    {
        return redirect()->route('sections.index');
    }
    public function create(Request $request)
    {
      
        $teachers = Teacher::with('employee')->get();
        $subjects = Subject::all();
        $sections = Section::all();

       
        $selectedSectionId = $request->query('section_id');
        $selectedYearId = $request->query('academic_year_id');

        $activeYear = AcademicYear::where('is_active', true)->first();
        $targetYearId = $selectedYearId ?? ($activeYear ? $activeYear->id : null);

        return view('admin.teacher_subjects.create', compact(
            'teachers',
            'subjects',
            'sections',
            'selectedSectionId',
            'targetYearId'
        ));
    }
    public function edit(TeacherSubject $teacherSubject)
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $sections = Section::all();
        $academicYears = AcademicYear::all();

        return view('admin.teacher_subjects.edit', compact('teacherSubject', 'teachers', 'subjects', 'sections', 'academicYears'));
    }


    public function update(StoreTeacherSubjectRequest $request, TeacherSubject $teacherSubject)
    {
        $teacherSubject->update($request->validated());

        return redirect()->route('sections.show', $teacherSubject->section_id)
            ->with('success', 'Teacher-subject assignment updated successfully.');
    }


    public function store(StoreTeacherSubjectRequest $request)
    {

        TeacherSubject::create($request->validated());

        return redirect()->route('sections.show', $request->section_id)
            ->with('success', 'Teacher assigned to subject successfully.');
    }
    public function destroy(TeacherSubject $teacherSubject)
    {
        $teacherSubject->delete();

        return redirect()->route('sections.show', $teacherSubject->section_id)
            ->with('success', 'Teacher-subject assignment deleted successfully.');
    }
}
