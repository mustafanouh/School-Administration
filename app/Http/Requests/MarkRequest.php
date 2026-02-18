<?php

namespace App\Http\Requests;

use App\Models\Exam;
use Illuminate\Foundation\Http\FormRequest;

class MarkRequest extends FormRequest
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
            'enrollment_id' => 'required|exists:enrollments,id',
            'exam_id'       => 'required|exists:exams,id',
            'score'         => [
                'required',
                'numeric',
                'min:0',
                // قاعدة مخصصة لضمان أن الدرجة لا تتعدى الدرجة العظمى للامتحان المختار
                function ($attribute, $value, $fail) {
                    $exam = Exam::find($this->exam_id);
                    if ($exam && $value > $exam->max_mark) {
                        $fail("The score cannot be greater than the exam's maximum mark ({$exam->max_mark}).");
                    }
                },
            ],
            'status'   => 'required|in:passed,failed',
            'max_mark' => 'nullable|numeric',
        ];
    }
}
