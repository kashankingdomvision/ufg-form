<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supplier;
use App\Season;
use App\Booking;
use App\TotalWallet;

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

        $query = Booking::orderBy('bookings.id', 'ASC')

        ->leftJoin('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
        ;


        $query->where('supplier_id',$request->supplier_id);
        $query->where('payment_status', 'active');
        $query->where('outstanding_amount_left','>' ,0);

        $a = $query->get([
            'bookings.ref_no',
            'bookings.quote_ref',
            'booking_details.id',
            'booking_details.actual_cost_bc',
            'booking_details.outstanding_amount_left',
        ]);

        // dd($a);



        // if(count($request->all()) > 0){

        //     if($request->has('supplier_id') && !empty($request->supplier_id)){

        //         $query->whereHas('getBookingDetail', function($query) use ($request){

        //             // $query->where('supplier_id',$request->supplier_id);
        //             $query->where('payment_status', 'active');
        //             // $query->where('outstanding_amount_left','>' ,0);

        //         });
            
        //     }

        //     dd($query->get());
        // }
        
        $data['bookings'] =  $query->get();


        $data['total_wallet'] =  TotalWallet::where('supplier_id', $request->supplier_id)->first();


        // dd($data['total_wallet']);

        return view('supplier_bulk_payments.index', $data);
    }

}
