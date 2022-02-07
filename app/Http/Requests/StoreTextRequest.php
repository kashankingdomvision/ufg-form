<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTextRequest extends FormRequest
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
            'name'          => 'required',
            'page_title'    => 'required',
            'description'   => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'        => 'Stored Text Name',
            'page_title'  => 'Title',
            'description' => 'Text',
        ];
    }
}
