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
            'country_id'    => 'required',
            'location_id'   => 'required',
            'categories'    => 'required|array',
            // 'products'      => 'required|array',
            // 'email'         => 'required|email|unique:suppliers',
            // 'town_id'       => 'required',
        ];
    }
    
    
    public function attributes()
    {
        return [
            'username'     => 'Name',
            'country_id'   => 'Country',
            'location_id'  => 'Location',
            'categories'   => 'Categories',
            // 'products'     =>  'Products',
            // 'email'        =>  'Email address',
            // 'town_id'      =>  'Town',
        ];
    }
}
