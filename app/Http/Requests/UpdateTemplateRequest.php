<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class UpdateTemplateRequest extends FormRequest
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
            // 'template_name'                             =>  ['required', Rule::unique('templates','title')->ignore(decrypt($this->id))],
            'template_name'    => [
                'required',
                Rule::unique('templates','title')
                ->where('user_id', Auth::id())
                ->ignore(decrypt($this->id))
            ],
            'privacy_status'                            =>  'required',
            'season_id'                                 =>  'required',
            'currency_id'                               =>  'required',
            'quote'                                     => 'required|array',
            'quote.*.date_of_service'                   => 'required',
            'quote.*.end_date_of_service'               => 'required',
            'quote.*.category_id'                       => 'required',
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

    public function attributes()
    {
        return [

            'template_name'                             => 'Template Name',
            'privacy_status'                            => 'Privacy Status',
            'season_id'                                 => 'Booking Season',
            'currency_id'                               => 'Booking currency',
            'quote.*.date_of_service'                   => 'Start Date of Service',
            'quote.*.end_date_of_service'               => 'End Date of Service',
            'quote.*.category_id'                       => 'Category',
            'quote.*.supplier_id'                       => 'Supplier',
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
