<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Http\Requests\AcademicYearRequest;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicYearController extends Controller
{

    public function index(AcademicYear $academicYear)
    {
       
        $semester = $academicYear->semesters()->where('is_active', true);
        // dd($semester);
        $academicYears  = AcademicYear::paginate(10);
        return view('admin.academic_years.index', compact('academicYears', 'semester'));
    }


    public function create()
    {
        return view('admin.academic_years.create');
    }


    public function store(AcademicYearRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();

                // 1. إدارة الحالة النشطة: جعل السنة المختارة هي الوحيدة النشطة
                if ($request->boolean('is_active')) {
                    AcademicYear::query()->update(['is_active' => false]);
                }

                // 2. إنشاء السنة الدراسية
                $year = AcademicYear::create($data);

                // 3. الأتمتة: إنشاء الفصول الثلاثة تلقائياً لهذه السنة
                $semesters = [
                    ['name' => 'First Semester'],
                    ['name' => 'Second Semester'],
                    // ['name' => 'Summer Semester'],
                ];

                foreach ($semesters as $semester) {
                    $year->semesters()->create($semester);
                }
            });

            return redirect()->route('academic_years.index')
                ->with('success', 'Academic year created with First, Second, and Summer semesters!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function edit(AcademicYear $academicYear)
    {
        return view('admin.academic_years.edit', compact('academicYear'));
    }


    public function update(AcademicYearRequest $request, AcademicYear $academicYear)
    {
        try {
            DB::transaction(function () use ($request, $academicYear) {
                $data = $request->validated();

                // إذا تم تفعيل هذه السنة، نقوم بتعطيل البقية
                if ($request->boolean('is_active')) {
                    AcademicYear::where('id', '!=', $academicYear->id)->update(['is_active' => false]);
                }

                $academicYear->update($data);
            });

            return redirect()->route('academic-years.index')
                ->with('success', 'Academic year updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating year.');
        }
    }


    public function destroy(AcademicYear $academicYear)
    {
        // تحقق إضافي: لا تسمح بحذف السنة إذا كان بها طلاب مسجلين (Enrollments)
        if ($academicYear->enrollments()->count() > 0) {
            return back()->with('error', 'Cannot delete year because it has active enrollments.');
        }

        $academicYear->delete();
        return redirect()->route('academic-years.index')
            ->with('success', 'Academic year deleted successfully.');
    }
}
