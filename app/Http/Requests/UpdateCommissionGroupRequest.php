<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommissionGroupRequest extends FormRequest
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
            'name' => ['required', Rule::unique('commission_groups','name')->ignore(decrypt($this->id))],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Group Name',
        ];
    }

}



        // return [
        //     'commission_id' => 'required',
        //     'percentage'    => 'required',
        //     'name'          => [
        //         'required',
        //         Rule::unique('commission_groups','name')
        //         ->where('commission_id',$this->request->get('commission_id'))
        //         ->ignore($this->request->get('id'))
        //     ]
        // ];