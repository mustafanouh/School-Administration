<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use App\Models\Grade;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(Section $section)
    {
        $sections = Section::whereHas('academicYear', function ($query) {
            $query->where('is_active', true);
        })
            ->with('grade')
            ->get();
        return view('sections.index', compact('sections'));
    }

    public function show($sectionId)
    {


        $activeYear = AcademicYear::where('is_active', true)->first();
        $section = Section::with([
            'enrollments' =>
            function ($query) use ($activeYear) {
                $query->where('academic_year_id', $activeYear->id)->with('student');
            }
        ])->findOrFail($sectionId);

        $students = $section->enrollments->pluck('student');
        // dd($students);

        return view('sections.show', compact('section'));
    }
    public function create()
    {
        $grades = Grade::all();
        $academicYears = AcademicYear::all();
        return view('sections.create', compact('grades', 'academicYears'));
    }

    public function store(SectionRequest $request)
    {
        $request->validated();

        Section::create($request->all());
        return redirect()->route('sections.index')->with('success', 'تم إضافة الشعبة بنجاح');
    }

    public function edit(Section $section)
    {
        $grades = Grade::all();
        $academicYears = AcademicYear::all();
        return view('sections.edit', compact('section', 'grades', 'academicYears'));
    }

    public function update(SectionRequest $request, Section $section)
    {
        $request->validated();

        $section->update($request->all());
        return redirect()->route('sections.index')->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Deleted section successfully');
    }
}
