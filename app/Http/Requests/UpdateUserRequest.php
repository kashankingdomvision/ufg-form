<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name'                => 'required|string',
            'email'               => ['required', Rule::unique('users')->ignore(decrypt($this->id))],
            'role'                => 'required',
            'commission_id'       => 'required',
            'commission_group_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name'                => 'Name',
            'email'               => 'Email address',
            'role'                => 'User Type',
            'commission_id'       => 'Commission',
            'commission_group_id' => 'Commission Group'
        ];
    }
}
