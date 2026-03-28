<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
        $employeeId = $this->route('employee');
        return [
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'gender'      => 'required|in:Male,Female',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string|max:255',
            'salary'      => 'required|numeric|min:0',
            'birth_date'  => 'required|date',
            'status'      => 'required|in:active,on_leave,resigned',
            'hire_data'   => 'required|date',
            'job_title'   => 'required|string|max:255',
            'notional_id' => [
                'required',
                'string',
                Rule::unique('employees', 'notional_id')->ignore($employeeId),
               ],
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('employees', 'user_id')->ignore($employeeId),
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'gender.in' => 'The gender must be either male or female.',
            'birth_date.before' => 'The date of birth must be a date before today.',
            'phone.required' => 'We need the employee phone number to contact them.',
        ];
    }
}
