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
            'batch_name'                      => 'required|unique:sac_batches,name',
            'payment_method_id'               => 'required_if:send_to_agent,1',
            'finance.*.pay_commission_amount' => 'exclude_unless:finance.*.finance_child,1|gt:0',
        ];
    }
    
    public function attributes()
    {
        return [
            'batch_name'        => 'Batch Name',
            'payment_method_id' => 'Payment Method',
            'finance.*.pay_commission_amount' => 'Commission Amount',

        ];
    }

    public function messages()
    {
        return[
            'payment_method_id.required_if'                       => 'The Payment Method field is required.',

            'finance.*.pay_commission_amount.not_in' => 'Amount should be greater than 0.',
        ];
    }
}
