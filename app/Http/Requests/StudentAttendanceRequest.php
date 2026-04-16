<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentAttendanceRequest extends FormRequest
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
            'section_id' => 'required|exists:sections,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
        ];
    }
    public function messages()
    {
        return [
            'section_id.required' => 'The section field is required.',
            'section_id.exists' => 'The selected section is invalid.',
            'attendance_date.required' => 'The attendance date field is required.',
            'attendance_date.date' => 'The attendance date must be a valid date.',
            'attendance.required' => 'The attendance data is required.',
            'attendance.array' => 'The attendance data must be an array.',
        ];
    }
}
