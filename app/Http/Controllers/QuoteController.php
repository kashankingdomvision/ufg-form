<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuoteRequest;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\QuoteExport;
use PHPUnit\TextUI\XmlConfiguration\Logging\TestDox\Html;
use App\Http\Helper;
use App\Brand;
use App\Booking;
use App\BookingMethod;
use App\BookingType;
use App\BookingDetail;
use App\BookingPaxDetail;
use App\BookingCategoryDetail;
use App\BookingDetailCountry;
use App\Currency;
use App\Category;
use App\Commission;
use App\Country;
use App\CurrencyConversion;
use App\CommissionGroup;
use App\CommissionCriteria; 
use App\Group;
use App\HolidayType;
use App\Location;
use App\Product;
use App\PresetComment; 
use App\QuoteUpdateDetail;
use App\QuoteDocument;
use App\Quote;
use App\QuoteDetail;
use App\QuotePaxDetail;
use App\QuoteLog;
use App\QuoteDetailStoredText;
use App\QuoteCategoryDetail;
use App\QuoteDetailCountry;
use App\ReferenceCredential;
use App\Season;
use App\Supplier;
use App\StoreText;
use App\Template;
use App\User;
use App\Harbour;
use App\GroupOwner;

class QuoteController extends Controller
{
    public $pagiantion = 10;

    public function index(Request $request)
    {
        $quote  = Quote::select('*', DB::raw('count(*) as quote_count'))->withTrashed()->where('is_archive', '!=', 1);
        if(count($request->all()) >0){
            $quote = $this->searchFilters($quote, $request);
        }
        $data['quotes']           = $quote->groupBy('ref_no')->orderBy('created_at','DESC')->paginate($this->pagiantion);
        $data['booking_seasons']  = Season::all();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
        $data['users']            = User::get();

        return view('quotes.listing', $data);
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

        $quote->when($request->dates, function ($query) use ($request) {

            $dates = Helper::dates($request->dates);

            $query->whereDate('created_at', '>=', $dates->start_date);
            $query->whereDate('created_at', '<=', $dates->end_date);
        });

        // if($request->has('created_date')){
        //     $quote->where(function($query) use($request){
        //         if(isset($request->created_date['form']) && !empty($request->created_date['form'])){
        //             $query->where('created_at', '>=', Carbon::createFromFormat('d/m/Y', $request->created_date['from'])->format('Y-m-d'));
        //         }
        //         if (isset($request->created_date['to']) && !empty($request->created_date['to'])) {
        //             $query->where('created_at', '<=', Carbon::createFromFormat('d/m/Y', $request->created_date['to'])->format('Y-m-d'));
        //         }
        //     });
        // }
        return $quote;
    }

    /* archive listing */
    public function archiveIndex(Request $request)
    {
        $data['status'] = 'archive';
        $quote  = Quote::select('*', DB::raw('count(*) as quote_count'))->where('is_archive', 1);
        if(count($request->all()) >0){
            $quote = $this->searchFilters($quote, $request);
        }
        $data['quotes']           = $quote->groupBy('ref_no')->orderBy('created_at','DESC')->paginate($this->pagiantion);
        $data['booking_seasons']  = Season::all();
        $data['users']            = User::all();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();

        return view('quotes.listing', $data);
    }

    public function get_currency_conversion(){
        return CurrencyConversion::all();
    }

