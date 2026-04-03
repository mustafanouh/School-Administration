<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeePhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
          
            'photo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp', 
                'max:2048', 
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'photo.required' => 'please select a photo to upload.',
            'photo.image'    => 'the uploaded file must be an image.',
            'photo.max'      => 'the image is too large. the maximum size is 2 mb.',
        ];
    }
}
