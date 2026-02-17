<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'          => 'required|string|max:50',
            'last_name'           => 'required|string|max:50',
            'gender'              => 'required|in:male,female',
            'date_of_birth'       => 'required|date|before:today',
            'place_of_birth'      => 'required|string|max:100',
            'nationality'         => 'required|string|max:50',
            'address'             => 'required|string|max:255',
            'phone_number'        => 'required|string|max:20',
            'mother_name'         => 'required|string|max:100',
            'mother_phone_number' => 'required|string|max:20',
            'mother_email'        => 'nullable|email|max:100',
            'father_name'         => 'required|string|max:100',
            'father_phone_number' => 'required|string|max:20',
            'father_email'        => 'nullable|email|max:100',
            'blood_group'         => 'nullable|string|max:5|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
        ];
    }


    public function messages(): array
    {
        return [
            'gender.in' => 'Please select a valid gender (Male or Female).',
            'date_of_birth.before' => 'The birth date must be in the past.',
            'blood_group.in' => 'Please select a valid blood group.',
        ];
    }
}
