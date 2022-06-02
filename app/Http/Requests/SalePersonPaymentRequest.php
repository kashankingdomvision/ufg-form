<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalePersonPaymentRequest extends FormRequest
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
            'sale_person_id' => 'required',
            'balance_owed_amount' => 'required',

        ];
    }
    
    public function attributes()
    {
        return [
            'batchsale_person_id_name' => 'Sale Person',
            'balance_owed_amount' => 'Balance Owed Amount',
        ];
    }

    // public function messages()
    // {
    //     return[
    //         'payment_method_id.required_if'                       => 'The Payment Method field is required.',
    //     ];
    // }
}
