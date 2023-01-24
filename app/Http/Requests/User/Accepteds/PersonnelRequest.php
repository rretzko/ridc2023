<?php

namespace App\Http\Requests\User\Accepteds;

use Illuminate\Foundation\Http\FormRequest;

class PersonnelRequest extends FormRequest
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
            'school_id' => ['required','integer','exists:schools,id'],
            'arrival_time' => ['required','string'],
            'accommodation' => ['nullable','string'],
            'chaperones' => ['array','min:0','max:3'],
            'chaperone.*' => ['nullable','string'],
        ];
    }
}
