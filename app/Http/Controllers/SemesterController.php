<?php

namespace App\Http\Controllers;

use App\Http\Requests\SemesterRequest;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function edit($id)
    {
        $semester = Semester::findOrFail($id); // هذا يعيد كائناً واحداً (Object)
        return view('admin.semesters.edit', compact('semester'));
    }


    public function update(SemesterRequest $request, Semester $semester)
    {
        $data = $request->validated();

        // منطق الفصل النشط للسنة الحالية فقط
        if ($request->boolean('is_active')) {
            Semester::where('academic_year_id', $semester->academic_year_id)
                ->update(['is_active' => false]);
        }

        $semester->update($data);

        return redirect()->route('admin.academic_years.index')
            ->with('success', 'Semester details updated successfully!');
    }
}
