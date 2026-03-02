<?php

namespace App\Http\Controllers;
use App\Http\Requests\AcademicYearRequest;
use App\Models\AcademicYear;
use App\Services\AcademicYearService;
use Exception;

class AcademicYearController extends Controller
{
    protected $service;

    public function __construct(AcademicYearService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $academicYears = AcademicYear::paginate(10);
        return view('admin.academic_years.index', compact('academicYears'));
    }

    public function store(AcademicYearRequest $request)
    {
        try {
            $this->service->storeYearWithSemesters($request->validated());
            return redirect()->route('academic_years.index')
                ->with('success', 'Academic year created with default semesters!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(AcademicYearRequest $request, AcademicYear $academicYear)
    {
        try {
            $this->service->updateYear($academicYear, $request->validated());
            return redirect()->route('academic_years.index')->with('success', 'Updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy(AcademicYear $academicYear)
    {
        try {
            $this->service->deleteYear($academicYear);
            return redirect()->route('academic_years.index')->with('success', 'Deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function create()
    {
        return view('admin.academic_years.create');
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('admin.academic_years.edit', compact('academicYear'));
    }
}
