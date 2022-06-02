<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Helper;
use App\Currency;
use App\User;
use App\Season;
use App\Brand;
use App\Booking;
use App\Quote;
use App\Traits\PaginationTrait;

class CustomerController extends Controller
{
    use PaginationTrait;

    public $pagination = 10;

    public function index(Request $request)
    {
        $emails = DB::table('quotes')->where('agency', '0')->groupBy('lead_passenger_email');

        if ($request->has('search') && !empty($request->search)) {

            $emails = $emails->where(function ($query) use($request) {
                $query->where('lead_passenger_name', 'like', '%'.$request->search.'%')
                ->orWhere('lead_passenger_email', 'like', '%'.$request->search.'%');
            });
        }

        $emails = $emails->select(['lead_passenger_email','lead_passenger_name'])->get()->toArray();

        $customers_data = [];
        if($emails && count($emails) > 0){

            foreach($emails as $key => $email){

                $customers_data[$key]['name']    = $email->lead_passenger_name;
                $customers_data[$key]['email']   = $email->lead_passenger_email;
                $customers_data[$key]['quotes']  = DB::table('quotes')->where('lead_passenger_email',$email->lead_passenger_email)->count();
                $customers_data[$key]['booking'] = DB::table('bookings')->where('lead_passenger_email', $email->lead_passenger_email)->count();
            }
        }

        $customers = $this->paginate($customers_data, $this->pagination);
        $customers->withPath('index');

        $data['customers'] = $customers;

        return view('customers.listing', $data);       
    }

    
    public function quote_listing(Request $request, $email)
    {

        $quote  = Quote::select('*', DB::raw('count(*) as quote_count'))->withTrashed()->where('is_archive', '!=', 1)->where('lead_passenger_email', decrypt($email));
        if(count($request->all()) >0){
            $quote = $this->searchFilters($quote, $request);
        }

        $data['quotes']           = $quote->groupBy('ref_no')->orderBy('created_at','DESC')->paginate($this->pagination);
        $data['booking_seasons']  = Season::all();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
        $data['users']            = User::get();
        $data['customer']         = Quote::where('lead_passenger_email', decrypt($email))->select('lead_passenger_name','lead_passenger_email','lead_passenger_contact','lead_passenger_dbo','lead_passsenger_nationailty_id')->first();
       
        return view('customers.quote_listing', $data);
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
                $quote->where('status', 'like', '%'.$request->status.'%' );
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
                ->orWhere('quote_ref', 'like', '%'.$request->search.'%');                    
            });
        }
        
        $quote->when($request->dates, function ($query) use ($request) {

            $dates = Helper::dates($request->dates);

            $query->whereDate('created_at', '>=', $dates->start_date);
            $query->whereDate('created_at', '<=', $dates->end_date);
        });

        return $quote;
    }


    public function booking_listing(Request $request, $email)
    {
        $booking = Booking::orderBy('created_at','DESC')->where('lead_passenger_email', decrypt($email));

        if (count($request->all()) > 0 && $booking->count() > 0) {

            if ($request->has('search') && !empty($request->search)) {
                $booking = $booking->where(function ($query) use ($request) {
                    $query->where('ref_no', 'like', '%'.$request->search.'%')
                    ->orWhere('quote_ref', 'like', '%'.$request->search.'%')
                    ->orWhere('lead_passenger_name', 'like', '%'.$request->search.'%');
                    // ->orWhere('lead_passenger_email', 'like', '%'.$request->search.'%');
                });
            }
            if($request->has('client_type') && !empty($request->client_type)){
                $client_type = ($request->client_type == 'client')? 0 : 1;
                if($client_type == 0)
                {
                    $booking->where('agency', '!=', 1);    
                }else{
                    $booking->where('agency', (int)$client_type);    
                }
            }
            
            if($request->has('staff') && !empty($request->staff)){
                $booking->whereHas('getSalePerson', function($query) use($request){
                    $query->where('name', 'like', '%'.$request->staff.'%' );
                });
            }
            
            if($request->has('booking_currency') && !empty($request->booking_currency)){
                $booking->whereHas('getCurrency', function($query) use($request){
                    foreach ($request->booking_currency as $currency) {
                        $query->where('code', 'like', '%'.$currency.'%' );
                    }
                });
            }          
            
            if($request->has('booking_season') && !empty($request->booking_season)){
                $booking->whereHas('getSeason', function($query) use($request){
                    $query->where('name',  'like', '%'.$request->booking_season.'%');
                });
            }        
                        
            if($request->has('brand') && !empty($request->brand)){
                $booking->whereHas('getBrand', function($query) use($request){
                    foreach ($request->brand as $brand) {
                        $query->where('name', 'like', '%'.$brand.'%' );
                    }
                });
            }      
            
            $booking->when($request->dates, function ($query) use ($request) {
                $dates = Helper::dates($request->dates);

                $query->whereDate('created_at', '>=', $dates->start_date);
                $query->whereDate('created_at', '<=', $dates->end_date);
            });
        }
        
        $data['bookings']            = $booking->paginate($this->pagination);
        $data['currencies']          = Currency::active()->orderBy('id', 'ASC')->get();
        $data['brands']              = Brand::orderBy('id','ASC')->get();
        $data['booking_seasons']     = Season::all();
        $data['users']               = User::all();
        $data['customer']            = Booking::where('lead_passenger_email', decrypt($email))->select('lead_passenger_name','lead_passenger_email','lead_passenger_contact','lead_passenger_dbo','lead_passsenger_nationailty_id')->first();
        
        return view('customers.booking_listing', $data);
    }
}
