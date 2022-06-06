<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email'               => 'required|email|unique:users',
            'password'            => 'required|min:8',
            'role_id'             => 'required',
            // 'commission_id'       => 'required',
            // 'commission_group_id' => 'required'
        ];
    }
    
    public function attributes()
    {
        return [
            'name'                => 'Name',
            'email'               => 'Email address',
            'password'            => 'Password',
            'role_id'             => 'User Type',
            // 'commission_id'       => 'Commission',
            // 'commission_group_id' => 'Commission Group'
        ];
    }
}
