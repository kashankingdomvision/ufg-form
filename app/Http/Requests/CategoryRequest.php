<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'label_of_time' => 'required_if:show_tf,1',
            'name'          => 'required|string|unique:categories',
            'sort_order'    => 'required|integer'
            // 'sort_order' => 'required|string|unique:categories'
        ];
    }
    
    public function attributes()
    {
        return [
            'label_of_time' => 'Label of Time Feild',
            'name'          => 'Category name',
            'sort_order'    => 'Sort Order',
        ];
    }

    public function messages()
    {
        return[
            'label_of_time.required_if' => 'The Label of Time Feild field is required.',
        ];
    }
}
