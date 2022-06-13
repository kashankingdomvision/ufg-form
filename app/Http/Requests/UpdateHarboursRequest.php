<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateHarboursRequest extends FormRequest
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
            'port_id'  => ['required', Rule::unique('harbours','port_id')->ignore(decrypt($this->id))],        
            'name'     => ['required', Rule::unique('harbours','name')->ignore(decrypt($this->id))],  
        ];
    }
    
    public function attributes()
    {
        return [
            'port_id' => 'Port ID',
            'name'    => 'Harbours, Train and Points of Interest Name',
        ];
    }
}
