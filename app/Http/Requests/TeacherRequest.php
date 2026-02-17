<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        'employee_id' => 'required|exists:employees,id', 
        'specialization' => 'required|string|max:255',
    ];
    }

     public function messages(): array
    {
        return [
            'employee_id.required' => 'يجب اختيار الموظف',
            'employee_id.exists' => 'الموظف المختار غير موجود',
            'employee_id.unique' => 'الموظف مسجل مسبقًا كمعلم',
            'specialization.required' => 'يجب إدخال التخصص',
            'specialization.string' => 'التخصص يجب أن يكون نصًا',
            'specialization.max' => 'التخصص طويل جدًا، الحد الأقصى 255 حرف',
        ];
    }
}
