<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supplier;
use App\Season;

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

        return view('supplier_bulk_payments.index', $data);
    }

}
