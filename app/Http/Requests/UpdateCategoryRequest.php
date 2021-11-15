<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
        // dd($this->all());
        return [
            'name'        => ['required', Rule::unique('categories')->ignore(decrypt($this->id))],
            'sort_order'  => 'required|integer'
            // 'sort_order'  => ['required', Rule::unique('categories')->ignore(decrypt($this->id))],
        ];

    }

    public function attributes()
    {
        return [
            'name'       => 'Category name',
            'sort_order' => 'Sort Order',
        ];
    }
}
