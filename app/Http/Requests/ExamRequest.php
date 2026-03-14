<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamRequest extends FormRequest
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
            'subject_id' => [
                'required',
                'exists:subjects,id',
            //     Rule::unique('exams')->where(function ($query) {
            //         return $query->where('subject_id', $this->subject_id)
            //             ->where('semester_id', $this->semester_id);
            //     }),
            ],
            'semester_id' => 'required|exists:semesters,id',
            'exam_type'   => 'required|string|max:100',
            'max_mark'    => 'required|numeric|min:0',
        ];
    }
}
