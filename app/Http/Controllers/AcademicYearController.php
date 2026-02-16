<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AcademicYearController extends Controller
{
    //عرض جميع السنوات الدراسية
    public function index()
    {
         $academicYears = AcademicYear::all();
         return response()->json($academicYears);
    }
    //عرض سنة دراسية واحدة
    public function show($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        return response()->json($academicYear);
    }
    //إنشاء سنة دراسية جديدي
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name'=>'required|string|unique:academic_years',
            'is_active' => 'boolean',
         ] );
         $academicYear = AcademicYear::create($validated);

    // إذا كانت السنة الجديدة مفعلة، عطّل السنة القديمة
         if ($validated['is_active'] ?? false){
            $this->deactivateOtherAcademicYears($academicYear->id);
         }
        return response()->json([
             'message' => 'تم إنشاء السنة الدراسية بنجاح',
            'data' => $academicYear
        ],201); 

    }
    //تحديث سنة دراسية
    public function update(Request $request, $id)
    {
        $academicYear =AcademicYear::findOrFail($id);

        $validated = $request->validate([
             'name' => 'required|string|unique:academic_years,name,' . $id,
            'is_active' => 'boolean'
        ]);
    // إذا تم تفعيل هذه السنة، عطّل السنوات الأخرى
    if ($validated['is_active'] ?? false){
        $this->deactivateOtherAcademicYears($academicYear->id);

    }
    
    $academicYear->update($validated);

    return  response()->json([
        'massage' =>'تم تحديث السنة الدراسية بنجاح',
        'data' => $academicYear
    ]);

    }
     // تفعيل سنة دراسية
    public function activate($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
         // عطّل جميع السنوات الأخرى
        $this->deactivateOtherAcademicYears($id);
        // فعّل السنة الحالية
        $academicYear->update(['is_active' => true]);

        return response()->json([
            'message' => 'تم تفعيل السنة الدراسية بنجاح',
            'data' => $academicYear
        ]);


    }
    public function destroy($id){
        $academicYear = AcademicYear::findOrFail($id);

        //التحقق من وجود قيود طلاب
        if($academicYear->hasEnrollments()){
            return response()->json([
                'message' =>'لا يمكن حذف هذه السنة الدراسية لأنها تحوي قيود طلاب',
                'enrollments_count' =>$academicYear->enrollments()->count()
            ],409);
        }
        // التحقق من وجود فصول دراسية
        if ($academicYear->sections()->count() > 0) {
            return response()->json([
                'message' => 'لا يمكن حذف هذه السنة الدراسية لأنها تحتوي على فصول دراسية',
                'sections_count' => $academicYear->sections()->count()
            ], 409);
        }

        $academicYear->delete();

        return response()->json([
            'message' => 'تم حذف السنة الدراسية بنجاح'
        ]);
    }
    // تعطيل جميع السنوات الأخرى
    private function deactivateOtherAcademicYears($exceptId){
        AcademicYear::where('id' , '!=' , $exceptId)
        ->update(['is_active' => false]);
    }
     // الحصول على السنة المفعلة الحالية
     public function getActiveYear()
     {
        $activeYear = AcademicYear::active()->first();

        if(!$activeYear){
            return response()->json([
                'message' =>'لا توجد سنة دراسية مفعلة حاليا'
            ], 404);
        }
         return response()->json($activeYear);
     }

    }


