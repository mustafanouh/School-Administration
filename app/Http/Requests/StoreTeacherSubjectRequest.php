<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeacherSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'teacher_id' => 'required|exists:teachers,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => [ // validation rule to ensure the same subject is not assigned to the same section in the same academic year
                'required',
                'exists:subjects,id',
                Rule::unique('teacher_subjects')->where(function ($query) {
                    return $query->where('section_id', $this->section_id)
                        ->where('academic_year_id', $this->academic_year_id);
                })->ignore($this->teacher_subject)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'subject_id.unique' => 'this subject is already assigned to this section for the selected academic year. Please choose a different subject or section.',
        ];
    }
}
