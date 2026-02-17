<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,' . $this->student,
            'password' => $this->isMethod('post') ? 'required|string|min:8|confirmed' : 'nullable|string|min:8|confirmed',
            'grade_id' => 'required|exists:grades,id',
            'section_id' => 'required|exists:sections,id',
            'role' => 'required|in:student', 
        ];
    }

      public function messages(): array
    {
        return [
            'name.required' => 'اسم الطالب مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا',
            'email.unique' => 'البريد الإلكتروني مستخدم مسبقًا',
            'password.required' => 'كلمة المرور مطلوبة',
            'grade_id.required' => 'يجب اختيار الصف الدراسي',
            'section_id.required' => 'يجب اختيار الشعبة',
        ];
    }
}
