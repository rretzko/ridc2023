<?php

namespace App\Http\Requests\User\Accepteds;

use Illuminate\Foundation\Http\FormRequest;

class RepertoireRequest extends FormRequest
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
            'arranger' => ['nullable','string','min:3','max:120'],
            'composer' => ['nullable','string','min:3','max:120'],
            'choreographer' => ['nullable','string','min:3','max:120'],
            'ensemble_id' => ['required','integer','exists:ensembles,id'],
            'lyricist' => ['nullable','string','min:3','max:120'],
            'minutes' => ['required','integer','min:0','max:59'],
            'order_by' => ['required','integer','min:1','max:7'],
            'notes' => ['nullable','string','min:3','max:255'],
            'seconds' => ['required','integer','min:0','max:59'],
            'subtitle' => ['nullable','string','min:3','max:120'],
            'title' => ['required','string','min:3','max:120'],
        ];
    }
}
