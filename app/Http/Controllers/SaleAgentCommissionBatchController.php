<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PayBatchRequest;
use App\Http\Helper;

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
        ->where('status', 'paid')
        ->get();

        return view('sale_agent_commission_batches.listing', $data);
    }

    public function store(SaleAgentCommissionBatchRequest $request)
    {
        // dd($request->all());

        $sac_batch = SaleAgentCommissionBatch::create([

            'name'                     => $request->batch_name,
            'payment_method_id'        => $request->payment_method_id,
            'total_paid_amount'        => $request->total_paid_amount,
            'total_outstanding_amount' => $request->total_outstanding_amount,
            'sale_person_id'           => $request->sale_person_id,
            'sale_person_currency_id'  => $request->sale_person_currency_id
        ]);

        foreach ($request->finance as $key => $finance) {

            if(isset($finance['finance_child']) && $finance['finance_child'] == 1){

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
                ]);

                if($finance['row_total_outstanding_amount'] == 0){
                    Booking::where('id', $finance['booking_id'])->update([ 'is_sale_agent_paid' => 2 ]);
                }
            }
        }

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Save & Send Successfully.',
            'redirect_url'    => route('pay_commissions.commission_review') 
        ]);
    }

    public function create(Request $request)
    {

        $data['users']            = User::get();
        $data['seasons']          = Season::all();
        $data['payment_methods']  = PaymentMethod::whereNotIn('id', [3])->get();

        if($request->filled('sale_person_id') && $request->filled('season')){

            $query = Booking::with([
                'getSalePerson.getCurrency',
                'getSalePerson',
                'getCurrency',
                'getSeason',
                'getLastSaleAgentCommissionBatchDetails',
            ])
            ->where('season_id', $request->season)
            ->whereIn('is_sale_agent_paid', [0,1])
            ->where('commission_amount', '>', 0);

            $bookings =  $query->select([
                'season_id',
                'ref_no',
                'quote_ref',
                'sale_person_id',
                'currency_id',
                'commission_amount',
                'rate_type',
                'id',
                'commission_amount_in_sale_person_currency',
                'is_sale_agent_paid',
            ])
            ->get()
            // ->take(1)

            ;


            $collection = collect([
                ['product' => 'Desk', 'price' => 200],
                ['product' => 'Chair', 'price' => 100],
            ]);

            dd($bookings->contains('is_sale_agent_paid', '0'));

            $data['pay'] = collect($bookings)->contains('is_sale_agent_paid', 0);

            dd($data['pay']);

  
            // dd($bookings);

            $data['sale_person_id'] = $request->sale_person_id;
            $data['sale_person_currency_id'] = User::find($request->sale_person_id)->value('currency_id');
            $data['bookings'] = $bookings;

   

       

            // $q = SaleAgentCommissionBatchDetails::whereIn('booking_id', [1,2,3])->exists();

            // dd($q);

            $test = $data['bookings'];

            // dd($data);
        }


        return view('sale_agent_commission_batches.create', $data);
    }

    public function payBatch(PayBatchRequest $request){

        if($request->filled('batch_id') && $request->filled('payment_method_id')){

            SaleAgentCommissionBatch::find($request->batch_id)
            ->update([
                'payment_method_id' => $request->payment_method_id,
                'status' => 'paid'
            ]);

            SaleAgentCommissionBatchDetails::where('booking_id', $id)->update([
                'dispute_detail' => request()->dispute_detail,
                'status' => 'dispute',
            ]);


            return response()->json([ 
                'status'          => true, 
                'success_message' => 'Batch Paid Successfully.',
                'redirect_url'    => route('pay_commissions.index') 
            ]);
        }
    }

    public function commissionReview(Request $request){

        $data['payment_methods']  = PaymentMethod::whereNotIn('id', [3])->get();

        $data['sac_batch'] = SaleAgentCommissionBatch::with([

            'getPaymentMethod',
            'getSaleAgentCommissionBatchDetails',
            'getSalePerson',
            'getSalePersonCurrency',
        ])
        ->whereNotIn('status', ['paid'])
        ->get();

        // dd($data['sac_batch']);

        return view('sale_agent_commission_batches.commission_review', $data);
    }

    public function commissionManagement(Request $request){

        $data['sac_batch'] = SaleAgentCommissionBatch::with([

            'getPaymentMethod',
            'getSaleAgentCommissionBatchDetails',
            'getSalePerson',
            'getSalePersonCurrency',
        ])
        ->orderBy('id', 'DESC')
        ->get();

        // dd($data['sac_batch']);

        return view('sale_agent_commission_batches.commission_management', $data);
    }

    public function commissionAction($action_type, $batch_id, $id){

        // dd($action_type);

        // dd(decrypt($batch_id));
        
        // try {

            if($action_type == 'dispute'){

                $this->disputeCommission(decrypt($id));
                $message = "Commission Disputed Successfully.";
            }

            if($action_type == 'confirmed'){

                $this->confirmedCommission(decrypt($id));
                $message = "Commission Confirmed Successfully.";
            }

            $this->updateBatchStatus(decrypt($batch_id));

            return response()->json([ 
                'status'          => true, 
                'success_message' => $message,
            ]);

 
          
        // } catch (\Exception $e) {

        //     // $e->getMessage(),
        //     return response()->json([ 
        //         'status'  => false, 
        //         'message' => "Something Went Wrong, Please Try Again."
        //     ]);
        // }
    }

    public function disputeCommission($id)
    {
        $rules = [
            'dispute_detail'  => 'required'
        ];

        $messages = [
            'dispute_detail.required'   => 'The Dispute Detail field is required.',
        ];

        Validator::make(request()->all(), $rules, $messages)->validate();

        SaleAgentCommissionBatchDetails::where('booking_id', $id)->update([
            'dispute_detail' => request()->dispute_detail,
            'status' => 'dispute',
        ]);
    }

    public function confirmedCommission($id)
    {
        SaleAgentCommissionBatchDetails::where('booking_id', $id)->update([
            'status' => 'confirmed',
            'dispute_detail' => null,
        ]);
    }

    public function updateBatchStatus($batch_id)
    {
        $statuses = SaleAgentCommissionBatchDetails::where('sac_batch_id', $batch_id)
        ->pluck('status')
        ->toArray();

        $status = '';

        if((count(array_unique($statuses)) === 1) && $statuses[0] == 'confirmed'){
            $status = 'confirmed';
        }

        if((count(array_unique($statuses)) === 1) && $statuses[0] == 'dispute'){
            $status = 'disputed';
        }

        if ((count(array_unique($statuses)) !== 1)){
            $status = 'partial';
        }

        SaleAgentCommissionBatch::find($batch_id)
        ->update([
            'status' => $status
        ]);

    }


    public function adjustCommission(Request $request)
    {
        $booking = Booking::find($request->booking_id);

        $rate = Helper::getCurrencyConversionRate($request->sale_person_currency_code, $request->booking_currency_code, $booking->rate_type);

        $booking->update([
            'commission_amount_in_sale_person_currency' => $request->adjust_commission_amount,
            'commission_amount' => $request->adjust_commission_amount * $rate,
            'commission_percentage' => null,
            'commission_criteria_id' => null,
        ]);

        $sal = SaleAgentCommissionBatchDetails::where('booking_id', $request->booking_id)->first();

        $sal->update([
            'commission_amount_in_sale_person_currency' => $request->adjust_commission_amount,
            'outstanding_amount_left'  => $request->adjust_commission_amount - $sal->total_paid_amount_yet,
            'total_paid_amount'        => $sal->total_paid_amount_yet + $sal->pay_commission_amount,
            'total_outstanding_amount' => ($request->adjust_commission_amount - $sal->total_paid_amount_yet) - $sal->pay_commission_amount,
            'status' => 'confirmed'
        ]);

        $this->updateBatchStatus($request->batch_id);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Commission Update Successfully.',
            'redirect_url'    => route('pay_commissions.commission_review') 
        ]);
    }
 

}
