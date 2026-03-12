<?php

namespace App\Http\Controllers;

use App\Http\Requests\SemesterRequest;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    public function edit($id)
    {
        $semester = Semester::findOrFail($id); // هذا يعيد كائناً واحداً (Object)
        return view('admin.semesters.edit', compact('semester'));
    }


    // {
    //     try {
    //         return DB::transaction(function () use ($request, $semester) {
    //             $data = $request->validated();


    //             $isActive = $request->boolean('is_active');

    //             if ($isActive) {
    //                 if (!$semester->academicYear->is_active) {
    //                     throw new \Exception('Cannot activate this semester because the associated Academic Year is not active.');
    //                 }

    //                 Semester::where('id', '!=', $semester->id)->update(['is_active' => false]);
    //             }


    //             $semester->fill($data);
    //             $semester->is_active = $isActive;
    //             $semester->save();
    //             // --- كود المعالجة المباشرة ---
    //             if (!$isActive) { // إذا تم إغلاق الفصل
    //                 try {
    //                     $enrollments = \App\Models\Enrollment::where('academic_year_id', $semester->academic_year_id)->get();

    //                     foreach ($enrollments as $enrollment) {
    //                         // تشغيل المعالجة يدوياً بدون طابور للتجربة
    //                         $job = new \App\Jobs\ProcessStudentGradesJob($enrollment, $semester);
    //                         app()->call([$job, 'handle']);
    //                     }
    //                 } catch (\Exception $e) {
    //                     // إذا حدث أي خطأ سيظهر لك هنا فوراً
    //                     return back()->with('error', 'خطأ أثناء توليد الملفات: ' . $e->getMessage());
    //                 }
    //             }

    //             return redirect()->route('academic_years.index')
    //                 ->with('success', 'Semester details updated successfully!');
    //         });
    //     } catch (\Exception $e) {
    //         return back()->withInput()->with('error', $e->getMessage());
    //     }
    // }

    //  public function update(SemesterRequest $request, Semester $semester)
    // {
    //     // 1. تحديث البيانات وحفظ الحالة الجديدة
    //     $semester->fill($request->validated());
    //     $semester->is_active = $request->has('is_active');
    //     $semester->save();

    //     // 2. إذا أصبح الفصل "غير نشط" (تم إغلاقه)
    //     if (!$semester->is_active) {

    //         // جلب الطلاب المسجلين في هذه السنة الأكاديمية
    //         $enrollments = \App\Models\Enrollment::where('academic_year_id', $semester->academic_year_id)->get();

    //         // فحص سريع: هل وجدنا طلاباً؟
    //         if ($enrollments->isEmpty()) {
    //             return redirect()->route('academic_years.index')
    //                 ->with('error', "تم إغلاق الفصل، ولكن لم نجد طلاباً مسجلين في السنة رقم ({$semester->academic_year_id}). تأكد من جدول enrollments.");
    //         }

    //         // 3. توليد الملفات فوراً (استخدام dispatchSync لضمان التنفيذ الآن)
    //         try {
    //             foreach ($enrollments as $enrollment) {
    //                 \App\Jobs\ProcessStudentGradesJob::dispatchSync($enrollment, $semester);
    //             }
    //             return redirect()->route('academic_years.index')
    //                 ->with('success', "نجاح! تم إغلاق الفصل وتوليد " . $enrollments->count() . " شهادة PDF.");
    //         } catch (\Exception $e) {
    //             return redirect()->route('academic_years.index')
    //                 ->with('error', "حدث خطأ أثناء التوليد: " . $e->getMessage());
    //         }
    //     }

    //     return redirect()->route('academic_years.index')->with('success', 'تم تحديث بيانات الفصل بنجاح وهو لا يزال نشطاً.');
    // }

    public function update(SemesterRequest $request, Semester $semester)
    {
        try {
            return DB::transaction(function () use ($request, $semester) {
                $data = $request->validated();
                $isActive = $request->boolean('is_active');

                // 1. قبل أي شيء، لنبحث هل يوجد "فصل آخر" نشط حالياً؟
                // هذا هو الفصل الذي سيتم إغلاقه تلقائياً
                $previouslyActiveSemester = null;

                if ($isActive) {
                    if (!$semester->academicYear->is_active) {
                        throw new \Exception('Cannot activate this semester because the associated Academic Year is not active.');
                    }

                    // العثور على الفصل النشط حالياً (غير الفصل الذي نقوم بتعديله)
                    $previouslyActiveSemester = Semester::where('is_active', true)
                        ->where('id', '!=', $semester->id)
                        ->first();

                    // إغلاق الفصول الأخرى (المنطق السابق الخاص بك)
                    Semester::where('id', '!=', $semester->id)->update(['is_active' => false]);
                }

                // 2. تحديث الفصل الحالي
                $semester->fill($data);
                $semester->is_active = $isActive;
                $semester->save();

                // 3. منطق توليد الـ PDF (الحالة الأولى): 
                // إذا قمنا بتفعيل فصل جديد، نولد شهادات للفصل الذي أُغلق تلقائياً
                if ($isActive && $previouslyActiveSemester) {
                    $this->generateSemesterPDFs($previouslyActiveSemester);
                }

                // 4. منطق توليد الـ PDF (الحالة الثانية): 
                // إذا قمنا بإغلاق الفصل الحالي يدوياً
                if (!$isActive) {
                    $this->generateSemesterPDFs($semester);
                }

                return redirect()->route('academic_years.index')
                    ->with('success', 'Semester updated and certificates generated successfully!');
            });
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }


    private function generateSemesterPDFs($semester)
    {
        $enrollments = \App\Models\Enrollment::where('academic_year_id', $semester->academic_year_id)->get();
        foreach ($enrollments as $enrollment) {
          
            \App\Jobs\ProcessStudentGradesJob::dispatchSync($enrollment, $semester);
        }
    }
}
