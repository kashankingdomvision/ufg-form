<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommissionCriteriaRequest extends FormRequest
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
            'commission_id'       => 'required',
            'percentage'          => 'required',
            'commission_group_id' => 'required',
            'brand_id'            => 'required',
            'holiday_type_id'     => 'required',
            'currency_id'         => 'required',
            'season_id'           => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'commission_id'       => 'Commission',
            'percentage'          => 'Commision Percentage',
            'commission_group_id' => 'Commission Group',
            'brand_id'            => 'Brand',
            'holiday_type_id'     => 'Type Of Holiday',
            'currency_id'         => 'Booking Currency',
            'season_id'           => 'Booking Season',
        ];
    }
}
