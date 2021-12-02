<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'code'        => ['required', Rule::unique('products')->ignore(decrypt($this->product))],
            'name'        => ['required', Rule::unique('products')->ignore(decrypt($this->product))],
            'location_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'          => 'Product name',
            'code'          => 'Product code',
            'location_id'   => 'Location',
            // 'description'   => 'Product description',
        ];
    }
}
