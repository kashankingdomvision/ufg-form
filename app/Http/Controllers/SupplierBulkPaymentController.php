<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Helper;

use App\Supplier;
use App\Season;
use App\Booking;
use App\TotalWallet;
use App\PaymentMethod;
use App\BookingDetailFinance;
use App\BookingDetail;
use App\Wallet;
use App\SupplierBulkPayment;
use App\SupplierBulkPaymentDetail;


class SupplierBulkPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['booking_seasons'] = Season::all();
        $data['suppliers']       = Supplier::orderBy('id', 'ASC')->get();
        $data['payment_methods'] = PaymentMethod::where('id', '!=' , 3)->get();
        $data['bookings']        =  null;


        if(count($request->all()) > 0){
            if($request->has('supplier_id') && !empty($request->supplier_id) && $request->has('season_id') && !empty($request->season_id)){

                $query = Booking::orderBy('bookings.id', 'ASC')
                ->leftJoin('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
                ;
                $query->where('bookings.season_id',$request->season_id);
                $query->where('booking_details.supplier_id',$request->supplier_id);
                $query->where('booking_details.payment_status', 'active');
                $query->where('booking_details.outstanding_amount_left','>' ,0);
                // $query->get();

                $data['bookings'] =  $query->get([
                    'bookings.ref_no',
                    'bookings.quote_ref',
                    'booking_details.id as booking_detail_id',
                    'bookings.id as booking_id',
                    'booking_details.actual_cost_bc',
                    'booking_details.outstanding_amount_left',
                    'booking_details.supplier_currency_id as supplier_currency_id',
                    'booking_details.booking_detail_unique_ref_id',
                ]);

                $data['selected_supplier_currency'] = Supplier::find($request->supplier_id)->getCurrency->code;
                $data['currency_id']                = Supplier::find($request->supplier_id)->currency_id;
                $data['supplier_id']                = $request->supplier_id;
                $data['season_id']                  = $request->season_id;
                $data['total_wallet']               = TotalWallet::where('supplier_id', $request->supplier_id)->first();
            }

        //    dd($data['bookings']);

        }
        
         
        return view('supplier_bulk_payments.index', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, ['payment_method_id' => 'required' ], ['required' => ' The Payment Method field is required.']);
        try {
            
            $supplier_bulk_payment = SupplierBulkPayment::create([
                'total_paid_amount'       => $request->total_paid_amount,
                'current_credit_amount'   => $request->current_credit_amount,
                'remaining_credit_amount' => $request->remaining_credit_amount,
                'payment_date'            => date('Y-m-d'),
                'payment_method_id'       => $request->payment_method_id,
                'user_id'                 => Auth::user()->id,
                'season_id'               => $request->season_id,
                'currency_id'             => $request->currency_id
            ]);
    
            foreach ($request->finance as $key => $finance) {
    
                if(isset($finance['child']) && $finance['child'] == 1 ){
    
                    $deposit['booking_detail_id'] = $finance['booking_detail_id'];
                    $deposit['booking_id']        = $finance['booking_id'];
                    $deposit['supplier_id']       = $finance['supplier_id'];
                    $deposit['payment_method_id'] = $request->payment_method_id;
                    $deposit['currency_id']       = $request->currency_id;
                    $deposit['user_id']           = Auth::user()->id;
                    $outstanding_amount_left      = $finance['booking_detail_outstanding_amount_left'];
                    $deposit['deposit_due_date']  = date('Y-m-d');
                    $deposit['paid_date']         = date('Y-m-d');
    
                    if(isset($finance['deposit']['deposit_amount']) && !empty($finance['deposit']['deposit_amount']) && $finance['deposit']['deposit_amount'] > 0){
    
                        $deposit['deposit_amount']     = $finance['deposit']['deposit_amount'];
                        $outstanding_amount            = $outstanding_amount_left - $finance['deposit']['deposit_amount'];
                        $deposit['outstanding_amount'] = $outstanding_amount;
    
                        BookingDetail::where('id', $finance['booking_detail_id'])->update([ 'outstanding_amount_left' => $outstanding_amount ]);
                        BookingDetailFinance::create($deposit);
                    }
    
                    if(isset($finance['credit']['credit_note']) && !empty($finance['credit']['credit_note']) && $finance['credit']['credit_note'] > 0 ){
    
                        $deposit['payment_method_id']  = 3;
                        $deposit['deposit_amount']     = $finance['credit']['credit_note'];
                        $outstanding_amount            = $outstanding_amount - $finance['credit']['credit_note'];
                        $deposit['outstanding_amount'] = $outstanding_amount;
                    
                        BookingDetailFinance::create($deposit);
                        BookingDetail::where('id', $finance['booking_detail_id'])->update([ 'outstanding_amount_left' => $outstanding_amount ]);
    
                        Wallet::create([
                            'booking_id'        => $finance['booking_id'],
                            'booking_detail_id' => $finance['booking_detail_id'],
                            'supplier_id'       => $finance['supplier_id'],
                            'amount'            => $finance['credit']['credit_note'],
                            'type'              => 'debit'
                        ]);
    
                        TotalWallet::where('supplier_id', $finance['supplier_id'])->update([
                            'amount' => Helper::getSupplierWalletAmount($finance['supplier_id'])
                        ]);
    
                    }
    
                    SupplierBulkPaymentDetail::create([
    
                        'supplier_bulk_payment_id' => $supplier_bulk_payment->id,     
                        'booking_id'               => $finance['booking_id'],     
                        'bd_reference_id'          => $finance['booking_detail_unique_ref_id'],     
                        'paid_amount'              => isset($finance['deposit']['deposit_amount']) && !empty($finance['deposit']['deposit_amount']) ? $finance['deposit']['deposit_amount'] : '',     
                        'credit_note_amount'       => isset($finance['credit']['credit_note']) && !empty($finance['credit']['credit_note']) ? $finance['credit']['credit_note'] : '', 
                        'currency_id'              => $request->currency_id
                    ]);
    
    
                }
                
            }

            return \Response::json(['status' => true, 'success_message' => 'Supplier Bulk Payment Added Successfully.'], 200); // Status code here
          
        } catch (\Exception $e) {

    
        
            return \Response::json(['status' => false, 'payment_error' => 'Something went wrong with Supplier Bulk Payment.'], 422); // Status code here
            // return $e->getMessage();
        }


    }

}
