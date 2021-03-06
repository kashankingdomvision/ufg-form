<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingRefundPaymentRequest;
use App\Http\Requests\BookingCreditNoteRequest;
use App\Http\Requests\CancelBookingRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Helper;

use App\Airline;
// use App\AccomodationDetail;
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
use App\BookingCancellation;
use App\BookingCancellationRefundPayment;
use App\BookingDetailCancellation;
use App\BookingCategoryDetail;
use App\BookingDetailCountry;
use App\Currency;
use App\Commission;
use App\Country;
use App\Category;
use App\CurrencyConversion;
use App\HolidayType;
use App\Location;
use App\PaymentMethod;
use App\QuoteUpdateDetail;
use App\Quote;
use App\Season;
use App\Supplier;
use App\ServiceExcursionDetail;
use App\TransferDetail;
use App\User;
use App\Wallet;
use App\TotalWallet;
use App\PresetComment; 
use App\ReferenceCredential;
use App\GroupOwner;

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
            
            $booking->when($request->dates, function ($query) use ($request) {
                $dates = Helper::dates($request->dates);

                $query->whereDate('created_at', '>=', $dates->start_date);
                $query->whereDate('created_at', '<=', $dates->end_date);
            });

            $booking->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            });
      
        }
        
        $data['bookings']            = $booking->paginate($this->pagination);
        $data['currencies']          = Currency::active()->orderBy('id', 'ASC')->get();
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
            'markup_type'                       =>  $request->markup_type??NULL,
            'commission_criteria_id'            =>  $request->commission_criteria_id??NULL,
            'commission_id'                     =>  $request->commission_id??NULL,
            'commission_group_id'               =>  $request->commission_group_id??NULL,
            'default_supplier_currency_id'      =>  $request->default_supplier_currency_id??NULL,
            'booking_details'                   =>  $request->booking_details,
            'ref_no'                            =>  $request->ref_no,
            'country_destination_ids'           => isset($request['country_destination_ids']) && !empty($request['country_destination_ids']) ? json_encode($request['country_destination_ids']) : NULL,
            // 'tas_ref'                           =>  $request->tas_ref??NULL,
            'ref_name'                          =>  $request->ref_name??'zoho',
            'quote_ref'                         =>  $request->quote_no,
            'agency'                            =>  ((int)$request->agency == '1')? '1' : '0',
            'agency_commission_type'            =>  $request->agency == 1 ? $request->agency_commission_type : NULL,
            'agency_commission'                 =>  $request->agency == 1 && $request->agency_commission_type == 'paid-net-of-commission' || $request->agency == 1 && $request->agency_commission_type == 'we-pay-commission-on-departure' ? $request->agency_commission : NULL,
            'total_net_margin'                  =>  $request->agency == 1 && $request->agency_commission_type == 'paid-net-of-commission' || $request->agency == 1 && $request->agency_commission_type == 'we-pay-commission-on-departure' ? $request->total_net_margin : $request->total_markup_amount,
            'agency_name'                       =>  $request->agency_name??NULL,
            'agency_contact'                    =>  ($request->agency_contact != NULL)? $request->full_number : NULL,
            'agency_email'                      =>  $request->agency_email??NULL,
            'agency_contact_name'               =>  $request->agency_contact_name??NULL,
            'lead_passenger_name'               =>  $request->lead_passenger_name??NULL,
            'lead_passenger_email'              =>  $request->lead_passenger_email??NULL,
            'lead_passenger_contact'            =>  ($request->lead_passenger_contact != NULL)? $request->full_number : NULL,
            'lead_passenger_dbo'                =>  $request->lead_passenger_dbo??NULL,
            'lead_passsenger_nationailty_id'    =>  $request->lead_passsenger_nationailty_id??NULL,
            'lead_passenger_dietary_preferences' =>  $request->lead_passenger_dietary_preferences??NULL,
            'lead_passenger_bedding_preference' =>  $request->lead_passenger_bedding_preference??NULL,
            'lead_passenger_medical_requirement' =>  $request->lead_passenger_medical_requirement??NULL,
            'lead_passenger_covid_vaccinated'   =>  isset($request->lead_passenger_covid_vaccinated) && !empty($request->lead_passenger_covid_vaccinated) ? $request->lead_passenger_covid_vaccinated : '0',
            'lead_passenger_resident'           =>  $request->lead_passenger_resident??NULL,
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
            'commission_percentage'             =>  $request->commission_percentage??$request->commission_percentage,
            'selling_currency_oc'               =>  $request->selling_price_other_currency??$request->selling_currency_oc,
            'selling_price_ocr'                 =>  $request->selling_price_other_currency_rate??$request->selling_price_ocr,
            'booking_amount_per_person_in_osp'  =>  $request->booking_amount_per_person_in_osp??$request->booking_amount_per_person_in_osp,
            'amount_per_person'                 =>  $request->booking_amount_per_person??$request->amount_per_person,
            'agency_name'                       =>  (isset($request['agency_name']))? $request->agency_name : NULL,
            'agency_contact'                    =>  (isset($request['agency_contact']))? $request->full_number : NULL, 
            'agency_email'                      =>  (isset($request['agency_email'])) ? $request->agency_email : NULL, 
            'revelant_qoutes'                   =>  $request->revelant_qoutes??NULL,
            'departure_date'                    =>  $request->departure_date??NULL,
            'return_date'                       =>  $request->return_date??NULL,
            'sale_person_currency_id'           =>  $request->sale_person_currency_id??NULL,
            'commission_amount_in_sale_person_currency' => $request->commission_amount_in_sale_person_currency??NULL,
        ];
    }

    public function getBookingDetailsArray($booking, $quoteD)
    {
        $data = [

            'status'                            => $quoteD['status'],
            'category_id'                       => $quoteD['category_id'],
            'supplier_country_ids'              => isset($quoteD['supplier_country_ids']) && !empty($quoteD['supplier_country_ids']) ? json_encode($quoteD['supplier_country_ids']) : NULL,
            'group_owner_id'                    => isset($quoteD['group_owner_id']) ? $quoteD['group_owner_id'] : NULL,
            'supplier_id'                       => (isset($quoteD['supplier_id']))? $quoteD['supplier_id'] : NULL ,
            'product_id'                        => (isset($quoteD['product_id']))? $quoteD['product_id'] : NULL,
            'booking_detail_unique_ref_id'      => isset($quoteD['booking_detail_unique_ref_id']) && !empty($quoteD['booking_detail_unique_ref_id']) ? $quoteD['booking_detail_unique_ref_id'] : Helper::getBDUniqueRefID(), 
            'booking_method_id'                 => $quoteD['booking_method_id'],
            'booked_by_id'                      => $quoteD['booked_by_id'],
            'supervisor_id'                     => $quoteD['supervisor_id'],
            'date_of_service'                   => $quoteD['date_of_service'],
            'end_date_of_service'               => $quoteD['end_date_of_service'],
            'number_of_nights'                  => $quoteD['number_of_nights'],
            'time_of_service'                   => $quoteD['time_of_service'],
            'second_time_of_service'            => $quoteD['second_time_of_service'],
            'booking_date'                      => $quoteD['booking_date'],
            'booking_due_date'                  => $quoteD['booking_due_date'],
            'service_details'                   => $quoteD['service_details'],
            'booking_reference'                 => $quoteD['booking_reference'],
            'booking_type_id'                   => $quoteD['booking_type_id'],
            'refundable_percentage'             => (!is_null($quoteD['booking_type_id']) && $quoteD['booking_type_id'] == 2) ? $quoteD['refundable_percentage'] : NULL,
            'supplier_currency_id'              => $quoteD['supplier_currency_id'],
            'comments'                          => $quoteD['comments'],
            'estimated_cost'                    => $quoteD['estimated_cost'],
            'actual_cost'                       => $quoteD['actual_cost'],
            'markup_amount'                     => $quoteD['markup_amount'],
            'markup_percentage'                 => $quoteD['markup_percentage'],
            'selling_price'                     => $quoteD['selling_price'],
            'profit_percentage'                 => $quoteD['profit_percentage'],
            'actual_cost_bc'                    => $quoteD['actual_cost_in_booking_currency'],
            'selling_price_in_booking_currency' => $quoteD['selling_price_in_booking_currency'],
            'markup_amount_in_booking_currency' => $quoteD['markup_amount_in_booking_currency'],
            'added_in_sage'                     => isset($quoteD['added_in_sage']) && !empty($quoteD['added_in_sage']) ? $quoteD['added_in_sage'] : 0,
            'outstanding_amount_left'           => $quoteD['outstanding_amount_left'],
            'category_details'                  => $quoteD['category_details'],
            'product_details'                   => $quoteD['product_details'],
            'tour_meeting_point'                => $quoteD['tour_meeting_point'],
            'tour_contact'                      => $quoteD['tour_contact'],
            'tour_telephone'                    => $quoteD['tour_telephone'],
            'tour_address'                      => $quoteD['tour_address'],
            'invoice'                           => $this->fileStore($quoteD, $booking->id),
            'booking_id'                        => $booking->id,
            'status'                            => isset($quoteD['status']) && !empty($quoteD['status']) ? $quoteD['status'] : 'active',
        ];

        return $data;
    }

    public function getFinanceBookingDetailsArray($quoteD)
    {

        // dd($quoteD);

        return [
            "deposit_amount"        => $quoteD['deposit_amount']??NULL,
            "deposit_due_date"      => $quoteD['deposit_due_date']??NULL,
            "paid_date"             => $quoteD['paid_date']??NULL,
            "payment_method_id"     => $quoteD['payment_method']??NULL,
            "upload_to_calender"    => $quoteD['upload_to_calender']??NULL,
            "additional_date"       => $quoteD['ab_number_of_days']??NULL,
            "outstanding_amount"    => $quoteD['outstanding_amount']??NULL,
            "added_in_sage"         => isset($quoteD['added_in_sage']) ? $quoteD['added_in_sage'] : '0',
            "user_id"               => Auth::id(),
        ];
    }

    public function getBookingCreditNoteArray($booking_Details, $quoteD)
    {
        return [
            "credit_note_amount"         => $quoteD['credit_note_amount']??NULL,
            "credit_note_no"             => Helper::getCreditNote(),
            "credit_note_recieved_date"  => $quoteD['credit_note_recieved_date']??NULL,
            "credit_note_recieved_by"    => $quoteD['credit_note_recieved_by']??NULL,
            'booking_detail_id'          => $booking_Details->id,
            'supplier_id'                => $booking_Details->supplier_id,
            'currency_id'                => $booking_Details->supplier_currency_id,
            'user_id'                    => Auth::id(),
        ];
    }

    public function getBookingRefundPaymentArray($quoteD)
    {
        return [
            "refund_amount"        => $quoteD['refund_amount']??NULL,
            "refund_date"          => $quoteD['refund_date']??NULL,
            "bank_id"              => $quoteD['bank']??NULL,
            "refund_confirmed_by"  => $quoteD['refund_confirmed_by']??NULL,
            "refund_recieved"      => $quoteD['refund_recieved']??NULL,
            "refund_recieved_date" => (isset($quoteD['refund_recieved']) && ($quoteD['refund_recieved'] == 1)) ? date('Y-m-d') : NULL,
            "user_id"              => Auth::id(),
        ];
    }

    public function getBookingCancellationRefundPaymentsArray( $booking ,$quoteD)
    {
        return [
            'booking_id'            => $booking->id,
            "refund_amount"         => $quoteD['refund_amount']??NULL,
            "refund_date"           => $quoteD['refund_date']??NULL,
            "refund_approved_date"  => $quoteD['refund_approved_date']??NULL,
            "refund_approved_by"    => $quoteD['refund_approved_by']??NULL,
            "refund_processed_by"   => $quoteD['refund_processed_by']??NULL,
            "bank_id"               => $quoteD['refund_process_from']??NULL,
        ];
    }

    public function edit($id)
    {
        $data['countries'] = cache()->rememberForever('countries', function () {
            return Country::orderBy('sort_order', 'ASC')->get();
        });

        $data['supplier_countries'] = cache()->rememberForever('supplier_countries', function () {
            return Country::orderByService()->orderBy('name', 'ASC')->get();
        });

        $booking                  = Booking::findOrFail(decrypt($id));
        $data['booking']          = $booking;
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['seasons']          = Season::all();
        $data['users']            = User::all()->sortBy('name');
        $data['supervisors']      = User::role(['supervisor'])->get();
        $data['sale_persons']     = User::get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();;
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['payment_methods']  = PaymentMethod::all();
        $data['commission_types'] = Commission::all();
        $data['banks']            = Bank::all();
        $data['quote_ref']        = Quote::where('quote_ref','!=', $booking['quote_ref'])->get('quote_ref');
        $data['currency_conversions'] = CurrencyConversion::ignoreSameCurrency()->orderBy('from', 'desc')->get();
        $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();
        $data['locations']        = Location::get();
        $data['group_owners']     = GroupOwner::orderBy('id','ASC')->get();
        $data['booking_detail_statuses'] = BookingDetail::Statuses();

        if(isset($booking->ref_no) && !empty($booking->ref_no)){

            $zoho_booking_reference = $booking->ref_no;

            $response = Cache::remember($zoho_booking_reference, $this->cacheTimeOut, function() use ($zoho_booking_reference) {
                return Helper::getPaymentDetialByRefNo($zoho_booking_reference);
            });

            if($response['status'] == 200) {
                
                $data['old_ufg_payment_records'] = isset($response['body']['old_records']) ? $response['body']['old_records'] : NULL;
                $data['ufg_payment_records']     = isset($response['body']['message']) ? $response['body']['message'] : NULL;
            }

        }

        $data = array_merge($data, Helper::checkAlreadyExistUser($id,'bookings'));

        return view('bookings.edit',$data);
    }

    public function getBookingCategoryDetailArray( $quoteD, $category_detail )
    {
        $data = [
            'booking_id'         => $quoteD['booking_id'],
            'booking_detail_id'  => $quoteD['id'],
            'category_id'      => $quoteD['category_id'],
            'type'             => $category_detail['type'],
            'label'            => $category_detail['label'],
        ];

        if($category_detail['type'] == 'checkbox-group' || ( $category_detail['type'] == 'select' && $category_detail['multiple'] == true ) ){
           
            $data['multiple'] = 'true';
            $data['value']    = json_encode($category_detail['userData']);
            
        }else{

            $data['multiple'] = 'false';
            $data['value'] = $category_detail['userData'][0];
        }

        return $data;
    }

    public function getBookingLogArray($booking)
    {

        $array   = $booking->toArray();

        /* Get booking details with child table records */ 
        $booking_details = $booking->getBookingDetail->map(function($booking_detail) {

            $bd                    = $booking_detail->toArray();
            $bd['finance']         = $booking_detail->getBookingFinance->toArray();
            $bd['refund_payments'] = $booking_detail->getBookingRefundPayment->toArray();
            $bd['credit_notes']    = $booking_detail->getBookingCreditNote->toArray();

            return $bd;
        });

        $array['booking']                              = $booking_details;
        $array['booking_cancellation_refund_payments'] = $booking->getBookingCancellationRefundPaymentDetail->count() ? $booking->getBookingCancellationRefundPaymentDetail->toArray() : [];
        $array['booking_cancellations']                = !is_null($booking->getTotalRefundAmount) ? $booking->getTotalRefundAmount->toArray() : [];
        $array['pax']                                  = $booking->getBookingPaxDetail->count() ? $booking->getBookingPaxDetail->toArray() : [];

        $data = [
            'booking_id'    => $booking->id,
            'version_no'    => $booking->version,
            'data'          => $array,
            'log_no'        => $booking->getBookingLogs()->count()
        ];

        return $data;
    }


    public function getPaxDetailsArray( $booking, $pax_data ){

        $data = [
            'booking_id'            => $booking->id,
            'full_name'             => $pax_data['full_name']??NULL,
            'email_address'         => $pax_data['email_address']??NULL,
            'contact_number'        => $pax_data['full_number']??NULL,
            'date_of_birth'         => $pax_data['date_of_birth']??NULL,
            'bedding_preference'    => $pax_data['bedding_preference']??NULL,
            'dietary_preferences'   => $pax_data['dietary_preferences']??NULL,
            'nationality_id'        => $pax_data['nationality_id']??NULL,
            'resident_in'           => $pax_data['resident_in']??NULL,
            'covid_vaccinated'      => $pax_data['covid_vaccinated'],
            'medical_requirement'   => $pax_data['medical_requirement'],
        ];

        return $data;
    }

    public function update(BookingRequest $request, $id)
    {

        // dd($request->all());

        // check update access
        // $quote_update_detail = QuoteUpdateDetail::where('foreign_id',decrypt($id))->where('user_id', Auth::id())->where('status','bookings');
        // if(!$quote_update_detail->exists()) {
        //     return \Response::json(['status' => false,'overrride_errors' => 'Someone Has Override Update Access.'], 422); // Status code here
        // }
        
        //- check update access
        // dd($request->all());
        $booking = Booking::findOrFail(decrypt($id));
        $booking->getCountryDestinations()->sync($request->country_destination_ids);

        /* store booking log */ 
        BookingLog::create($this->getBookingLogArray($booking));

        $booking->update($this->bookingArray($request));

        if($request->has('quote') && count($request->quote) > 0){

            $booking->getBookingDetail()->delete();

            foreach ($request->quote as $qu_details) {

                $booking_Details = BookingDetail::create($this->getBookingDetailsArray($booking, $qu_details));

                if($booking_Details->status == 'cancelled'){
                    BookingDetailCancellation::create([
                        'booking_detail_id' => $booking_Details->id,
                        'cancelled_by_id'   => $qu_details['created_by']
                    ]);
                }

                if(isset($qu_details['supplier_country_ids']) && !empty($qu_details['supplier_country_ids'])){

                    foreach($qu_details['supplier_country_ids'] as $key => $id){

                        BookingDetailCountry::create([
                            'booking_id'        => $booking->id,
                            'booking_detail_id' => $booking_Details->id,
                            'country_id'        => $id
                        ]);
                    }
                }


                if(isset($qu_details['finance']) && !empty($qu_details['finance'])){
                    foreach ($qu_details['finance'] as $finance){

                        $fin                      = $this->getFinanceBookingDetailsArray($finance);
                        $fin['booking_detail_id'] = $booking_Details->id;
                        $fin['currency_id']       = $booking_Details->supplier_currency_id;

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

                                TotalWallet::where('supplier_id',$booking_Details->supplier_id)->update([
                                    'amount' => Helper::getSupplierWalletAmount($booking_Details->supplier_id)
                                ]);

                            }
                        }
                    }
                }
                   
                if(isset($qu_details['refund']) && !empty($qu_details['refund'])){
                    foreach ($qu_details['refund'] as $refund){

                        $refund                      = $this->getBookingRefundPaymentArray($refund);
                        $refund['booking_detail_id'] = $booking_Details->id;
                        $refund['currency_id']       = $booking_Details->supplier_currency_id;
    
                        if(!empty($refund['refund_amount']) && ($refund['refund_amount'] > 0) ){

                            BookingRefundPayment::create($refund);
                            BookingDetailFinance::where('booking_detail_id',$booking_Details->id)->update(['status' => 'cancelled']);
                            BookingDetail::where('id',$booking_Details->id)->update([ 'payment_status' => 'cancelled', 'outstanding_amount_left' => '0.00' ]);
                        }
                    }
                }

                if(isset($qu_details['credit_note']) && !empty($qu_details['credit_note'])){
                    
                    foreach ($qu_details['credit_note'] as $credit_note){

                        $credit_note = $this->getBookingCreditNoteArray($booking_Details, $credit_note);
                   

                        if(($credit_note['credit_note_amount']) > 0 && !empty($credit_note['credit_note_recieved_date'])){

                            BookingCreditNote::create($credit_note);

                            Wallet::create([
                                'booking_id'        => $booking->id,
                                'booking_detail_id' => $booking_Details->id,
                                'supplier_id'       => $booking_Details->supplier_id,
                                'amount'            => $credit_note['credit_note_amount'],
                                'type'              => 'credit'
                            ]);

                            $total_wallet = TotalWallet::where('supplier_id', $booking_Details->supplier_id);
                            if(!$total_wallet->exists()){

                                TotalWallet::create([
                                    'supplier_id'     => $booking_Details->supplier_id,
                                    'amount'          => $credit_note['credit_note_amount'],
                                ]);

                            }else {

                                TotalWallet::where('id',$booking_Details->supplier_id)->update([
                                    'amount' => Helper::getSupplierWalletAmount($booking_Details->supplier_id)
                                ]);
                            }

                            BookingDetailFinance::where('booking_detail_id',$booking_Details->id)->update(['status' => 'cancelled']);
                            BookingDetail::where('id',$booking_Details->id)->update([ 'payment_status' => 'cancelled', 'outstanding_amount_left' => '0.00' ]);
                        }
                    }
                }

                if(isset($qu_details['category_details']) && !empty($qu_details['category_details'])){

                    $category_details = json_decode($qu_details['category_details'], true);

                    foreach ($category_details as $category_detail){
                        if(isset($category_detail['userData'])){
                            $getBookingCategoryDetailArray = $this->getBookingCategoryDetailArray($booking_Details, $category_detail);
                            BookingCategoryDetail::create($getBookingCategoryDetailArray);
                        }
                    }
                }


            }
        }
        
        // booking pax details
        if($request->has('pax')){

            $booking->getPaxDetail()->delete();

            foreach ($request->pax as $pax_data) {

                BookingPaxDetail::create($this->getPaxDetailsArray($booking, $pax_data));
            }
        }else{
            $booking->getPaxDetail()->delete();
        }

        if($request->has('cancellation_refund') && count($request->cancellation_refund) > 0){

            $booking->getBookingCancellationRefundPaymentDetail()->delete();

            foreach ($request->cancellation_refund as $cancellation_refund) {

                if(!empty($cancellation_refund['refund_amount']) && ($cancellation_refund['refund_amount'] > 0) ){
                    BookingCancellationRefundPayment::create($this->getBookingCancellationRefundPaymentsArray($booking, $cancellation_refund));
                }
  
            }

        }

        // $quote_update_detail->delete(); 

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Booking Updated Successfully.',
            'redirect_url'    => route('bookings.index') 
        ]);
    }

    public function show($id, $status = null)
    {
        $data['countries'] = cache()->rememberForever('countries', function () {
            return Country::orderBy('sort_order', 'ASC')->get();
        });

        $data['supplier_countries'] = cache()->rememberForever('supplier_countries', function () {
            return Country::orderByService()->orderBy('name', 'ASC')->get();
        });

        $booking                  = Booking::findOrFail(decrypt($id));
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['seasons']          = Season::all();
        $data['users']            = User::all()->sortBy('name');
        $data['supervisors']      = User::role(['supervisor'])->get();
        $data['sale_persons']     = User::get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();;
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['booking']          = $booking;
        $data['commission_types'] = Commission::all();
        $data['payment_methods']  = PaymentMethod::all();
        $data['banks']            = Bank::all();
        $data['currency_conversions'] = CurrencyConversion::ignoreSameCurrency()->orderBy('from', 'desc')->get();
        $data['locations']        = Location::get();
        $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();
        $data['group_owners']     = GroupOwner::orderBy('id','ASC')->get();
        $data['booking_detail_statuses'] = BookingDetail::Statuses();

        
        if(isset($data['booking']->ref_no) && !empty($data['booking']->ref_no)){

            $zoho_booking_reference = isset($data['booking']->ref_no) && !empty($data['booking']->ref_no) ? $data['booking']->ref_no : '' ;
            $response = Cache::remember($zoho_booking_reference, $this->cacheTimeOut, function() use ($zoho_booking_reference) {
                return Helper::getPaymentDetialByRefNo($zoho_booking_reference);
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

        if(isset($booking->ref_no) && !empty($booking->ref_no)){

            $zoho_booking_reference = $booking->ref_no;

            $response = Cache::remember($zoho_booking_reference, $this->cacheTimeOut, function() use ($zoho_booking_reference) {
                return Helper::getPaymentDetialByRefNo($zoho_booking_reference);
            });

            if($response['status'] == 200) {

                $data['old_ufg_payment_records'] = isset($response['body']['old_records']) ? $response['body']['old_records'] : NULL;
                $data['ufg_payment_records']     = isset($response['body']['message']) ? $response['body']['message'] : NULL;
            }
        }

        return view('bookings.show', $data);
    }

    // not used currently
    public function category_detail_feilds(Request $request){

        // dd($request->all());

        $category = Category::find($request->category_id);


        return \Response::json(['status' => true, 'category_detail_feilds' => $category->feilds ], 200);
    }


    public function viewVersion($id)
    {
        $booking_log                = BookingLog::findOrFail(decrypt($id));
        $data['log']                = $booking_log;
        $data['booking']            = (object) $booking_log->data;
        $data['countries']          = cache()->rememberForever('countries', function () {
                                        return Country::orderBy('sort_order', 'ASC')->get();
                                    });

        $data['supplier_countries'] = cache()->rememberForever('supplier_countries', function () {
                                        return Country::orderByService()->orderBy('name', 'ASC')->get();
                                    });
        $data['categories']         = Category::orderby('sort_order', 'ASC')->get();
        $data['seasons']            = Season::all();
        $data['users']              = User::all()->sortBy('name');
        $data['supervisors']        = User::get();
        $data['sale_persons']       = User::get();
        $data['booking_methods']    = BookingMethod::all()->sortBy('id');
        $data['currencies']         = Currency::active()->orderBy('id', 'ASC')->get();;
        $data['brands']             = Brand::orderBy('id','ASC')->get();
        $data['booking_types']      = BookingType::all();
        $data['payment_methods']    = PaymentMethod::all();
        $data['commission_types']   = Commission::all();
        $data['banks']              = Bank::all();
        $data['currency_conversions'] = CurrencyConversion::ignoreSameCurrency()->orderBy('from', 'desc')->get();
        $data['locations']        = Location::get();
        $data['group_owners']     = GroupOwner::orderBy('id','ASC')->get();
        $data['booking_detail_statuses'] = BookingDetail::Statuses();
      
        return view('bookings.version', $data);
    }

    public function destroy(Request $request, $id)
    {
        Booking::destroy(decrypt($id));
        return redirect()->route('bookings.index',$request->season)->with('success_message', 'Booking deleted successfully');    
    }
    
    public function get_booking_net_price($id){

        $booking = Booking::find($id); 

        return [

            'booking_net_price'     => $booking->net_price,
            'booking_currency_id'   => $booking->currency_id,
            'booking_currency_code' => $booking->getCurrency->code,
            'form_action'           => route('bookings.multiple.alert', ['cancel_booking', encrypt($id)])
        ];
    }

    public function cancel_booking(CancelBookingRequest $request){ 

        $total_refund_amount = $request->booking_net_price - $request->cancellation_charges;

        BookingCancellation::create([

            'booking_id'           => $request->booking_id,
            'cancellation_charges' => $request->cancellation_charges,
            'cancellation_reason'  => $request->cancellation_reason,
            'total_refund_amount'  => $total_refund_amount,
            'currency_id'          => $request->booking_currency_id,
        ]);

        Booking::where('id', $request->booking_id)->update([ 'status' => 'cancelled' ]);

        return \Response::json(['success_message' => 'Booking Cancelled Successfully'], 200);
    }

    public function booking_detail_cancellation(Request $request){

        $booking_detail_id       = decrypt($request->booking_detail_id);
        $booking_cancelled_by_id = $request->booking_cancelled_by_id;

        BookingDetail::where('id', $booking_detail_id)->update([ 'status' => 'cancelled' ]);
        BookingDetailCancellation::create([
            'booking_detail_id' => $booking_detail_id,
            'cancelled_by_id'   => $booking_cancelled_by_id
        ]);

        return \Response::json(['success_message' => 'Booking Service Cancelled Successfully' ], 200);
    }

    public function revert_booking_detail_cancellation($id){

        BookingDetail::where('id', decrypt($id))->update([ 'status' => 'active' ]);
        BookingDetailCancellation::where('booking_detail_id',decrypt($id))->delete();

        return \Response::json(['success_message' => 'Booking Service Reverted Successfully' ], 200);
    }

    public function revert_cancel_booking($id){ 

        Booking::where('id',decrypt($id))->update([ 'status' => 'confirmed' ]);
        BookingCancellation::where('booking_id',decrypt($id))->delete();

        return redirect()->back()->with('success_message', 'Booking Reverted Successfully');    
    }

    public function booking_detail_clone($count){

        $data['countries']        = Country::orderBy('sort_order', 'ASC')->get();
        // $data['templates']        = Template::all()->sortBy('name');
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::role(['supervisor'])->get();
        $data['sale_persons']     = User::role(['sales-agent'])->get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();;
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['commission_types'] = Commission::all();
        $data['quote_id']         = \Helper::getQuoteID();
        $data['count'] = $count;

        return response()->json(View::make('partials.booking_detail', $data)->render());
    }

    public function bookingCancel($id)
    {
        $booking = Booking::findOrFail(decrypt($id))->update(['cancel_date' => Carbon::now()]);
        return redirect()->back()->with('success_message', 'Booking canceled successfully');    
    }

    public function multipleAlert($action_type, $id){
        
        try {

            $message = "";

            if($action_type == 'cancel_booking'){

                $this->cancelBooking(decrypt($id));
                $message = "Booking Cancelled Successfully.";
            }

            if($action_type == 'restore_booking'){

                $this->restorBooking(decrypt($id));
                $message = "Booking Restored Successfully.";
            }

            return response()->json([ 
                'status'          => true, 
                'success_message' => $message,
            ]);
          
        } catch (\Exception $exception) {

            if(in_array($action_type, ['cancel_booking'])){
                
                if(count($exception->errors()) > 0){
                    return response()->json([ 'errors' => $exception->errors() ], 422);
                }
            }

            return response()->json([ 
                'status'        => false, 
                'error_message' => "Something Went Wrong, Please Try Again."
            ]);
        }
    }

    public function bookingDetailStatus($action_type, $id){
        
        try {

            $message = "";

            if($action_type == 'not_booked'){

                BookingDetail::findOrFail(decrypt($id))->update([ 'status' => 'not_booked' ]);
                $message = "Change Status Successfully.";
            }

            if($action_type == 'pending'){

                BookingDetail::findOrFail(decrypt($id))->update([ 'status' => 'pending' ]);
                $message = "Change Status Successfully.";
            }
            
            if($action_type == 'booked'){

                BookingDetail::findOrFail(decrypt($id))->update([ 'status' => 'booked' ]);
                $message = "Change Status Successfully.";
            }

            if($action_type == 'cancelled'){

                BookingDetail::findOrFail(decrypt($id))->update([ 'status' => 'cancelled' ]);
                $message = "Change Status Successfully.";
            }

            return response()->json([ 
                'status'          => true, 
                'success_message' => $message,
            ]);
          
        } catch (\Exception $exception) {

            return response()->json([ 
                'status'        => false, 
                'error_message' => "Something Went Wrong, Please Try Again."
            ]);
        }
    }

    public function cancelBooking($id)
    {
        $rules = [
            'cancellation_charges' => 'required|numeric|lte:booking_net_price',
            'cancellation_reason'  => 'required'
        ];

        $messages = [
            'cancellation_charges.required'  => 'The Cancellation Charges field is required.',
            'cancellation_reason.required'   => 'The Cancellation Reason field is required.',
        ];

        Validator::make(request()->all(), $rules, $messages)->validate();

        $total_refund_amount = request()->booking_net_price - request()->cancellation_charges;

        BookingCancellation::create([

            'booking_id'           => $id,
            'cancellation_charges' => request()->cancellation_charges,
            'cancellation_reason'  => request()->cancellation_reason,
            'total_refund_amount'  => $total_refund_amount,
            'currency_id'          => request()->booking_currency_id,
        ]);

        Booking::where('id', $id)->update([ 
            'status' => 'cancelled',
            'cancel_date'    => Carbon::now()
        ]);
    }

    public function restorBooking($id)
    {
        Booking::where('id', $id)->update([ 'status' => 'confirmed' ]);
        BookingCancellation::where('booking_id', $id)->delete();
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

    // $booking_transactions = Wallet::select(
    //     'supplier_id',
    //     DB::raw("sum(case when type = 'credit' then amount else 0 end) as credit"),
    //     DB::raw("sum(case when type = 'debit' then amount else 0 end) as debit")
    // )
    // ->groupBy('supplier_id')
    // ->where('supplier_id', 1)
    // ->first();

    // dd($booking_transactions->credit - $booking_transactions->debit);
// ____________________________________________________________________________________________________________________________________--
    // if(isset($qu_details['category_detials'])){
        
    //     if(isset($qu_details['category_detials']['accommodation']) && !empty($qu_details['category_detials']['accommodation'])){

    //         $accommodation_details                      = $this->getAccommodationDetailsArray($qu_details['category_detials']['accommodation']);
    //         $accommodation_details['booking_detail_id'] = $booking_Details->id;
    //         AccomodationDetail::create($accommodation_details);
    //     }

    //     if(isset($qu_details['category_detials']['transfer'])){
            
    //         $transfer_details                      = $this->getTransferDetailsArray($qu_details['category_detials']['transfer']);
    //         $transfer_details['booking_detail_id'] = $booking_Details->id;
    //         TransferDetail::create($transfer_details);
    //     }

    //     if(isset($qu_details['category_detials']['service_excursion'])){
            
    //         $service_excursion                      = $this->getServiceExcursionDetailsArray($qu_details['category_detials']['service_excursion']);
    //         $service_excursion['booking_detail_id'] = $booking_Details->id;
    //         ServiceExcursionDetail::create($service_excursion);
    //     }

    // }

    // public function getAccommodationDetailsArray($quoteD)
    // {
    //     return [
    //         "arrival_date"            => $quoteD['arrival_date']??NULL,
    //         "no_of_nights"            => $quoteD['no_of_nights']??NULL,
    //         "no_of_rooms"             => $quoteD['no_of_rooms']??NULL,
    //         "room_types"              => $quoteD['room_types']??NULL,
    //         "meal_plan"               => $quoteD['meal_plan']??NULL,
    //         "refrence"                => $quoteD['refrence']??NULL,
    //         'day_event'               => isset($quoteD['day_event']) ? $quoteD['day_event']: null,
    //         'confirmed_with_supplier' => isset($quoteD['confirmed_with_supplier']) ? $quoteD['confirmed_with_supplier'] : null , 
    //     ];
    // }

    // public function getTransferDetailsArray($quoteD)
    // {
    //     return [
    //         "transfer_description"    => $quoteD['transfer_description']??NULL,
    //         "quantity"                => $quoteD['quantity']??NULL,
    //         "pickup_port"             => $quoteD['pickup_port']??NULL,
    //         "pickup_accomodation"     => $quoteD['pickup_accomodation']??NULL,
    //         "pickup_date"             => $quoteD['pickup_date']??NULL,
    //         "pickup_time"             => $quoteD['pickup_time']??NULL,
    //         "dropoff_port"            => $quoteD['dropoff_port']??NULL,
    //         "dropoff_accomodation"    => $quoteD['dropoff_accomodation']??NULL,
    //         "dropoff_date"            => $quoteD['dropoff_date']??NULL,
    //         "dropoff_time"            => $quoteD['dropoff_time']??NULL,
    //         'confirmed_with_supplier'  => isset($quoteD['confirmed_with_supplier']) ? $quoteD['confirmed_with_supplier'] : 2 , 
    //     ];
    // }

    // public function getServiceExcursionDetailsArray($quoteD)
    // {
    //     return [
    //         'name'                     => $quoteD['name']??NULL,
    //         'description'              => $quoteD['description']??NULL,               
    //         'date'                     => $quoteD['date']??NULL,        
    //         'time'                     => $quoteD['time']??NULL,
    //         'quantity'                 => $quoteD['quantity']??NULL,          
    //         'refrence'                 => $quoteD['refrence']??NULL,      
    //         'confirmed_with_supplier'  => isset($quoteD['confirmed_with_supplier']) ? $quoteD['confirmed_with_supplier'] : 2 ,    
    //         'note'                     => $quoteD['note']??NULL,
    //     ];
    // }

    // 'product_location_id'     => $quoteD['product_location_id'],
    // 'supplier_location_id'    => $quoteD['supplier_location_id'],




// foreach ($booking->getBookingDetail as $bookingde) {
//     $d = $bookingde->toArray();
//     $d['finance']         = $bookingde->getBookingFinance->toArray();
//     $d['refund_payments'] = $bookingde->getBookingRefundPayment->toArray();
//     $d['credit_notes']    = $bookingde->getBookingCreditNote->toArray();

//     array_push($book, $d);
// }

}
