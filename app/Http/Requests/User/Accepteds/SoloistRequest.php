<?php

namespace App\Http\Requests\User\Accepteds;

use Illuminate\Foundation\Http\FormRequest;

class SoloistRequest extends FormRequest
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

    protected function prepareForValidation()
    {
//        if(! $this->concert_1){
//
//            $this->request->remove('concert_1');
//        }
//
//        if(! $this->concert_2){
//
//            $this->request->remove('concert_2');
//        }
//
//        if(! $this->jazzpopshow_1){
//
//            $this->request->remove('jazzpopshow_1');
//        }
//
//        if(! $this->jazzpopshow_2){
//
//            $this->request->remove('jazzpopshow_2');
//        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'soloistType' => ['required', 'numeric', 'min:0', 'max:1'],
            'studentId' => ['required', 'numeric', 'min:1'],
            'title' => ['required', 'string'],
            'composer' => ['required', 'string'],
        ];

//        return [
//            [
//                'concert_1' => ['nullable','integer','exists:students,id'],
//                'concert_2' => ['nullable','integer','exists:students,id'],
//                'jazzpopshow_1' => ['nullable','integer','exists:students,id'],
//                'jazzpopshow_2' => ['nullable','integer','exists:students,id'],
//            ]
//        ];
    }

    public function messages()
    {
        return [
            'studentId.required' => 'A student must be selected.',
            'studentId.min' => 'A student must be selected.',
        ];
    }
}
