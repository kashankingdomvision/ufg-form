<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\CustomerReportExport;
use App\Exports\UserReportExport;
use App\Exports\ActivityByUserReportExport;

use App\Http\Helper;
use App\Booking;
use App\Brand;
use App\Category;
use App\Currency;
use App\Quote;
use App\Role;
use App\Supplier;
use App\User;
use App\Wallet;
use App\Season;
use App\PaymentMethod;
use App\BookingDetailFinance;
use App\Commission;
use App\Bank;
use App\BookingRefundPayment;
use App\BookingCreditNote;
use App\BookingDetail;


class ReportController extends Controller
{
    public function user_report(Request $request){

        $data['roles']      = Role::orderBy('name', 'ASC')->get();
        $data['brands']     = Brand::orderBy('id', 'ASC')->get();
        $data['currencies'] = Currency::where('status', 1)->orderBy('name', 'ASC')->get();

        $user = User::orderBy('id', 'ASC');

        $user->when($request->role, function ($query) use ($request) {
            return $query->whereHas('getRole', function ($query) use($request) {
                $query->where('id', $request->role);
            });
        });

        $user->when($request->currency, function ($query) use ($request) {
            return $query->whereHas('getCurrency', function ($query) use($request) {
                $query->where('id', $request->currency);
            });
        });
        
        $user->when($request->brand, function ($query) use ($request) {
            return $query->whereHas('getBrand', function ($query) use($request) {
                $query->where('id', $request->brand);
            });
        });

        $user->when($request->month, function ($query) use ($request) {
            return $query->whereMonth('created_at', $request->month);
        });

        $user->when($request->year, function ($query) use ($request) {
            return $query->whereYear('created_at', $request->year);
        });

        $user->when($request->dates, function ($query) use ($request) {

            $dates = Helper::dates($request->dates);

            $query->whereDate('created_at', '>=', $dates->start_date);
            $query->whereDate('created_at', '<=', $dates->end_date);
        });

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

        $data['brands']           = Brand::orderBy('id', 'ASC')->get();
        $data['users']            = User::orderBy('name', 'ASC')->get();
        $data['booking_seasons']  = Season::all();
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['commission_types'] = Commission::all();

        $quote = Quote::orderBy('created_at','DESC');
        if (!empty(request()->all())) {
            $quote = $this->searchFilters($quote, $request);
        }

        $data['quotes'] = $quote->get();
        return view('reports.quote_report', $data);
    }

    public function payment_method_report(Request $request){

        $booking_finance_details = BookingDetailFinance::orderBy('id', 'ASC');
        
        if (!empty(request()->all())) {
            
            if(request()->has('payment_method') && !empty(request()->payment_method)){
                $booking_finance_details = $booking_finance_details->where('payment_method_id', $request->payment_method);
            }

            if($request->has('dates') && !empty($request->dates)){

                $dates = explode ("-", $request->dates);

                $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                $booking_finance_details->whereDate('paid_date', '>=', $start_date);
                $booking_finance_details->whereDate('paid_date', '<=', $end_date);
            }

            if($request->has('month') && !empty($request->month)){
                $booking_finance_details = $booking_finance_details->whereMonth('paid_date', $request->month);
            }

            if($request->has('year') && !empty($request->year)){
                $booking_finance_details = $booking_finance_details->whereYear('paid_date', $request->year);
            }
        }

        $data['payment_methods']         = PaymentMethod::all();
        $data['booking_finance_details'] = $booking_finance_details->get();

        return view('reports.payment_method_report', $data);
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
            $quote->where('booking_status', 'like', '%'.$request->status.'%' );
        }

        if($request->has('booking_currency') && !empty($request->booking_currency)){
            // $quote->whereHas('getCurrency', function($query) use($request){
            //     foreach ($request->booking_currency as $currency) {
            //         $query->where('code', 'like', '%'.$currency.'%' );
            //     }
            // });

            $quote->whereIn('currency_id', $request->booking_currency);
        }

        if($request->has('booking_season') && !empty($request->booking_season)){
            $quote->whereHas('getSeason', function($query) use($request){
               $query->where('name', 'like', '%'. $request->booking_season.'%' );
            });
        }

        if($request->has('brand') && !empty($request->brand)){
            $quote->whereIn('brand_id', $request->brand);
        }

        if($request->has('commission_type') && !empty($request->commission_type)){
            $quote->where('commission_id', $request->commission_type);
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

        if($request->has('month') && !empty($request->month)){
            $quote->whereMonth('created_at', $request->month);
        }

        if($request->has('year') && !empty($request->year)){
            $quote->whereYear('created_at', $request->year);
        }


        return $quote;
    }

