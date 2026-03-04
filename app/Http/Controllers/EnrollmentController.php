<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentRequest;
use App\Models\Enrollment;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    protected $enrollmentService;

    /**
     * حقن التبعيات (Dependency Injection)
     */
    public function __construct(EnrollmentService $enrollmentService)
    {
        $this->enrollmentService = $enrollmentService;
    }

    /**
     * عرض قائمة التسجيلات
     */
    public function index()
    {
        $enrollments = $this->enrollmentService->getIndexData();
        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * عرض نموذج تسجيل جديد
     */
    public function create()
    {
        try {
            $data = $this->enrollmentService->getCreateFormData();
            return view('admin.enrollments.create', $data);
        } catch (Exception $e) {
            // في حال عدم وجود سنة نشطة أو أي خطأ منطقي آخر من السيرفس
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * حفظ عملية التسجيل
     */
    public function store(EnrollmentRequest $request)
    {
        try {
            $this->enrollmentService->storeEnrollment($request->validated());

            return redirect()
                ->route('enrollments.index')
                ->with('success', 'Student has been successfully enrolled.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * عرض نموذج التعديل
     */
    public function edit(Enrollment $enrollment)
    {
        $data = $this->enrollmentService->getEditFormData($enrollment);
        return view('admin.enrollments.edit', $data);
    }

    /**
     * تحديث بيانات التسجيل
     */
    public function update(EnrollmentRequest $request, Enrollment $enrollment)
    {
        try {
            $this->enrollmentService->updateEnrollment($enrollment, $request->validated());

            return redirect()
                ->route('enrollments.index')
                ->with('success', 'Enrollment details updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * حذف سجل التسجيل
     */
    public function destroy(Enrollment $enrollment)
    {
        try {
            $this->enrollmentService->deleteEnrollment($enrollment);

            return redirect()
                ->route('enrollments.index')
                ->with('success', 'Enrollment record deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
   
}
