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


    public function update(SemesterRequest $request, Semester $semester)
    {
        try {
            return DB::transaction(function () use ($request, $semester) {
                $data = $request->validated();

               
                $isActive = $request->boolean('is_active');

                if ($isActive) {
                 
                    if (!$semester->academicYear->is_active) {
                   
                        throw new \Exception('Cannot activate this semester because the associated Academic Year is not active.');
                    }

                  
                    Semester::where('id', '!=', $semester->id)->update(['is_active' => false]);
                }
               
                $semester->update($data);

                return redirect()->route('academic_years.index')
                    ->with('success', 'Semester details updated successfully!');
            });
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
