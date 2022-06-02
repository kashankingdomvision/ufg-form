<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SalePersonPaymentRequest;

use App\SalePersonPayment;
use App\User;
use App\Currency;

class SalePersonPaymentController extends Controller
{
    public function index(Request $request)
    {
        $data['sp_payments'] = SalePersonPayment::with([
            'getSalePerson',
            'getSalePersonCurrency',
        ])
        ->get();

        // dd($data);
        
        return view('sale_person_payments.listing', $data);
    }

    public function create()
    {
        $data['sp_payments'] = SalePersonPayment::get();
        $data['users']       = User::with([
            'getCurrency'
        ])->role(['sales-agent'])->get();


        // dd($data['users']);
        
        return view('sale_person_payments.create', $data);
    }

    public function store(SalePersonPaymentRequest $request)
    {
        SalePersonPayment::create([
            'sale_person_id'          => $request->sale_person_id,
            'sale_person_currency_id' => $request->sale_person_currency_id,
            'balance_owed_amount'     => $request->balance_owed_amount,
        ]);

        return response()->json([ 
            'status'          => true, 
            'success_message' => "Sale Person's Payment Successfully.",
            'redirect_url'    => route('sale_person_payments.index') 
        ]);
    }

    public function edit($id)
    {
        $data['sp_payment'] = SalePersonPayment::find(decrypt($id));
        $data['users']       = User::with([
            'getCurrency'
        ])->role(['sales-agent'])->get();

        return view('sale_person_payments.edit', $data);
    }

    public function update(SalePersonPaymentRequest $request, $id)
    {
        $sp_payment = SalePersonPayment::find(decrypt($id));

        $sp_payment->update([
            'sale_person_id'          => $request->sale_person_id,
            'sale_person_currency_id' => $request->sale_person_currency_id,
            'balance_owed_amount'     => $request->balance_owed_amount,
        ]);

        return response()->json([ 
            'status'          => true, 
            'success_message' => "Sale Person's Payment Updated Successfully.",
            'redirect_url'    => route('sale_person_payments.index') 
        ]);
    }

}