    public function customer_report() {
        $customers_quote = Quote::select('*', DB::raw('count(id) as total_quotes'))->where('agency', '0')->groupBy('lead_passenger_email');
        $customers_booking = Booking::select('*', DB::raw('count(id) as total_bookings'))->where('agency', '0')->groupBy('lead_passenger_email');

        if (!empty(request()->all())) {

            if(request()->has('dates') && !empty(request()->dates)){

                $dates = explode ("-", request()->dates);

                $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                $customers_quote->whereDate('created_at', '>=', $start_date);
                $customers_quote->whereDate('created_at', '<=', $end_date);

                $customers_booking->whereDate('created_at', '>=', $start_date);
                $customers_booking->whereDate('created_at', '<=', $end_date);
            }

            if(request()->has('month') && !empty(request()->month)){
                $customers_quote = $customers_quote->whereMonth('created_at', request()->month);
                $customers_booking = $customers_booking->whereMonth('created_at', request()->month);
            }

            if(request()->has('year') && !empty(request()->year)){
                $customers_quote = $customers_quote->whereYear('created_at', request()->year);
                $customers_booking = $customers_booking->whereYear('created_at', request()->year);
            }

        }
        $data['customers_quote'] = $customers_quote->get();
        $data['customers_booking'] = $customers_booking->get();
        $data['selected_type'] = request()->type;

        return view('reports.customer_report', $data);
    }

    public function refund_by_bank_report(Request $request) {

        $query = BookingRefundPayment::orderBy('id', 'ASC');

        if (!empty(request()->all())) {

            if(request()->has('bank') && !empty(request()->bank)){
                $query->where('bank_id', $request->bank);
            }

            if($request->has('dates') && !empty($request->dates)){

                $dates = explode ("-", $request->dates);

                $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                $query->whereDate('refund_date', '>=', $start_date);
                $query->whereDate('refund_date', '<=', $end_date);
            }

            if($request->has('month') && !empty($request->month)){
                $query->whereMonth('refund_date', $request->month);
            }

            if($request->has('year') && !empty($request->year)){
                $query->whereYear('refund_date', $request->year);
            }
        }

        $data['banks']                   = Bank::all();
        $data['users']                   = User::all();
        $data['booking_refund_payments'] = $query->get();

        return view('reports.refund_by_bank_report', $data);
    }

    public function refund_by_credit_note_report(Request $request) {

        $query = BookingCreditNote::orderBy('id', 'ASC');

        if (!empty(request()->all())) {

            if(request()->has('credit_note_recieved_by') && !empty(request()->credit_note_recieved_by)){
                $query->where('user_id', $request->credit_note_recieved_by);
            }

            if($request->has('dates') && !empty($request->dates)){

                $dates = explode ("-", $request->dates);

                $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                $query->whereDate('credit_note_recieved_date', '>=', $start_date);
                $query->whereDate('credit_note_recieved_date', '<=', $end_date);
            }

            if($request->has('month') && !empty($request->month)){
                $query->whereMonth('credit_note_recieved_date', $request->month);
            }

            if($request->has('year') && !empty($request->year)){
                $query->whereYear('credit_note_recieved_date', $request->year);
            }

        }

        $data['users']                   = User::all();
        $data['booking_credit_notes']    = $query->get();

        return view('reports.refund_by_credit_note', $data);
    }

    public function transfer_report(Request $request) {

        $query = BookingDetail::where('category_id',1);

        $query->whereHas('getBooking', function($query) use($request){
            $query->where('booking_status','confirmed' );
        });

        if (!empty(request()->all())) {

            if(request()->has('quote_ref') && !empty(request()->quote_ref)){
                $query->whereIn('booking_id', $request->quote_ref);
            }

            if(request()->has('booking_season') && !empty(request()->booking_season)){
                $query->whereHas('getBooking', function($query) use($request){
                    $query->where('season_id', $request->booking_season );
                });
            }

            if($request->has('dates') && !empty($request->dates)){

                $dates = explode ("-", $request->dates);

                $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                $query->whereDate('date_of_service', '>=', $start_date);
                $query->whereDate('end_date_of_service', '<=', $end_date);
            }

            if($request->has('month') && !empty($request->month)){
                $query->whereMonth('created_at', $request->month);
            }

            if($request->has('year') && !empty($request->year)){
                $query->whereYear('created_at', $request->year);
            }

            if($request->has('status') && !empty($request->status)){
                $query->where('status', $request->status);
            }

        }

        $data['booking_details'] = $query->orderBy('booking_id','ASC')->get();
        $data['bookings']        = Booking::select('id','quote_ref')->where('booking_status','confirmed')->orderBy('id','ASC')->get();
        $data['suppliers']       = Category::where('slug','transfer')->first()->getSupplier;
        $data['brands']          = Brand::all();
        $data['booking_seasons'] = Season::all();
    
        return view('reports.transfer_report', $data);
    }

