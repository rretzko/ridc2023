<?php

namespace App\Http\Requests\User\Accepteds;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'email' => ['required','email',Rule::unique('users')->ignore(auth()->id())],
            'first' => ['required','string'],
            'honorific_id' => ['required','numeric','exists:honorifics,id'],
            'job_title' => ['required','string','max:60'],
            'last' => ['required','string','min:2'],
            'middle' => ['nullable','string'],
            'phone_mobile' => ['required','string','min:10','max:20'],
            'phone_work' => ['nullable','string','min:10','max:20'],
            'suffix' => ['nullable','string'],
        ];
    }
}
