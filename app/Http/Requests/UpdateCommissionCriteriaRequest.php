<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommissionCriteriaRequest extends FormRequest
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
            'name'            => ['required', Rule::unique('commission_criterias','name')->ignore(decrypt($this->id))],
            'percentage'      => 'required',
            'brand_id'        => 'required',
            'holiday_type_id' => 'required',
            'currency_id'     => 'required',
            'season_id'       => 'required',
            // 'commission_group_id' => 'required',
            // 'commission_id'       => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'            => 'Name',
            'percentage'      => 'Commision Percentage',
            'brand_id'        => 'Brand',
            'holiday_type_id' => 'Type Of Holiday',
            'currency_id'     => 'Booking Currency',
            'season_id'       => 'Booking Season',

            // 'commission_id'       => 'Commission',
            // 'commission_group_id' => 'Commission Group',
        ];
    }
}
