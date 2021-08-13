<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingCreditNoteRequest extends FormRequest
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
            'credit_note_amount'        =>  'required',
            'credit_note_no'            =>  'required',
            'credit_note_recieved_date' =>  'required',
            'credit_note_recieved_by'   =>  'required'
        ];
    }

    public function messages()
    {
        return[
            'credit_note_amount'        =>  'The Credit Note Amount feild is required',
            'credit_note_no'            =>  'The Credit Note No. feild is required',
            'credit_note_recieved_date' =>  'The Credit Note recieved Date feild is required',
            'credit_note_recieved_by'   =>  'The Credit Note Recieved By feild is required'
        ];
    }

    public function attributes()
    {
        return[
            'credit_note_amount'        =>  'Credit Note Amount',
            'credit_note_no'            =>  'Credit Note No.',
            'credit_note_recieved_date' =>  'Credit Note Recieved Date',
            'credit_note_recieved_by'   =>  'Credit Note Recieved By',
        ];
    }
}
