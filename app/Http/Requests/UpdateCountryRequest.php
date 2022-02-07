<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCountryRequest extends FormRequest
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
            'name'      => ['required', Rule::unique('countries')->ignore(decrypt($this->id))],
            'sortname'  => ['required', Rule::unique('countries')->ignore(decrypt($this->id))],
            'phonecode' => ['required', Rule::unique('countries')->ignore(decrypt($this->id))],
        ];
    }
    
    public function attributes()
    {
        return [
            'name'      => 'Country Name',
            'sortname'  => 'Sort Name',
            'phonecode' => 'Phone Code',
        ];
    }
}