    // *** REPORTS IN EXPORT *** //
    public function customer_report_export(Request $request) {
        try {
            $passedParams = json_decode(request()->params, true);
            $customers_quote = Quote::select('*', DB::raw('count(id) as total_quotes'))->where('agency', '0')->groupBy('lead_passenger_email');
            $customers_booking = Booking::select('*', DB::raw('count(id) as total_bookings'))->where('agency', '0')->groupBy('lead_passenger_email');

            if (!empty($passedParams)) {
                if($passedParams['dates'] && !empty($passedParams['dates'])){

                    $dates = explode ("-", $passedParams['dates']);

                    $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                    $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                    $customers_quote->whereDate('created_at', '>=', $start_date);
                    $customers_quote->whereDate('created_at', '<=', $end_date);

                    $customers_booking->whereDate('created_at', '>=', $start_date);
                    $customers_booking->whereDate('created_at', '<=', $end_date);
                }

                if($passedParams['month'] && !empty($passedParams['month'])){
                    $customers_quote = $customers_quote->whereMonth('created_at', $passedParams['month']);
                    $customers_booking = $customers_booking->whereMonth('created_at', $passedParams['month']);
                }

                if($passedParams['year'] && !empty($passedParams['year'])){
                    $customers_quote = $customers_quote->whereYear('created_at', $passedParams['year']);
                    $customers_booking = $customers_booking->whereYear('created_at', $passedParams['year']);
                }

            }
            $data['customers_quote'] = $customers_quote->get();
            $data['customers_booking'] = $customers_booking->get();
            $data['selected_type'] = $passedParams['type'];
            $reportName = "Customer Report";

            return Excel::download(new CustomerReportExport($data), "$reportName.xlsx");

        } catch (\Exception $e) {
            return ['resp' => false, 'msg' => $e->getMessage()];
        }
        
    }

    public function user_report_export(Request $request) {
        try {
            $passedParams = json_decode(request()->params, true);
            $data['roles']      = Role::orderBy('name', 'ASC')->get();
            $data['brands']     = Brand::orderBy('id', 'ASC')->get();
            $data['currencies'] = Currency::where('status', 1)->orderBy('name', 'ASC')->get();

            $user = User::orderBy('id', 'ASC');

            if(!empty($passedParams['role'])) {
                $user->when($passedParams['role'], function ($query) use ($passedParams) {
                    return $query->whereHas('getRole', function ($query) use($passedParams) {
                        $query->where('id', $passedParams['role']);
                    });
                });
            }

            if(!empty($passedParams['currency'])) {
                $user->when($passedParams['currency'], function ($query) use ($passedParams) {
                    return $query->whereHas('getCurrency', function ($query) use($passedParams) {
                        $query->where('id', $passedParams['currency']);
                    });
                });
            }
            
            if(!empty($passedParams['brand'])) {
                $user->when($passedParams['brand'], function ($query) use ($passedParams) {
                    return $query->whereHas('getBrand', function ($query) use($passedParams) {
                        $query->where('id', $passedParams['brand']);
                    });
                });
            }

            if(!empty($passedParams['month'])) {
                $user->when($passedParams['month'], function ($query) use ($passedParams) {
                    return $query->whereMonth('created_at', $passedParams['month']);
                });
            }

            if(!empty($passedParams['year'])) {
                $user->when($passedParams['year'], function ($query) use ($passedParams) {
                    return $query->whereYear('created_at', $passedParams['year']);
                });
            }

            if(!empty($passedParams['dates'])) {
                $user->when($passedParams['dates'], function ($query) use ($passedParams) {

                    $dates = Helper::dates($passedParams['dates']);

                    $query->whereDate('created_at', '>=', $dates->start_date);
                    $query->whereDate('created_at', '<=', $dates->end_date);
                });
            }
            
            $data['users'] = $user->get();
            $reportName = "User Report";
            
            return Excel::download(new UserReportExport($data), "$reportName.xlsx");

        } catch (\Exception $e) {
            return ['resp' => false, 'msg' => $e->getMessage()];
        }
    }

