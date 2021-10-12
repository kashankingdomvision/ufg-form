<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRateSheetRequest extends FormRequest
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
            'supplier_id'   =>  'required',
            'season_id'     =>  'required',
            'file'          =>  'mimes:jpeg,png,pdf'
           
        ];
    }

    public function attributes()
    {
        return [
            'supplier_id' => 'Supplier',
            'season_id'   => 'Season',
            'file'        => 'Rate Sheet',
        ];
    }
}