    public function quoteArray($request, $type, $action = null)
    {
        $data = [

            'booking_details'                   =>  $request->booking_details,
            'reason_for_trip'                   =>  $request->reason_for_trip,
            // 'tas_ref'                           =>  $request->tas_ref??NULL,
            'commission_id'                     =>  $request->commission_id??NULL,
            'commission_group_id'               =>  $request->commission_group_id??NULL,
            'default_supplier_currency_id'      =>  $request->default_supplier_currency_id??NULL,
            'user_id'                           =>  Auth::id(),
            'season_id'                         =>  $request->season_id,
            'brand_id'                          =>  $request->brand_id,
            'currency_id'                       =>  $request->currency_id,
            'holiday_type_id'                   =>  $request->holiday_type_id,
            'ref_name'                          =>  $request->ref_name??'zoho',
            'ref_no'                            =>  $request->ref_no,
            'sale_person_id'                    =>  $request->sale_person_id,
            'agency'                            =>  ((int)$request->agency == '1')? '1' : '0',
            'agency_commission_type'            =>  $request->agency == 1 ? $request->agency_commission_type : NULL,
            'agency_commission'                 =>  $request->agency == 1 && $request->agency_commission_type == 'paid-net-of-commission' || $request->agency == 1 && $request->agency_commission_type == 'we-pay-commission-on-departure' ? $request->agency_commission : NULL,
            'total_net_margin'                  =>  $request->agency == 1 && $request->agency_commission_type == 'paid-net-of-commission' || $request->agency == 1 && $request->agency_commission_type == 'we-pay-commission-on-departure' ? $request->total_net_margin : $request->total_markup_amount,
            'agency_name'                       =>  $request->agency_name??NULL,
            'agency_email'                      =>  $request->agency_email??NULL,
            'agency_contact_name'               =>  $request->agency_contact_name??NULL,
            'lead_passenger_name'               =>  $request->lead_passenger_name??NULL,
            'lead_passenger_email'              =>  $request->lead_passenger_email??NULL,
            'lead_passenger_dbo'                =>  $request->lead_passenger_dbo??NULL,
            'lead_passenger_resident'           =>  $request->lead_passenger_resident??NULL,
            'lead_passsenger_nationailty_id'    =>  $request->lead_passsenger_nationailty_id??NULL,
            'lead_passenger_dietary_preferences' =>  $request->lead_passenger_dietary_preferences??NULL,
            'lead_passenger_medical_requirement' =>  $request->lead_passenger_medical_requirement??NULL,
            'lead_passenger_bedding_preference' =>  $request->lead_passenger_bedding_preference??NULL,
            'lead_passenger_covid_vaccinated'   =>  isset($request->lead_passenger_covid_vaccinated) && !empty($request->lead_passenger_covid_vaccinated) ? $request->lead_passenger_covid_vaccinated : '0',
            'pax_no'                            =>  $request->pax_no??'0',
            'net_price'                         =>  $request->total_net_price??$request->net_price,
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
            'rate_type'                         =>  ($request->rate_type == 'live') ? 'live': 'manual',
            'markup_type'                       =>  $request->markup_type??NULL,
            'revelant_quote'                    =>  $request->revelant_quote??NULL,
        ];

        if($type == 'quotes'){

            $data['country_destination_ids']   = isset($request['country_destination_ids']) && !empty($request['country_destination_ids']) ? json_encode($request['country_destination_ids']) : NULL ;
            $data['quote_ref']              = $request->quote_no??$request->quote_ref;
            $data['agency_contact']         = isset($request->agency_contact) && !empty($request->agency_contact) ? $request->full_number : NULL;
            $data['lead_passenger_contact'] = isset($request->lead_passenger_contact) && !empty($request->lead_passenger_contact) ? $request->full_number : NULL;
            $data['stored_text']            = $request->stored_text??NULL;

            /* append only for store quote */
            if($action == 'store'){
                $data['created_by'] =  Auth::id();
            }
        }

        if($type == 'clone'){

            $data['country_destination_ids']   = isset($request['country_destination_ids']) && !empty($request['country_destination_ids']) ? $request['country_destination_ids'] : NULL ;
            $data['quote_ref']              = Helper::getQuoteID();
            $data['agency_contact']         = $request->agency_contact??NULL;
            $data['lead_passenger_contact'] = $request->lead_passenger_contact??NULL;
            $data['stored_text']            = $request->stored_text??NULL;
            $data['created_by']             =  Auth::id();
        }

        if($type == 'bookings'){

            $data['country_destination_ids'] = isset($request['country_destination_ids']) && !empty($request['country_destination_ids']) ? $request['country_destination_ids'] : NULL ;
            $data['quote_id']               = $request->id;
            $data['quote_ref']              = $request->quote_no??$request->quote_ref;
            $data['agency_contact']         = $request->agency_contact??NULL;
            $data['lead_passenger_contact'] = $request->lead_passenger_contact??NULL;
            $data['booking_details']        = $request->booking_details;
            $data['booking_status']         = 'confirmed';
            $data['booking_date']           = Carbon::now();
            $data['created_by']             =  Auth::id();
        }

        return $data;
    }

    public function getQuoteDetailsArray($quote, $quoteD, $type)
    {
        $data = [
            
            'category_id'                       => $quoteD['category_id'],
            'supplier_id'                       => (isset($quoteD['supplier_id']))? $quoteD['supplier_id'] : NULL ,
            'group_owner_id'                    => isset($quoteD['group_owner_id']) ? $quoteD['group_owner_id'] : NULL,
            'product_id'                        => (isset($quoteD['product_id']))? $quoteD['product_id'] : NULL,
            'date_of_service'                   => $quoteD['date_of_service'],
            'end_date_of_service'               => $quoteD['end_date_of_service'],
            'number_of_nights'                  => $quoteD['number_of_nights'],
            'time_of_service'                   => $quoteD['time_of_service'],
            'second_time_of_service'            => $quoteD['second_time_of_service'],
            'service_details'                   => $quoteD['service_details'],
            'booking_type_id'                   => $quoteD['booking_type_id']??$quoteD['booking_type_id'],
            'refundable_percentage'             => (!is_null($quoteD['booking_type_id']) && $quoteD['booking_type_id'] == 2) ? $quoteD['refundable_percentage'] : NULL,
            'supplier_currency_id'              => $quoteD['supplier_currency_id'],
            'comments'                          => $quoteD['comments'],
            'estimated_cost'                    => $quoteD['estimated_cost'],
            'markup_amount'                     => isset($quote->markup_type) && $quote->markup_type == 'itemised' ? $quoteD['markup_amount'] : NULL,
            'markup_percentage'                 => isset($quote->markup_type) && $quote->markup_type == 'itemised' ? $quoteD['markup_percentage'] : NULL,
            'selling_price'                     => isset($quote->markup_type) && $quote->markup_type == 'itemised' ? $quoteD['selling_price'] : NULL,
            'profit_percentage'                 => isset($quote->markup_type) && $quote->markup_type == 'itemised' ? $quoteD['profit_percentage'] : NULL,
            'estimated_cost_bc'                 => $quoteD['estimated_cost_in_booking_currency']??$quoteD['estimated_cost_bc'],
            'selling_price_in_booking_currency' => isset($quote->markup_type) && $quote->markup_type == 'itemised' ? $quoteD['selling_price_in_booking_currency'] : NULL,
            'markup_amount_in_booking_currency' => isset($quote->markup_type) && $quote->markup_type == 'itemised' ? $quoteD['markup_amount_in_booking_currency'] : NULL,
            'category_details'                  => $quoteD['category_details']??$quoteD['category_details'],
            'product_details'                   => $quoteD['product_details']??$quoteD['product_details'],
            'image'                             => isset($quoteD['image']) && !empty($quoteD['image']) ? $quoteD['image'] : NULL
        ];

        if($type == 'quote_details'){

            $data['quote_id']             = $quote->id;
            $data['supplier_country_ids'] = isset($quoteD['supplier_country_ids']) && !empty($quoteD['supplier_country_ids']) ? json_encode($quoteD['supplier_country_ids']) : NULL ;
        }

        if($type == 'clone'){

            $data['quote_id']             = $quote->id;
            $data['supplier_country_ids'] = isset($quoteD['supplier_country_ids']) && !empty($quoteD['supplier_country_ids']) ? $quoteD['supplier_country_ids'] : NULL ;
        }

        if($type == 'booking_details'){

            $data['booking_id']                   = $quote->id;
            $data['supplier_country_ids']         = isset($quoteD['supplier_country_ids']) && !empty($quoteD['supplier_country_ids']) ? $quoteD['supplier_country_ids'] : NULL ;
            $data['outstanding_amount_left']      = $quoteD['estimated_cost'];
            $data['actual_cost']                  = $quoteD['estimated_cost'];
            $data['actual_cost_bc']               = $quoteD['estimated_cost_bc'];
            $data['booking_detail_unique_ref_id'] = Helper::getBDUniqueRefID();
        }

        return $data;
    }

