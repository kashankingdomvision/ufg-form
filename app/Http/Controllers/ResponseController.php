<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
use App\CommissionGroup;
use App\SupplierRateSheet;
use App\SupplierProduct;

class ResponseController extends Controller
{
    public function getBrandToHoliday(Request $request)
    {    
        $holiday_types = HolidayType::where('brand_id',$request->brand_id)->get();
        return response()->json($holiday_types);
    }

    public function getCommissionGroups(Request $request)
    {    
        $commission_groups = CommissionGroup::where('commission_id',$request->commission_id)->get();
        return response()->json($commission_groups);
    }

    
    public function addProductWithSupplierSync(Request $request)
    {    
        $this->validate(
            $request, 
            [
                'code' => 'required',
                'name' => 'required'
            ],
            [
                'code.required' => 'The Product Code field is required.',
                'name.required' => 'The Product Name field is required.'
            ]
     
        );

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

            return \Response::json(['status' => true, 'success_message' => 'Supplier Bulk Payment Added Successfully.' , 'products' => $supplierProducts], 200); // Status code here
          
        } catch (\Exception $e) {

            return \Response::json(['status' => false, 'product_error' => 'Something went wrong in Product Creation Please try again!' ], 422); // Status code here
        
        }
 
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

    public function getSupplierProductAndSheet(Request $request)
    {
        // dd($request->all());

        $response['url'] = '';
        $response['products'] = '';

     
        $supplier = SupplierRateSheet::where([ "supplier_id" => $request->supplier_id, "season_id" => $request->season_id])->first();
        if(!is_null($supplier)){
            $response['url'] = url(Storage::url($supplier->file));
        }

        // dd($response['url'] );

        $response['products'] = isset($request->supplier_id) && !empty($request->supplier_id) ? Supplier::find($request->supplier_id)->getProducts : '';
        // $response['products'] = '';

        return $response;

    }

    public function getCategoryToSupplier(Request $request)
    {
        $category_details = '';
        $category         = '';
        $table_name       = 'App\\'.$request->table_name;
 
        $supplier = Supplier::whereHas('getCategories', function($query) use($request) {
            $query->where('id', $request->category_id);
        })->get();

        $booking_detail = $table_name::where('category_id', $request->category_id)->where('id', $request->detail_id)->first('category_details');
        $category       = Category::where('id', $request->category_id)->first();

        if(is_null($booking_detail)){
            $category_details = $category->feilds;

        }else{

            $category_details = $booking_detail->category_details;
        }

        return response()->json([ 'suppliers' => $supplier, 'category_details' => $category_details, 'category' => $category ]);
    }
    
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
        return response()->json(View::make('partials.quote_listing', $data)->render());
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
        $template = Template::findOrFail(decrypt($id));
        $data['template']         = $template;
        $data['categories']       = Category::all()->sortBy('name');
        $data['supervisors']      = User::where('role_id', 5)->get()->sortBy('name');
        $data['suppliers']        = Supplier::all()->sortBy('name');
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['users']            = User::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['booking_types']    = BookingType::all();
        $return['template']       = $template;
        $return['template_view']  = View::make('partials.quote_template', $data)->render();
        return response()->json($return);
    }
    
    public function getPaxPartial($count)
    {
        $data['countries'] = Country::orderBy('name', 'ASC')->get();
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

    public function filter_currency_rate(Request $request)
    {
        $query = DB::table('currency_conversions');

        if(!is_null($request->selected_currencies)){
            $query->whereIn('from', $request->selected_currencies);
        }

        $data['currency_conversions'] = $query->get();

        return view('partials.filter_currency_rates', $data);
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
}
