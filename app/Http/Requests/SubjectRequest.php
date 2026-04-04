<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'track_id' => 'required|exists:tracks,id',
            'min_mark' => 'required|numeric|min:0',
            'max_mark' => 'required|numeric|min:0|gt:min_mark',
            'semester' => 'required|in:first semester,second semester,other',
            'description' => 'string'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The subject name is required.',
            'grade_id.required' => 'Please select a grade for the subject.',
            'grade_id.exists' => 'The selected grade does not exist.',
            'track_id.required' => 'Please select a track for the subject.',
            'track_id.exists' => 'The selected track does not exist.',
            'min_mark.required' => 'Minimum mark is required.',
            'min_mark.numeric' => 'Minimum mark must be a number.',
            'min_mark.min' => 'Minimum mark must be at least 0.',
            'max_mark.required' => 'Maximum mark is required.',
            'max_mark.numeric' => 'Maximum mark must be a number.',
            'max_mark.min' => 'Maximum mark must be at least 0.',
            'max_mark.gt' => 'Maximum mark must be greater than minimum mark.',
            'semester.required' => 'Please select a semester for the subject.',
            'semester.in' => 'Semester must be one of: first semester, second semester, other.',
            'description.string' => 'Description must be a string.'
        ];
    }
}