    public function getQuoteCategoryDetailArray( $quoteD, $category_detail )
    {

        $data = [
            'quote_id'         => $quoteD['quote_id'],
            'quote_detail_id'  => $quoteD['id'],
            'category_id'      => $quoteD['category_id'],
            'type'             => $category_detail['type'],
            'label'            => $category_detail['label'],
            'data'             => isset($category_detail['data']) ? $category_detail['data'] : NULL,
            'inline'           => (isset($category_detail['inline']) && $category_detail['inline'] == true) ? 'true' : 'false',
            'min'              => isset($category_detail['min']) ? $category_detail['min'] : NULL,
            'max'              => isset($category_detail['max']) ? $category_detail['max'] : NULL,
            'subtype'          => isset($category_detail['subtype']) ? $category_detail['subtype'] : NULL,
            'toggle'           => (isset($category_detail['toggle']) && $category_detail['toggle'] == true) ? 'true' : 'false',
        ];

        if($category_detail['type'] == 'checkbox-group' || ( $category_detail['type'] == 'select' && $category_detail['multiple'] == true ) ){

            $data['value']    = json_encode($category_detail['userData']);
            $data['multiple'] = 'true';
        }
        else{

            $data['value']    = $category_detail['userData'][0];
            $data['multiple'] = 'false';
        }

        return $data;
    }

    public function getBookingQuoteCategoryDetailArray( $quoteD, $category_detail ){
       
        return [
            'booking_id'         => $quoteD['booking_id'],
            'booking_detail_id'  => $quoteD['id'],
            'category_id'        => $quoteD['category_id'],
            'type'               => $category_detail['type'],
            'label'              => $category_detail['label'],
            'data'               => isset($category_detail['data']) ? $category_detail['data'] : NULL,
            'inline'             => (isset($category_detail['inline']) && $category_detail['inline'] == true) ? 'true' : 'false',
            'min'                => isset($category_detail['min']) ? $category_detail['min'] : NULL,
            'max'                => isset($category_detail['max']) ? $category_detail['max'] : NULL,
            'subtype'            => isset($category_detail['subtype']) ? $category_detail['subtype'] : NULL,
            'toggle'             => (isset($category_detail['toggle']) && $category_detail['toggle'] == true) ? 'true' : 'false',
            'multiple'           => $category_detail['multiple'],
            'value'              => $category_detail['value'],
        ];
    }

    public function getCloneQuoteCategoryDetailArray( $quoteD, $category_detail ){
       
        return [
            'quote_id'           => $quoteD['quote_id'],
            'quote_detail_id'    => $quoteD['id'],
            'category_id'        => $quoteD['category_id'],
            'type'               => $category_detail['type'],
            'multiple'           => $category_detail['multiple'],
            'label'              => $category_detail['label'],
            'value'              => $category_detail['value'],
        ];
    }

    public function getPaxDetailsArray( $object, $pax_data, $type ){

        $data = [

            'full_name'             => $pax_data['full_name'],
            'email_address'         => $pax_data['email_address'],
            'date_of_birth'         => $pax_data['date_of_birth'],
            'bedding_preference'    => $pax_data['bedding_preference'],
            'dietary_preferences'   => $pax_data['dietary_preferences'],
            'nationality_id'        => $pax_data['nationality_id'],
            'resident_in'           => $pax_data['resident_in'],
            'covid_vaccinated'      => isset($pax_data['covid_vaccinated']) && !empty($pax_data['covid_vaccinated']) ? $pax_data['covid_vaccinated'] : '0',
            'medical_requirement'   => $pax_data['medical_requirement'],
        ];

        if($type == 'quotes'){

            $data['quote_id']       = $object->id;
            $data['contact_number'] = $pax_data['full_number'];
        }

        if($type == 'clone'){

            $data['quote_id']       = $object->id;
            $data['contact_number'] = $pax_data['contact_number'];
        }

        if($type == 'bookings'){

            $data['booking_id']     = $object->id;
            $data['contact_number'] = $pax_data['contact_number'];
        }

        return $data;
    }

    public function getQuoteDetailCountryArray( $quote, $quoteDetail, $id, $type)
    {
        $data = [
            'country_id'      => $id
        ];

        if($type == 'quote_details' || $type == 'clone'){

            $data['quote_id']        = $quote->id;
            $data['quote_detail_id'] = $quoteDetail->id;
        }

        if($type == 'booking_details'){

            $data['booking_id']        = $quote->id;
            $data['booking_detail_id'] = $quoteDetail->id;
        }

        return $data;
    }

    public function getQuoteDetailStoredTextArray($quoteDetail, $quote_detail){

        $data = [
            'quote_detail_id' => $quoteDetail->id,
            'stored_text'     => $quote_detail['stored_text']['text'],
            'action_date'     => $quote_detail['stored_text']['date']
        ];

        return $data;
    }

