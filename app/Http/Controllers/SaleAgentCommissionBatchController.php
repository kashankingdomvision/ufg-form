<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Season;
use App\PaymentMethod;
use App\Booking;
use App\CurrencyConversion;
use App\SaleAgentCommissionBatch;
use App\SaleAgentCommissionBatchDetails;

use App\Http\Requests\SaleAgentCommissionBatchRequest;

class SaleAgentCommissionBatchController extends Controller
{
    public function index(Request $request)
    {

        $data['sac_batch'] = SaleAgentCommissionBatch::with([
            'getPaymentMethod',
            'getSaleAgentCommissionBatchDetails',
        ])
        ->get();


        return view('sale_agent_commission_batches.listing', $data);
    }

    public function store(SaleAgentCommissionBatchRequest $request)
    {
        // dd($request->all());

        $sac_batch = SaleAgentCommissionBatch::create([

            'name' => $request->batch_name,
            'payment_method_id' => $request->payment_method_id,
            'total_paid_amount' => $request->total_paid_amount,
            'total_outstanding_amount' => $request->total_outstanding_amount
        ]);

        foreach ($request->finance as $key => $finance) {

            if(isset($finance['finance_child']) && $finance['finance_child'] == 1){

                SaleAgentCommissionBatchDetails::create([

                    'sac_batch_id'                          => $sac_batch->id,
                    'booking_id'                            => $finance['booking_id'],
                    'sales_agent_default_currency_id'       => $finance['sales_agent_default_currency_id'],
                    'commission_amount_in_default_currency' => $finance['commission_amount_in_default_currency'],
                    'total_paid_amount_yet'                 => $finance['total_paid_amount_yet'],
                    'outstanding_amount_left'               => $finance['outstanding_amount_left'],
                    'pay_commission_amount'                 => $finance['pay_commission_amount'],
                    'total_paid_amount'                     => $finance['row_total_paid_amount'],
                    'total_outstanding_amount'              => $finance['row_total_outstanding_amount'],
                ]);

                if($finance['row_total_outstanding_amount'] == 0){
                    Booking::where('id', $finance['booking_id'])->update([ 'is_sale_agent_paid' => 1 ]);
                }
            }
        }

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Payment Added Successfully.',
            'redirect_url'    => route('pay_commissions.index') 
        ]);
    }

    public function create(Request $request)
    {
        // dd($request->season);

        $data['users']            = User::get();
        $data['seasons']          = Season::all();
        $data['payment_methods']  = PaymentMethod::whereNotIn('id', [3])->get();

        if($request->filled('sales_agent') && $request->filled('season')){

            $query = Booking::with([
                'getSalePerson.getCurrency',
                'getSalePerson',
                'getCurrency',
                'getSeason',
                'getLastSaleAgentCommissionBatchDetails',
            ])
            ->where('season_id', $request->season)
            ->where('is_sale_agent_paid', 0)
            ->where('commission_amount', '>', 0);

            $data['bookings'] =  $query->select([
                'season_id',
                'ref_no',
                'quote_ref',
                'sale_person_id',
                'currency_id',
                'commission_amount',
                'rate_type',
                'id',
            ])
            ->get()
            // ->take(4)
            ;

            $test = $data['bookings'];

            // dd($data);
        }


        return view('sale_agent_commission_batches.create', $data);
    }
}
