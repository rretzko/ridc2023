<?php

namespace App\Http\Requests\User\Accepteds;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address_1' => ['required','string','min:5','max:200'],
            'address_2' => ['nullable','string','min:5','max:200'],
            'city' => ['required','string','min:5','max:200'],
            'colors' => ['required','array','min:1','max:3'],
            'colors.*' => ['nullable','string','min:3','max:16'],
            'colors.0' => ['required','min:3','max:16'],
            'geostate_id' => ['required','numeric','exists:geostates,id'],
            'postal_code' => ['required','string','min:5','max:16'],
            'school_name' => ['required','string','min:5','max:200'],
            'student_body' => ['required','numeric','min:1','max:10000'],
        ];
    }

    public function messages()
    {
        return [
            'student_body.min' => 'The student population must be at least 1.',
            'student_body.max' => 'The student population must not be greater than 10,000',
            'colors.0.required' => 'At least one color is required.',
            'colors.*.min' => 'A color must be at least 3 characters.',
            'colors.*.max' => 'A color must not be greater than 16 characters.',

        ];
    }
}
