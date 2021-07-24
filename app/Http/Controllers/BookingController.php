<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Season;
use Cache;
use App\User;
use App\Booking;
use App\PaymentMethod;
use App\Airline;
use App\Brand;
use App\HolidayType;
use App\Currency;
use App\Category;
use App\Supplier;
use App\BookingMethod;
use App\BookingType;
use App\BookingDetail;
use App\BookingDetailFinance;
use App\BookingLog;
use App\BookingPaxDetail;
use App\Commission;
use App\Http\Requests\BookingRequest;
use Auth;
use App\Country;
use Carbon\Carbon;
class BookingController extends Controller
{
    public $pagination = 10;

    public function view_seasons(Request $request)
    {
        $season = Season::orderBy('seasons.created_at', 'desc');
        if(count($request->all()) >  0){
            if($request->has('search') && $request->search){
                $season->where('name', 'like', '%'.$request->search.'%');
            }
        }
        $data['seasons'] = $season->groupBy('seasons.id', 'seasons.name')->paginate($this->pagination);
        return view('bookings.season_listing', $data);
    }

    public function index(Request $request, $id)
    {
        $season = Season::findOrFail(decrypt($id));
        $booking = $season->getBooking();
    
        if (count($request->all()) > 0 && $season->getBooking()->count() > 0) {
            if ($request->has('search') && !empty($request->search)) {
                $booking = $booking->where(function ($query) use ($request) {
                    $query->where('ref_no', 'like', '%'.$request->search.'%')
                    ->orWhere('quote_ref', 'like', '%'.$request->search.'%')
                    ->orWhere('lead_passenger', 'like', '%'.$request->search.'%')
                    ->orWhere('dinning_preference', 'like', '%'.$request->search.'%')
                    ->orWhere('bedding_preference', 'like', '%'.$request->search.'%');
                });
            }
                             
            if ($request->has('currency') && !empty($request->currency)) {
                $booking = $booking->whereHas('getCurrency', function ($q) use($request) {
                    $q->where('name', $request->currency);
                });
            }
            
            if ($request->has('brand') && !empty($request->brand)) {
                $booking = $booking->whereHas('getBrand', function ($q) use($request) {
                    $q->where('name', $request->brand);
                });
            }
            
            if($request->has('date') && !empty($request->date['from']) || !empty($request->date['to'])){
                $booking = $booking->where(function($query) use($request){
                    $query->where('created_at', '>=', Carbon::createFromFormat('d/m/Y', $request->date['from'])->format('Y-m-d'))
                    ->where('created_at', '<=', Carbon::createFromFormat('d/m/Y', $request->date['to'])->format('Y-m-d'));
                });
            }
        }
        
        $data['bookings'] = $booking->paginate($this->pagination);
        $data['season_id'] = $season->id;
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        return view('bookings.listing', $data);
    }

    public function edit($id)
    {
        $data['countries']         = Country::orderBy('name', 'ASC')->get();
        $data['booking']          = Booking::findOrFail(decrypt($id));
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
        $data['payment_methods']  = PaymentMethod::all();
        $data['commission_types'] = Commission::all();
   

        return view('bookings.edit',$data);
    }

    public function show($id)
    {

        $data['countries']        = Country::orderBy('name', 'ASC')->get();
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
        $data['booking']            = Booking::findOrFail(decrypt($id));
        $data['commission_types'] = Commission::all();
        $data['payment_methods']  = PaymentMethod::all();

        return view('bookings.show',$data);

    }

    public function bookingArray($request)
    {
        return [
            'user_id'             =>  Auth::id(),
            'rate_type'           =>  ($request->rate_type == 'live')? 'live': 'manual',
            'commission_id'       =>  $request->commission_id,
            'ref_no'              =>  $request->ref_no,
            'ref_name'            =>  $request->ref_name??'zoho',
            'quote_ref'           =>  $request->quote_no,
            'lead_passenger'      =>  $request->lead_passenger,
            'brand_id'            =>  $request->brand_id,
            'holiday_type_id'     =>  $request->holiday_type_id,
            'sale_person_id'      =>  $request->sale_person_id,
            'season_id'           =>  $request->season_id,
            'country_id'          =>  $request->nationality_id??$request->country_id,
            'agency'              =>  ((int)$request->agency == 1)? '1' : false,
            'dinning_preference'  =>  $request->dinning_preference,
            'bedding_preference'  =>  $request->bedding_preference,
            'currency_id'         =>  $request->currency_id,
            'pax_no'              =>  $request->pax_no,
            'net_price'           =>  $request->total_net_price??$request->total_net_price,
            'markup_amount'       =>  $request->total_markup_amount??$request->markup_amount,
            'markup_percentage'   =>  $request->total_markup_percent??$request->markup_percentage,
            'selling_price'       =>  $request->total_selling_price??$request->selling_price,
            'profit_percentage'   =>  $request->total_profit_percentage??$request->profit_percentage,
            'commission_amount'   =>  $request->commission_amount??$request->commission_amount,
            'selling_currency_oc' =>  $request->selling_price_other_currency??$request->selling_currency_oc,
            'selling_price_ocr'   =>  $request->selling_price_other_currency_rate??$request->selling_price_ocr,
            'amount_per_person'   =>  $request->booking_amount_per_person??$request->amount_per_person,
            'agency_name'        =>   (isset($request['agency_name']))? $request->agency_name : NULL,
            'agency_contact'     =>   (isset($request['agency_contact']))? $request->full_number : NULL, 
            'agency_email'        => (isset($request['agency_email'])) ? $request->agency_email : NULL, 
        ];
    }

