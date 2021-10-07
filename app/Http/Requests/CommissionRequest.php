<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommissionRequest extends FormRequest
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

        // dd($this->commission_group_id);

        return [
            'name'          => 'required',
            // 'percentage'          => 'required',
            // 'commission_group_id' => 'required',
            // 'brand_id'            => 'required',
            // 'holiday_type_id'     => 'required',
            // 'currency_id'         => 'required',
            // 'name'    => [
            //     'required',
            //     Rule::unique('commissions','name')
            //     ->where('commission_group_id', $this->commission_group_id)
            //     ->where('brand_id', $this->commission_group_id)
            //     ->where('holiday_type_id', $this->holiday_type_id)
            //     ->where('currency_id', $this->currency_id)
            // ]

              // Rule::unique('commission_seasons','season_id')
                // ->join('commission_seasons', 'commissions.id', '=', 'commission_seasons.commission_id')
                // ->where(function ($query) {
                    // })
                    
                    // ->whereIn('season_id', $this->input('season_id'))

                   //     ->whereHas('commission_seasons', function($query) use($request){
            //         $query->whereIn('season_id', $this->season_id );
            //     })
           


            // 'season_id' => Rule::unique('commission_seasons')->where(function ($query) {
            //     $query->where('season_id', $this->input('season_id'));
            // })
        ];

        // return [
        //     // 'name' => 'required',
        //     // 'percentage' => 'required'
        // ];
    }
}
