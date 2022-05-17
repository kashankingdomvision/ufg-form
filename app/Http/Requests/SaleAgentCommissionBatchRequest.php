<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleAgentCommissionBatchRequest extends FormRequest
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
            'batch_name' => 'required',
            'payment_method_id' => 'required'
        ];
    }
    
    public function attributes()
    {
        return [
            'batch_name' => 'Batch Name',
            'payment_method_id' => 'Payment Method'
        ];
    }
}
