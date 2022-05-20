<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\HotelRequest;
use App\Http\Requests\AirportCodeRequest;
use App\Http\Requests\HarboursRequest;
use App\Http\Requests\GroupOwnerRequest;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\CabinTypeRequest;
use App\Http\Requests\StationRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Helper;

use App\Brand;
use App\BookingType;
use App\BookingMethod;
use App\BookingDetail;
use App\Category;
use App\Currency;
use App\Country;
use App\HolidayType;
use App\Product;
use App\Quote;
use App\ReferenceCredential;
use App\Season;
use App\Supplier;
use App\Template;
use App\User;
use App\StoreText;
use App\Commission;
use App\CommissionGroup;
use App\CommissionCriteria;
use App\SupplierRateSheet;
use App\SupplierProduct;
use App\Town;
use App\Location;
use App\QuoteDetail;
use App\Harbour;
use App\AirportCode;
use App\Hotel;
use App\GroupOwner;
use App\SupplierCountry;
use App\SupplierLocation;
use App\SupplierCategory;

use App\CabinType;
use App\Station;
use App\TourContact;
use App\CurrencyConversion;

class ResponseController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Store Methods
    |--------------------------------------------------------------------------
    */

    public function storeCategoryDetailsFeilds($model_name, $category_id, $detail_id, $table_name, $object){
        
        $category_details = '';
        $category         = '';
        $model_name       = 'App\\'.$model_name;

        $booking_detail = $model_name::where('category_id', $category_id)->where('id', $detail_id)->first('category_details');
        $category       = Category::where('id', $category_id)->first();

        if(!is_null($booking_detail)){

            $final_json_quotes = array();
            $feilds = json_decode($booking_detail->category_details);

            foreach($feilds as $key => $feild){

                $final_json_quotes[$key] = $feild;

                if(in_array($feild->type, ['autocomplete'])){
                    if($feild->data == $table_name){

                        $new_object = (object) [
                            'label'    => $object->name,
                            'value'    => $object->name,
                            'selected' => false
                        ];

                        array_push($feild->values, $new_object);
                    }
                }

            }

            $category_details = json_encode($final_json_quotes);
        }
        else if(is_null($booking_detail) && !is_null($category->feilds)){

            $final_json_quotes = array();
            $feilds            = json_decode($category->feilds);

            foreach($feilds as $key => $feild){

                $final_json_quotes[$key] = $feild;

                if(in_array($feild->type, ['autocomplete'])){
                    if($feild->data != "none"){
                        $feild->values = Helper::get_autocomplete_type_records($feild->data); 
                    }
                }
            }

            $category_details = json_encode($final_json_quotes);
            
        }else{

            $category_details = "";
        }

        return $category_details;
    }

    public function storeHarbour(HarboursRequest $request)
    {
        $harbour = Harbour::create([
            'port_id' =>  $request->port_id,
            'name'    =>  $request->name
        ]);

        $category_details = $this->storeCategoryDetailsFeilds($request->model_name, $request->category_id, $request->detail_id, "harbours", $harbour);

        return response()->json([
            'status'           => true, 
            'category_details' => $category_details,
            'success_message'  => 'Harbours, Train and POI Created Successfully.',
        ]);
    }

    public function storeAirportCode(AirportCodeRequest $request)
    {
        $airport_code = AirportCode::create([
            'name'      => $request->name,
            'iata_code' => $request->iata_code
        ]);

        $category_details = $this->storeCategoryDetailsFeilds($request->model_name, $request->category_id, $request->detail_id, "airport_codes", $airport_code);

        return response()->json([
            'status'           => true, 
            'category_details' => $category_details,
            'success_message'  => 'Airport Created Successfully.',
        ]);
    }

    public function storeHotel(HotelRequest $request)
    {
        $hotel = Hotel::create([
            'name'       =>  $request->name,
            'accom_code' =>  $request->accom_code
        ]);

        $category_details = $this->storeCategoryDetailsFeilds($request->model_name, $request->category_id, $request->detail_id, "hotels", $hotel);

        return response()->json([
            'status'           => true, 
            'category_details' => $category_details,
            'success_message'  => 'Hotel Created Successfully.',
        ]);
    }

    public function storeGroupOwner(GroupOwnerRequest $request)
    {
        GroupOwner::create([
            'name'       => $request->name,
        ]);

        $group_owners = GroupOwner::orderBy('id', 'ASC')->get();

        return response()->json([
            'status'           => true, 
            'group_owners'     => $group_owners,
            'success_message'  => 'Group Owner Created Successfully.',
        ]);
    }

    public function storeSupplier(SupplierRequest $request)
    {
        try {

            $supplier = Supplier::create([
                'name'            => $request->username, 
                'email'           => $request->email, 
            ]);

            if($request->has('categories') && count($request->categories) > 0){
                foreach ($request->categories as $category) {
                    SupplierCategory::create([
                        'supplier_id' => $supplier->id,
                        'category_id' => $category
                    ]);
                }
            }
            
            $supplier->getCountries()->sync($request->country_id);
            $supplier->getLocations()->sync($request->location_id);
            $supplier_country_id = explode(",", $request->supplier_country_id);

            if(!empty($request->country_id)){

                $suppliers = Supplier::whereHas('getCountries', function($query) use ($supplier_country_id) {
                    $query->whereIn('id', $supplier_country_id);
                })->get();


                return response()->json([ 
                    'status' => true, 
                    'success_message' => 'Supplier Added Successfully.', 
                    'suppliers' => $suppliers
                ]);
            }

        } catch (\Exception $e) {

            return response()->json([ 
                'status' => false, 
                'success_message' => 'Something went Wrong, Please try again later!',
            ]);
        }
    }

    public function storeCabinType(CabinTypeRequest $request)
    {
        $cabin_type = CabinType::create([
            'name'       => $request->name,
        ]);

        $category_details = $this->storeCategoryDetailsFeilds($request->model_name, $request->category_id, $request->detail_id, "cabin_types", $cabin_type);

        return response()->json([
            'status'           => true, 
            'category_details' => $category_details,
            'success_message'  => 'Cabin Type Created Successfully.',
        ]);
    }

    // StationRequest
    public function storeStation(StationRequest $request)
    {
        $station = Station::create([
            'name'  =>  $request->name
        ]);

        $category_details = $this->storeCategoryDetailsFeilds($request->model_name, $request->category_id, $request->detail_id, "stations", $station);

        return response()->json([
            'status'           => true, 
            'category_details' => $category_details,
            'success_message'  => 'Station Created Successfully.',
        ]);
    }

    public function storeProductWithSupplier(ProductRequest $request)
    {    
        try {

            $product = Product::create([
                'code'        => $request->code,
                'name'        => $request->name,
                'description' => $request->description,
            ]);
    
            $supplier = Supplier::find($request->product_supplier_id);
            
            SupplierProduct::create([
                'supplier_id' => $supplier->id,
                'product_id'  => $product->id
            ]);
    
            $supplierProducts = $supplier->getProducts;

            return response()->json([
                'status'          => true,
                'success_message' => 'Product Added Successfully.',
                'products'        => $supplierProducts
            ], 200);

          
        } catch (\Exception $e) {

            return response()->json([
                'status'          => false,
                'product_error'   => 'Something went wrong in Product Creation Please try again!',
                'products'        => $supplierProducts
            ], 422);

        }
    }

    public function getPassenger($response)
    {   
        return [
            'bedding_prefrences' => $response['BEDDING_PREFERENCE'],
            'dinning_prefrences' => $response['DIETARY_PREFERENCES'],
            'passenger_email'    => $response['Passenger_Email'],
            'passenger_name'     => $response['Name'],
            'passenger_dbo'      => $response['Passenger_DOB'],
            'passenger_contact'  => $response['Passenger_Phone'],

        ];
    }

    public function getLeadPassengerData($response, $zoho_credentials)
    {   
        $contact_id = $response['Contact_Name']['id'];
        $url = "https://www.zohoapis.com/crm/v2/Contacts/{$contact_id}";
        $args = array(
            'method' 	=> 'GET',
            'ssl' 		=> false,
            'format' 	=> 'ARRAY',
            'headers' 	=> array(
                "Authorization:" . 'Zoho-oauthtoken ' . $zoho_credentials->access_token,
                "Content-Type: application/json",
            )
        );

        $contact_response = Helper::cf_remote_request($url, $args);

        if ($contact_response['status'] == 200) {

            $contact_response = array_shift($contact_response['body']['data']);

            return [
                'name'   => $contact_response['Full_Name'],
                'email'  => $contact_response['Email'],
                'phone'  => $contact_response['Phone'],
            ];

        }
    }

    // Find Reference from Zoho Crm 
    public function findReference(Request $request)
    {
        $zoho_credentials = ReferenceCredential::where('type', 'zoho')->first();
        
        if(is_null($zoho_credentials)){ 
            return response()->json([
                'status' => 'false',
                'errors'  => 'Something went wrong with reference number Please try again!',
            ], 400);           
        }

        $ajax_response = [];
        $ref = $request->ref_no;
        // $refresh_token = '1000.18cb2e5fbe397a6422d8fcece9b67a06.d71539ff6e5fa8364879574343ab799a';
        $url = "https://www.zohoapis.com/crm/v2/Deals/search?criteria=(Booking_Reference:equals:{$ref})";
        $args = array(
            'method' => 'GET',
            'ssl' => false,
            'format' => 'ARRAY',
            'headers' => array(
                "Authorization:" . 'Zoho-oauthtoken ' . $zoho_credentials->access_token,
                "Content-Type: application/json",
            ),
        );

        $response = Helper::cf_remote_request($url, $args);

        if ($response['status'] == 200) {
            
            $responses_data = array_shift($response['body']['data']);
            // $passenger_id   = $responses_data['id'];
            // $url            = "https://www.zohoapis.com/crm/v2/Passengers/search?criteria=(Deal:equals:{$passenger_id})";

            // $passenger_response = Helper::cf_remote_request($url, $args);

            // if ($passenger_response['status'] == 200) {
            //     $pax_no = count($passenger_response['body']['data']);
            // }

            $holidayName  = isset($responses_data['Holiday_Type']) && !empty($responses_data['Holiday_Type']) ? $responses_data['Holiday_Type'] : null;
            $holiday      = HolidayType::where('name', $holidayName)->first();
            $holidayTypes = NULL;
            if($holiday){
                $holidayTypes = HolidayType::where('brand_id', $holiday->brand_id)->get();
            }
            
            // $passenger_data = [];
            // $passengerArray = [];

            // if(isset($passenger_response['body']['data']) && count($passenger_response['body']['data']) > 0 ){
            //     foreach ($passenger_response['body']['data'] as $key => $passenger) {

            //         if($key == 0){    
            //             $passengerArray['lead_passenger'] = $this->getPassenger($passenger);

            //         }else{            

            //             $x = $this->getPassenger($passenger);
            //             array_push($passenger_data, $x);
            //         }
            //     }
            // }

            // $passengerArray['passengers'] = $passenger_data;

            $response = [
                "brand"         => $holiday,
                "holidayTypes"  => $holidayTypes,
                "sale_person"   => isset($responses_data['Owner']['email']) && !empty($responses_data['Owner']['email']) ? $responses_data['Owner']['email'] : null,
                "currency"      => isset($responses_data['Currency']) && !empty($responses_data['Currency']) ? $responses_data['Currency'] : null,
                // "pax"           => isset($pax_no) && !empty($pax_no) ? $pax_no : null,
                // 'passengers'    => $passengerArray,

                'lead_passenger' => $this->getLeadPassengerData($responses_data, $zoho_credentials),
                'tas_ref'       => (isset($responses_data['TAS_REF_No']) && !empty($responses_data['TAS_REF_No']))? $responses_data['TAS_REF_No'] : NULL,
            ];

            // $payment_detial_response = Helper::get_payment_detial_by_ref_no($ref);
            // if ($payment_detial_response['status'] == 200) {
            //     $response['payment_details'] = $payment_detial_response['body']['old_records'];
            // }

            $ajax_response['status']    = true;
            $ajax_response['response']  = $response;
            
            return response()->json($ajax_response);
        }

            return response()->json([
                'status' => 'false',
                'errors'  => 'Something went wrong with reference number Please try again!',
            ], 402);    
            
        // return response()->json($ajax_response);
    }


    /*
    |--------------------------------------------------------------------------
    | On Change Methods
    |--------------------------------------------------------------------------
    */

    public function SupplierOnChange(Request $request)
    {
        $supplier = Supplier::find($request->supplier_id);

        $supplier_products = $supplier->getProducts;

        return response()->json([
            'supplier'          => $supplier,
            'supplier_products' => $supplier_products,
        ]);
    }

    public function brandOnChange(Request $request)
    {    
        $holiday_types = HolidayType::where('brand_id', $request->brand_id)->get();

        // $brand_supplier_countries = Brand::find($request->brand_id)->getSupplierCountries()->pluck('country_id')->toArray();
        // 'brand_supplier_countries' => $brand_supplier_countries,

        return response()->json([
            'holiday_types'     => $holiday_types,
        ]);

        return response()->json($holiday_types);
    }

    public function multipleBrandOnChange(Request $request)
    {    
        $holiday_types = HolidayType::whereIn('brand_id',$request->brand_ids)
        ->leftJoin('brands', 'holiday_types.brand_id', '=', 'brands.id')
        ->select([
            'holiday_types.id',
            'brands.name as brand_name',
            'holiday_types.name',
        ])->get();

        return response()->json($holiday_types);
    }

    public function countryOnChange(Request $request)
    {  
        $locations = Location::whereIn('country_id', $request->supplier_country_ids)
        ->leftJoin('countries', 'locations.country_id', '=', 'countries.id')
        ->get([
            'locations.id',
            'countries.name as country_name',
            'locations.name',
        ]);

        return response()->json($locations);
    }

    public function groupOwnerOnChange(Request $request)
    {
        $query = Supplier::orderBy('id', 'ASC');

        $query->whereHas('getCountries', function($query) use ($request) {
          $query->whereIn('id', $request->supplier_country_ids);
        });

        $query->whereHas('getCategories', function($query) use ($request) {
          $query->where('id', $request->category_id);
        });

        $query->where('group_owner_id', $request->group_owner_id);
        
        $suppliers = $query->get();

        return response()->json([
            'suppliers'          => $suppliers,
        ]);
    }

    public function categoryOnChange(Request $request)
    {
        $category_details = '';
        $category         = '';
        $supplier         = '';
        $model_name       = 'App\\'.$request->model_name;
 
        // $supplier = Supplier::whereHas('getCategories', function($query) use($request) {
        //     $query->where('id', $request->category_id);
        // })->get();


        // dd($request->supplier_country_ids);

        if(!is_null($request->supplier_country_ids) && !is_null($request->supplier_country_ids)){

            $supplier = Supplier::whereHas('getCountries', function($query) use ($request) {
                $query->whereIn('id', $request->supplier_country_ids);
            })
            ->whereHas('getCategories', function($query) use ($request) {
                $query->where('id', $request->category_id);
            })
            ->whereNull('group_owner_id')
            ->get();
        }

        $booking_detail = $model_name::where('category_id', $request->category_id)->where('id', $request->detail_id)->first('category_details');
        $category       = Category::where('id', $request->category_id)->first();

        if(!is_null($booking_detail)){
            $category_details = $booking_detail->category_details;
        }
        else if(is_null($booking_detail) && !is_null($category->feilds)){

            $final_json_quotes = array();
            $feilds            = json_decode($category->feilds);

            foreach($feilds as $key => $feild){

                $final_json_quotes[$key] = $feild;

                if($feild->type == "autocomplete"){
                    if($feild->data != "none"){
                        $feild->values = Helper::get_autocomplete_type_records($feild->data); 
                    }
                }
            }

            $category_details = json_encode($final_json_quotes);
            
        }else{

            $category_details = "";
        }

        /* Returning category related products*/ 
        $products = Category::find($request->category_id)->getProducts;

        // $array = [];
        // $array['airport_codes'] = DB::table('airport_codes')->get();
        // $array['harbours'] = DB::table('harbours')->get();
        // $array['hotels'] = DB::table('hotels')->get();
        // $array['all'] = DB::table('hotels')
        //     ->select('name')
        //     ->union(DB::table('airport_codes')->select('name'))
        //     ->union(DB::table('harbours')->select('name'))
        //     ->get();
        // return $array;

        return response()->json([
            'suppliers'        => $supplier,
            'category_details' => $category_details,
            'category'         => $category,
            'products'         => $products,
        ]);
    }

    public function supplierCountriesOnChange(Request $request)
    {
        $suppliers = Supplier::whereHas('getCountries', function($query) use($request) {
            $query->whereIn('id', $request->supplier_country_ids);
        })
        ->whereHas('getCategories', function($query) use($request) {
            $query->where('id', $request->category_id);
        })
        ->get();

        return response()->json([ 'suppliers' => $suppliers ]);
    }

    public function productOnChange(Request $request)
    {

        $product_details = '';
        $model_name       = 'App\\'.$request->model_name;

        $product = Product::find($request->product_id);

        $booking_detail = $model_name::where('product_id', $request->product_id)->where('id', $request->detail_id)->first('product_details');

        if(!is_null($booking_detail)){

            $product_details = $booking_detail->product_details;

        } else if(is_null($booking_detail) && !is_null($product->feilds)){

            $product_details = $product->feilds;
            
        }else{

            $product_details = "";
        }

        return response()->json([
            'product'         => $product,
            'product_details' => $product_details,
        ]);
    }

    public function salesPersonOnChange(Request $request){

        $supervisor  = User::find($request->sales_person_id)->getSupervisor;
        $sale_person_currency  = User::find($request->sales_person_id)->getCurrency;

        return response()->json([
            'supervisor'    => $supervisor,
            'sale_person_currency' => $sale_person_currency,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Methods
    |--------------------------------------------------------------------------
    */

    public function getCurrencyConversions(){
        return DB::table('currency_conversions')->get();
    }

    public function getCommissionCriterias(){

        return CommissionCriteria::
        leftJoin('commission_criteria_seasons', 'commission_criterias.id', '=', 'commission_criteria_seasons.commission_criteria_id')
        ->leftJoin('commission_criteria_groups', 'commission_criterias.id', '=', 'commission_criteria_groups.commission_criteria_id')
        ->leftJoin('commission_criteria_brands', 'commission_criterias.id', '=', 'commission_criteria_brands.commission_criteria_id')
        ->leftJoin('commission_criteria_holiday_types', 'commission_criterias.id', '=', 'commission_criteria_holiday_types.commission_criteria_id')
        ->leftJoin('commission_criteria_currencies', 'commission_criterias.id', '=', 'commission_criteria_currencies.commission_criteria_id')
        ->orderBy('commission_criterias.id','ASC')
        ->get([
            'commission_criterias.id',
            'commission_criterias.name',
            'commission_criterias.percentage',
            'commission_criteria_brands.brand_id',
            'commission_criteria_holiday_types.holiday_type_id',
            'commission_criteria_currencies.currency_id',
            'commission_criteria_seasons.season_id'
        ]);

        // 'commission_criterias.commission_id',
        // 'commission_criteria_groups.commission_group_id',
    }

    public function getCommissions(){
        return DB::table('commissions')->get();
    }

    public function getCommissionGroups(){
        return DB::table('commission_groups')->get();
    }

    public function getFilterCurrencyRates(Request $request){
        $query = DB::table('currency_conversions');

        if(!is_null($request->selected_currencies)){
            $query->whereIn('from', $request->selected_currencies);
        }

        $data['currency_conversions'] = $query->get();

        return view('quote_booking_includes.currency_conversion_filter_modal', $data);
    }

    public function storeHolidayTypes(Request $request)
    {
        $holiday_types = collect($request->holiday_types)
        ->filter(function ($item) {
            if(!is_null($item['brand_id'])){
                return $item;
            }
        })
        ->toArray();

        if(empty($holiday_types)){
            return response()->json([ 

                'error_message' => 'Please Select Atleast one Brand.',
            ], 422);
        }

        foreach($holiday_types as $key => $holiday_type){

            HolidayType::create([
                'name'     => $holiday_type['name'],
                'brand_id' => $holiday_type['brand_id'],
            ]);
        }

        return response()->json([ 
            'status' => true,
            'success_message' => 'Holiday Type Added Successfully.',
        ]);
    }

    public function getHolidayTypes(){

        $zoho_credentials = ReferenceCredential::where('type', 'zoho')->first();

        $url = "https://www.zohoapis.com/crm/v2/settings/fields/2740962000000177001?module=Deals";
        $args = array(
            'method' => 'GET',
            'ssl' => false,
            'format' => 'ARRAY',
            'headers' => array(
                "Authorization:" . 'Zoho-oauthtoken ' . $zoho_credentials->access_token,
                "Content-Type: application/json",
            ),
        );

        $response = Helper::cf_remote_request($url, $args);

        if ($response && $response['status'] == 200) {

            $holiday_types_array = $response['body']['fields'][0]['pick_list_values'];
    
            $holiday_types = collect($holiday_types_array)
            ->map(function ($item, $key) {
                return $item['display_value'];
            })
            ->filter(function ($item) {
    
                if(!in_array($item,['-None-','Unassigned'])){
                    return $item;
                }
            })
            ->values()
            ->toArray();
    
            $data['existing_holiday_types'] = HolidayType::pluck('name')->toArray();
            $data['brands'] = Brand::get();
    
            $data['new_holiday_types'] = array_diff($holiday_types, $data['existing_holiday_types']);
    
    
            if (empty($data['new_holiday_types'])) {
                return response()->json([
                    'status' => false,
                    'icon'   => 'info',
                    'success_message' => 'Holiday Type already Upto date.',
                ]);
            }
    
            return response()->json([
                'status' => true,
                'icon' => 'info',
                'html'   => view('holiday_types.includes.view_holiday_types', $data)->render()
            ]);
        }

        return response()->json([
            'status' => false,
            'icon'   => 'error',
            'success_message' => 'Something Went Wrong, Please Try Again.',
        ]);

    }

    public function getTourContacts()
    {
        $tour_contacts = TourContact::pluck('name')->toArray();

        return response()->json($tour_contacts);
    }

    public function isReferenceExists($ref_no)
    {
        $response['response'] = Quote::where('ref_no', $ref_no)->exists();
        return response()->json($response);
    }

    public function getChildReference(Request $request)
    {
        $data['quotes'] = Quote::withTrashed()->where('ref_no', $request->ref_no)->where('id', '!=' ,$request->id)->orderBy('created_at')->get();

        return response()->json(View::make('quotes.includes.child_quote_listing', $data)->render());
    }

    public function callTemplate($id)
    {
        $template = Template::find(decrypt($id));
        
        $data['template']         = $template;
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['supervisors']      = User::where('role_id', 5)->get()->sortBy('name');
        $data['suppliers']        = Supplier::all()->sortBy('name');
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
        $data['users']            = User::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['booking_types']    = BookingType::all();
        $data['storetexts']       = StoreText::get();
        
        $return['template']       = $template;
        $return['template_view']  = View::make('templates.includes.quote_detail_template', $data)->render();
   
        return response()->json($return);
    }

    public function getStoredText($slug)
    {
        $store = StoreText::where('slug', $slug)->firstOrFail()->description;
        return response()->json($store);
    }

    /* used in transfer report*/ 
    public function categoryDetailsFilter(Request $request) {

        // dd($request->all());

        $type          = $request->type;
        $label         = $request->label;
        $data          = $request->data;
        $dataTypes     = ['airport_codes', 'harbours', 'hotels', 'all'];
        $label_results = '';

        if($type == 'autocomplete' && in_array($data, $dataTypes)){

            $label_results = $this->get_autocomplete_data($data);

        }else{

            $label_results = BookingCategoryDetail::where('label', $request->label )->get(['value' , 'id']);
        }

        return response()->json([ 'label_results' => $label_results ]);
    }

    public function removeFormBuidlerFeild(Request $request)
    {

        $id           = decrypt($request->id);
        $element_name = $request->element_name;
        $json_quotes  = QuoteDetail::where('category_id', $id)->whereNotNull('category_details')->get(['category_details','id']);

        foreach($json_quotes as $Qkey => $json_quote){

            $category_details = json_decode($json_quote->category_details);

            foreach($category_details as $key => $category_detail){
 
                if(($category_detail->name == $element_name) && isset($category_detail->userData)){
                    return response()->json([ "status" => true, "success_message" => "You Can Not Remove this feild." ]);
                }
            }
           
        }
    }










    // public function getCountryToTown(Request $request)
    // {    
    //     $towns = Town::where('country_id',$request->country_id)->get();

    //     return response()->json($towns);
    // }
 
    // public function getCommissionGroups(Request $request)
    // {    
    //     $commission_groups = CommissionGroup::where('commission_id',$request->commission_id)->get();
    //     return response()->json($commission_groups);
    // }

    // public function getSupplierProductAndSheet(Request $request)
    // {
    //     // dd($request->all());

    //     $response['url'] = '';
    //     $response['products'] = '';

     
    //     $supplier = SupplierRateSheet::where([ "supplier_id" => $request->supplier_id, "season_id" => $request->season_id])->first();
    //     if(!is_null($supplier)){
    //         $response['url'] = url(Storage::url($supplier->file));
    //     }

    //     $response['products'] = Supplier::whereHas('getCategories', function($query) use($request) {
    //         $query->where('id', $request->category_id);
    //     })
    //     ->whereHas('getLocations', function($query) use($request) {
    //         $query->where('id', $request->supplier_location_id);
    //     })
    //     ->find($request->supplier_id)->getProducts;

    //     $response['supplier_currency'] = isset($request->supplier_id) && !empty($request->supplier_id) ? Supplier::find($request->supplier_id)->currency_id : '';

    //     return $response;
    // }

    // public function getLocationToSupplier(Request $request)
    // {
    //     // $suppliers = Supplier::where('location_id', $request->suppplier_location_id)->where()->get();

    //     $suppliers = Supplier::whereHas('getCategories', function($query) use($request) {
    //         $query->where('id', $request->category_id);
    //     })
    //     ->whereHas('getLocations', function($query) use($request) {
    //         $query->where('id', $request->suppplier_location_id);
    //     })
    //     ->get();

    //     return response()->json([ 'suppliers' => $suppliers ]);
    // }

    // public function getLocationToProduct(Request $request)
    // {
    //     $products = Product::whereHas('getSuppliers', function($query) use($request) {
    //         $query->where('id', $request->supplier_id);
    //     })
    //     ->where('location_id', $request->product_location_id)
    //     ->get();

    //     // $products = Supplier::find($request->supplier_id)->getProducts()
    //     // ->where('location_id', $request->product_location_id)
    //     // ->get();

    //     return response()->json([ 'products' => $products ]);
    // }
    
    // public function getSupplierToProductORCurrency(Request $request)
    // {
    //     $supplier = Supplier::find($request->id);
    //     $response['product'] = $supplier->getProducts;
    //     $response['currency'] = $supplier->getCurrency->id;
    //     return response()->json($response);
    // }
    
    // FIND QUOTE REFERENCES\
    // public function getPaxPartial($count)
    // {
    //     $data['countries'] = Country::orderBy('sort_order', 'ASC')->get();
    //     $data['count']     = $count;
    //     $re['response']    = View::make('partials.paxdetail', $data)->render();
    //     return response()->json($re);
    // }
    
    // public function bulkAction(Request $request)
    // {
    //     $ids               = explode(",", $request->id);
    //     $table_name        = $request->table;
    //     $respons['status'] = FALSE;
    //     $isArchive         = ($request->btn == 'unarchive')? 0 : 1;

    //     if($request->btn == 'archive' || $request->btn == 'unarchive'){
            
    //         DB::table($table_name)->whereIn('id', $ids)->update(['is_archive' => $isArchive]);
    //         $respons['message'] = ($isArchive == 1)? "Quotes Archived Successfully" : 'Quotes Unarchived Successfully';

    //     }elseif ($request->btn  == 'cancel'){

    //         DB::table($table_name)->whereIn('id', $ids)->update(['booking_status' => 'cancelled']);
    //         $respons['message'] = 'Quotes Cancelled Successfully !!';
    //     }
    //     elseif ($request->btn  == 'quote'){

    //         DB::table($table_name)->whereIn('id', $ids)->update(['booking_status' => 'quote']);
    //         $respons['message'] = 'Revert Cancelled Quotes Successfully !!';
    //     }

    //     $respons['status']  = true;

    //     return response()->json($respons);
    // }
    
    // public function updateCurrencyStatus(Request $request)
    // {
    //     $ids = explode(',', $request->id);
    //     $status  = ($request->btn == 'active')? '1' : '0'; 
    //     Currency::whereIn('id', $ids)->update(['status' => $status]);
    //     $respons['message'] = 'Records Status Updated Successfully !!';
    //     $respons['status']  = true;
    //     return response()->json($respons);
    // }

    // SupplierRequest



    // $this->validate(
    //     $request, 
    //     [
    //         'code' => 'required',
    //         'name' => 'required'
    //     ],
    //     [
    //         'code.required' => 'The Product Code field is required.',
    //         'name.required' => 'The Product Name field is required.'
    //     ]
    // );

    // public function getSupplierRateSheet(Request $request)
    // {
    //     $url = '';

    //     $supplier = SupplierRateSheet::where([ "supplier_id" => $request->supplier_id, "season_id" => $request->season_id])->first();
    //     if(!is_null($supplier)){
    //         $url = url(Storage::url($supplier->file));
    //     }

    //     return $url;
    // }

    // $response['products'] = Product::whereHas('getSuppliers', function($query) use($request) {
    //     $query->where([ 
    //         'id'          => $request->supplier_id,
            
    //     ]);
    // })
    // ->get();

    // $response['products']          = isset($request->supplier_id) && !empty($request->supplier_id) ? Supplier::find($request->supplier_id)->getProducts : '';


    // $this->validate(
    //     request(), 
    //     [
    //         'port_id'  => 'required',        
    //         'name'     => 'required',
    //     ],
    //     [
    //         'port_id.required' => 'The Port ID field is required.',
    //         'name.required'    => 'The Harbours, Train and Points of Interest Name field is required.',
    //     ]
    // );


    // $this->validate(
    //     request(), 
    //     [
    //         'name'       => 'required',
    //         'iata_code'  => 'required'   
    //     ],
    //     [
    //         'name.required' => 'The Airport Name field is required.',
    //         'iata_code.required' => 'The IATA Code field is required.'
    //     ]
    // );

    // $airport_code = AirportCode::create([
    //     'name'      => $request->name,
    //     'iata_code' => $request->iata_code
    // ]);
}
