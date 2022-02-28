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

            'booking_details'                           => 'required',
            'reason_for_trip'                           => 'required',
            'ref_no'                                    => 'required',
            'quote_no'                                  => 'required',
            'rate_type'                                 => 'required',
            'markup_type'                               => 'required',
            'sale_person_id'                            => 'required',
            'brand_id'                                  => 'required',
            'holiday_type_id'                           => 'required',
            'season_id'                                 => 'required',
            'currency_id'                               => 'required',
            'agency'                                    => 'required',
            'agency_name'                               => 'required_if:agency,1',
            'agency_contact_name'                       => 'required_if:agency,1',
            'agency_contact'                            => 'required_if:agency,1',
            'agency_email'                              => 'required_if:agency,1|email',
            'lead_passenger_name'                       => 'required_if:agency,0',
            'lead_passenger_email'                      => 'required_if:agency,0|email',
            'lead_passenger_contact'                    => 'required_if:agency,0',    
            'pax_no'                                    => 'required',
            'quote'                                     => 'required|array',
            'quote.*.date_of_service'                   => 'required',
            'quote.*.end_date_of_service'               => 'required',
            'quote.*.category_id'                       => 'required',
            'quote.*.supplier_country_ids'              => 'required|array',
            // 'quote.*.supplier_location_id'              => 'required',
            'quote.*.supplier_id'                       => 'required',
            'quote.*.refundable_percentage'             => 'required_if:quote.*.booking_type_id,2',
            'quote.*.supplier_currency_id'              => 'required',
            'quote.*.estimated_cost'                    => 'required',
            'quote.*.markup_amount'                     => 'required_if:markup_type,itemised',
            'quote.*.markup_percentage'                 => 'required_if:markup_type,itemised',
            'quote.*.selling_price_in_booking_currency' => 'required_if:markup_type,itemised',
            'quote.*.markup_amount_in_booking_currency' => 'required_if:markup_type,itemised',
        ];
    }

    public function messages()
    {
        return[

            'agency_name.required_if'                       => 'The Agency Name field is required.',
            'agency_contact_name.required_if'               => 'The Agency Contact Name field is required.',
            'agency_contact.required_if'                    => 'The Agency Contact field is required.',
            'agency_email.required_if'                      => 'The Agency Email field is required.',
            'lead_passenger_name.required_if'               => 'The Lead Passenger name field is required',
            'lead_passenger_email.required_if'              => 'The Lead Passenger email field is required',
            'lead_passenger_contact.required_if'            => 'The Lead Passenger contact field is required',    
            'lead_passenger_dbo.required_if'                => 'The Lead Passenger date of birth field is required',
            'lead_passsenger_nationailty_id.required_if'    => 'The Lead Passenger nationailty field is required',
            'lead_passenger_bedding_preference.required_if' => 'The Lead Passenger bedding preference field is required',
            'lead_passenger_dinning_preference.required_if' => 'The Lead Passenger dinning preference field is required',
            'quote.*.date_of_service.required'              => 'The Date of Service field is required.',
            'quote.*.end_date_of_service.required'          => 'The End Date of Service field is required.',
            'quote.*.category_id.required'                  => 'The Category field is required.',
            'quote.*.supplier_id.required'                  => 'The Supplier field is required.',
            'quote.*.refundable_percentage.required_if'     => 'The Refundable % field is required.',
            'quote.*.supplier_country_ids'                  => 'The Supplier Country field is required.',
        ];
    }
    
    public function attributes()
    {
        return [
            
            'booking_details'                           => 'Booking Details',
            'reason_for_trip'                           => 'Reason for Trip',
            'ref_no'                                    => 'Zoho Reference',
            'quote_no'                                  => 'Quote Reference',
            'rate_type'                                 => 'Currency Rate Type',
            'sale_person_id'                            => 'Sales Person',
            'brand_id'                                  => 'Brand',
            'holiday_type_id'                           => 'Type Of Holiday',
            'season_id'                                 => 'Booking Season',
            'currency_id'                               => 'Booking Currency',
            'agency'                                    => 'Agency',
            'agency_name'                               => 'Agency Name',
            'agency_contact_name'                       => 'Agency Contact Name',
            'agency_contact'                            => 'Agency Contact No.',
            'agency_email'                              => 'Agency Email',
            'lead_passenger_name'                       => 'Lead Passenger Name',
            'lead_passenger_email'                      => 'Email Address',
            'lead_passenger_contact'                    => 'Contact Number',    
            'lead_passenger_dbo'                        => 'Date Of Birth',
            'lead_passsenger_nationailty_id'            => 'Nationality', 
            'lead_passenger_bedding_preference'         => 'Bedding Preferences', 
            'lead_passenger_dinning_preference'         => 'Dinning Preferences', 
            'pax_no'                                    => 'required',
            'quote'                                     => 'required|array',
            'quote.*.date_of_service'                   => 'Start Date of Service',
            'quote.*.end_date_of_service'               => 'End Date of Service',
            'quote.*.category_id'                       => 'Category',
            'quote.*.supplier_country_ids'              => 'Supplier Country',
            // 'quote.*.supplier_location_id'              => 'Supplier Location',
            'quote.*.supplier_id'                       => 'Supplier',
            // 'quote.*.booking_due_date'                  => 'Booking Due Date',
            'quote.*.supplier_currency_id'              => 'Supplier Currency',
            'quote.*.estimated_cost'                    => 'Estimated Cost',
            'quote.*.markup_amount'                     => 'Markup Amount',
            'quote.*.markup_percentage'                 => 'Markup %',
            'quote.*.selling_price_in_booking_currency' => 'Estimated Cost in Booking Currency',
            'quote.*.markup_amount_in_booking_currency' => 'Selling Price in Booking Currency',
            'quote.*.refundable_percentage'             => 'Refundable %',
        ];
    }
}
