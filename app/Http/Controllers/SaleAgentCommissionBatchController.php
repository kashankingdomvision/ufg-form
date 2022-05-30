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
            'getSaleAgentCommissionBatchDetails.getBooking',
            'getSaleAgentCommissionBatchDetails.getBooking.getCurrency',
            'getSaleAgentCommissionBatchDetails.getBooking.getBrand',
            'getSaleAgentCommissionBatchDetails.getBooking.getHolidayType',
            'getSaleAgentCommissionBatchDetails.getBooking.getSeason',
        ])
        ->where('status', 'paid')
        ->get();

        return view('sale_agent_commission_batches.listing', $data);
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
                'getCommissionCriteria',
                'getBrand',
                'getHolidayType',
                'getLastSaleAgentCommissionBatchDetails',
            ])
            ->where('season_id', $request->season)
            ->whereIn('sale_person_payment_status', [0,1])
            ->where('commission_amount', '>', 0);

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
            ])
            ->get()
            // ->take(1)
            ;

            $data['sale_person_id'] = $request->sale_person_id;
            $data['sale_person_currency_id'] = User::find($request->sale_person_id)->value('currency_id');
            $data['bookings'] = $bookings;
            $data['send_to_agent'] = collect($bookings)->contains('sale_person_payment_status', 0) ? 0 : 1;

        }

        return view('sale_agent_commission_batches.create', $data);
    }

    public function store(SaleAgentCommissionBatchRequest $request)
    {
        // dd($request->boolean('send_to_agent'));
        // dd($request->all());

        $status = '';

        $sac_batch = SaleAgentCommissionBatch::create([

            'name'                     => $request->batch_name,
            'payment_method_id'        => $request->payment_method_id,
            'total_paid_amount'        => $request->total_paid_amount,
            'total_outstanding_amount' => $request->total_outstanding_amount,
            'sale_person_id'           => $request->sale_person_id,
            'sale_person_currency_id'  => $request->sale_person_currency_id,
            'status'                   => $request->send_to_agent == 0 ? 'pending' : 'paid'
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


                // if($finance['row_total_outstanding_amount'] > 0){
                //     Booking::where('id', $finance['booking_id'])->update([ 'sale_person_payment_status' => 1 ]);
                // }

                // if($finance['row_total_outstanding_amount'] == 0){
                //     Booking::where('id', $finance['booking_id'])->update([ 'sale_person_payment_status' => 2 ]);
                // }
            }
        }

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Save & Send Successfully.',
            'redirect_url'    => route('pay_commissions.commission_review') 
        ]);
    }

    public function payBatch(PayBatchRequest $request){

        if($request->filled('batch_id') && $request->filled('payment_method_id')){

            $sac_batch = SaleAgentCommissionBatch::find($request->batch_id);

            $sac_batch->update([
                'payment_method_id' => $request->payment_method_id,
                'status' => 'paid'
            ]);

            $sac_batch->getSaleAgentCommissionBatchDetails()
            ->update([
                'status' => 'paid',
            ]);

            foreach($sac_batch->getSaleAgentCommissionBatchDetails as $details){

                if($details->total_outstanding_amount == 0){
                    Booking::where('id', $details->booking_id)->update([ 'sale_person_payment_status' => 2 ]);
                }

                if($details->total_outstanding_amount > 0){
                    Booking::where('id', $details->booking_id)->update([ 'sale_person_payment_status' => 1 ]);
                }
            }

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
            'getSaleAgentCommissionBatchDetails.getBooking',
            'getSaleAgentCommissionBatchDetails.getBooking.getCurrency',
            'getSaleAgentCommissionBatchDetails.getBooking.getBrand',
            'getSaleAgentCommissionBatchDetails.getBooking.getHolidayType',
            'getSaleAgentCommissionBatchDetails.getBooking.getSeason',
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
            'getSaleAgentCommissionBatchDetails.getBooking',
            'getSaleAgentCommissionBatchDetails.getBooking.getCurrency',
            'getSaleAgentCommissionBatchDetails.getBooking.getBrand',
            'getSaleAgentCommissionBatchDetails.getBooking.getHolidayType',
            'getSaleAgentCommissionBatchDetails.getBooking.getSeason',
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

                SaleAgentCommissionBatchDetails::where('id', decrypt($id))
                ->update([
                    'status' => 'confirmed'
                ]);

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
        SaleAgentCommissionBatchDetails::whereIn('id', $id)
        ->update([
            'status' => 'confirmed'
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

        SaleAgentCommissionBatch::where('id', $batch_id)
        ->update([
            'status' => $status
        ]);
    }

    public function updateBulkBatchStatus($batch_ids)
    {
        if(!empty($batch_ids)){
            foreach($batch_ids as $id){
                $this->updateBatchStatus($id);
            }
        }
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

    public function salePersonCommissionBulkAction(Request $request)
    {
        // dd($request->all());

        // try {

            $message = "";
            $bulk_action_type = $request->bulk_action_type;

            $bulk_action_ids  = explode(",", $request->bulk_action_ids);
            $batch_ids  = explode(",", $request->batch_ids);

            if($bulk_action_type == 'confirmed'){
                $this->confirmedCommission($bulk_action_ids);



                $this->updateBulkBatchStatus($batch_ids);
                $message = 'Commission Update Successfully.';
            }
    
            return response()->json([ 
                'status'  => true, 
                'message' => $message,
            ]);
          
        // } catch (\Exception $e) {

        //     // $e->getMessage(),
        //     return response()->json([ 
        //         'status'  => false, 
        //         'message' => "Something Went Wrong, Please Try Again."
        //     ]);
        // }

 
    }

}
