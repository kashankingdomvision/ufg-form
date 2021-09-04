<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelBookingRequest extends FormRequest
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
            'cancellation_charges' => 'required|numeric|lte:booking_net_price',
            'cancellation_reason' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'cancellation_charges' => 'Cancellation Charges',
            'cancellation_reason' => 'Cancellation Reason',
        ];
    }

    
    public function messages()
    {
        return[

            'cancellation_charges.required'  => 'The Cancellation Charges field is required.',
            'cancellation_reason.required'   => 'The cancellation Reason field is required.',
        ];
    }
}
