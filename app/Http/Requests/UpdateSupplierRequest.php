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
            'email'       => ['required', Rule::unique('suppliers')->ignore(decrypt($this->supplier))],
            'categories'  =>  'required|array',
            'products'    =>  'required|array',
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
            'email'        =>  'Email address',
            'categories'   =>  'Categories',
            'products'     =>  'Products',
        ];
    }
}
