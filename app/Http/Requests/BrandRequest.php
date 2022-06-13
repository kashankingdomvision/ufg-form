<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name'  => 'required|unique:brands',
            'phone' => 'required',
            // 'logo'  =>  'required'
        ];
    }

    public function attributes()
    {
        return [
            'name'  => 'Brand Name',
            'phone' => 'Contact Number',
            // 'logo'  => 'Logo'
        ];
    }
}
