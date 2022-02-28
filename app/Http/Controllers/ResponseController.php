<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
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

class ResponseController extends Controller
{
    public function removeFormBuidlerFeild(Request $request)
    {
        // dd($request->all());

        $id           = decrypt($request->id);
        $element_name = $request->element_name;
        // dd($element_name);

        $json_quotes = QuoteDetail::where('category_id', $id)->whereNotNull('category_details')->get(['category_details','id']);


        foreach($json_quotes as $Qkey => $json_quote){

            $category_details = json_decode($json_quote->category_details);

            foreach($category_details as $key => $category_detail){
 

                if(($category_detail->name == $element_name) && isset($category_detail->userData)){

                    // return "a";

                    return response()->json([ "status" => true, "success_message" => "You Can Not Remove this feild." ]);
                }
                // dd(isset($category_detail->userData));
            }
           
        }
        return response()->json([ 'status' => false, 'success_message' => 'Product Added Successfully.' ]);
    }

    public function get_commissions(){
        $commissions = Commission::all();
        return $commissions;
    }

    public function get_commission_groups(){
        $commission_groups = CommissionGroup::all();
        return $commission_groups;
    }

    public function get_commission_criterias(){
        $commission_criterias = CommissionCriteria::
        leftJoin('commission_criteria_seasons', 'commission_criterias.id', '=', 'commission_criteria_seasons.commission_criteria_id')
        ->leftJoin('commission_criteria_groups', 'commission_criterias.id', '=', 'commission_criteria_groups.commission_criteria_id')
        ->leftJoin('commission_criteria_brands', 'commission_criterias.id', '=', 'commission_criteria_brands.commission_criteria_id')
        ->leftJoin('commission_criteria_holiday_types', 'commission_criterias.id', '=', 'commission_criteria_holiday_types.commission_criteria_id')
        ->leftJoin('commission_criteria_currencies', 'commission_criterias.id', '=', 'commission_criteria_currencies.commission_criteria_id')
        ->orderBy('commission_criterias.id','ASC')
        ->get([
            'commission_criterias.commission_id',
            'commission_criterias.percentage',
            'commission_criteria_groups.commission_group_id',
            'commission_criteria_brands.brand_id',
            'commission_criteria_holiday_types.holiday_type_id',
            'commission_criteria_currencies.currency_id',
            'commission_criteria_seasons.season_id'
        ]);

        return $commission_criterias;
    }


    public function getBrandToHoliday(Request $request)
    {    
        $holiday_types = HolidayType::where('brand_id',$request->brand_id)->get();
        return response()->json($holiday_types);
    }

    public function getMultipleBrandToHoliday(Request $request)
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

    public function getCountryToTown(Request $request)
    {    
        $towns = Town::where('country_id',$request->country_id)->get();

        return response()->json($towns);
    }

