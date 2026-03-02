<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use App\Services\SectionService;
use Exception;

class SectionController extends Controller
{
    protected $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function index()
    {
        $sections = $this->sectionService->getSectionsForIndex();
        return view('sections.index', compact('sections'));
    }

    public function show($sectionId)
    {
        try {
            $section = $this->sectionService->getSectionDetails($sectionId);
            return view('sections.show', compact('section'));
        } catch (Exception $e) {
            return redirect()->route('sections.index')->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        $data = $this->sectionService->getFormData();
        return view('sections.create', $data);
    }

    public function store(SectionRequest $request)
    {
        $this->sectionService->storeSection($request->validated());
        return redirect()->route('sections.index')->with('success', 'تم إضافة الشعبة بنجاح');
    }

    public function edit(Section $section)
    {
        $data = $this->sectionService->getFormData();
        $data['section'] = $section;
        return view('sections.edit', $data);
    }

    public function update(SectionRequest $request, Section $section)
    {
        $this->sectionService->updateSection($section, $request->validated());
        return redirect()->route('sections.index')->with('success', 'section updated successfully.');
    }

    public function destroy(Section $section)
    {
        try {
            $this->sectionService->deleteSection($section);
            return redirect()->route('sections.index')->with('success', 'section deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
