<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'username'    => ['required', Rule::unique('suppliers','name')->ignore(decrypt($this->supplier))],
            'country_id'  => 'required',
            'location_id' => 'required',
            'categories'  =>  'required|array',
            // 'products'    =>  'required|array',
            // 'email'       => ['required', Rule::unique('suppliers')->ignore(decrypt($this->supplier))],
            // 'town_id'     => 'required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'username'     =>  'Name',
            'country_id'   =>  'Country',
            'location_id'  =>  'Location',
            'categories'   =>  'Categories',
            // 'products'     =>  'Products',
            // 'email'        =>  'Email address',
            // 'town_id'      =>  'Town',
        ];
    }
}
