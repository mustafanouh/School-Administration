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

   
    public function index()
    {
        $enrollments = $this->enrollmentService->getIndexData();
        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        try {
            $data = $this->enrollmentService->getCreateFormData();
            return view('admin.enrollments.create', $data);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

   
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

   
    public function edit(Enrollment $enrollment)
    {
        $data = $this->enrollmentService->getEditFormData($enrollment);
        return view('admin.enrollments.edit', $data);
    }

  
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