    public function getCountryToLocation(Request $request)
    {  
        $locations = Location::whereIn('country_id',$request->supplier_country_ids)
        ->leftJoin('countries', 'locations.country_id', '=', 'countries.id')
        ->get([
            'locations.id',
            'countries.name as country_name',
            'locations.name',
        ]);

        return response()->json($locations);
    }
 
 
    // public function getCommissionGroups(Request $request)
    // {    
    //     $commission_groups = CommissionGroup::where('commission_id',$request->commission_id)->get();
    //     return response()->json($commission_groups);
    // }

    
    public function addProductWithSupplierSync(ProductRequest $request)
    {    
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

            return \Response::json(['status' => true, 'success_message' => 'Product Added Successfully.' , 'products' => $supplierProducts], 200); // Status code here
          
        } catch (\Exception $e) {

            return \Response::json(['status' => false, 'product_error' => 'Something went wrong in Product Creation Please try again!' ], 422); // Status code here
        
        }
 
    }
    
    public function getSupplierProductAndSheet(Request $request)
    {
        // dd($request->all());

        $response['url'] = '';
        $response['products'] = '';

     
        $supplier = SupplierRateSheet::where([ "supplier_id" => $request->supplier_id, "season_id" => $request->season_id])->first();
        if(!is_null($supplier)){
            $response['url'] = url(Storage::url($supplier->file));
        }

        $response['products'] = Supplier::whereHas('getCategories', function($query) use($request) {
            $query->where('id', $request->category_id);
        })
        ->whereHas('getLocations', function($query) use($request) {
            $query->where('id', $request->supplier_location_id);
        })
        ->find($request->supplier_id)->getProducts;

        $response['supplier_currency'] = isset($request->supplier_id) && !empty($request->supplier_id) ? Supplier::find($request->supplier_id)->currency_id : '';

        return $response;
    }

    public function getCountryToSupplier(Request $request)
    {
        $suppliers = Supplier::whereHas('getCountries', function($query) use($request) {
            $query->whereIn('id', $request->supplier_country_ids);
        })->get();

        return response()->json([ 'suppliers' => $suppliers ]);
    }

    public function getCategoryToSupplier(Request $request)
    {
        $category_details = '';
        $category         = '';
        $model_name       = 'App\\'.$request->model_name;
 
        $supplier = Supplier::whereHas('getCategories', function($query) use($request) {
            $query->where('id', $request->category_id);
        })->get();

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

    public function getProductBookingType(Request $request)
    {
        // dd($request->all());

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

    public function getLocationToSupplier(Request $request)
    {
        // $suppliers = Supplier::where('location_id', $request->suppplier_location_id)->where()->get();

        $suppliers = Supplier::whereHas('getCategories', function($query) use($request) {
            $query->where('id', $request->category_id);
        })
        ->whereHas('getLocations', function($query) use($request) {
            $query->where('id', $request->suppplier_location_id);
        })
        ->get();

        return response()->json([ 'suppliers' => $suppliers ]);
    }

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
    
    public function getSupplierToProductORCurrency(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $response['product'] = $supplier->getProducts;
        $response['currency'] = $supplier->getCurrency->id;
        return response()->json($response);
    }
    
    public function getChildReference(Request $request)
    {
        $data['quotes'] = Quote::withTrashed()->where('ref_no', $request->ref_no)->where('id', '!=' ,$request->id)->orderBy('created_at')->get();

        return response()->json(View::make('quotes.includes.child_quote_listing', $data)->render());
    }
    // FIND QUOTE REFERENCES
    public function findReference(Request $request)
    {
        $zoho_credentials = ReferenceCredential::where('type', 'zoho')->first();
        if($zoho_credentials == null){ 
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
        $response = $this->cf_remote_request($url, $args);
        if ($response['status'] == 200) {
            
            $responses_data = array_shift($response['body']['data']);
            $passenger_id = $responses_data['id'];
            $url = "https://www.zohoapis.com/crm/v2/Passengers/search?criteria=(Deal:equals:{$passenger_id})";
            $passenger_response = $this->cf_remote_request($url, $args);
            if ($passenger_response['status'] == 200) {
                $pax_no = count($passenger_response['body']['data']);
            }
            $holidayName = isset($responses_data['Holiday_Type']) && !empty($responses_data['Holiday_Type']) ? $responses_data['Holiday_Type'] : null;
            $holiday = HolidayType::where('name', $holidayName)->first();
            $holidayTypes = NULL;
            if($holiday){
                $holidayTypes = HolidayType::where('brand_id', $holiday->brand_id)->get();
            }
            
            $passenger_data = [];
            $passengerArray = [];
            if(isset($passenger_response['body']['data']) && count($passenger_response['body']['data']) > 0 ){
                foreach ($passenger_response['body']['data'] as $key => $passenger) {
                        if($key == 0){    
                        $passengerArray['lead_passenger'] = $this->getPassenger($passenger);
                    }else{                            
                        $x = $this->getPassenger($passenger);
                        array_push($passenger_data, $x);
                    }
                }
            }

            $passengerArray['passengers'] = $passenger_data;

            $response = [
                "brand"         => $holiday,
                "holidayTypes"  => $holidayTypes,
                "sale_person"   => isset($responses_data['Owner']['email']) && !empty($responses_data['Owner']['email']) ? $responses_data['Owner']['email'] : null,
                "currency"      => isset($responses_data['Currency']) && !empty($responses_data['Currency']) ? $responses_data['Currency'] : null,
                "pax"           => isset($pax_no) && !empty($pax_no) ? $pax_no : null,
                'passengers'    => $passengerArray,
                'tas_ref'       => (isset($responses_data['TAS_REF_No']) && !empty($responses_data['TAS_REF_No']))? $responses_data['TAS_REF_No'] : NULL,
            ];

            $payment_detial_response = \Helper::get_payment_detial_by_ref_no($ref);
            if ($payment_detial_response['status'] == 200) {
                $response['payment_details'] = $payment_detial_response['body']['old_records'];
            }

            $ajax_response['status']    = true;
            $ajax_response['response']  = $response;
            
            return response()->json($ajax_response);
        }

            return response()->json([
                'status' => 'false',
                'errors'  => 'Something went wrong with reference number Please try again!',
            ], 402);    
            
        return response()->json($ajax_response);
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


    public function isReferenceExists($ref_no)
    {
        $response['response'] = Quote::where('ref_no', $ref_no)->exists();
        return response()->json($response);
    }
    
    
    
    public function cf_remote_request($url, $_args = array())
    {
        // prepare array
        $array = array(
            //'status' => false,
            'message' => array(
                '101' => 'Invalid url',
                '102' => 'cURL Error #: ',
                '200' => 'cURL Successful #: ',
                '400' => '400 Bad Request',
            ),
        );

        // initalize args
        $args = array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking' => true,
            'ssl' => true,
            'headers' => array(),
            'body' => array(),
            'returntransfer' => true,
            'encoding' => '',
            'maxredirs' => 10,
            'format' => 'JSON',
        );

        if (empty($url)) {
            $code = 101;
            $response = array('status' => $code, 'body' => $array['message'][$code]);
            return $response;
        }

        if (!empty($_args) && is_array($_args)) {
            $args = array_merge($args, $_args);
        }

        $fields = $args['body'];
        if (strtolower($args['method']) == 'post' && is_array($fields)) {
            $fields = http_build_query($fields);
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => $args['returntransfer'],
            CURLOPT_ENCODING => $args['encoding'],
            CURLOPT_MAXREDIRS => $args['maxredirs'],
            CURLOPT_HTTP_VERSION => $args['httpversion'], // CURL_HTTP_VERSION_1_1,
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
            //CURLOPT_HEADER             => true,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_TIMEOUT => $args['timeout'],
            CURLOPT_CONNECTTIMEOUT => $args['timeout'],
            CURLOPT_SSL_VERIFYPEER => $args['ssl'] === true ? true : false,
            //CURLOPT_SSL_VERIFYHOST     => $args['ssl'] === true ? true : false,
            // CURLOPT_CAPATH             => APPPATH . 'certificates/ca-bundle.crt',
            CURLOPT_CUSTOMREQUEST => $args['method'],
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_HTTPHEADER => $args['headers'],
        ));

        $curl_response = curl_exec($curl);
        $err = curl_error($curl);
        $curl_info = array(
            'status' => curl_getinfo($curl, CURLINFO_HTTP_CODE),
            'header' => curl_getinfo($curl, CURLINFO_HEADER_OUT),
            'total_time' => curl_getinfo($curl, CURLINFO_TOTAL_TIME),
        );

        curl_close($curl);

        if ($err) {
            $response = array('message' => $err, 'body' => $err);
        } else {
            if ($curl_info['status'] == 200
                && in_array($args['format'], array('ARRAY', 'OBJECT'))
                && !empty($curl_response) && is_string($curl_response)) {
                $curl_response = json_decode($curl_response, $args['format'] == 'ARRAY' ? true : false);
                $curl_response = (json_last_error() == JSON_ERROR_NONE) ? $curl_response : $curl_response;
            } else {
                $curl_response = json_decode($curl_response, true);
            }

            $response = array(
                //'message'     => $array['message'][ $curl_info['status'] ],
                'body' => $curl_response,
            );
        }

        $response = array_merge($curl_info, $response);
        return $response;
    }
    // FIND QUOTE REFERENCES\
    
    
    public function call_template($id)
    {
        $template = Template::find(decrypt($id));
        
        $data['template']         = $template;
        $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
        $data['supervisors']      = User::where('role_id', 5)->get()->sortBy('name');
        $data['suppliers']        = Supplier::all()->sortBy('name');
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['users']            = User::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['booking_types']    = BookingType::all();
        $data['storetexts']       = StoreText::get();
        
        $return['template']       = $template;
        $return['template_view']  = View::make('templates.includes.quote_detail_template', $data)->render();
   
        return response()->json($return);
    }
    
    public function getPaxPartial($count)
    {
        $data['countries'] = Country::orderBy('sort_order', 'ASC')->get();
        $data['count']     = $count;
        $re['response']    = View::make('partials.paxdetail', $data)->render();
        return response()->json($re);
    }
    
    public function bulkAction(Request $request)
    {
        $ids               = explode(",", $request->id);
        $table_name        = $request->table;
        $respons['status'] = FALSE;
        $isArchive         = ($request->btn == 'unarchive')? 0 : 1;

        if($request->btn == 'archive' || $request->btn == 'unarchive'){
            
            DB::table($table_name)->whereIn('id', $ids)->update(['is_archive' => $isArchive]);
            $respons['message'] = ($isArchive == 1)? "Quotes Archived Successfully" : 'Quotes Unarchived Successfully';

        }elseif ($request->btn  == 'cancel'){

            DB::table($table_name)->whereIn('id', $ids)->update(['booking_status' => 'cancelled']);
            $respons['message'] = 'Quotes Cancelled Successfully !!';
        }
        elseif ($request->btn  == 'quote'){

            DB::table($table_name)->whereIn('id', $ids)->update(['booking_status' => 'quote']);
            $respons['message'] = 'Revert Cancelled Quotes Successfully !!';
        }

        $respons['status']  = true;

        return response()->json($respons);
    }

    public function filterCurrencyRate(Request $request){
        $query = DB::table('currency_conversions');

        if(!is_null($request->selected_currencies)){
            $query->whereIn('from', $request->selected_currencies);
        }

        $data['currency_conversions'] = $query->get();

        return view('quote_booking_includes.currency_conversion_filter_modal', $data);
    }
    
    public function updateCurrencyStatus(Request $request)
    {
        $ids = explode(',', $request->id);
        $status  = ($request->btn == 'active')? '1' : '0'; 
        Currency::whereIn('id', $ids)->update(['status' => $status]);
        $respons['message'] = 'Records Status Updated Successfully !!';
        $respons['status']  = true;
        return response()->json($respons);
    }

    public function getStoredText($slug)
    {
        $store = StoreText::where('slug', $slug)->firstOrFail()->description;
        return response()->json($store);
    }

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
}
