<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRefundPaymentRequest extends FormRequest
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
            'refund_amount'       =>  'required',
            'refund_date'         =>  'required',
            'bank'                =>  'required',
            'refund_confirmed_by' =>  'required'
        ];
    }

    public function messages()
    {
        return[
            'refund_amount.required'        => 'The Refund Amount field is required.',
            'refund_date.required'          => 'The Refund Date field is required.',
            'bank.required'                 => 'The Bank field is required.',
            'refund_confirmed_by.required'  => 'The Refund Confirmed By field is required.'
        ];
    }

    public function attributes()
    {
        return[
            'refund_amount.required'        => 'Refund Amount',
            'refund_date.required'          => 'Refund Date',
            'bank.required'                 => 'Bank',
            'refund_confirmed_by.required'  => 'Refund Confirmed By'
        ];
    }
}
