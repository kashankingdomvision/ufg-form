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
use App\Http\Helper;
use App\Brand;
use App\Booking;
use App\BookingMethod;
use App\BookingType;
use App\BookingDetail;
use App\BookingPaxDetail;
use App\Currency;
use App\Category;
use App\Commission;
use App\Country;
use App\CurrencyConversion;
use App\Group;
use App\HolidayType;
use App\Product;
use App\QuoteUpdateDetail;
use App\QuoteDocument;
use App\Quote;
use App\QuoteDetail;
use App\QuotePaxDetail;
use App\QuoteLog;
use App\Season;
use App\Supplier;
use App\Template;
use App\User;
use App\StoreText;
use PHPUnit\TextUI\XmlConfiguration\Logging\TestDox\Html;
use App\QuoteDetailStoredText;
use App\ReferenceCredential;
use App\CommissionGroup;
use App\CommissionCriteria; 
use App\PresetComment; 

class QuoteController extends Controller
{

    public function compare_quote(Request $request)
    {
    
        if ($request->isMethod('post')) {

            // dd($request->all());


            // $q = QuoteDetail::whereIn('quote_id', $request->all())->get('date_of_service')->toArray();

            // dd($q );


            


            // $quote_ref_one = Quote::find($request->quote_ref_one)->getQuoteDetails()->get('date_of_service')->toArray();


            // dd();



            // $quote_ref_two = Quote::find($request->quote_ref_two)->getQuoteDetails()->get();

            // // $c = array_merge_recursive($quote_ref_one,$quote_ref_two);

            // // dd($c);

            // dd($quote_ref_one);
            // dd($quote_ref_two);

            // $quote_ref_two = Quote::find($request->quote_ref_two);

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

            // dd($data);

        }
    
        $data['quotes'] = Quote::groupBy('ref_no')->orderBy('created_at','DESC')->get();

 
        return view('compare_quote.index', $data);
    }

    public $pagiantion = 10;

    public function quote_document(Request $request, $id)
    {
        $quote          = Quote::findOrFail(decrypt($id));
        $quoteDetails   = $quote->getQuoteDetails()->orderBy('time_of_service', 'ASC')->orderBy('date_of_service', 'ASC')->get(['date_of_service', 'end_date_of_service', 'time_of_service', 'category_id', 'product_id', 'service_details'])->groupBy('date_of_service');
        $data['quote_details']  = $quoteDetails;
        $data['created_at']     =  $quote->doc_formated_created_at;
        $data['title']          =  $quote->quote_title;
        $data['person_name']    =  $quote->getSalePerson->name;
        $data['brand_about']    =  $quote->getBrand->about_us;
        $pdf = PDF::loadView('quote_documents.pdf', $data);
        return $pdf->stream();
        // return $pdf->download('medium.pdf');
    }


