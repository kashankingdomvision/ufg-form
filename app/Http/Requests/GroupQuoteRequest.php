<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupQuoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        $validation = [
            'name'      => 'required|unique:groups|max:255',
        ];

        if($this->has('quote_ids')){
            $validation['quote_ids'] = 'required|array|min:2';
        }

        return $validation;
    }
    
    public function attributes()
    {
        return [
            'name'      => 'Group Name',
            'quote_ids' => 'Quotes',
        ];
    }

}
