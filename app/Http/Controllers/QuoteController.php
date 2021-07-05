<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Season;
use App\User;
use App\Supplier;
use App\BookingMethod;
use App\Currency;
use App\Template;
use App\Brand;
use App\HolidayType;
use App\BookingType;
use App\CurrencyConversion;
use App\Quote;
use App\QuoteDetail;
use App\QuotePaxDetail;
use Auth;
use App\Http\Requests\QuoteRequest;

class QuoteController extends Controller
{
    public $pagiantion = 10;
    
    public function index()
    {
       $data['quotes'] = Quote::paginate($this->pagiantion);
       return view('quotes.listing', $data);
       
    }
    
    public function create()
    {

        $data['categories']       = Category::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::whereHas('getRole', function($query){
                                        $query->where('slug', 'supervisor');
                                    })->get();
        $data['sale_persons']      = User::whereHas('getRole', function($query){
                                        $query->where('slug', 'sales-agent');
                                    })->get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        return view('quotes.create', $data);
    }

    public function get_currency_conversion(){
        return  CurrencyConversion::all();
    }
    
    public function quoteArray($request)
    {
        $data =  [
            'user_id'            =>  Auth::id(),
            'season_id'          =>  $request->season_id,
            'brand_id'           =>  $request->brand_id,
            'currency_id'        =>  $request->currency_id,
            'holiday_type_id'    =>  $request->holiday_type_id,
            'ref_name'           =>  $request->ref_name??'zoho',
            'ref_no'             =>  $request->ref_no,
            'quote_ref'          =>  $request->quote_no,
            'lead_passenger'     =>  $request->lead_passenger,
            'sale_person'        =>  $request->sales_person,
            'agency'             =>  ($request->agency == 'on')? '1' : '0',
            'dinning_preference' =>  $request->dinning_preferences,
            'bedding_preference' =>  $request->bedding_preference,
            'pax_no'             =>  $request->pax_no,
            'markup_amount'      =>  $request->total_markup_amount,
            'markup_percentage'  =>  $request->total_markup_percent,
            'selling_price'      =>  $request->total_selling_price,
            'profit_percentage'  =>  $request->total_profit_percentage,
            'selling_currency_oc'=>  $request->selling_price_other_currency,
            'selling_price_oc'   =>  $request->selling_price_other_currency_rate,
            'amount_per_person'  =>  $request->booking_amount_per_person,
            'rate_type'          =>  ($request->rate_type == 'live')? 'live': 'manual',
        ];
        
        if($request->has('agency') && $request->agency == 'yes'){
            $data['agency_name']        = $request->agency_name;
            $data['agency_contact']     = $request->agency_contact;
        }
        
        return $data;
    }
    
    public function getQuoteDetailsArray($quoteD, $id)
    {
        return [
            'quote_id'              => $id,
            'category_id'           => $quoteD['category_id'],
            'supplier_id'           => (isset($quoteD['supplier_id']))? $quoteD['supplier_id'] : NULL ,
            'product_id'            => (isset($quoteD['product_id']))? $quoteD['product_id'] : NULL,
            'booking_method_id'     => $quoteD['booking_method_id'],
            'booked_by_id'          => $quoteD['booked_by_id'],
            'supervisor_id'         => $quoteD['supervisor_id'],
            'date_of_service'       => $quoteD['date_of_service'],
            'booking_date'          => $quoteD['booking_date'],
            'booking_due_date'      => $quoteD['booking_due_date'],
            'service_details'       => $quoteD['service_details'],
            'booking_refrence'      => $quoteD['booking_refrence'],
            'booking_type'          => $quoteD['booking_type'],
            'supplier_currency_id'  => $quoteD['supplier_currency_id'],
            'comments'              => $quoteD['comments'],
            'estimated_cost'        => $quoteD['estimated_cost'],
            'markup_amount'         => $quoteD['markup_amount'],
            'markup_percentage'     => $quoteD['markup_percentage'],
            'selling_price'         => $quoteD['selling_price'],
            'profit_percentage'     => $quoteD['profit_percentage'],
            'selling_price_bc'      => $quoteD['selling_price_in_booking_currency'],
            'markup_amount_bc'      => $quoteD['markup_amount_in_booking_currency'],
            'added_in_sage'         => ($quoteD['added_in_sage'] == "0")? '0' : '1',
        ];
    }
    
    public function store(QuoteRequest $request)
    {
        $quote =  Quote::create($this->quoteArray($request));
        if($request->has('quote') && count($request->quote) > 0){
            foreach ($request->quote as $qu_details) {
                    $quoteDetail = $this->getQuoteDetailsArray($qu_details, $quote->id);
                    QuoteDetail::create($quoteDetail);
            }
        }
       //pax data 
       if($request->has('pax')){
            foreach ($request->pax as $pax_data) {
                QuotePaxDetail::create([
                    'quote_id'              => $quote->id,
                    'full_name'             => $pax_data['full_name'],
                    'email'                 => $pax_data['email_address'],
                    'contact'               => $pax_data['contact_number'],
                    'date_of_birth'         => $pax_data['date_of_birth'],
                    'bedding_preference'    => $pax_data['bedding_preference'],
                    'dinning_preference'    => $pax_data['dinning_preference'],
                ]);
            }
       }
       return redirect()->route('quotes.index')->with('success_message', 'Role created successfully');
    }
    
}