    public function index(Request $request)
    {
        $quote  = Quote::select('*', DB::raw('count(*) as quote_count'))->withTrashed()->where('is_archive', '!=', 1);
        if(count($request->all()) >0){
            $quote = $this->searchFilters($quote, $request);
        }
        $data['quotes']           = $quote->groupBy('ref_no')->orderBy('created_at','DESC')->paginate($this->pagiantion);
        $data['booking_seasons']  = Season::all();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
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

    public function get_currency_conversion(){
        return CurrencyConversion::all();
    }

    public function get_commission(){
        return CommissionCriteria::leftJoin('commission_criteria_seasons', 'commission_criterias.id', '=', 'commission_criteria_seasons.commission_criteria_id')->get(['commission_criterias.commission_id','commission_criterias.percentage','commission_criterias.commission_group_id','commission_criterias.brand_id','commission_criterias.holiday_type_id','commission_criterias.currency_id','commission_criteria_seasons.season_id']);
    }

    public function quoteArray($request, $type = null)
    {
        $data = [
            'quote_title'                       =>  $request->quote_title,
            'tas_ref'                           =>  $request->tas_ref??NULL,
            'commission_id'                     =>  $request->commission_id??NULL,
            'commission_group_id'               =>  $request->commission_group_id??NULL,
            'user_id'                           =>  Auth::id(),
            'season_id'                         =>  $request->season_id,
            'brand_id'                          =>  $request->brand_id,
            'currency_id'                       =>  $request->currency_id,
            'holiday_type_id'                   =>  $request->holiday_type_id,
            'ref_name'                          =>  $request->ref_name??'zoho',
            'ref_no'                            =>  $request->ref_no,
            'quote_ref'                         =>  ($type == 'clone')? Helper::getQuoteID() : ($request->quote_no??$request->quote_ref),
            'sale_person_id'                    =>  $request->sale_person_id,
            'agency'                            =>  ((int)$request->agency == '1')? '1' : '0',
            'agency_name'                       =>  $request->agency_name??NULL,
            'agency_contact'                    =>  (!empty($type))? $request->agency_contact : (($request->agency_contact)? $request->full_number : NULL),
            'agency_email'                      =>  $request->agency_email??NULL,
            'agency_contact_name'               =>  $request->agency_contact_name??NULL,
            'lead_passenger_name'               =>  $request->lead_passenger_name??NULL,
            'lead_passenger_email'              =>  $request->lead_passenger_email??NULL,
            'lead_passenger_contact'            =>  (!empty($type))? $request->lead_passenger_contact : (($request->lead_passenger_contact)? $request->full_number : NULL),
            'lead_passenger_dbo'                =>  $request->lead_passenger_dbo??NULL,
            'lead_passenger_resident'           =>  $request->lead_passenger_resident??NULL,
            'lead_passsenger_nationailty_id'    =>  $request->lead_passsenger_nationailty_id??NULL,
            'lead_passenger_dinning_preference' =>  $request->lead_passenger_dinning_preference??NULL,
            'lead_passenger_bedding_preference' =>  $request->lead_passenger_bedding_preference??NULL,
            'lead_passenger_covid_vaccinated'   =>  ((int) $request->lead_passenger_covid_vaccinated == '1')? '1' : '0',
            'pax_no'                            =>  $request->pax_no??'0',
            'net_price'                         =>  $request->total_net_price??$request->net_price,
            'markup_amount'                     =>  $request->total_markup_amount??$request->markup_amount,
            'markup_percentage'                 =>  $request->total_markup_percent??$request->markup_percentage,
            'selling_price'                     =>  $request->total_selling_price??$request->selling_price,
            'profit_percentage'                 =>  $request->total_profit_percentage??$request->profit_percentage,
            'commission_amount'                 =>  $request->commission_amount??$request->commission_amount,
            'selling_currency_oc'               =>  $request->selling_price_other_currency??$request->selling_currency_oc,
            'selling_price_ocr'                 =>  $request->selling_price_other_currency_rate??$request->selling_price_ocr,
            'amount_per_person'                 =>  $request->booking_amount_per_person??$request->amount_per_person,
            'rate_type'                         =>  ($request->rate_type == 'live') ? 'live': 'manual',
            'markup_type'                       =>  $request->markup_type??NULL,
            'revelant_quote'                    =>  $request->revelant_quote??NULL,
        ];
        if($type != 'booking'){
            $data['stored_text']                =   $request->stored_text??NULL;
        }
        return $data;
    }

    public function getQuoteDetailsArray($quoteD, $id)
    {
        return [
            'category_id'           => $quoteD['category_id'],
            'supplier_id'           => (isset($quoteD['supplier_id']))? $quoteD['supplier_id'] : NULL ,
            'product_id'            => (isset($quoteD['product_id']))? $quoteD['product_id'] : NULL,
            // 'booking_method_id'     => $quoteD['booking_method_id'],
            // 'booked_by_id'          => $quoteD['booked_by_id'],
            // 'supervisor_id'         => $quoteD['supervisor_id'],
            'date_of_service'       => $quoteD['date_of_service'],
            'end_date_of_service'   => $quoteD['end_date_of_service'],
            'number_of_nights'      => $quoteD['number_of_nights'],
            'time_of_service'       => $quoteD['time_of_service'],
            // 'booking_date'          => $quoteD['booking_date'],
            // 'booking_due_date'      => $quoteD['booking_due_date'],
            'service_details'       => $quoteD['service_details'],
            // 'booking_reference'     => $quoteD['booking_reference'],
            'booking_type_id'       => $quoteD['booking_type_id']??$quoteD['booking_type_id'],
            'refundable_percentage' => (!is_null($quoteD['booking_type_id']) && $quoteD['booking_type_id'] == 2) ? $quoteD['refundable_percentage'] : NULL,
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
            'category_details'      => $quoteD['category_details']??$quoteD['category_details'],
            // 'added_in_sage'           => isset($quoteD['added_in_sage']) && !empty($quoteD['added_in_sage']) ? : 0,
        ];
    }

    public function create()
    {
        $data['countries']        = Country::orderBy('name', 'ASC')->get();
        $data['templates']        = Template::all()->sortBy('name');
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['supervisors']      = User::whereHas('getRole', function($query){
                                        $query->where('slug', 'supervisor');
                                    })->get();
        $data['sale_persons']     = User::get();
        // whereHas('getRole', function($query){
        //     $query->where('slug', 'sales-agent');
        // })
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        $data['booking_types']    = BookingType::all();
        $data['commission_types'] = Commission::all();
        $data['quote_id']         = Helper::getQuoteID();
        $data['quote_ref']        = Quote::get('quote_ref');
        $data['storetexts']       = StoreText::get();
        $data['groups']           = Group::orderBy('created_at','DESC')->get();
        $data['currency_conversions'] = CurrencyConversion::orderBy('from', 'desc')->get();

        $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();

        return view('quotes.create', $data);
    }

    public function store(QuoteRequest $request)
    {
        $quote =  Quote::create($this->quoteArray($request));
        if($request->has('quote') && count($request->quote) > 0){
            foreach ($request->quote as $qu_details) {
                $quoteDetail = $this->getQuoteDetailsArray($qu_details, $quote->id);
                $quoteDetail['quote_id'] = $quote->id;
                if(isset($qu_details['image']) && !empty($qu_details['image'])){
                    $quoteDetail['image'] = $qu_details['image'];
                }

                $qd = QuoteDetail::create($quoteDetail);
                if(isset($qu_details['stored_text'])){
                    QuoteDetailStoredText::create([
                        'quote_detail_id' => $qd->id,
                        'stored_text' => $qu_details['stored_text']['text'],
                        'action_date' => $qu_details['stored_text']['date']
                    ]);
                }

            }
        }
       //pax data
        if($request->has('pax')){
            foreach ($request->pax as $pax_data) {
                QuotePaxDetail::create([
                    'quote_id'              => $quote->id,
                    'full_name'             => $pax_data['full_name'],
                    'email'                 => $pax_data['email_address'],
                    'contact'               => $pax_data['full_number'],
                    'date_of_birth'         => $pax_data['date_of_birth'],
                    'bedding_preference'    => $pax_data['bedding_preference'],
                    'dinning_preference'    => $pax_data['dinning_preference'],
                    'nationality_id'        => $pax_data['nationality_id'],
                    'resident_in'           => $pax_data['resident_in'],
                    'covid_vaccinated'      => ((int) $pax_data['covid_vaccinated'] == '1')? '1' : '0'
                ]);
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

        return \Response::json(['status' => 200, 'success_message' => 'Quote created successfully'], 200);
    }

    public function edit($id)
    {
        $quote = Quote::findOrFail(decrypt($id));
        $data['quote']            = $quote;
        $data['countries']        = Country::orderBy('name', 'ASC')->get();
        $data['templates']        = Template::all()->sortBy('name');
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
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
        $data['commission_types'] = Commission::all();
        $data                     = array_merge($data, Helper::checkAlreadyExistUser($id,'quotes'));
        $data['quote_ref']        = Quote::where('quote_ref','!=', $quote->quote_ref)->get('quote_ref');
        $data['storetexts']       = StoreText::get();
        $data['groups']           = Group::where('currency_id', $quote->currency_id)->orderBy('created_at','DESC')->get();
        $data['currency_conversions'] = CurrencyConversion::orderBy('id', 'desc')->get();
        $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();

        return view('quotes.edit',$data);
    }

    public function update(QuoteRequest $request, $id)
    {
        $quote_update_detail = QuoteUpdateDetail::where('foreign_id',decrypt($id))->where('user_id',Auth::id())->where('status','quotes')->first();
        if(is_null($quote_update_detail)){
            return \Response::json(['overrride_errors' => 'Someone Has Override Update Access.'], 422); // Status code here
        }

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
                if(isset($qu_details['image']) && !empty($qu_details['image'])){
                    $quoteDetail['image'] = $qu_details['image'];
                }
                $qd = QuoteDetail::create($quoteDetail);
                if(isset($qu_details['stored_text'])){
                    QuoteDetailStoredText::create([
                        'quote_detail_id'   => $qd->id,
                        'stored_text'       => $qu_details['stored_text']['text'],
                        'action_date'       => $qu_details['stored_text']['date']
                    ]);
                }
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
                    'contact'               => $pax_data['full_number'],
                    'date_of_birth'         => $pax_data['date_of_birth'],
                    'bedding_preference'    => $pax_data['bedding_preference'],
                    'dinning_preference'    => $pax_data['dinning_preference'],
                    'nationality_id'        => $pax_data['nationality_id'],
                    'resident_in'           => $pax_data['resident_in'],
                    'covid_vaccinated'      => ((int) $pax_data['covid_vaccinated'] == '1')? '1' : '0'
                ]);
            }
       }

