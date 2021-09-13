<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Wallet;


class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking_transactions = Wallet::select(
            'supplier_id',
            DB::raw("sum(case when type = 'credit' then amount else 0 end) as credit"),
            DB::raw("sum(case when type = 'debit' then amount else 0 end) as debit")
        )
        ->groupBy('supplier_id')
        ->get();

        // dd($booking_transactions);

        $data['booking_transactions'] = $booking_transactions;
        return view('wallets.index', $data);
    }

    /* get_supplier_wallet_amount in booking payment section */
    public function get_supplier_wallet_amount($supplier_id)
    {
        $total = 0;
        $booking_transactions = Wallet::select(
            DB::raw("sum(case when type = 'credit' then amount else 0 end) as credit"),
            DB::raw("sum(case when type = 'debit' then amount else 0 end) as debit")
        )
        ->where('supplier_id', $supplier_id)
        ->first();

        if(!is_null($booking_transactions->credit) && !is_null($booking_transactions->debit)){
            $total = $booking_transactions->credit - $booking_transactions->debit;
        }

     

        if($total <= 0){
            // return "This Supplier Has no Credit Notes";
            return \Response::json(['response' => false ,'message' => "This Supplier Has no Credit Notes"], 422);
        }
        
        else{
            // return $total;
            return \Response::json(['response' =>  true ,'message' => $total], 200);
        }
        // dd($total);

        // $data['booking_transactions'] = $booking_transactions;
        // return view('wallets.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
