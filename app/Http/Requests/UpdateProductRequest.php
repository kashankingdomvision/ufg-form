<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

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
    public function rules(Request $request)
    {
        return [
            'code'        => ['required', Rule::unique('products')->ignore(decrypt($request->id))],
            'name'        => ['required', Rule::unique('products')->ignore(decrypt($request->id))],
            'category_id' => 'required',
            // 'location_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'          => 'Product name',
            'code'          => 'Product code',
            'category_id'   => 'Category',

            // 'location_id'   => 'Location',
            // 'description'   => 'Product description',
        ];
    }
}
