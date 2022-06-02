<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SalePersonPaymentRequest;

use App\SalePersonPayment;
use App\User;
use App\Currency;
use App\Season;
use App\PaymentMethod;
use App\Booking;

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


    public function accountAllocation(Request $request)
    {

        
        $data['users']            = User::role(['sales-agent'])->get();
        $data['seasons']          = Season::all();
        $data['payment_methods']  = PaymentMethod::whereNotIn('id', [3])->get();

        if($request->filled('sale_person_id') && $request->filled('season')){

            $query = Booking::with([
                'getSalePerson.getCurrency',
                'getSalePerson',
                'getCurrency',
                'getSeason',
                'getCommissionCriteria',
                'getBrand',
                'getHolidayType',
                'getLastSaleAgentCommissionBatchDetails',
            ])
            ->where('season_id', $request->season)
            ->whereIn('sale_person_payment_status', [0,1])
            ->where('commission_amount', '>', 0);

            $query->when($request->departure_date, function ($query) use ($request) {

                $dates = Helper::dates($request->departure_date);
                $query->whereBetween('departure_date', [$dates->start_date, $dates->end_date]);
            });

            $bookings = $query->select([
                'season_id',
                'brand_id',
                'holiday_type_id',
                'commission_criteria_id',
                'ref_no',
                'quote_ref',
                'sale_person_id',
                'currency_id',
                'commission_amount',
                'rate_type',
                'id',
                'commission_amount_in_sale_person_currency',
                'sale_person_payment_status',
                'departure_date',
                'selling_price',
                'markup_amount',
                'markup_percentage',
                'sale_person_bonus_amount'
            ])
            ->get()
            // ->take(1)
            ;

            // dd($bookings);

            $data['sale_person_id'] = $request->sale_person_id;
            $data['sale_person_currency_id'] = User::find($request->sale_person_id)->value('currency_id');
            $data['bookings'] = $bookings;
            $data['send_to_agent'] = collect($bookings)->contains('sale_person_payment_status', 0) ? 0 : 1;

        }

        return view('sale_person_payments.account_allocation', $data);
    }


}