    public function getQuoteLogArray($quote)
    {

        $array          = $quote->toArray();
        $array['quote'] = $quote->getQuoteDetails->toArray();
        $array['pax'  ] = $quote->getPaxDetail->toArray();

        $data = [
            'quote_id'   => $quote->id,
            'version_no' => $quote->version,
            'data'       => $array,
            'log_no'     => $quote->getQuotelogs()->count(),
        ];

        return $data;
    }

    public function create()
    {
        $data['countries']          = Country::orderBy('sort_order', 'ASC')->get();
        $data['supplier_countries'] = Country::orderByService()->orderByAsc()->get();
        $data['public_templates']  = Template::public()->get();
        $data['private_templates'] = Template::private()->get();
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::role(['supervisor'])->get();
        $data['sale_persons']     = User::get();
        // whereHas('getRole', function($query){
        //     $query->where('slug', 'sales-agent');
        // })
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['commission_types'] = Commission::all();
        $data['quote_id']         = Helper::getQuoteID();
        $data['quote_ref']        = Quote::get('quote_ref');
        $data['storetexts']       = StoreText::get();
        $data['groups']           = Group::orderBy('created_at','DESC')->get();
        $data['group_owners']     = GroupOwner::orderBy('id','ASC')->get();
        $data['currency_conversions'] = CurrencyConversion::orderBy('from', 'desc')->get();

        $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();
        $data['locations']        = Location::get();
        $data['harbours']          = Harbour::get();

        return view('quotes.create', $data);
    }

