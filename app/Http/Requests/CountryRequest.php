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
            'name'       => 'required|string|unique:countries',
            'sort_order' => 'required',
            'phone'  => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'       => 'Country Name',
            'sort_order' => 'Sort Order',
            'phone'  => 'Phone Code',
        ];
    }
}
