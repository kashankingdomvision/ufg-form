<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Brand;
use App\Category;
use App\Currency;
use App\Role;
use App\Supplier;
use App\User;
use App\Wallet;
use App\Season;
use App\Quote;


class ReportController extends Controller
{
    public function user_report(Request $request){

        $data['roles']      = Role::orderBy('name', 'ASC')->get();
        $data['brands']     = Brand::orderBy('id', 'ASC')->get();
        $data['currencies'] = Currency::where('status', 1)->orderBy('name', 'ASC')->get();

        $user = User::orderBy('id', 'ASC');

        if (!empty($request->all())) {


            if ($request->has('role') && !empty($request->role)) {
                $user = $user->whereHas('getRole', function ($q) use($request) {
                    $q->where('id', $request->role);
                });
            }

            if ($request->has('currency') && !empty($request->currency)) {
                $user = $user->whereHas('getCurrency', function ($q) use($request) {
                    $q->where('id', $request->currency);
                });
            }

            if ($request->has('brand') && !empty($request->brand)) {
                $user = $user->whereHas('getBrand', function ($q) use($request) {
                    $q->where('id', $request->brand);
                });
            }

            if($request->has('dates') && !empty($request->dates)){

                $dates = explode ("-", $request->dates);

                $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                $user->whereDate('created_at', '>=', $start_date);
                $user->whereDate('created_at', '<=', $end_date);
            }

            if($request->has('month') && !empty($request->month)){
                $user = $user->whereMonth('created_at', $request->month);
            }

            if($request->has('year') && !empty($request->year)){
                $user = $user->whereYear('created_at', $request->year);
            }

        }

        $data['users'] = $user->get();

        return view('reports.user_report', $data);
    }


    public function activity_by_user(Request $request){

        $user = User::orderBy('id', 'ASC');

        if (!empty($request->all())) {

            if($request->has('user') && !empty($request->user)){
                $user->where('id',  $request->user);
            }

            $user->withCount(['getTotalQuote' => function($query) use($request) {

                if($request->has('month') && !empty($request->month)){
                    $query->whereMonth('created_at',  $request->month);
                }

                if($request->has('year') && !empty($request->year)){
                    $query->whereYear('created_at',  $request->year);
                }

                if($request->has('dates') && !empty($request->dates)){

                    $dates = explode ("-", $request->dates); 
    
                    $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                    $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');
    
                    $query->whereDate('created_at', '>=', $start_date);
                    $query->whereDate('created_at', '<=', $end_date);
                }

            }]);

            
            $user->withCount(['getQuote' => function($query) use($request) {

                if($request->has('month') && !empty($request->month)){
                    $query->whereMonth('created_at',  $request->month);
                }

                if($request->has('year') && !empty($request->year)){
                    $query->whereYear('created_at',  $request->year);
                }

                if($request->has('dates') && !empty($request->dates)){

                    $dates = explode ("-", $request->dates); 
    
                    $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                    $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');
    
                    $query->whereDate('created_at', '>=', $start_date);
                    $query->whereDate('created_at', '<=', $end_date);
                }

            }]);

            $user->withCount(['getCancelledQuote' => function($query) use($request) {

                if($request->has('month') && !empty($request->month)){
                    $query->whereMonth('created_at',  $request->month);
                }

                if($request->has('year') && !empty($request->year)){
                    $query->whereYear('created_at',  $request->year);
                }

                if($request->has('dates') && !empty($request->dates)){

                    $dates = explode ("-", $request->dates); 
    
                    $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                    $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');
    
                    $query->whereDate('created_at', '>=', $start_date);
                    $query->whereDate('created_at', '<=', $end_date);
                }

            }]);

            $user->withCount(['getTotalBooking' => function($query) use($request) {

                if($request->has('month') && !empty($request->month)){
                    $query->whereMonth('created_at',  $request->month);
                }

                if($request->has('year') && !empty($request->year)){
                    $query->whereYear('created_at',  $request->year);
                }

                if($request->has('dates') && !empty($request->dates)){

                    $dates = explode ("-", $request->dates); 
    
                    $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                    $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');
    
                    $query->whereDate('created_at', '>=', $start_date);
                    $query->whereDate('created_at', '<=', $end_date);
                }

            }]);

            $user->withCount(['getConfirmedBooking' => function($query) use($request) {

                if($request->has('month') && !empty($request->month)){
                    $query->whereMonth('created_at',  $request->month);
                }

                if($request->has('year') && !empty($request->year)){
                    $query->whereYear('created_at',  $request->year);
                }

                if($request->has('dates') && !empty($request->dates)){

                    $dates = explode ("-", $request->dates); 
    
                    $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                    $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');
    
                    $query->whereDate('created_at', '>=', $start_date);
                    $query->whereDate('created_at', '<=', $end_date);
                }

            }]);

            $user->withCount(['getCancelledBooking' => function($query) use($request) {

                if($request->has('month') && !empty($request->month)){
                    $query->whereMonth('created_at',  $request->month);
                }

                if($request->has('year') && !empty($request->year)){
                    $query->whereYear('created_at',  $request->year);
                }

                if($request->has('dates') && !empty($request->dates)){

                    $dates = explode ("-", $request->dates); 
    
                    $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                    $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');
    
                    $query->whereDate('created_at', '>=', $start_date);
                    $query->whereDate('created_at', '<=', $end_date);
                }

            }]);

        }else{

            $user->withCount('getTotalQuote');
            $user->withCount('getQuote');
            $user->withCount('getCancelledQuote');
            $user->withCount('getTotalBooking');
            $user->withCount('getConfirmedBooking');
            $user->withCount('getCancelledBooking');
        }

        $data['users'] = $user->orderBy('id', 'ASC')->get();

        return view('reports.activity_by_user', $data);

    }