    public function activity_by_user_report_excel(Request $request){
        try {
            $passedParams = json_decode(request()->params, true);
            $user = User::orderBy('id', 'ASC');

            if (!empty($passedParams)) {

                if($passedParams['user'] && !empty($passedParams['user'])){
                    $user->where('id',  $passedParams['user']);
                }

                $user->withCount(['getTotalQuote' => function($query) use( $request, $passedParams ) {

                    if($passedParams['month'] && !empty($passedParams['month'])){
                        $query->whereMonth('created_at',  $passedParams['month']);
                    }

                    if($passedParams['year'] && !empty($passedParams['year'])){
                        $query->whereYear('created_at',  $passedParams['year']);
                    }

                    if($passedParams['dates'] && !empty($passedParams['dates'])){

                        $dates = explode ("-", $passedParams['dates']);

                        $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                        $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                        $query->whereDate('created_at', '>=', $start_date);
                        $query->whereDate('created_at', '<=', $end_date);
                    }

                }]);

                $user->withCount(['getQuote' => function($query) use( $request, $passedParams ) {

                    if($passedParams['month'] && !empty($passedParams['month'])){
                        $query->whereMonth('created_at',  $passedParams['month']);
                    }

                    if($passedParams['year'] && !empty($passedParams['year'])){
                        $query->whereYear('created_at',  $passedParams['year']);
                    }

                    if($passedParams['dates'] && !empty($passedParams['dates'])){

                        $dates = explode ("-", $passedParams['dates']);

                        $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                        $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                        $query->whereDate('created_at', '>=', $start_date);
                        $query->whereDate('created_at', '<=', $end_date);
                    }

                }]);

                $user->withCount(['getCancelledQuote' => function($query) use( $request, $passedParams ) {

                    if($passedParams['month'] && !empty($passedParams['month'])){
                        $query->whereMonth('created_at',  $passedParams['month']);
                    }

                    if($passedParams['year'] && !empty($passedParams['year'])){
                        $query->whereYear('created_at',  $passedParams['year']);
                    }

                    if($passedParams['dates'] && !empty($passedParams['dates'])){

                        $dates = explode ("-", $passedParams['dates']);

                        $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                        $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                        $query->whereDate('created_at', '>=', $start_date);
                        $query->whereDate('created_at', '<=', $end_date);
                    }

                }]);

                $user->withCount(['getTotalBooking' => function($query) use( $request, $passedParams ) {

                    if($passedParams['month'] && !empty($passedParams['month'])){
                        $query->whereMonth('created_at',  $passedParams['month']);
                    }

                    if($passedParams['year'] && !empty($passedParams['year'])){
                        $query->whereYear('created_at',  $passedParams['year']);
                    }

                    if($passedParams['dates'] && !empty($passedParams['dates'])){

                        $dates = explode ("-", $passedParams['dates']);

                        $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                        $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                        $query->whereDate('created_at', '>=', $start_date);
                        $query->whereDate('created_at', '<=', $end_date);
                    }

                }]);

                $user->withCount(['getConfirmedBooking' => function($query) use( $request, $passedParams) {

                    if($passedParams['month'] && !empty($passedParams['month'])){
                        $query->whereMonth('created_at',  $passedParams['month']);
                    }

                    if($passedParams['year'] && !empty($passedParams['year'])){
                        $query->whereYear('created_at',  $passedParams['year']);
                    }

                    if($passedParams['dates'] && !empty($passedParams['dates'])){

                        $dates = explode ("-", $passedParams['dates']);

                        $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                        $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                        $query->whereDate('created_at', '>=', $start_date);
                        $query->whereDate('created_at', '<=', $end_date);
                    }

                }]);

                $user->withCount(['getCancelledBooking' => function($query) use( $request, $passedParams ) {

                    if($passedParams['month'] && !empty($passedParams['month'])){
                        $query->whereMonth('created_at',  $passedParams['month']);
                    }

                    if($passedParams['year'] && !empty($passedParams['year'])){
                        $query->whereYear('created_at',  $passedParams['year']);
                    }

                    if($passedParams['dates'] && !empty($passedParams['dates'])){

                        $dates = explode ("-", $passedParams['dates']);

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
            $reportName = "Activity By User Report Excel";

            return Excel::download(new ActivityByUserReportExport($data), "$reportName.xlsx");

        } catch(\Exception $e) {
            return ['resp' => false, 'msg' => $e->getMessage()];
        }
    }

}
