<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateRequests extends FormRequest
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
            'template_name' => 'required',
            'season_id'     => 'required',
        ];
    }

    public function attributes()
    {
        return [
           'template_name'    => 'Template Name',
           'season_id'        => 'Season',
        ];
    }
}
