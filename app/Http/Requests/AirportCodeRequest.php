<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AirportCodeRequest extends FormRequest
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
            'name'       => 'required',
            'iata_code'  => 'required'        
        ];
    }

    public function attributes()
    {
        return [
            'name'       => 'Airport Name',
            'iata_code'  => 'IATA Code',
        ];
    }
}