    // QuoteRequest
    // Request
    public function store(QuoteRequest $request)
    {

        

        $quote = Quote::create($this->quoteArray($request, 'quotes', 'store'));
        $quote->getCountryDestinations()->sync($request->country_destination_ids);

        if($request->has('quote') && count($request->quote) > 0){
            foreach ($request->quote as $quote_detail) {

                $quoteDetail = QuoteDetail::create($this->getQuoteDetailsArray($quote, $quote_detail, 'quote_details'));

                if(isset($quote_detail['supplier_country_ids']) && !empty($quote_detail['supplier_country_ids'])){

                    foreach($quote_detail['supplier_country_ids'] as $id){
                        QuoteDetailCountry::create($this->getQuoteDetailCountryArray($quote, $quoteDetail, $id, 'quote_details'));
                    }
                }

                if(isset($quote_detail['stored_text'])){
                    QuoteDetailStoredText::create($this->getQuoteDetailStoredTextArray($quoteDetail, $quote_detail));
                }

                /* quote_category_details values*/ 
                if(isset($quote_detail['category_details']) && !is_null($quote_detail['category_details'])){

                    $category_details = json_decode($quote_detail['category_details'], true);

                    foreach ($category_details as $category_detail){
                        if(isset($category_detail['userData'])){

                            QuoteCategoryDetail::create($this->getQuoteCategoryDetailArray($quoteDetail, $category_detail));
                        }
                    }
                }

            }
        }

       //pax data
        if($request->has('pax')){
            foreach ($request->pax as $pax_data) {

                QuotePaxDetail::create($this->getPaxDetailsArray($quote, $pax_data, 'quotes'));
            }
        }

        if(request()->quote_group != 0) {
            /* update quote values with a group total values */
            $new_quote_group = Group::find(request()->quote_group);
            $new_quote_group->total_net_price = $new_quote_group->total_net_price + $quote->net_price;
            $new_quote_group->total_markup_amount = $new_quote_group->total_markup_amount + $quote->markup_amount;
            $new_quote_group->total_markup_percentage = $new_quote_group->total_markup_percentage + $quote->markup_percentage;
            $new_quote_group->total_selling_price = $new_quote_group->total_selling_price + $quote->selling_price;
            $new_quote_group->total_profit_percentage = $new_quote_group->total_profit_percentage + $quote->profit_percentage;
            $new_quote_group->total_commission_amount = $new_quote_group->total_commission_amount + $quote->commission_amount;
            $new_quote_group->save();
            $new_quote_group->quotes()->attach($quote->id);
        }

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Quote Created Successfully.',
            'redirect_url'    => route('quotes.index') 
        ]);
    }

    public function edit($id)
    {
        $quote = Quote::findOrFail(decrypt($id));
        $data['quote']            = $quote;
        $data['countries']        = Country::orderBy('sort_order', 'ASC')->get();
        $data['supplier_countries'] = Country::orderByService()->orderByAsc()->get();
        $data['public_templates']  = Template::public()->get();
        $data['private_templates'] = Template::private()->get();
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::role(['supervisor'])->get();
        $data['sale_persons']     = User::get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['commission_types'] = Commission::all();
        $data                     = array_merge($data, Helper::checkAlreadyExistUser($id,'quotes'));
        $data['quote_ref']        = Quote::where('quote_ref','!=', $quote->quote_ref)->get('quote_ref');
        $data['storetexts']       = StoreText::get();
        $data['groups']           = Group::where('currency_id', $quote->currency_id)->orderBy('created_at','DESC')->get();
        $data['currency_conversions'] = CurrencyConversion::orderBy('id', 'desc')->get();
        $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();
        $data['locations']        = Location::get();
        $data['group_owners']     = GroupOwner::orderBy('id','ASC')->get();

        return view('quotes.edit',$data);
    }

    // QuoteRequest
    // Request
    public function update(QuoteRequest $request, $id)
    {
        // dd($request->all());

        /* check override update access */ 
        // $quote_update_detail = QuoteUpdateDetail::where('foreign_id',decrypt($id))->where('user_id',Auth::id())->where('status','quotes')->first();
        // if(is_null($quote_update_detail)){
        //     return \Response::json(['overrride_errors' => 'Someone Has Override Update Access.'], 422); // Status code here
        // }

        $quote = Quote::findOrFail(decrypt($id));
        $quote->getCountryDestinations()->sync($request->country_destination_ids);

        /* store quote log*/ 
        QuoteLog::create($this->getQuoteLogArray($quote));

        /* update quote table */ 
        $quote->update($this->quoteArray($request, 'quotes'));

        /* update quote detail table*/ 
        if($request->has('quote') && count($request->quote) > 0){

            /* delete old quote details */ 
            $quote->getQuoteDetails()->delete();

            foreach ($request->quote as $quote_detail) {
                
                $quoteDetail = QuoteDetail::create($this->getQuoteDetailsArray($quote, $quote_detail, 'quote_details'));

                if( isset($quote_detail['supplier_country_ids']) && !empty($quote_detail['supplier_country_ids']) ){

                    foreach($quote_detail['supplier_country_ids'] as $key => $id){
                        QuoteDetailCountry::create($this->getQuoteDetailCountryArray($quote, $quoteDetail, $id, 'quote_details'));
                    }
                }
                
                /* quote_detail_stored_texts values*/ 
                if(isset($quote_detail['stored_text'])){

                    QuoteDetailStoredText::create($this->getQuoteDetailStoredTextArray($quoteDetail, $quote_detail));
                }

                /* quote_category_details values*/ 
                if(isset($quote_detail['category_details']) && !empty($quote_detail['category_details'])){

                    $category_details = json_decode($quote_detail['category_details'], true);

                    foreach ($category_details as $category_detail){
                        if(isset($category_detail['userData'])){

                            QuoteCategoryDetail::create($this->getQuoteCategoryDetailArray($quoteDetail, $category_detail));
                        }
                    }
                }

            }
        }

        /* update quote_pax_details values */
        if($request->has('pax')){

            /* delete old pax details */
            $quote->getPaxDetail()->delete();

            foreach ($request->pax as $pax_data) {
                QuotePaxDetail::create($this->getPaxDetailsArray($quote, $pax_data, 'quotes'));
            }
        }else{
            $quote->getPaxDetail()->delete();
        }

        /* update group_quote values */ 
        if(request()->quote_group != 0) {
            $this->add_and_update_quote_group($quote);
        } else {
            $this->update_quote_group($quote);
        }
        // $quote_update_detail->delete();

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Quote Updated Successfully.',
            'redirect_url'    => route('quotes.index') 
        ]);
    }
    
    public function quoteVersion($id, $type = null)
    {
        $log = QuoteLog::findOrFail(decrypt($id));

        $quote                    = $log->data;
        $data['quote']            = (object) $quote;
        $data['log']              = $log;
        $data['public_templates']  = Template::public()->get();
        $data['private_templates'] = Template::private()->get();
        $data['countries']        = Country::orderBy('sort_order', 'ASC')->get();
        $data['supplier_countries'] = Country::orderByService()->orderByAsc()->get();
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::role(['supervisor'])->get();
        $data['sale_persons']     = User::get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['commission_types'] = Commission::all();
        $data['quote_ref']        = Quote::where('quote_ref','!=', $data['quote']->quote_ref)->get('quote_ref');
        $data['storetexts']       = StoreText::get();
        $data['groups']           = Group::with('quotes')->where('currency_id', $data['quote']->currency_id)->orderBy('id','ASC')->get();
        $data['currency_conversions'] = CurrencyConversion::orderBy('id', 'desc')->get();
        $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();
        $data['locations']        = Location::get();
        $data['group_owners']     = GroupOwner::orderBy('id','ASC')->get();

        if($type != NULL){
            $data['type'] = $type;
        }
        return view('quotes.version', $data);
    }

    /* view final quote */
    public function finalQuote($id)
    {
        $data['countries']        = Country::orderBy('sort_order', 'ASC')->get();
        $data['supplier_countries'] = Country::orderByService()->orderByAsc()->get();
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['public_templates']  = Template::public()->get();
        $data['private_templates'] = Template::private()->get();
        $data['currency_conversions'] = CurrencyConversion::orderBy('from', 'desc')->get();
        $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::role(['supervisor'])->get();
        $data['sale_persons']     = User::get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $quote                    = Quote::findOrFail(decrypt($id));
        $data['quote']            = $quote;
        $data['commission_types'] = Commission::all();
        $data['quote_ref']        = Quote::where('quote_ref','!=', $quote->quote_ref)->get('quote_ref');
        $data['storetexts']       = StoreText::get();
        $data['groups']           = Group::orderBy('id','ASC')->get();
        $data['locations']        = Location::get();
        $data['group_owners']     = GroupOwner::orderBy('id','ASC')->get();

        return view('quotes.show',$data);
    }

    public function bulkAction(Request $request)
    {
        try {

            $message = "";
            $bulk_action_ids  = $request->bulk_action_ids;
            $bulk_action_type = $request->bulk_action_type;
    
            $bulk_action_ids  = explode(",", $bulk_action_ids);
    
            if($bulk_action_type == 'cancel'){
                DB::table("quotes")->whereIn('id', $bulk_action_ids)->update([ 'booking_status' => 'cancelled' ]);
                $message = "Quotes Cancelled Successfully.";
            }
    
            if($bulk_action_type == 'revert_cancel'){
                DB::table("quotes")->whereIn('id', $bulk_action_ids)->update([ 'booking_status' => 'quote' ]);
                $message = "Revert Cancelled Quotes Successfully.";
            }
    
            if($bulk_action_type == 'archive'){
                DB::table("quotes")->whereIn('id', $bulk_action_ids)->update([ 'is_archive' => 1 ]);
                $message = "Quotes Archived Successfully.";
            }
    
            if($bulk_action_type == 'unarchive'){
                DB::table("quotes")->whereIn('id', $bulk_action_ids)->update([ 'is_archive' => 0 ]);
                $message = "Quotes Unarchived Successfully.";
            }
    
            return response()->json([ 
                'status'  => true, 
                'message' => $message,
            ]);
          
        } catch (\Exception $e) {

            // $e->getMessage(),
            return response()->json([ 
                'status'  => false, 
                'message' => "Something Went Wrong, Please Try Again."
            ]);
        }

        // $table_name        = $request->table;
        // $respons['status'] = FALSE;
        // $isArchive         = ($request->btn == 'unarchive')? 0 : 1;

        // if($request->btn == 'archive' || $request->btn == 'unarchive'){
            
        //     DB::table($table_name)->whereIn('id', $ids)->update(['is_archive' => $isArchive]);
        //     $respons['message'] = ($isArchive == 1)? "Quotes Archived Successfully" : 'Quotes Unarchived Successfully';

        // }elseif ($request->btn  == 'cancel'){

        //     DB::table($table_name)->whereIn('id', $ids)->update(['booking_status' => 'cancelled']);
        //     $respons['message'] = 'Quotes Cancelled Successfully !!';
        // }
        // elseif ($request->btn  == 'quote'){

        //     DB::table($table_name)->whereIn('id', $ids)->update(['booking_status' => 'quote']);
        //     $respons['message'] = 'Revert Cancelled Quotes Successfully !!';
        // }

        // $respons['status']  = true;

        // return response()->json($respons);
    }

    public function compare_quote(Request $request)
    {
        if ($request->isMethod('post')) {

            if(isset($request->quote_ref_one) && !empty($request->quote_ref_one)){
                $data['quote_ref_one'] =  Quote::find($request->quote_ref_one);
            }
            
            if(isset($request->quote_ref_two) && !empty($request->quote_ref_two)){
                $data['quote_ref_two'] =  Quote::find($request->quote_ref_two);
            }

            if(isset($request->quote_ref_three) && !empty($request->quote_ref_three)){
                $data['quote_ref_three'] =  Quote::find($request->quote_ref_three);
            }

            if(isset($request->quote_ref_four) && !empty($request->quote_ref_four)){
                $data['quote_ref_four'] =  Quote::find($request->quote_ref_four);
            }

        }
    
        $data['quotes'] = Quote::groupBy('ref_no')->orderBy('created_at','DESC')->get();

        return view('compare_quote.index', $data);
    }

    public function quote_document(Request $request, $id)
    {
        $quote          = Quote::findOrFail(decrypt($id));
        $quoteDetails   = $quote->getQuoteDetails()->orderBy('time_of_service', 'ASC')->orderBy('date_of_service', 'ASC')->get(['date_of_service', 'end_date_of_service', 'time_of_service', 'category_id', 'product_id', 'service_details'])->groupBy('date_of_service');
        $data['quote_details']  = $quoteDetails;
        $data['created_at']     =  $quote->doc_formated_created_at;
        $data['title']          =  $quote->booking_details;
        $data['person_name']    =  $quote->getSalePerson->name;
        $data['brand_about']    =  $quote->getBrand->about_us;
        $pdf = PDF::loadView('quote_documents.pdf', $data);
        return $pdf->stream();
    }

    public function booking($id)
    {
        try {

            $quote   = Quote::findORFail(decrypt($id));
            $booking = Booking::create($this->quoteArray($quote, 'bookings'));
    
            foreach ($quote->getQuoteDetails as $qu_details) {
    
                $bookingDetail = BookingDetail::create($this->getQuoteDetailsArray($quote, $qu_details, 'booking_details'));
    
                if($qu_details->getQuoteDetailCountries && $qu_details->getQuoteDetailCountries->count()){
                    foreach ($qu_details->getQuoteDetailCountries as $detail) {
    
                        BookingDetailCountry::create($this->getQuoteDetailCountryArray($booking, $bookingDetail, $detail->country_id, 'booking_details'));
                    }
                }
    
                if($qu_details->getCategoryDetailFeilds && $qu_details->getCategoryDetailFeilds->count()){
                    foreach ($qu_details->getCategoryDetailFeilds as $feilds) {
    
                        BookingCategoryDetail::create($this->getBookingQuoteCategoryDetailArray($bookingDetail, $feilds));
                    }
                }
            }
    
            if($quote->getPaxDetail->count()){
                foreach ($quote->getPaxDetail as $pax_data) {
    
                    BookingPaxDetail::create($this->getPaxDetailsArray($booking, $pax_data, 'bookings'));
                }
            }
            
            $quote->update([
                'booking_status' => 'booked',
                'booking_date'   => Carbon::now()
            ]);
          
            return response()->json([ 
                'status'          => true, 
                'success_message' => 'Quote Booked Successfully.',
            ]);

        } catch (\Exception $e) {
          
            // $e->getMessage();
            return response()->json([ 
                'status'        => false, 
                'error_message' => "Something Went Wrong, Please Try Again."
            ]);
        }
    }

    public function multipleAlert($action_type ,$id){
        
        try {

            $message = "";

            if($action_type == 'booked_quote'){

                $this->bookedQuote($id);
                $message = "Quote Booked Successfully.";
            }

            if($action_type == 'clone_quote'){

                $this->cloneQuote($id);
                $message = "Quote Cloned Successfully.";
            }

            if($action_type == 'cancel_quote'){
                
                Quote::findOrFail(decrypt($id))->update([ 'booking_status' => 'cancelled' ]);
                $message = "Quote Cancelled Successfully.";
            }

            if($action_type == 'restore_quote'){

                Quote::findOrFail(decrypt($id))->update([ 'booking_status' => 'quote' ]);
                $message = "Quote Restored Successfully.";
            }

            if($action_type == 'archive_quote'){

                Quote::findOrFail(decrypt($id))->update([ 'is_archive' => 1 ]);
                $message = "Quote Archived Successfully.";
            }

            if($action_type == 'unarchive_quote'){

                Quote::findOrFail(decrypt($id))->update([ 'is_archive' => 0 ]);
                $message = "Quote Unarchived Successfully.";
            }
    
            return response()->json([ 
                'status'          => true, 
                'success_message' => $message,
            ]);
          
        } catch (\Exception $e) {

            return response()->json([ 
                'status'        => false, 
                // 'error_message' => "Something Went Wrong, Please Try Again."
                'error_message' => $e->getMessage()
            ]);
        }
    }

    public function bookedQuote($id){

        $quote   = Quote::findORFail(decrypt($id));
        $booking = Booking::create($this->quoteArray($quote, 'bookings'));
        $booking->getCountryDestinations()->sync($quote->getCountryDestinations()->pluck('country_id')->toArray());

        foreach ($quote->getQuoteDetails as $qu_details) {

            $bookingDetail = BookingDetail::create($this->getQuoteDetailsArray($booking, $qu_details, 'booking_details'));

            if($qu_details->getQuoteDetailCountries && $qu_details->getQuoteDetailCountries->count()){
                foreach ($qu_details->getQuoteDetailCountries as $detail) {

                    BookingDetailCountry::create($this->getQuoteDetailCountryArray($booking, $bookingDetail, $detail->country_id, 'booking_details'));
                }
            }

            if($qu_details->getCategoryDetailFeilds && $qu_details->getCategoryDetailFeilds->count()){
                foreach ($qu_details->getCategoryDetailFeilds as $feilds) {

                    BookingCategoryDetail::create($this->getBookingQuoteCategoryDetailArray($bookingDetail, $feilds));
                }
            }
        }

        if($quote->getPaxDetail->count()){
            foreach ($quote->getPaxDetail as $pax_data) {

                BookingPaxDetail::create($this->getPaxDetailsArray($booking, $pax_data, 'bookings'));
            }
        }
        
        $quote->update([
            'booking_status' => 'booked',
            'booking_date'   => Carbon::now()
        ]);
    }

    public function cancelQuote($id){

        Quote::findOrFail(decrypt($id))->update(['booking_status' => 'cancelled']);
    }

    public function exportQuote($id){

        $quote = Quote::with('getSalePerson','getCommission','getBrand','getHolidayType','getSeason','getCurrency','getNationality','getPaxDetail','getQuoteDetails')->findOrFail(decrypt($id));
        $data['quote']            = $quote;
        $data['countries']        = Country::orderBy('sort_order', 'ASC')->get();
        $data['templates']        = Template::all()->sortBy('name');
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::role(['supervisor'])->get();
        $data['sale_persons']     = User::get();
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['commission_types'] = Commission::all();
        $data                     = array_merge($data, Helper::checkAlreadyExistUser($id,'quotes'));
        $data['quote_ref']        = Quote::where('quote_ref','!=', $quote->quote_ref)->get('quote_ref');
    
        return Excel::download(new QuoteExport($data), "$quote->quote_ref.xlsx");
    }

    public function add_and_update_quote_group($quote) {
        /*if quote is already connected with a group*/
        $this->update_quote_group($quote);

        /* update quote values with a group total values */
        $new_quote_group = Group::find(request()->quote_group);
        $new_quote_group->total_net_price = $new_quote_group->total_net_price + $quote->net_price;
        $new_quote_group->total_markup_amount = $new_quote_group->total_markup_amount + $quote->markup_amount;
        $new_quote_group->total_markup_percentage = $new_quote_group->total_markup_percentage + $quote->markup_percentage;
        $new_quote_group->total_selling_price = $new_quote_group->total_selling_price + $quote->selling_price;
        $new_quote_group->total_profit_percentage = $new_quote_group->total_profit_percentage + $quote->profit_percentage;
        $new_quote_group->total_commission_amount = $new_quote_group->total_commission_amount + $quote->commission_amount;
        $new_quote_group->save();
        $new_quote_group->quotes()->attach($quote->id);
    }

    public function update_quote_group($quote) {
        $update_quote_group = DB::table('group_quote')->where('quote_id', $quote->id)->get()->first();
        if(!empty($update_quote_group)) {
            $old_quote_group = Group::find($update_quote_group->group_id);
            $old_quote_group->total_net_price = $old_quote_group->total_net_price - $quote->net_price;
            $old_quote_group->total_markup_amount = $old_quote_group->total_markup_amount - $quote->markup_amount;
            $old_quote_group->total_markup_percentage = $old_quote_group->total_markup_percentage - $quote->markup_percentage;
            $old_quote_group->total_selling_price = $old_quote_group->total_selling_price - $quote->selling_price;
            $old_quote_group->total_profit_percentage = $old_quote_group->total_profit_percentage - $quote->profit_percentage;
            $old_quote_group->total_commission_amount = $old_quote_group->total_commission_amount - $quote->commission_amount;
            $old_quote_group->save();
            $old_quote_group->quotes()->detach($quote->id);
        }
    }

    public function cancel($id)
    {
        Quote::findOrFail(decrypt($id))->update(['booking_status' => 'cancelled']);
        return redirect()->back()->with('success_message', 'Quote Cancelled Successfully');
    }

    public function restore($id)
    {
        Quote::findOrFail(decrypt($id))->update(['booking_status' => 'quote']);
        return redirect()->back()->with('success_message', 'Quote Restore Successfully');
    }

    public function getTrash()
    {
        $data['quotes'] = Quote::onlyTrashed()->paginate($this->pagiantion);
        return view('quotes.trash', $data);
    }

    /* quote clone */
    public function cloneQuote($id)
    {
        $quote      = Quote::findORFail(decrypt($id));
        $clone      = Quote::create($this->quoteArray($quote, 'clone'));
        $clone->getCountryDestinations()->sync($quote->getCountryDestinations()->pluck('country_id')->toArray());

        foreach ($quote->getQuoteDetails as $qu_details) {

            $quoteDetail = QuoteDetail::create($this->getQuoteDetailsArray($clone, $qu_details, 'clone'));

            if($qu_details->getCategoryDetailFeilds && $qu_details->getCategoryDetailFeilds->count()){
                foreach ($qu_details->getCategoryDetailFeilds as $feilds) {

                    QuoteCategoryDetail::create($this->getCloneQuoteCategoryDetailArray($quoteDetail, $feilds));
                }
            }

            if($qu_details->getQuoteDetailCountries && $qu_details->getQuoteDetailCountries->count()){
                foreach ($qu_details->getQuoteDetailCountries as $detail) {
                    QuoteDetailCountry::create($this->getQuoteDetailCountryArray($clone, $quoteDetail, $detail->country_id, 'clone'));
                }
            }
            
        }
    
        if($quote->getPaxDetail && $quote->pax_no >= 1){
            foreach ($quote->getPaxDetail as $pax_data) {

                QuotePaxDetail::create($this->getPaxDetailsArray($clone, $pax_data, 'clone'));
            }
        }
    }

    public function getGroups($currency_id){
        try {
            $data['groups'] = Group::where('currency_id', $currency_id)->orderBy('created_at','DESC')->get();
            return ['status' => true, 'groups' => $data['groups']];
            
        } catch (\Exception $e) {
            return ['status' => false, 'error' => $e->getMessage()];
        }
     }

    public function get_autocomplete_data()
    {
        $array = [];
        $array['airport_codes'] = DB::table('airport_codes')->get();
        $array['harbours'] = DB::table('harbours')->get();
        $array['hotels'] = DB::table('hotels')->get();
        $array['all'] = DB::table('hotels')
            ->select('name')
            ->union(DB::table('airport_codes')->select('name'))
            ->union(DB::table('harbours')->select('name'))
            ->get();
        return $array;
    }

    /* update status in archive */
    // public function addInArchive(Request $request, $id)
    // {
    //     $isArchive = ((int)$request->is_archive == 0)? 1 : 0;
    //     Quote::findOrFail(decrypt($id))->update(['is_archive' => $isArchive]);
    //     if(isset($request->status)){
    //         $messge = 'Quote reverted from archive successfully';
    //         return redirect()->route('quotes.archive')->with('success_message', $messge);
    //     }else{
    //         $messge = 'Quote add in archive successfully';
    //         return redirect()->route('quotes.index')->with('success_message', $messge);
    //     }

    //     return redirect()->back();
    // }

    // public function multiple_action(Request $request)
    // {
    //     $action       = $request->action;
    //     $check_values = $request->checkedValues;

    //     if($action == "Delete"){
    //         Quote::destroy(decrypt($check_values));
    //         return ['status' => true, 'message' => 'Records Deleted Successfully !!'];
    //     }

    //     if($action == "Archive"){
    //         Quote::findOrFail(decrypt($check_values))->update(['is_archive' => 1]);
    //         return ['status' => true, 'message' => 'Records Archived Successfully !!'];
    //     }

    // }

    // BookingPaxDetail::create([
    //     'booking_id'            => $booking->id,
    //     'full_name'             => $pax['full_name'],
    //     'email_address'         => $pax['email_address'],
    //     'contact_number'        => $pax['full_number'],
    //     'date_of_birth'         => $pax['date_of_birth'],
    //     'bedding_preference'    => $pax['bedding_preference'],
    //     'dinning_preference'    => $pax['dinning_preference'],
    //     'nationality_id'        => $pax['nationality_id'],
    //     'resident_in'           => $pax['resident_in'],
    // ]);

    /* store quote*/
    // QuotePaxDetail::create([
    //     'quote_id'              => $quote->id,
    //     'full_name'             => $pax_data['full_name'],
    //     'email_address'         => $pax_data['email_address'],
    //     'contact_number'        => $pax_data['full_number'],
    //     'date_of_birth'         => $pax_data['date_of_birth'],
    //     'bedding_preference'    => $pax_data['bedding_preference'],
    //     'dinning_preference'    => $pax_data['dinning_preference'],
    //     'nationality_id'        => $pax_data['nationality_id'],
    //     'resident_in'           => $pax_data['resident_in'],
    //     'covid_vaccinated'      => $pax_data['covid_vaccinated'],
    // ]);

    // 'booking_reference'     => $quoteD['booking_reference'],
    // 'booking_date'          => $quoteD['booking_date'],
    // 'booking_due_date'      => $quoteD['booking_due_date'],
    // 'product_location_id'   => $quoteD['product_location_id'],
    // 'booking_method_id'     => $quoteD['booking_method_id'],
    // 'booked_by_id'          => $quoteD['booked_by_id'],
    // 'supervisor_id'         => $quoteD['supervisor_id'],
    // 'supplier_location_id'  => $quoteD['supplier_location_id'],
    // 'supplier_country_ids'  => (isset($quoteD['supplier_country_ids'])) ? json_encode($quoteD['supplier_country_ids']) : NULL ,
    // 'added_in_sage'           => isset($quoteD['added_in_sage']) && !empty($quoteD['added_in_sage']) ? : 0,
}
