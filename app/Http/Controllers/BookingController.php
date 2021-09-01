<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingRefundPaymentRequest;
use App\Http\Requests\BookingCreditNoteRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Helper;

use App\Airline;
use App\AccomodationDetail;
use App\Brand;
use App\Bank;
use App\Booking;
use App\BookingRefundPayment;
use App\BookingCreditNote;
use App\BookingMethod;
use App\BookingType;
use App\BookingDetail;
use App\BookingDetailFinance;
use App\BookingLog;
use App\BookingPaxDetail;
use App\Currency;
use App\Commission;
use App\Country;
use App\Category;
use App\HolidayType;
use App\PaymentMethod;
use App\QuoteUpdateDetail;
use App\Season;
use App\Supplier;
use App\ServiceExcursionDetail;
use App\User;
use App\TransferDetail;
use App\Wallet;
use App\Quote;
use Cache;
use Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public $pagination = 10, $cacheTimeOut;

    public function __construct(Request $request)
    {
        $this->cacheTimeOut = 180000;
    }

    public function view_seasons(Request $request)
    {
        $season = Season::orderBy('seasons.created_at', 'desc');
        if(count($request->all()) >  0){
            if($request->has('seasons') && $request->seasons){
                $season->where('name', $request->seasons);
            }
        }
        $data['seasons'] = $season->groupBy('seasons.id', 'seasons.name')->paginate($this->pagination);
        $data['booking_seasons'] = Season::orderBy('seasons.created_at', 'desc')->groupBy('seasons.id', 'seasons.name')->get();
        return view('bookings.season_listing', $data);
    }

    public function index(Request $request)
    {
        // $season = Season::findOrFail(decrypt($id));
        $booking = Booking::orderBy('created_at','DESC');
    
        if (count($request->all()) > 0 && $booking->count() > 0) {
            if ($request->has('search') && !empty($request->search)) {
                $booking = $booking->where(function ($query) use ($request) {
                    $query->where('ref_no', 'like', '%'.$request->search.'%')
                    ->orWhere('quote_ref', 'like', '%'.$request->search.'%')
                    ->orWhere('lead_passenger_name', 'like', '%'.$request->search.'%')
                    ->orWhere('lead_passenger_email', 'like', '%'.$request->search.'%');
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
            
            if($request->has('created_date')){
                $booking->where(function($query) use($request){
                    if(isset($request->created_date['form']) && !empty($request->created_date['form'])){
                        $query->where('created_at', '>=', Carbon::createFromFormat('d/m/Y', $request->created_date['from'])->format('Y-m-d'));
                    }
                    if (isset($request->created_date['to']) && !empty($request->created_date['to'])) {
                        $query->where('created_at', '<=', Carbon::createFromFormat('d/m/Y', $request->created_date['to'])->format('Y-m-d'));
                    }
                });
            }
        }
        
        $data['bookings']            = $booking->paginate($this->pagination);
        $data['currencies']          = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['brands']              = Brand::orderBy('id','ASC')->get();
        $data['booking_seasons']     = Season::all();
        $data['users']               = User::all();
        
        return view('bookings.listing', $data);
    }

    public function bookingArray($request)
    {
        return [
            'user_id'                           =>  Auth::id(),
            'rate_type'                         =>  ($request->rate_type == 'live')? 'live': 'manual',
            'commission_id'                     =>  $request->commission_id,
            'ref_no'                            =>  $request->ref_no,
            'ref_name'                          =>  $request->ref_name??'zoho',
            'quote_ref'                         =>  $request->quote_no,
            'agency'                            =>  ((int)$request->agency == '1')? '1' : '0',
            'agency_name'                       =>  $request->agency_name??NULL,
            'agency_contact'                    =>  ($request->agency_contact != NULL)? $request->full_number : NULL,
            'agency_email'                      =>  $request->agency_email??NULL,
            'agency_contact_name'               =>  $request->agency_contact_name??NULL,
            'lead_passenger_name'               =>  $request->lead_passenger_name??NULL,
            'lead_passenger_email'              =>  $request->lead_passenger_email??NULL,
            'lead_passenger_contact'            =>  ($request->lead_passenger_contact != NULL)? $request->full_number : NULL,
            'lead_passenger_dbo'                =>  $request->lead_passenger_dbo??NULL,
            'lead_passsenger_nationailty_id'    =>  $request->lead_passsenger_nationailty_id??NULL,
            'lead_passenger_dinning_preference' =>  $request->lead_passenger_dinning_preference??NULL,
            'lead_passenger_bedding_preference' =>  $request->lead_passenger_bedding_preference??NULL,
            'lead_passenger_covid_vaccinated'   =>  ((int) $request->lead_passenger_covid_vaccinated == '1')? '1' : '0',
            'brand_id'                          =>  $request->brand_id,
            'holiday_type_id'                   =>  $request->holiday_type_id,
            'sale_person_id'                    =>  $request->sale_person_id,
            'season_id'                         =>  $request->season_id,
            'currency_id'                       =>  $request->currency_id,
            'pax_no'                            =>  $request->pax_no,
            'net_price'                         =>  $request->total_net_price??$request->total_net_price,
            'markup_amount'                     =>  $request->total_markup_amount??$request->markup_amount,
            'markup_percentage'                 =>  $request->total_markup_percent??$request->markup_percentage,
            'selling_price'                     =>  $request->total_selling_price??$request->selling_price,
            'profit_percentage'                 =>  $request->total_profit_percentage??$request->profit_percentage,
            'commission_amount'                 =>  $request->commission_amount??$request->commission_amount,
            'selling_currency_oc'               =>  $request->selling_price_other_currency??$request->selling_currency_oc,
            'selling_price_ocr'                 =>  $request->selling_price_other_currency_rate??$request->selling_price_ocr,
            'amount_per_person'                 =>  $request->booking_amount_per_person??$request->amount_per_person,
            'agency_name'                       =>  (isset($request['agency_name']))? $request->agency_name : NULL,
            'agency_contact'                    =>  (isset($request['agency_contact']))? $request->full_number : NULL, 
            'agency_email'                      =>  (isset($request['agency_email'])) ? $request->agency_email : NULL, 
            'revelant_qoutes'                   =>  $request->revelant_qoutes??NULL,
        ];
    }

    public function getBookingDetailsArray($quoteD)
    {
        return [
            'category_id'             => $quoteD['category_id'],
            'supplier_id'             => (isset($quoteD['supplier_id']))? $quoteD['supplier_id'] : NULL ,
            'product_id'              => (isset($quoteD['product_id']))? $quoteD['product_id'] : NULL,
            'booking_method_id'       => $quoteD['booking_method_id'],
            'booked_by_id'            => $quoteD['booked_by_id'],
            'supervisor_id'           => $quoteD['supervisor_id'],
            'date_of_service'         => $quoteD['date_of_service'],
            'end_date_of_service'     => $quoteD['end_date_of_service'],
            'time_of_service'         => $quoteD['time_of_service'],
            'booking_date'            => $quoteD['booking_date'],
            'booking_due_date'        => $quoteD['booking_due_date'],
            'service_details'         => $quoteD['service_details'],
            'booking_reference'       => $quoteD['booking_reference'],
            'booking_type_id'         => $quoteD['booking_type'],
            'supplier_currency_id'    => $quoteD['supplier_currency_id'],
            'comments'                => $quoteD['comments'],
            'estimated_cost'          => $quoteD['estimated_cost'],
            'markup_amount'           => $quoteD['markup_amount'],
            'markup_percentage'       => $quoteD['markup_percentage'],
            'selling_price'           => $quoteD['selling_price'],
            'profit_percentage'       => $quoteD['profit_percentage'],
            'estimated_cost_bc'       => $quoteD['estimated_cost_in_booking_currency'],
            'selling_price_bc'        => $quoteD['selling_price_in_booking_currency'],
            'markup_amount_bc'        => $quoteD['markup_amount_in_booking_currency'],
            'added_in_sage'           => (isset($quoteD['added_in_sage']))? (($quoteD['added_in_sage'] == "0")? '0' : '1') : '0',
            'outstanding_amount_left' => $quoteD['outstanding_amount_left'],
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
            "outstanding_amount"    => $quoteD['outstanding_amount']??NULL,
        ];
    }

    public function getBookingCreditNoteArray($quoteD)
    {
        return [
            "credit_note_amount"         => $quoteD['credit_note_amount']??NULL,
            "credit_note_no"             => Helper::getCreditNote(),
            "credit_note_recieved_date"  => $quoteD['credit_note_recieved_date']??NULL,
            "credit_note_recieved_by"    => $quoteD['credit_note_recieved_by']??NULL,
        ];
    }

    public function getBookingRefundPaymentArray($quoteD)
    {
        return [
            "refund_amount"        => $quoteD['refund_amount']??NULL,
            "refund_date"          => $quoteD['refund_date']??NULL,
            "bank_id"              => $quoteD['bank']??NULL,
            "refund_confirmed_by"  => $quoteD['refund_confirmed_by']??NULL
        ];
    }

    public function getAccommodationDetailsArray($quoteD)
    {
        return [
            // "accomadation_name"       => $quoteD['accomadation_name']??NULL,
            "arrival_date"            => $quoteD['arrival_date']??NULL,
            "no_of_nights"            => $quoteD['no_of_nights']??NULL,
            "no_of_rooms"             => $quoteD['no_of_rooms']??NULL,
            "room_types"              => $quoteD['room_types']??NULL,
            "meal_plan"               => $quoteD['meal_plan']??NULL,
            "refrence"                => $quoteD['refrence']??NULL,
            'day_event'               => isset($quoteD['day_event']) ? $quoteD['day_event']: null,
            'confirmed_with_supplier' => isset($quoteD['confirmed_with_supplier']) ? $quoteD['confirmed_with_supplier'] : null , 
        ];
    }

    public function getTransferDetailsArray($quoteD)
    {
        return [
            "transfer_description"    => $quoteD['transfer_description']??NULL,
            "quantity"                => $quoteD['quantity']??NULL,
            "pickup_port"             => $quoteD['pickup_port']??NULL,
            "pickup_accomodation"     => $quoteD['pickup_accomodation']??NULL,
            "pickup_date"             => $quoteD['pickup_date']??NULL,
            "pickup_time"             => $quoteD['pickup_time']??NULL,
            "dropoff_port"            => $quoteD['dropoff_port']??NULL,
            "dropoff_accomodation"    => $quoteD['dropoff_accomodation']??NULL,
            "dropoff_date"            => $quoteD['dropoff_date']??NULL,
            "dropoff_time"            => $quoteD['dropoff_time']??NULL,
            'confirmed_with_supplier'  => isset($quoteD['confirmed_with_supplier']) ? $quoteD['confirmed_with_supplier'] : 2 , 
        ];
    }

    public function getServiceExcursionDetailsArray($quoteD)
    {
        return [
            'name'                     => $quoteD['name']??NULL,
            'description'              => $quoteD['description']??NULL,               
            'date'                     => $quoteD['date']??NULL,        
            'time'                     => $quoteD['time']??NULL,
            'quantity'                 => $quoteD['quantity']??NULL,          
            'refrence'                 => $quoteD['refrence']??NULL,      
            'confirmed_with_supplier'  => isset($quoteD['confirmed_with_supplier']) ? $quoteD['confirmed_with_supplier'] : 2 ,    
            'note'                     => $quoteD['note']??NULL,
        ];
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail(decrypt($id));
        $data['countries']        = Country::orderBy('name', 'ASC')->get();
        $data['booking']          = $booking;
        $data['categories']       = Category::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::whereHas('getRole', function($query){
                                        $query->where('slug', 'supervisor');
                                    })->get();
        $data['sale_persons']     = User::get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['payment_methods']  = PaymentMethod::all();
        $data['commission_types'] = Commission::all();
        $data['banks']            = Bank::all();
        $data['quote_ref']        = Quote::where('quote_ref','!=', $booking['quote_ref'])->get('quote_ref');

        if(isset($data['booking']->ref_no) && !empty($data['booking']->ref_no)){

            $zoho_booking_reference = isset($data['booking']->ref_no) && !empty($data['booking']->ref_no) ? $data['booking']->ref_no : '' ;

            $response = Cache::remember($zoho_booking_reference, $this->cacheTimeOut, function() use ($zoho_booking_reference) {
                return Helper::get_payment_detial_by_ref_no($zoho_booking_reference);
            });

            if($response['status'] == 200 && isset($response['body']['old_records'])) {
                $data['old_ufg_payment_records'] = $response['body']['old_records'];
            }

            if($response['status'] == 200 && isset($response['body']['message'])) {
                $data['ufg_payment_records'] = $response['body']['message'];
            }
        }

        $data = array_merge($data, Helper::checkAlreadyExistUser($id,'bookings'));

        return view('bookings.edit',$data);
    }

    public function show($id,$status = null)
    {
        $data['countries']        = Country::orderBy('name', 'ASC')->get();
        $data['categories']       = Category::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::whereHas('getRole', function($query){
                                        $query->where('slug', 'supervisor');
                                    })->get();
        $data['sale_persons']     = User::get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['booking']            = Booking::findOrFail(decrypt($id));
        $data['commission_types'] = Commission::all();
        $data['payment_methods']  = PaymentMethod::all();
        $data['banks']            = Bank::all();
        
        if(isset($data['booking']->ref_no) && !empty($data['booking']->ref_no)){

            $zoho_booking_reference = isset($data['booking']->ref_no) && !empty($data['booking']->ref_no) ? $data['booking']->ref_no : '' ;
            $response = Cache::remember($zoho_booking_reference, $this->cacheTimeOut, function() use ($zoho_booking_reference) {
                return Helper::get_payment_detial_by_ref_no($zoho_booking_reference);
            });

            if($response['status'] == 200 && isset($response['body']['old_records'])) {
                $data['old_ufg_payment_records'] = $response['body']['old_records'];
            }

            if($response['status'] == 200 && isset($response['body']['message'])) {
                $data['ufg_payment_records'] = $response['body']['message'];
            }
        }

        $data['status'] = $status;
        $data = array_merge($data, Helper::checkAlreadyExistUser($id,'bookings'));

        return view('bookings.show',$data);
    }

    public function update(BookingRequest $request, $id)
    {

        // dd($request->all());

        // check update access
        $quote_update_detail = QuoteUpdateDetail::where('foreign_id',decrypt($id))->where('user_id', Auth::id())->where('status','bookings');
        if(!$quote_update_detail->exists()) {
            return \Response::json(['status' => false,'overrride_errors' => 'Someone Has Override Update Access.'], 422); // Status code here
        }
        
        //- check update access

        $booking = Booking::findOrFail(decrypt($id));
        $array   = $booking->toArray();
        $book    = [];

        foreach ($booking->getBookingDetail as $bookingde) {
            $d = $bookingde->toArray();
            $d['finance'] = $bookingde->getBookingFinance->toArray();
            array_push($book, $d);
        }

        $array['booking'] = $book;
        $array['pax']     = $booking->getBookingPaxDetail->toArray();

        BookingLog::create([
            'booking_id'    => $booking->id,
            'version_no'    => $booking->version,
            'data'          => $array,
            'log_no'        => $booking->getBookingLogs()->count()
        ]);

        $booking->update($this->bookingArray($request));

        if($request->has('quote') && count($request->quote) > 0){

            $booking->getBookingDetail()->delete();

            foreach ($request->quote as $qu_details) {
                $bookingDetail = $this->getBookingDetailsArray($qu_details);
                $bookingDetail['invoice'] = $this->fileStore($qu_details, $booking->id);
                $bookingDetail['booking_id'] = $booking->id;
                $booking_Details=  BookingDetail::create($bookingDetail);
                foreach ($qu_details['finance'] as $finance){
                    $fin = $this->getFinanceBookingDetailsArray($finance);
                    $fin['booking_detail_id'] = $booking_Details->id;

                    if($fin['deposit_amount'] > 0){
                        BookingDetailFinance::create($fin);

                        if($fin['payment_method_id'] == 3){
                            Wallet::create([
                                'booking_id'        => $booking->id,
                                'booking_detail_id' => $booking_Details->id,
                                'supplier_id'       => $booking_Details->supplier_id,
                                'amount'            => $fin['deposit_amount'],
                                'type'              => 'debit'
                            ]);
                        }
                    }
                }
                    
                foreach ($qu_details['refund'] as $refund){

                    $refund = $this->getBookingRefundPaymentArray($refund);
                    $refund['booking_detail_id'] = $booking_Details->id;

                    if(!empty($refund['refund_amount']) && !empty($refund['refund_date'])){
                        BookingRefundPayment::create($refund);
                        BookingDetailFinance::where('booking_detail_id',$booking_Details->id)->update(['status' => 'cancelled']);
                    }
                }

                if(isset($qu_details['credit_note']) && !empty($qu_details['credit_note'])){
                    
                    foreach ($qu_details['credit_note'] as $credit_note){

                        $credit_note = $this->getBookingCreditNoteArray($credit_note);
                        $credit_note['booking_detail_id'] = $booking_Details->id;
                        $credit_note['supplier_id']       = $booking_Details->supplier_id;
                        $credit_note['user_id']           = Auth::id();

                        if(($credit_note['credit_note_amount']) > 0 && !empty($credit_note['credit_note_recieved_date'])){

                            BookingCreditNote::create($credit_note);
                            Wallet::create([
                                'booking_id'        => $booking->id,
                                'booking_detail_id' => $booking_Details->id,
                                'supplier_id'       => $booking_Details->supplier_id,
                                'amount'            => $credit_note['credit_note_amount'],
                                'type'              => 'credit'
                            ]);

                            BookingDetailFinance::where('booking_detail_id',$booking_Details->id)->update(['status' => 'cancelled']);
                        }
                    }
                }

                // dd($qu_details['category_detials']['accommodation']);
                
                if(isset($qu_details['category_detials'])){
                    
                    if(isset($qu_details['category_detials']['accommodation']) && !empty($qu_details['category_detials']['accommodation'])){

                        // dd($qu_details['category_detials']['accommodation']);
                       
                        $accommodation_details = $this->getAccommodationDetailsArray($qu_details['category_detials']['accommodation']);

                        $accommodation_details['booking_detail_id'] = $booking_Details->id;
                        AccomodationDetail::create($accommodation_details);
                    }

                    if(isset($qu_details['category_detials']['transfer'])){
                       
                        $transfer_details = $this->getTransferDetailsArray($qu_details['category_detials']['transfer']);
                        $transfer_details['booking_detail_id'] = $booking_Details->id;
                        TransferDetail::create($transfer_details);
                    }

                    if(isset($qu_details['category_detials']['service_excursion'])){
                       
                        $service_excursion = $this->getServiceExcursionDetailsArray($qu_details['category_detials']['service_excursion']);
                        $service_excursion['booking_detail_id'] = $booking_Details->id;
                        ServiceExcursionDetail::create($service_excursion);
                    }

                }

            }
        }
        
        // booking pax details
        if($request->has('pax')){

            $booking->getPaxDetail()->delete();

            foreach ($request->pax as $pax_data) {

                BookingPaxDetail::create([
                    'booking_id'            => $booking->id,
                    'full_name'             => $pax_data['full_name']??NULL,
                    'email'                 => $pax_data['email_address']??NULL,
                    'contact'               => $pax_data['full_number']??NULL,
                    'date_of_birth'         => $pax_data['date_of_birth']??NULL,
                    'bedding_preference'    => $pax_data['bedding_preference']??NULL,
                    'dinning_preference'    => $pax_data['dinning_preference']??NULL,
                    'nationality_id'        => $pax_data['nationality_id']??NULL,
                    'covid_vaccinated'      => ((int) $pax_data['covid_vaccinated'] == '1') ? '1' : '0'
                ]);
            }
        }

        // $quote_update_detail->delete(); 

        return \Response::json(['success_message' => 'Booking Update Successfully'], 200);
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
        $booking_log                = BookingLog::findOrFail(decrypt($id));
        $data['log']                = $booking_log;
        $data['booking']            = $booking_log->data;
        $data['countries']          = Country::orderBy('name', 'ASC')->get();
        $data['categories']         = Category::all()->sortBy('name');
        $data['seasons']            = Season::all();
        $data['booked_by']          = User::all()->sortBy('name');
        $data['supervisors']        = User::get();
        $data['sale_persons']       = User::get();
        $data['booking_methods']    = BookingMethod::all()->sortBy('id');
        $data['currencies']         = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['brands']             = Brand::orderBy('id','ASC')->get();
        $data['booking_types']      = BookingType::all();
        $data['payment_methods']    = PaymentMethod::all();
        $data['commission_types']   = Commission::all();

        if(isset($data['booking']['ref_no']) && !empty($data['booking']['ref_no'])){

            $zoho_booking_reference = isset($data['booking']['ref_no']) && !empty($data['booking']['ref_no']) ? $data['booking']['ref_no'] : '' ;
            $response = Cache::remember('response', $this->cacheTimeOut, function() use ($zoho_booking_reference) {
                return Helper::get_payment_detial_by_ref_no($zoho_booking_reference);
            });

            if ($response['status'] == 200) {
                $data['payment_details'] = $response['body']['old_records'];
            }
        }
        
        return view('bookings.version',$data);
    }
    
    public function bookingCancel($id)
    {
        $booking = Booking::findOrFail(decrypt($id))->update(['cancel_date' => Carbon::now()]);
        return redirect()->back()->with('success_message', 'Booking canceled successfully');    
    }
    
    //storage url
    public function fileStore($request, $bookingID)
    {
        if(isset($request['invoice']) && $request['invoice'] != null){
            $url     = 'public/booking/'.$bookingID.'/invoice/';
            $invoice = $request['invoice'];
            $path    = $invoice->store($url);
            // if($old != NULL){
            //     Storage::delete($old->getOriginal('logo'));
            // }
            $file_path = url(Storage::url($path));
            return $path;
        }
        return;
    }

    //storage url

    // 'UC20190765'  payments.unforgettabletravel.com
    // 'UC20189776'  utcstaging.unforgettabletravel.com
    // $response = \Helper::get_payment_detial_by_ref_no($zoho_booking_reference);
    // $response = \Helper::get_payment_detial_by_ref_no('UC20189776');

    // if($response['status'] == 200 && isset($response['body']['message'])) {
    //     $data['ufg_travel_system'] = $response['body']['message'];
    // }

    
    // public function getBookingTansaction($quoteD)
    // {
    //     return [
    //         "amount"             => $quoteD['credit_note_recieved_by']??NULL,
    //         "type"               => $quoteD['credit_note_supplier_id']??NULL
    //     ];
    // }

    // public function refund_to_bank(BookingRefundPaymentRequest $request)
    // {
    //     BookingRefundPayment::create([
    //         'booking_detail_id'   =>  $request->booking_detail_id,
    //         'refund_amount'       =>  $request->refund_amount,
    //         'refund_date'         =>  $request->refund_date,
    //         'bank_id'             =>  $request->bank,
    //         'refund_confirmed_by' =>  $request->refund_confirmed_by
    //     ]);

    //     BookingDetailFinance::where('booking_detail_id',$request->booking_detail_id)->update(['status' => 'cancelled']);

    //     return \Response::json(['success_message' => 'Booking Update Successfully'], 200);
    // }

    // public function credit_note(BookingCreditNoteRequest $request)
    // {
    //     BookingCreditNote::create([
    //         "booking_detail_id"         => $request->booking_detail_id,
    //         "credit_note_amount"        => $request->credit_note_amount,
    //         "credit_note_no"            => $request->credit_note_no,
    //         "credit_note_recieved_date" => $request->credit_note_recieved_date,
    //         "credit_note_recieved_by"   => $request->credit_note_recieved_by,
    //         "user_id"                   => Auth::id(),
    //     ]);

    //     BookingDetailFinance::where('booking_detail_id',$request->booking_detail_id)->update(['status' => 'cancelled']);

    //     return \Response::json(['success_message' => 'Booking Update Successfully'], 200);
    // }
}
