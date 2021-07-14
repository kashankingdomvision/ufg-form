<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuoteRequest;
use Auth;
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
use App\QuoteLog;
use App\Booking;
use App\BookingDetail;
use App\BookingPaxDetail;
use App\Commission;
use DB;
use Carbon\Carbon;

class QuoteController extends Controller
{
    public $pagiantion = 10;
    
    public function index()
    {
        $data['quotes'] = Quote::select('*', DB::raw('count(*) as quote_count'))->groupBy('ref_no')->paginate(10);
        return view('quotes.listing', $data);       
    }
    
    
    public function create()
    {

        $data['templates']        = Template::all()->sortBy('name');
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
        $data['commission_types'] = Commission::all();

        return view('quotes.create', $data);
    }

    public function get_currency_conversion(){
        return CurrencyConversion::all();
    }

    public function get_commission(){
        return Commission::all();
    }
    
    public function quoteArray($request)
    {
        $data =  [
            'commission_id'      =>  $request->commission_id,
            'user_id'            =>  Auth::id(),
            'season_id'          =>  $request->season_id,
            'brand_id'           =>  $request->brand_id,
            'currency_id'        =>  $request->currency_id,
            'holiday_type_id'    =>  $request->holiday_type_id,
            'ref_name'           =>  $request->ref_name??'zoho',
            'ref_no'             =>  $request->ref_no,
            'quote_ref'          =>  $request->quote_no??$request->quote_ref,
            'lead_passenger'     =>  $request->lead_passenger,
            'sale_person_id'     =>  $request->sale_person_id,
            'agency'             =>  ($request->agency == 1)? 1 : (($request->agency == 'on')? '1' : '0'),
            'dinning_preference' =>  $request->dinning_preference,
            'bedding_preference' =>  $request->bedding_preference,
            'pax_no'             =>  $request->pax_no,
            'net_price'          =>  $request->total_net_price??$request->net_price,
            'markup_amount'      =>  $request->total_markup_amount??$request->markup_amount,
            'markup_percentage'  =>  $request->total_markup_percent??$request->markup_percentage,
            'selling_price'      =>  $request->total_selling_price??$request->selling_price,
            'profit_percentage'  =>  $request->total_profit_percentage??$request->profit_percentage,
            'commission_amount'  =>  $request->commission_amount??$request->commission_amount,
            'selling_currency_oc'=>  $request->selling_price_other_currency??$request->selling_currency_oc,
            'selling_price_ocr'  =>  $request->selling_price_other_currency_rate??$request->selling_price_ocr,
            'amount_per_person'  =>  $request->booking_amount_per_person??$request->amount_per_person,
            'rate_type'          =>  ($request->rate_type == 'live')? 'live': 'manual',
        ];
        
        if($request->agency == 'yes' || $request->agency == 1){
            $data['agency_name']        = $request->agency_name;
            $data['agency_contact']     = $request->agency_contact;
        }
        
        return $data;
    }
    
    public function getQuoteDetailsArray($quoteD, $id)
    {
        return [
            'category_id'           => $quoteD['category_id'],
            'supplier_id'           => (isset($quoteD['supplier_id']))? $quoteD['supplier_id'] : NULL ,
            'product_id'            => (isset($quoteD['product_id']))? $quoteD['product_id'] : NULL,
            'booking_method_id'     => $quoteD['booking_method_id'],
            'booked_by_id'          => $quoteD['booked_by_id'],
            'supervisor_id'         => $quoteD['supervisor_id'],
            'date_of_service'       => $quoteD['date_of_service'],
            'time_of_service'       => $quoteD['time_of_service'],
            'booking_date'          => $quoteD['booking_date'],
            'booking_due_date'      => $quoteD['booking_due_date'],
            'service_details'       => $quoteD['service_details'],
            'booking_reference'     => $quoteD['booking_reference'],
            'booking_type_id'       => $quoteD['booking_type'],
            'supplier_currency_id'  => $quoteD['supplier_currency_id'],
            'comments'              => $quoteD['comments'],
            'estimated_cost'        => $quoteD['estimated_cost'],
            'markup_amount'         => $quoteD['markup_amount'],
            'markup_percentage'     => $quoteD['markup_percentage'],
            'selling_price'         => $quoteD['selling_price'],
            'profit_percentage'     => $quoteD['profit_percentage'],
            'estimated_cost_bc'     => $quoteD['estimated_cost_in_booking_currency']??$quoteD['estimated_cost_bc'],
            'selling_price_bc'      => $quoteD['selling_price_in_booking_currency']??$quoteD['selling_price_bc'],
            'markup_amount_bc'      => $quoteD['markup_amount_in_booking_currency']??$quoteD['markup_amount_bc'],
            'added_in_sage'         => ($quoteD['added_in_sage'] == "0")? '0' : '1',
        ];
    }
    
