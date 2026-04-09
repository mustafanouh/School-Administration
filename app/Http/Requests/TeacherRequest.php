<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => [
                'required',
                'exists:employees,id',
                Rule::unique('teachers', 'employee_id')->ignore($this->teacher),

            ],
            'specialization' => 'required|string|max:255',
            'stage' => 'required|in:Primary,Middle,High',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'The employee ID is required',
            'employee_id.exists' => 'The employee ID was not found in the employees table',
            'employee_id.unique' => 'This employee is already registered as a teacher',
            'specialization.required' => 'The specialization field is required',
            'specialization.string' => 'The specialization must be a string',
            'specialization.max' => 'The specialization is too long, the maximum is 255 characters',
            'stage.required' => 'The stage field is required',
            'stage.in' => 'The stage must be one of the following: Primary, Middle, High',
        ];
    }
}