       if(request()->quote_group != 0) {
            $this->add_and_update_quote_group($quote);
       } else {
           $this->update_quote_group($quote);
       }
       $quote_update_detail->delete();

       return \Response::json(['status' => 200, 'success_message' => 'Quote update successfully'], 200);
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

    public function quoteVersion($id, $type = null)
    {
        $log = QuoteLog::findOrFail(decrypt($id));

        $quote                    = $log->data;
        $data['quote']            = $quote;
        $data['log']              = $log;
        $data['countries']        = Country::orderBy('name', 'ASC')->get();
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
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
        $data['commission_types'] = Commission::all();
        $data['quote_ref']        = Quote::where('quote_ref','!=', $quote['quote_ref'])->get('quote_ref');
        $data['storetexts']       = StoreText::get();
        $data['groups']           = Group::with('quotes')->where('currency_id', $data['quote']['currency_id'])->orderBy('id','ASC')->get();
        $data['currency_conversions'] = CurrencyConversion::orderBy('id', 'desc')->get();
        $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();

        if($type != NULL){
            $data['type'] = $type;
        }
        return view('quotes.version', $data);
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

    public function booking($id)
    {
        $quote = Quote::findORFail(decrypt($id));
        $getQuote = $this->quoteArray($quote, 'booking');
        $getQuote['quote_id']       = $quote->id;
        $getQuote['booking_status'] = 'confirmed';
        $getQuote['booking_date']   = Carbon::now();
        $booking = Booking::create($getQuote);

        foreach ($quote->getQuoteDetails as $qu_details) {
            $quoteDetail = $this->getQuoteDetailsArray($qu_details, $quote->id);

            $quoteDetail['booking_id']                   = $booking->id;
            $quoteDetail['outstanding_amount_left']      = $quoteDetail['estimated_cost'];
            $quoteDetail['actual_cost']                  = $quoteDetail['estimated_cost'];
            $quoteDetail['actual_cost_bc']               = $quoteDetail['estimated_cost_bc'];
            $quoteDetail['booking_detail_unique_ref_id'] = Helper::getBDUniqueRefID();

            // dd($quoteDetail['booking_detail_unique_ref_id']);


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
                    'nationality_id'        => $pax['nationality_id'],
                ]);
            }
        }
        $quote->update([
            'booking_status' => 'booked',
            'booking_date'   => Carbon::now()
        ]);

        return redirect()->back()->with('success_message', 'Quote Booked successfully');
    }

    public function multiple_action(Request $request)
    {
        $action       = $request->action;
        $check_values = $request->checkedValues;

        if($action == "Delete"){
            Quote::destroy(decrypt($check_values));
            return ['status' => true, 'message' => 'Records Deleted Successfully !!'];
        }

        if($action == "Archive"){

            Quote::findOrFail(decrypt($check_values))->update(['is_archive' => 1]);

            return ['status' => true, 'message' => 'Records Archived Successfully !!'];
        }

    }

    public function getTrash()
    {
        $data['quotes'] = Quote::onlyTrashed()->paginate($this->pagiantion);
        return view('quotes.trash', $data);
    }

    /* view final quote */
    public function finalQuote($id)
    {
        $data['countries']        = Country::orderBy('name', 'ASC')->get();
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
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
        $quote                    = Quote::findOrFail(decrypt($id));
        $data['quote']            = $quote;
        $data['commission_types'] = Commission::all();
        $data['quote_ref']        = Quote::where('quote_ref','!=', $quote->quote_ref)->get('quote_ref');
        $data['storetexts']       = StoreText::get();
        $data['groups']           = Group::orderBy('id','ASC')->get();

        return view('quotes.show',$data);
    }

    /* update status in archive */
    public function addInArchive(Request $request, $id)
    {
        $isArchive = ((int)$request->is_archive == 0)? 1 : 0;
        Quote::findOrFail(decrypt($id))->update(['is_archive' => $isArchive]);
        if(isset($request->status)){
            $messge = 'Quote reverted from archive successfully';
            return redirect()->route('quotes.archive')->with('success_message', $messge);
        }else{
            $messge = 'Quote add in archive successfully';
            return redirect()->route('quotes.index')->with('success_message', $messge);
        }

        return redirect()->back();
    }

    /* archive listing */
    public function getArchive(Request $request)
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
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();

        return view('quotes.listing', $data);
    }

    /* quote clone */
    public function clone($id)
    {
        $quote      = Quote::findORFail(decrypt($id));
        $getQuote   = $this->quoteArray($quote,'clone');
        $clone      = Quote::create($getQuote);
        foreach ($quote->getQuoteDetails as $qu_details) {
            $quoteDetail = $this->getQuoteDetailsArray($qu_details, $clone->id);
            $quoteDetail['quote_id'] = $clone->id;
            if(isset($qu_details['image']) && !empty($qu_details['image'])){
                $quoteDetail['image'] = $qu_details['image'];
            }
            QuoteDetail::create($quoteDetail);
        }

        if($quote->getPaxDetail && $quote->pax_no >= 1){
            foreach ($quote->getPaxDetail as $pax) {
                QuotePaxDetail::create([
                    'quote_id'              => $clone->id,
                    'full_name'             => $pax['full_name'],
                    'email'                 => $pax['email'],
                    'contact'               => $pax['contact'],
                    'date_of_birth'         => $pax['date_of_birth'],
                    'bedding_preference'    => $pax['bedding_preference'],
                    'dinning_preference'    => $pax['dinning_preference'],
                    'nationality_id'        => $pax['nationality_id'],
                    'covid_vaccinated'      => ((int) $pax['covid_vaccinated'] == '1')? '1' : '0'
                ]);
            }
        }

       return redirect()->back()->with('success_message', 'Quote clone successfully');
    }


   // public function iteration($date)
    // {
    //     $iterations = QuoteDetail::distinct()->where('quote_id',1)->pluck('iteration')->toArray();
    //     foreach($iterations as $ik => $i) {

    //         $d =  QuoteDetail::where('date_of_service', $date)->where('iteration',$i)->orderBy('category_id','ASC')->get()->toArray();
    //         $f = $this->iterationWithText($d);
    //         $iteration[] = $f;
    //     }
    //     return $iteration;
    // }

    // public function iterationWithText($iterationObject){

    //     $arr = [];

    //     $transfer_date_of_service = isset($iterationObject[0]['date_of_service']) ? $iterationObject[0]['date_of_service'] : '';
    //     $transfer_time_of_service = isset($iterationObject[0]['time_of_service']) ? $iterationObject[0]['time_of_service'] : '';

    //     $accommodation_date_of_service = isset($iterationObject[1]['date_of_service']) ? $iterationObject[1]['date_of_service'] : '';
    //     $accommodation_time_of_service = isset($iterationObject[1]['time_of_service']) ? $iterationObject[1]['time_of_service'] : '' ;

    //     $transfer_product_name      = $this->getProductName(isset($iterationObject[0]['product_id']) ? $iterationObject[0]['product_id'] : '');
    //     $accommodation_product_name = $this->getProductName(isset($iterationObject[1]['product_id']) ? $iterationObject[1]['product_id'] : '');

    //     $arr[0] = "Transfer to $accommodation_product_name via $transfer_product_name on $transfer_date_of_service $transfer_time_of_service";
    //     $arr[1] = "$accommodation_product_name";
    //     $arr[2] = "Check in: $accommodation_date_of_service $accommodation_time_of_service";
    //     $arr[3] = "27 Days";

    //     return $arr;
    // }

    // public function getProductName($id){
    //    $product = Product::find($id);
    //    return isset($product->name) ? $product->name : '';
    // }

     public function getGroups($currency_id){
        try {
            $data['groups'] = Group::where('currency_id', $currency_id)->orderBy('created_at','DESC')->get();
            return ['status' => true, 'groups' => $data['groups']];
        } catch (\Exception $e) {
            return ['status' => false, 'error' => $e->getMessage()];
        }
     }
}