    public function store(QuoteRequest $request)
    {
        $quote =  Quote::create($this->quoteArray($request));
        if($request->has('quote') && count($request->quote) > 0){
            foreach ($request->quote as $qu_details) {
                $quoteDetail = $this->getQuoteDetailsArray($qu_details, $quote->id);
                $quoteDetail['quote_id'] = $quote->id;
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
       return redirect()->route('quotes.index')->with('success_message', 'Quote created successfully');
    }
    
    public function edit($id)
    {
        $data['templates']        = Template::all()->sortBy('name');
        $data['categories']       = Category::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::whereHas('getRole', function($query){
                                        $query->where('slug', 'supervisor');
                                    })->get();
        $data['sale_persons']     = User::whereHas('getRole', function($query){
                                        $query->where('slug', 'sales-agent');
                                    })->get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['quote']            = Quote::findOrFail(decrypt($id));
        $data['commission_types'] = Commission::all();

        return view('quotes.edit',$data);
    }
    
    public function update(QuoteRequest $request, $id)
    {
        $quote = Quote::findOrFail(decrypt($id));
        $array =  $quote->toArray();
        $array['quote'] = $quote->getQuoteDetails->toArray();
        $array['pax'  ] = $quote->getPaxDetail->toArray();

        QuoteLog::create([
            'quote_id'   => $quote->id,
            'version_no' => $quote->version,
            'data'       => $array,
            'log_no'     => $quote->getQuotelogs()->count(),
        ]);
        
        $quote->update($this->quoteArray($request));
        
        if($request->has('quote') && count($request->quote) > 0){
            $quote->getQuoteDetails()->delete();
            foreach ($request->quote as $qu_details) {
                $quoteDetail = $this->getQuoteDetailsArray($qu_details, $quote->id);
                $quoteDetail['quote_id'] = $quote->id;
                
                QuoteDetail::create($quoteDetail);
            }
        }
        
        //pax data 
        if($request->has('pax')){
           $quote->getPaxDetail()->delete();
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
       return redirect()->route('quotes.index')->with('success_message', 'Quote update successfully');        
    }
    
    public function quoteVersion($id, $type = null)
    {
        $log = QuoteLog::findOrFail(decrypt($id));
        $data['quote'] = $log->data;
        $data['log']  = $log;
        $data['categories']       = Category::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::whereHas('getRole', function($query){
                                        $query->where('slug', 'supervisor');
                                    })->get();
        $data['sale_persons']     = User::whereHas('getRole', function($query){
                                        $query->where('slug', 'sales-agent');
                                    })->get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['commission_types'] = Commission::all();

        if($type != NULL){
            $data['type'] = $type;
        }
        // dd($log->data);
        return view('quotes.version', $data);


        $currency_conver = CurrencyConversions::whereNull('live');
        
        
        $from   = $currency_conver->pluck(['from', 'to']);
        $count  = $currency_conver->count();
    }


    public function delete($id)
    {
        Quote::destroy(decrypt($id));
        return redirect()->route('quotes.index')->with('success_message', 'Quote deleted successfully');        
    }

    public function booking($id)
    {
        $quote = Quote::findORFail(decrypt($id));
        $getQuote = $this->quoteArray($quote);
        $getQuote['quote_id'] = $quote->id; 
        $booking = Booking::create($getQuote);
        
        foreach ($quote->getQuoteDetails as $qu_details) {
            $quoteDetail = $this->getQuoteDetailsArray($qu_details, $quote->id);
            $quoteDetail['booking_id'] = $booking->id;
            BookingDetail::create($quoteDetail);
        }
        
        if($quote->getPaxDetail && $quote->pax_no > 1){
            foreach ($quote->getPaxDetail as $pax) {
                BookingPaxDetail::create([
                    'booking_id'            => $booking->id,
                    'full_name'             => $pax['full_name'],
                    'email'                 => $pax['email'],
                    'contact'               => $pax['contact'],
                    'date_of_birth'         => $pax['date_of_birth'],
                    'bedding_preference'    => $pax['bedding_preference'],
                    'dinning_preference'    => $pax['dinning_preference'],
                ]);
            }
        }
        $quote->update([
            'booking_status' => 'booked',
            'booking_date'   => Carbon::now()
        ]);
        
        return redirect()->route('quotes.index')->with('success_message', 'Quote Booked successfully');        
    }
    
    public function getTrash()
    {
        $data['quotes'] = Quote::onlyTrashed()->get();
        return view('quotes.quotetrash', $data);
    } 
    
    public function restore($id)
    {
        $quote = Quote::withTrashed()->find(decrypt($id))->restore();
        return redirect()->route('quotes.view.trash')->with('success_message', 'Quote restored successfully');        
    }
}
