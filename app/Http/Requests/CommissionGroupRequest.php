<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommissionGroupRequest extends FormRequest
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
            'commission_id' => 'required',
            'group_id'      => 'required',
            'percentage'    => [
                'required',
                Rule::unique('commission_groups','percentage')
                ->where('commission_id',$this->request->get('commission_id'))
                ->where('group_id',$this->request->get('group_id'))
            ]
        ];

    }

    public function attributes()
    {
        return [
            'percentage'    => 'Percentage',
            'commission_id' => 'Commission',
            'group_id'      => 'Group',
        ];
    }

}
