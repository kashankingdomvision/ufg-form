<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name'      => 'required|string|unique:countries',
            'sortname'  => 'required|string|unique:countries',
            'phonecode' => 'required|string|unique:countries',
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
