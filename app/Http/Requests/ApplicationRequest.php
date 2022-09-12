<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplicationRequest extends FormRequest
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

    public function messages()
    {
        return [
          'hasprimary.required' => 'A primary ensemble OR new ensemble name is required.'
        ];
    }

    protected function prepareForValidation()
    {
        if (((strlen($this->newensemblename) && $this->newensemblecategoryid)) ||
            $this->primary) {

            $this->merge([
                'hasprimary' => true,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address_1' => ['string','nullable'],
            'address_2' => ['string','nullable'],
            'attending_adults' => ['numeric','required','min:1'],
            'attending_students' => ['numeric','required','min:1'],
            'city' => ['string','required','min:3'],
            'email' => ['email','required',Rule::unique('users')->ignore(auth()->id())],
            'geostate_id' => ['numeric','required','min:1','exists:geostates,id'],
            'hasprimary' => ['required'],
            'name' => ['string','required'],
            'newensemblecategoryid' => ['numeric','nullable','exists:categories,id'],
            'newensemblename' => ['string','nullable'],
            'phone_mobile' => ['string','required','min:10'],
            'phone_work' => ['string','nullable','min:10'],
            'postal_code' => ['string','required','min:5'],
            'primary' => ['numeric','nullable','exists:ensembles,id'],
            'school_id' => ['numeric','required','exists:schools,id'],
            'school_name' => ['string','required','min:5'],
            'secondaries' => ['array','nullable'],
            'secondaries.*' => ['numeric','nullable','exists:ensembles,id'],
        ];
    }
}