    public function supplier_report(Request $request)
    {
        $data['categories'] = Category::orderBy('name', 'ASC')->get();
        $data['currencies'] = Currency::where('status', 1)->orderBy('name', 'ASC')->get();

        $supplier = Supplier::with('getCategories','getCurrency')->orderBy('id', 'ASC');

        if (!empty($request->all())) {

            if ($request->has('category') && !empty(request()->category)) {
                $supplier = $supplier->whereHas('getCategories', function ($q) {
                    $q->where('id', request()->category);
                });
            }

            if ($request->has('currency') && !empty(request()->currency)) {
                $supplier = $supplier->whereHas('getCurrency', function ($q) {
                    $q->where('id', request()->currency);
                });
            }

            if($request->has('dates') && !empty($request->dates)){

                $dates = explode ("-", $request->dates);

                $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                $supplier->whereDate('created_at', '>=', $start_date);
                $supplier->whereDate('created_at', '<=', $end_date);
            }

            if($request->has('month') && !empty($request->month)){
                $supplier = $supplier->whereMonth('created_at', $request->month);
            }

            if($request->has('year') && !empty($request->year)){
                $supplier = $supplier->whereYear('created_at', $request->year);
            }
        }
        $data['suppliers'] = $supplier->get();

        return view('reports.supplier_report', $data);
    }

    public function wallet_report(Request $request)
    {
        $data['suppliers'] = Supplier::orderBy('name', 'ASC')->get();

        $wallet = Wallet::with('getSupplier','getBooking')->orderBy('id', 'ASC');

        if (!empty(request()->all())) {

            if ($request->has('supplier') && !empty(request()->supplier)) {
                $wallet = $wallet->whereHas('getSupplier', function ($q) {
                    $q->where('id', request()->supplier);
                });
            }

            if(request()->has('type') && !empty(request()->type)){
                $wallet = $wallet->where('type', request()->type);
            }

            if(request()->has('dates') && !empty(request()->dates)){

                $dates = explode ("-", request()->dates);

                $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                $wallet->whereDate('created_at', '>=', $start_date);
                $wallet->whereDate('created_at', '<=', $end_date);
            }

            if(request()->has('month') && !empty(request()->month)){
                $wallet = $wallet->whereMonth('created_at', request()->month);
            }

            if(request()->has('year') && !empty(request()->year)){
                $wallet = $wallet->whereYear('created_at', request()->year);
            }
        }
        $data['wallets'] = $wallet->get();

        return view('reports.wallet_report', $data);
    }

    public function quote_report(Request $request){
        $data['brands']     = Brand::orderBy('id', 'ASC')->get();
        $data['users'] = User::orderBy('name', 'ASC')->get();
        $data['booking_seasons']  = Season::all();
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();

        $quote = Quote::orderBy('created_at','DESC');
        if (!empty(request()->all())) {
            $quote = $this->searchFilters($quote, $request);
        }
      
        $data['quotes'] = $quote->get();
        return view('reports.quote_report', $data);
    }

    public function searchFilters($quote, $request)
    {
        if($request->has('client_type') && !empty($request->client_type)){
            $client_type = ($request->client_type == 'client')? '0' : '1';
            $quote->where('agency', 'like', '%'.$client_type.'%' );    
        }
        
        if($request->has('staff') && !empty($request->staff)){
            $quote->whereHas('getSalePerson', function($query) use($request){
                $query->where('name', 'like', '%'.$request->staff.'%' );
             });
        }
        
        if($request->has('status') && !empty($request->status)){
            if($request->status == 'cancelled'){
                $quote->where('deleted_at', '!=', null);
            }else{
                $quote->where('booking_status', 'like', '%'.$request->status.'%' );
            }
        }
        
        if($request->has('booking_currency') && !empty($request->booking_currency)){
            $quote->whereHas('getCurrency', function($query) use($request){
                foreach ($request->booking_currency as $currency) {
                    $query->where('code', 'like', '%'.$currency.'%' );
                }
            });
        }            
        
        if($request->has('booking_season') && !empty($request->booking_season)){
            $quote->whereHas('getSeason', function($query) use($request){
               $query->where('name', 'like', '%'. $request->booking_season.'%' );
            });
        }        
        
        if($request->has('brand') && !empty($request->brand)){
            $quote->whereHas('getBrand', function($query) use($request){
                foreach ($request->brand as $brand) {
                    $query->where('name', 'like', '%'.$brand.'%' );
                }
            });
        }            
        
        if($request->has('search') && !empty($request->search)){
            $quote->where(function($query) use($request){
                $query->where('ref_no', 'like', '%'.$request->search.'%')
                ->orWhere('lead_passenger_name', 'like', '%'.$request->search.'%')
                ->orWhere('lead_passenger_email', 'like', '%'.$request->search.'%')
                ->orWhere('quote_ref', 'like', '%'.$request->search.'%');                    
            });

    
        }

        if($request->has('dates') && !empty($request->dates)){

            $dates = explode ("-", $request->dates);

            $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
            $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

            $quote->whereDate('created_at', '>=', $start_date);
            $quote->whereDate('created_at', '<=', $end_date);
        }
        
     
        return $quote;
    }
    
}
