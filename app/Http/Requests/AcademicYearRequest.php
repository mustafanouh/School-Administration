<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AcademicYearRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $academicYearId = $this->route('academic_year');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('academic_years', 'name')->ignore($academicYearId),
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ];
    }


    public function attributes(): array
    {
        return [
            'name' => 'Academic Year Name',
            'is_active' => 'Status',
        ];
    }


    public function messages(): array
    {
        return [
            'name.unique' => 'This academic year has already been registered.',
        ];
    }
}
