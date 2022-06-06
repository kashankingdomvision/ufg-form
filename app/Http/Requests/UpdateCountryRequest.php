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
            'name'       => ['required', Rule::unique('countries', 'name')->ignore(decrypt($this->id))],
            'sort_order' => 'required',
        ];
    }
    
    public function attributes()
    {
        return [
            'name'       => 'Country Name',
            'sort_order' => 'Sort Order',
        ];
    }
}
