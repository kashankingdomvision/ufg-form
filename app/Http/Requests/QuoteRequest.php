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
            'agency_name'                       =>  'required_if:agency,1',
            'agency_contact'                    =>  'required_if:agency,1',
            'agency_email'                      =>  'required_if:agency,1',
            'agency_contact_name'               =>  'required_if:agency,1',
            'commission_id'                     =>  'required',
            'season_id'                         =>  'required',
            'brand_id'                          =>  'required',
            'currency_id'                       =>  'required',
            'holiday_type_id'                   =>  'required',
            'ref_no'                            =>  'required',
            'quote_no'                          =>  'required',
            'lead_passenger_name'               =>  'required_if:agency,0',
            'lead_passenger_email'              =>  'required_if:agency,0',
            'lead_passenger_contact'            =>  'required_if:agency,0',    
            'lead_passenger_dbo'                =>  'required_if:agency,0',
            'lead_passsenger_nationailty_id'    =>  'required_if:agency,0', 
            'lead_passenger_dinning_preference' =>  'required_if:agency,0', 
            'lead_passenger_bedding_preference' =>  'required_if:agency,0', 
            'sale_person_id'                    =>  'required',
            'agency'                            =>  'required',
            'pax_no'                            =>  'required',
            'rate_type'                         =>  'required',
            'quote'                             =>  'required|array',
            'quote.*.date_of_service'           =>  'required',
            'quote.*.category_id'               =>  'required',
            'quote.*.supplier_id'               =>  'required',
            'quote.*.booking_due_date'          =>  'required',
            'quote.*.supplier_currency_id'      =>  'required',
            'quote.*.estimated_cost'            =>  'required',
            'quote.*.markup_amount'             =>  'required',
            'quote.*.markup_percentage'         =>  'required',
            'quote.*.selling_price_in_booking_currency' => 'required',
            'quote.*.markup_amount_in_booking_currency' => 'required',
            // 'quote.*.added_in_sage'             =>  'required',
            // 'quote.*.supplier_id'               =>  'nullable',
            'quote.*.product_id'                =>  'nullable',
            'quote.*.booking_method_id'         =>  'nullable',
            'quote.*.booked_by_id'              =>  'nullable',
            'quote.*.supervisor_id'             =>  'nullable',
        ];
    }

    public function messages()
    {
        return[

            'agency_name.required_if'           => 'The Agency Name field is required.',
            'agency_contact.required_if'        => 'The Agency Contact field is required.',
            'agency_email.required_if'          => 'The Agency Email field is required.',
            'agency_contact_name.required_if'   => 'The Agency contact name field is required.',
            'lead_passenger_name.required_if'               => 'The lead passenger name field is required',
            'lead_passenger_email.required_if'              => 'The lead passenger email field is required',
            'lead_passenger_contact.required_if'            => 'The lead passenger contact field is required',    
            'lead_passenger_dbo.required_if'                => 'The lead passenger date of birth field is required',
            'lead_passsenger_nationailty_id.required_if'    => 'The lead passenger nationailty field is required',
            'lead_passenger_dinning_preference.required_if' => 'The lead passenger dinning preference field is required',
            'lead_passenger_bedding_preference.required_if' => 'The lead passenger bedding preference field is required',
            'quote.*.category_id.required'               =>  'The Category field is required.',
            'quote.*.supplier_id.required'               =>  'The Supplier field is required.',
            'quote.*.date_of_service.required'           =>  'The Date of Service field is required.'
        ];
    }
    
    public function attributes()
    {
        return [
            'agency'                            => 'Agency',
            'agency_name.required_if'           => 'Agency Name',
            'agency_contact.required_if'        => 'Agency Contact',
            'agency_email.required_if'          => 'Agency Email',
            'commission_id'                     => 'Commission Type',
            'season_id'                         => 'Booking Season',
            'brand_id'                          => 'Brand',
            'currency_id'                       => 'Booking Currency',
            'holiday_type_id'                   => 'Holiday Type',
            'ref_no'                            => 'Zoho Reference',
            'quote_no'                          => 'Quote Reference',
            'lead_passenger'                    => 'Lead Passenger name',
            'sale_person_id'                    => 'Sale Person',
            'agency'                            => 'Agency',
            'dinning_preference'                => 'Dinning Preference',
            'bedding_preference'                => 'Bedding Preference',
            'pax_no'                            => 'Pax No',
            'rate_type'                         => 'Rate Rype',
            'nationailty_id'                    => 'Nationality',
            'quote.*.booking_due_date'          => 'Booking Due Date',
            'quote.*.supplier_currency_id'      => 'Supplier Currency',
            'quote.*.estimated_cost'            => 'Estimated cost',
            'quote.*.markup_amount'             => 'Markup Amount',
            'quote.*.markup_percentage'         => 'Markup Percentage',
            'quote.*.selling_price_in_booking_currency' => 'Selling Price Booking',
            'quote.*.markup_amount_in_booking_currency' => 'Markup Amount Booking',
            // 'quote.*.added_in_sage'             =>  'Added in sage',
            'quote.*.date_of_service'           =>  'Date of Service',
            'quote.*.supplier_id'               =>  'Supplier',
            'quote.*.product_id'                =>  'Product',
            'quote.*.booking_method_id'         =>  'Booking Method',
            'quote.*.booked_by_id'              =>  'Booked By',
            'quote.*.supervisor_id'             =>  'Supervisor',
            'quote.*.category_id'             =>    'Category',
            'quote.*.supplier_id'             =>    'Supplier',
        ];
    }
}
