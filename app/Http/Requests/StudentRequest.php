<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'first' => ['required','string','min:2','max:60'],
            'last' => ['required','string','min:2','max:60'],
            'middle' => ['nullable','string', 'min:1', 'max:60'],
            'class_of' => ['required','numeric','min:2023','max:2050'],
        ];
    }
}