    public function getBookingDetailsArray($quoteD)
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
            'estimated_cost_bc'     => $quoteD['estimated_cost_in_booking_currency'],
            'selling_price_bc'      => $quoteD['selling_price_in_booking_currency'],
            'markup_amount_bc'      => $quoteD['markup_amount_in_booking_currency'],
            'added_in_sage'         => ($quoteD['added_in_sage'] == "0")? '0' : '1',
        ];
    }


    public function getFinanceBookingDetailsArray($quoteD)
    {
        return [
         
            "deposit_amount"        => $quoteD['deposit_amount']??NULL,
            "deposit_due_date"      => $quoteD['deposit_due_date']??NULL,
            "paid_date"             => $quoteD['paid_date']??NULL,
            "payment_method_id"     => $quoteD['payment_method']??NULL,
            "upload_to_calender"    => $quoteD['upload_to_calender']??NULL,
            "additional_date"       => $quoteD['ab_number_of_days']??NULL,
        ];
    }

    public function update(BookingRequest $request, $id)
    {
        $booking = Booking::findOrFail(decrypt($id));
        $array =  $booking->toArray();
        $book =[];
        foreach ($booking->getBookingDetail as $bookingde) {
            $d = $bookingde->toArray();
            $d['finance'] = $bookingde->getBookingFinance->toArray();
            array_push($book, $d);
        }
        $array['booking'] = $book;
        $array['pax'] = $booking->getBookingPaxDetail->toArray();
        BookingLog::create([
                'booking_id'   => $booking->id,
                'version_no' => $booking->version,
                'data'       => $array,
                'log_no'     =>  $booking->getBookingLogs()->count()
            ]);
            
            
        $booking->update($this->bookingArray($request));
        if($request->has('quote') && count($request->quote) > 0){
            $booking->getBookingDetail()->delete();
            foreach ($request->quote as $qu_details) {
                $bookingDetail = $this->getBookingDetailsArray($qu_details);
                $bookingDetail['booking_id'] = $booking->id;
                $booking_Details=  BookingDetail::create($bookingDetail);
                foreach ($qu_details['finance'] as $finance){
                    $fin = $this->getFinanceBookingDetailsArray($finance);
                    $fin['booking_detail_id'] = $booking_Details->id;
                    BookingDetailFinance::create($fin);
                }
            }
        }
        
         //pax data 
         if($request->has('pax')){
            $booking->getPaxDetail()->delete();
             foreach ($request->pax as $pax_data) {
                 BookingPaxDetail::create([
                     'booking_id'              => $booking->id,
                     'full_name'             => $pax_data['full_name']??NULL,
                     'email'                 => $pax_data['email_address']??NULL,
                     'contact'               => $pax_data['full_number']??NULL,
                     'date_of_birth'         => $pax_data['date_of_birth']??NULL,
                     'bedding_preference'    => $pax_data['bedding_preference']??NULL,
                     'dinning_preference'    => $pax_data['dinning_preference']??NULL,
                     'country_id'            => $pax_data['nationality_id']??NULL,
                 ]);
             }
        }

        return redirect()->route('bookings.index',encrypt($request->season_id))->with('success_message', 'Booking update successfully');    
    }
    
    private function curl_data($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return $output = curl_exec($ch);
    }
    
    
    public function destroy(Request $request, $id)
    {
        Booking::destroy(decrypt($id));
        return redirect()->route('bookings.index',$request->season)->with('success_message', 'Booking deleted successfully');    
    }
    
    public function viewVersion($id)
    {
        $booking_log = BookingLog::findOrFail(decrypt($id));
        $data['log']                = $booking_log;
        $data['booking']            = $booking_log->data;
        $data['countries']          = Country::orderBy('name', 'ASC')->get();
        $data['categories']         = Category::all()->sortBy('name');
        $data['seasons']            = Season::all();
        $data['booked_by']          = User::all()->sortBy('name');
        $data['supervisors']        = User::whereHas('getRole', function($query){
                                                $query->where('slug', 'supervisor');
                                        })->get();
        $data['sale_persons']       = User::whereHas('getRole', function($query){
                                            $query->where('slug', 'sales-agent');
                                        })->get();
        $data['booking_methods']    = BookingMethod::all()->sortBy('id');
        $data['currencies']         = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['brands']             = Brand::orderBy('id','ASC')->get();
        $data['booking_types']      = BookingType::all();
        $data['payment_methods']    = PaymentMethod::all();
        $data['commission_types']   = Commission::all();
        
        return view('bookings.version',$data);
    }
}
