<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAirportCodeRequest extends FormRequest
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
            'name'       => ['required', Rule::unique('airport_codes','name')->ignore(decrypt($this->id))],
            'iata_code'  => ['required', Rule::unique('airport_codes','iata_code')->ignore(decrypt($this->id))],      
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
