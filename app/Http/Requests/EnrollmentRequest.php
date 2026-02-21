<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnrollmentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    // public function rules(): array
    // {
    //     return [
    //         'student_id' => [
    //             'required',
    //             'exists:students,id',
    //             Rule::unique('enrollments')
    //                 ->where('academic_year_id', $this->academic_year_id)
    //                 ->ignore($this->route('enrollment'))
    //         ],

    //         'section_id' => ['required', 'exists:sections,id'],
    //         'academic_year_id' => ['required', 'exists:academic_years,id'],
    //         'track_id' => ['required', 'exists:tracks,id'],
    //         'status' => ['required', Rule::in(['enrolled', 'graduated', 'dropped'])],
    //         'enrollment_date' => ['required', 'date'],
    //     ];
    // }
    public function rules(): array
    {
        return [
            'student_id' => [
                'required',
                'exists:students,id',
                Rule::unique('enrollments', 'student_id')
                    ->where(function ($query) {
                        return $query->where('academic_year_id', $this->academic_year_id);
                    })
                    ->ignore($this->route('enrollment')) // سيعمل في التحديث ويتجاهله في الإضافة
            ],
            'section_id' => ['required', 'exists:sections,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'track_id' => ['required', 'exists:tracks,id'],
            'status' => ['required', Rule::in(['enrolled', 'graduated', 'dropped'])],
            'enrollment_date' => ['required', 'date'],
        ];
    }


    public function attributes(): array
    {
        return [
            'student_id' => 'Student',
            'section_id' => 'Section',
            'academic_year_id' => 'Academic Year',
            'track_id' => 'Track',
            'enrollment_date' => 'Enrollment Date',
        ];
    }
}
