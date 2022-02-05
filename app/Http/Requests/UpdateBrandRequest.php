<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
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
            'name'  => ['required', Rule::unique('brands','name')->ignore(decrypt($this->id))],
            'phone' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'  => 'Brand Name',
            'phone' => 'Contact Number',
        ];
    }
}
