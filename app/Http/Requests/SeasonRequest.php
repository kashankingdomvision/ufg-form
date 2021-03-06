<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeasonRequest extends FormRequest
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
            'name'          => 'required|unique:seasons',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date',
            'default'       => 'required',
        ];
    }
    
    public function attributes()
    {
        return [
            'name'          => 'Season Name',
            'start_date'    => 'Start Date',
            'end_date'      => 'End Date',
            'default'       => 'Select Default Season',
        ];
    }
}
