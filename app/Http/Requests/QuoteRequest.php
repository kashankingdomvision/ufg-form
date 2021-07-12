<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
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
            'agency'                            =>  'required',
            'agency_name'                       =>  'required_if:agency,yes',
            'agency_contact'                    =>  'required_if:agency,yes',
            'commission_id'                     =>  'required',
            'season_id'                         =>  'required',
            'brand_id'                          =>  'required',
            'currency_id'                       =>  'required',
            'holiday_type_id'                   =>  'required',
            'ref_no'                            =>  'required',
            'quote_no'                          =>  'required',
            'lead_passenger'                    =>  'required',
            'sale_person_id'                    =>  'required',
            'agency'                            =>  'required',
            'dinning_preference'                =>  'required',
            'bedding_preference'                =>  'required',
            'pax_no'                            =>  'required',
            'rate_type'                         =>  'required',
            'quote'                             =>  'required|array',
            'quote.*.booking_due_date'          =>  'required',
            'quote.*.supplier_currency_id'      =>  'required',
            'quote.*.estimated_cost'            =>  'required',
            'quote.*.markup_amount'             =>  'required',
            'quote.*.markup_percentage'         =>  'required',
            'quote.*.selling_price_in_booking_currency' => 'required',
            'quote.*.markup_amount_in_booking_currency' => 'required',
            // 'quote.*.added_in_sage'             =>  'required',
            'quote.*.supplier_id'               =>  'nullable',
            'quote.*.product_id'                =>  'nullable',
            'quote.*.booking_method_id'         =>  'nullable',
            'quote.*.booked_by_id'              =>  'nullable',
            'quote.*.supervisor_id'             =>  'nullable',
        ];
    }
    
    public function attributes()
    {
        return [
            'agency'                            => 'Agency',
            'agency_name.required_if'           => 'Agency Name',
            'agency_contact.required_if'        => 'Agency Contact',
            'season_id'                         => 'Booking season',
            'brand_id'                          => 'Brand',
            'currency_id'                       => 'Booking currency',
            'holiday_type_id'                   => 'Holiday type',
            'ref_no'                            => 'Zoho reference',
            'quote_no'                          => 'Quote reference',
            'lead_passenger'                    => 'Lead Passenger name',
            'sale_person_id'                    => 'Sale person',
            'agency'                            => 'Agency',
            'dinning_preference'                => 'Dinning Preference',
            'bedding_preference'                => 'Bedding Preference',
            'pax_no'                            => 'Pax number ',
            'rate_type'                         => 'Rate type',
            'quote.*.booking_due_date'          => 'Booking Due Date',
            'quote.*.supplier_currency_id'      => 'Supplier currency',
            'quote.*.estimated_cost'            => 'Estimated cost',
            'quote.*.markup_amount'             => 'Markup amount',
            'quote.*.markup_percentage'         => 'Markup percentage',
            'quote.*.selling_price_in_booking_currency' => 'Selling price booking',
            'quote.*.markup_amount_in_booking_currency' => 'Markup amount booking',
            // 'quote.*.added_in_sage'             =>  'Added in sage',
            'quote.*.supplier_id'               =>  'Supplier',
            'quote.*.product_id'                =>  'Product',
            'quote.*.booking_method_id'         =>  'Booking method',
            'quote.*.booked_by_id'              =>  'Booked By',
            'quote.*.supervisor_id'             =>  'Supervisor',
        ];
    }
}
