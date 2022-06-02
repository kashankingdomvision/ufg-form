<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SalePersonPaymentRequest;
use App\Http\Requests\SaleAgentCommissionBatchRequest;

use App\SalePersonPayment;
use App\User;
use App\Currency;
use App\Season;
use App\PaymentMethod;
use App\Booking;
use App\SaleAgentCommissionBatch;
use App\SaleAgentCommissionBatchDetails;

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
            'sale_person_id'                  => $request->sale_person_id,
            'sale_person_currency_id'         => $request->sale_person_currency_id,
            'balance_owed_amount'             => $request->balance_owed_amount,
            'balance_owed_outstanding_amount' => $request->balance_owed_amount,
            'balance_owed_total_paid_amount'  => $request->balance_owed_amount,
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

    public function accountAllocation(Request $request, $sale_person_payment_id ,$sale_person_id)
    {
        // dd(decrypt($sale_person_id));

        $data['users']            = User::role(['sales-agent'])->get();
        $data['seasons']          = Season::all();
        $data['payment_methods']  = PaymentMethod::whereNotIn('id', [3])->get();
        $data['sp_payment']      = SalePersonPayment::find(decrypt($sale_person_payment_id));

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
            ->where('season_id', 1)
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

            $data['sale_person_id'] = decrypt($sale_person_id);
            $data['sale_person_currency_id'] = User::find(decrypt($sale_person_id))->value('currency_id');
            $data['bookings'] = $bookings;
            $data['send_to_agent'] = collect($bookings)->contains('sale_person_payment_status', 0) ? 0 : 1;


            return view('sale_person_payments.account_allocation', $data);

    }


    public function storeAccountAllocation(SaleAgentCommissionBatchRequest $request)
    {
        // dd($request->all());


        $sp_payment = SalePersonPayment::find($request->sale_person_payment_id);
        $sp_payment->update([
            'balance_owed_outstanding_amount' => $request->balance_owed_outstanding_amount,
            'balance_owed_total_paid_amount' => $request->balance_owed_total_paid_amount
        ]);


        $status = '';

        $sac_batch = SaleAgentCommissionBatch::create([

            'name'                     => $request->batch_name,
            'payment_method_id'        => $request->payment_method_id,
            'total_paid_amount'        => $request->total_paid_amount,
            'total_outstanding_amount' => $request->total_outstanding_amount,
            'sale_person_id'           => $request->sale_person_id,
            'sale_person_currency_id'  => $request->sale_person_currency_id,
            'status'                   => $request->send_to_agent == 0 ? 'pending' : 'paid',
            'deposit_date'             => $request->send_to_agent == 1 ? Carbon::today()->toDateString() : null
        ]);

        foreach ($request->finance as $key => $finance) {

            if(isset($finance['finance_child']) && $finance['finance_child'] == 1){

                if($request->send_to_agent == 0)
                    $status = 'pending';

                if($request->send_to_agent == 1)
                    $status = 'paid';

                if($request->send_to_agent == 0 && $finance['total_paid_amount_yet'] > 0)
                    $status = 'confirmed';

                SaleAgentCommissionBatchDetails::create([

                    'sac_batch_id'                              => $sac_batch->id,
                    'booking_id'                                => $finance['booking_id'],
                    'sale_person_id'                            => $finance['sale_person_id'],
                    'sale_person_currency_id'                   => $finance['sale_person_currency_id'],
                    'commission_amount_in_sale_person_currency' => $finance['commission_amount_in_sale_person_currency'],
                    'total_paid_amount_yet'                     => $finance['total_paid_amount_yet'],
                    'outstanding_amount_left'                   => $finance['outstanding_amount_left'],
                    'pay_commission_amount'                     => $finance['pay_commission_amount'],
                    'total_paid_amount'                         => $finance['row_total_paid_amount'],
                    'total_outstanding_amount'                  => $finance['row_total_outstanding_amount'],
                    'status'                                    => $status
                ]);
            }
        }

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Save & Send Successfully.',
            'redirect_url'    => url()->previous()
        ]);

    }


}
