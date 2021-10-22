<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supplier;
use App\Season;
use App\Booking;
use App\TotalWallet;
use App\PaymentMethod;
use App\BookingDetailFinance;
use Illuminate\Support\Facades\Auth;

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

                $query = Booking::orderBy('bookings.id', 'ASC')->leftJoin('booking_details', 'bookings.id', '=', 'booking_details.booking_id');
                $query->where('bookings.season_id',$request->season_id);
                $query->where('booking_details.supplier_id',$request->supplier_id);
                $query->where('booking_details.payment_status', 'active');
                $query->where('booking_details.outstanding_amount_left','>' ,0);
                $query->get([
                    'bookings.ref_no',
                    'bookings.quote_ref',
                    'booking_details.id',
                    'booking_details.actual_cost_bc',
                    'booking_details.outstanding_amount_left',
                ]);

                $data['bookings'] =  $query->get();

                $data['selected_supplier_currency'] = Supplier::find($request->supplier_id)->getCurrency->code;
                $data['currency_id']                = Supplier::find($request->supplier_id)->currency_id;
                $data['supplier_id']                = $request->supplier_id;
                $data['season_id']                  = $request->season_id;
                $data['total_wallet']               = TotalWallet::where('supplier_id', $request->supplier_id)->first();
            }


        }
        
         
        return view('supplier_bulk_payments.index', $data);
    }

    public function store(Request $request)
    {
        // dd($request->payment_method_id);
        // dd($request->all());

        foreach ($request->finance as $key => $finance) {

            $deposit['booking_detail_id'] = $finance['booking_detail_id'];
            $deposit['payment_method_id'] = $request->payment_method_id;
            $deposit['currency_id']       = $request->currency_id;
            $deposit['user_id']           = Auth::user()->id;
            $outstanding_amount_left      = $finance['booking_detail_outstanding_amount_left'];

            if(isset($finance['deposit']['deposit_amount']) && !empty($finance['deposit']['deposit_amount']) && $finance['deposit']['deposit_amount'] > 0){
                $deposit['deposit_amount']     = $finance['deposit']['deposit_amount'];
                $outstanding_amount            = $outstanding_amount_left - $finance['deposit']['deposit_amount'];
                $deposit['outstanding_amount'] = $outstanding_amount;

                BookingDetailFinance::create($deposit);
            }

            if(isset($finance['credit']['credit_note']) && !empty($finance['credit']['credit_note']) && $finance['credit']['credit_note'] > 0 ){

                $deposit['payment_method_id'] = 3;
                $deposit['deposit_amount']    = $finance['credit']['credit_note'];
                $deposit['outstanding_amount'] = $outstanding_amount - $finance['credit']['credit_note'] ;
               
                BookingDetailFinance::create($deposit);
            }

            
        }

        dd($request->all());


    }

}
