<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSystems extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|unique:systems',
            'reference_code'    => 'required|unique:systems',
            'reference_number'  => 'required|unique:systems',
            'description'       => 'required',
            'url'               => 'required',
            'date_deployed'     => 'required',
            'status'            => 'required',
            'section_owner'     => 'required',
            'abbreviation'      => 'required',
        ];
    }

    public $validator = null;
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
}
