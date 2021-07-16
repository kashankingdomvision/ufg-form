<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateRequest extends FormRequest
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
            'template_name' =>  'required',
            // 'season_id'     =>  'required',
            // 'currency_id'   =>  'required',
            // 'rate_type'     =>  'required',
            // 'quote'                             =>  'required|array',
            // 'quote.*.booking_due_date'          =>  'required',
            // 'quote.*.supplier_currency_id'      =>  'required',
        ];
    }


    public function attributes()
    {
        return [
            'template_name' => 'Template Name',
            // 'season_id'     => 'Booking season',
            // 'currency_id'   => 'Booking currency',
            // 'rate_type'     => 'Rate type',
            // 'quote.*.booking_due_date'          => 'Booking Due Date',
            // 'quote.*.supplier_currency_id'      => 'Supplier currency',
        ];
    }
}
