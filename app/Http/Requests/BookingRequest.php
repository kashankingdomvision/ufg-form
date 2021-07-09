<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'season_id'           =>  'required',
            'brand_id'            =>  'required',
            'currency_id'         =>  'required',
            'holiday_type_id'     =>  'required',
            'ref_no'              =>  'required',
            'quote_no'            =>  'required',
            'lead_passenger'      =>  'required',
            'sale_person_id'      =>  'required',
            'agency'              =>  'required',
            'dinning_preference'  =>  'required',
            'bedding_preference'  =>  'required',
            'pax_no'              =>  'required',
            'rate_type'           =>  'required',
        ];
    }
    
    public function attributes()
    {
        return [
            'season_id'           => 'Booking season',
            'brand_id'            => 'Brand',
            'currency_id'         => 'Booking currency',
            'holiday_type_id'     => 'Holiday type',
            'ref_no'              => 'Zoho reference',
            'quote_no'            => 'Quote reference',
            'lead_passenger'      => 'Lead Passenger name',
            'sale_person_id'      => 'Sale person',
            'agency'              => 'Agency',
            'dinning_preferences' => 'Dinning Preference',
            'bedding_preference'  => 'Bedding Preference',
            'pax_no'              => 'Pax number ',
            'rate_type'           => 'Rate type',
        ];
    }
}
