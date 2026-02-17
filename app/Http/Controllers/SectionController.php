<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Grade;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with(['grade', 'academicYear'])->get();

        return view('sections.index', compact('sections'));
    }

    public function show(Section $section)
    {
        // تحميل العلاقات: الصف، السنة، التسجيلات مع بيانات الطلاب، والمدرسين مع المواد
        $section->load([
            'grade',
            'academicYear',
            'enrollments.student', // افترضنا وجود علاقة student داخل موديل Enrollment
            'teacherSubjects.teacher.employee', // الوصول لاسم المدرس من خلال الموظف
            'teacherSubjects.subject'
        ]);

        return view('sections.show', compact('section'));
    }
    public function create()
    {
        $grades = Grade::all();
        $academicYears = AcademicYear::all();
        return view('sections.create', compact('grades', 'academicYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'capacity' => 'required|integer|min:1',
        ]);

        Section::create($request->all());
        return redirect()->route('sections.index')->with('success', 'تم إضافة الشعبة بنجاح');
    }

    public function edit(Section $section)
    {
        $grades = Grade::all();
        $academicYears = AcademicYear::all();
        return view('sections.edit', compact('section', 'grades', 'academicYears'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'capacity' => 'required|integer|min:1',
        ]);

        $section->update($request->all());
        return redirect()->route('sections.index')->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'تم حذف الشعبة');
    }
}
