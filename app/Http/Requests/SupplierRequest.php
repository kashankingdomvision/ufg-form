<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'username'      => 'required|unique:suppliers,name',
            'email'         => 'required|email|unique:suppliers',
            'country_id'    => 'required',
            'town_id'       => 'required',
            'categories'    => 'required|array',
            'products'      => 'required|array',
        ];
    }
    
    
    public function attributes()
    {
        return [
            'username'     =>  'Name',
            'email'        =>  'Email address',
            'country_id'   =>  'Country',
            'town_id'      =>  'Town',
            'categories'   =>  'Categories',
            'products'     =>  'Products',
        ];
    }
}
