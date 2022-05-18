<?php
namespace App\Http;
use App\Booking;
use App\Country;
use App\Quote;
use App\Category;
use App\Product;
use App\BookingMethod;
use App\BookingType;
use App\Currency;
use App\Supplier;
use App\BookingCreditNote;
use App\BookingDetail;
use App\QuoteUpdateDetail;
use App\SupplierRateSheet;
use App\User;
use App\Wallet;
use App\CurrencyConversion;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class Helper
{


	public static function getAmountInSaleAgentCurrency($from, $to, $amount, $rate_type){

		$rate = Helper::getCurrencyConversionRate($from, $to, $rate_type);

		return Helper::number_format($rate * $amount);
    }

	public static function getCurrencyConversionRate($from_currency, $to_currency, $rate_type){
	 
        return $object = CurrencyConversion::where([
            'from' => $from_currency,
            'to'   => $to_currency
        ])
        ->first()
        ->value($rate_type);
    }


	public static function get_autocomplete_type_records($autocomplete_type){

		$x = collect(DB::table($autocomplete_type)->get())->map(function ($item, $key) {
			return (object) [
				'label'    => $item->name,
				'value'    => $item->name,
				'selected' => false
			];
		});

		return $x;
    }

    public static function number_format($number){
		return number_format($number, 2);
    }

	public static function issetAndNotEmpty($variable){
		$test = isset($variable) && !empty($variable) ? $variable : '';
        return $test;
    }

	public static function document_date_format($date){

		$date = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $date))->format('Y-m-d')));
        return date("l M d, Y",strtotime($date));
    }

	public static function getSupplierRateSheetUrl($supplier_id, $season_id){

		$url = '';
        $supplier = SupplierRateSheet::where([ "supplier_id" => $supplier_id, "season_id" => $season_id ])->first();

        if(!is_null($supplier)){
            $url = url(Storage::url($supplier->file));
        }

        return $url;
    }

	public static function date_difference($start_date, $end_date)
	{
		// dd($start_date);
		// calulating the difference in timestamps
		$diff = strtotime($start_date) - strtotime($end_date);

		// 1 day = 24 hours
		// 24 * 60 * 60 = 86400 seconds
		return ceil(abs($diff / 86400));
	}

	public static function db_date_format($value){
		return date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }

    public static function getQuoteID(){

        $last_id = Quote::latest()->pluck('id')->first();
       return "QR-".sprintf("%04s", ++$last_id);
    }

	public static function getProductCode(){

		// $last_id = Product::latest()->pluck('id')->first();
		$last_id = Product::orderBY('id', 'DESC')->pluck('id')->first();
       	return "PC-".sprintf("%04s", ++$last_id);
    }

	public static function getCreditNote(){
        $last_id = BookingCreditNote::latest()->pluck('id')->first();
       return "CN-".sprintf("%04s", ++$last_id);
    }

	
	public static function getBDUniqueRefID(){

		$last_id = BookingDetail::latest()->pluck('id')->first();
		return sprintf("%06s", ++$last_id);
    }

	public static function getSupplierWalletAmount($supplier_id){

       $booking_transaction = Wallet::select(
            'supplier_id',
            DB::raw("sum(case when type = 'credit' then amount else 0 end) as credit"),
            DB::raw("sum(case when type = 'debit' then amount else 0 end) as debit")
        )
        ->groupBy('supplier_id')
		->where('supplier_id', $supplier_id)
        ->first();

		// dd(/$booking_transaction);

		$wallet_amount = $booking_transaction->credit - $booking_transaction->debit;

		return $wallet_amount;
    }


	public static function getPaymentDetialByRefNo($zoho_booking_reference) {

		$url = "https://payments.unforgettabletravel.com/backend/api/payment/zoho_payment_status";
		// $url = "https://utcstaging.unforgettabletravel.com/backend/api/payment/zoho_payment_status";

		$args = array(
            'body' => json_encode(
                array('param' => array(
                    'zoho_booking_reference' => $zoho_booking_reference
                ))
            ),

            'headers' => array( "Content-Type: application/json" ),
        );

        return Helper::cf_remote_request($url, $args);
	}

	public static function dates($dates)
	{
		$dates = explode ("-", $dates);

		$start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
		$end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');
		$dates      = [ 'start_date' => $start_date,'end_date' => $end_date];

		return (object) $dates;
	}

    public static function cf_remote_request($url, $_args = array()) {
		// prepare array
		$array = array(
			//'status' => false,
			'message' => array(
				'101' => 'Invalid url',
				'102' => 'cURL Error #: ',
				'200' => 'cURL Successful #: ',
				'400' => '400 Bad Request',
			)
		);

		// initalize args
		$args = array(
			'method' 		=> 'POST',
			'timeout' 		=> 45,
			'redirection' 	=> 5,
			'httpversion' 	=> '1.0',
			'blocking' 		=> true,
			'ssl' => true,
			'headers' => array(),
			'body' => array(),
			'returntransfer' => true,
			'encoding' => '',
			'maxredirs' => 10,
			'format' => 'JSON'
		);

		if( empty($url) ) {
			$code = 101;
			$response = array('status' => $code, 'body' => $array['message'][$code]);
			return $response;
		}

		if( !empty($_args) && is_array($_args) )
			$args = array_merge($args, $_args);

		$fields = $args['body'];
		if( strtolower($args['method']) == 'post' && is_array($fields) )
			$fields = http_build_query( $fields );

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL 			=> $url,
			CURLOPT_RETURNTRANSFER 	=> $args['returntransfer'],
			CURLOPT_ENCODING 		=> $args['encoding'],
			CURLOPT_MAXREDIRS 		=> $args['maxredirs'],
			CURLOPT_HTTP_VERSION 	=> $args['httpversion'],// CURL_HTTP_VERSION_1_1,
			CURLOPT_USERAGENT 		=> isset($_SERVER['HTTP_USER_AGENT']) && !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
			//CURLOPT_HEADER 			=> true,
			CURLINFO_HEADER_OUT 	=> true,
			CURLOPT_TIMEOUT 		=> $args['timeout'],
			CURLOPT_CONNECTTIMEOUT 	=> $args['timeout'],
			CURLOPT_SSL_VERIFYPEER 	=> $args['ssl'] === true ? true : false,
			//CURLOPT_SSL_VERIFYHOST 	=> $args['ssl'] === true ? true : false,
            // CURLOPT_CAPATH     		=> APPPATH . 'certificates/ca-bundle.crt',
			CURLOPT_CUSTOMREQUEST 	=> $args['method'],
			CURLOPT_POSTFIELDS 		=> $fields,
			CURLOPT_HTTPHEADER 		=> $args['headers'],
		));

		$curl_response 	= curl_exec($curl);
		$err 			= curl_error($curl);
		$curl_info = array(
			'status' 		=> curl_getinfo($curl, CURLINFO_HTTP_CODE),
			'header' 		=> curl_getinfo($curl, CURLINFO_HEADER_OUT),
			'total_time' 	=> curl_getinfo($curl, CURLINFO_TOTAL_TIME)
		);

		curl_close($curl);


		if( $err ) {
			$response = array('message' => $err, 'body' => $err);

		} else {
			if( $curl_info['status'] == 200
			&& in_array($args['format'], array('ARRAY', 'OBJECT'))
			&& !empty($curl_response) && is_string($curl_response) ) {
				$curl_response = json_decode( $curl_response, $args['format'] == 'ARRAY' ? true : false );
                $curl_response = ( json_last_error() == JSON_ERROR_NONE ) ? $curl_response : $curl_response;
			}
            else{
                $curl_response = json_decode($curl_response, TRUE);
            }

			$response = array(
				//'message' 	=> $array['message'][ $curl_info['status'] ],
				'body' 		=> $curl_response
			);
		}

		$response = array_merge($curl_info, $response);
		return $response;
	}

	public static function checkAlreadyExistUser($id, $status){

        $quote_update_detail = QuoteUpdateDetail::where('foreign_id',decrypt($id))->where('status',$status)->first();
		$response            = [];

        if(!is_null($quote_update_detail)){

            $response['exist']   = 1;
            $response['user_id'] = $quote_update_detail->user_id;

			return $response;
        }

		QuoteUpdateDetail::create([
			'user_id'      =>  Auth::id(),
			'foreign_id'   =>  decrypt($id),
			'status'       =>  $status
		]);

		$response['exist']   = null;
		$response['user_id'] = null;

		return $response;
	}

	public static function getCategory($id){

    	$category = Category::find($id);
		return $category->name;
    }

	public static function getSupplier($id){

    	$supplier = Supplier::find($id);
		return $supplier->name;
    }

	public static function getProduct($id){

    	$product = Product::find($id);
		return $product->name;
    }

	public static function getSupervisor($id){

    	$supervisor = User::find($id);
		return $supervisor->name;
    }

	public static function getBookingMethod($id){

    	$bookingMethod = BookingMethod::find($id);
		return $bookingMethod->name;
    }

	public static function getBookedBy($id){

    	$bookedBy = User::find($id);
		return $bookedBy->name;
    }

	public static function getBookingType($id){

    	$bookingType = BookingType::find($id);
		return $bookingType->name;
    }

	public static function getSupplierCurrency($id){

    	$currency = Currency::find($id);
		return $currency->name;
    }

    public static function getCountry($id){

        $country = Country::find($id);
        return $country->name;
    }

    public static function getTotalQuote($value){

        $total_quote = Quote::select(DB::raw('count(id) as total_quote'))
            ->where('agency', '0')
            ->where('status', 'quote')
            ->where('lead_passenger_email', $value)
            ->groupBy('lead_passenger_email')
            ->get();

        if(!empty($total_quote)) {
            return isset($total_quote[0]->total_quote) && !empty($total_quote[0]->total_quote) ? $total_quote[0]->total_quote : 0 ;
        }
    }

    public static function getTotalCancelledQuote($value){
        $total_cancelled_quote = Quote::select(DB::raw('count(id) as total_cancelled_quote'))
            ->where('agency', '0')
            ->where('status', 'cancelled')
            ->where('lead_passenger_email', $value)
            ->groupBy('lead_passenger_email')
            ->get();

        if(!empty($total_cancelled_quote)) {
            return isset($total_cancelled_quote[0]->total_cancelled_quote) && !empty($total_cancelled_quote[0]->total_cancelled_quote) ? $total_cancelled_quote[0]->total_cancelled_quote : 0 ;
        }
    }

    public static function getTotalBooking($value){

        $total_bookings = Booking::select(DB::raw('count(id) as total_bookings'))
            ->where('agency', '0')
            ->where('lead_passenger_email', $value)
            ->groupBy('lead_passenger_email')
            ->get();

        if(!empty($total_bookings)) {
            return isset($total_bookings[0]->total_bookings) && !empty($total_bookings[0]->total_bookings) ? $total_bookings[0]->total_bookings : 0 ;
        }
    }

    public static function getTotalConfirmBooking($value){

        $total_confirmed_bookings = Booking::select(DB::raw('count(id) as total_confirmed_bookings'))
            ->where('agency', '0')
            ->where('lead_passenger_email', $value)
            ->where('status', 'confirmed')
            ->groupBy('lead_passenger_email')
            ->get();

        if(!empty($total_confirmed_bookings)) {
            return isset($total_confirmed_bookings[0]->total_confirmed_bookings) && !empty($total_confirmed_bookings[0]->total_confirmed_bookings) ? $total_confirmed_bookings[0]->total_confirmed_bookings : 0 ;
        }
    }

    public static function getTotalCancelledBooking($value){

        $total_cancelled_bookings = Booking::select(DB::raw('count(id) as total_cancelled_bookings'))
            ->where('agency', '0')
            ->where('lead_passenger_email', $value)
            ->where('status', 'cancelled')
            ->groupBy('lead_passenger_email')
            ->get();

        if(!empty($total_cancelled_bookings)) {
            return isset($total_cancelled_bookings[0]->total_cancelled_bookings) && !empty($total_cancelled_bookings[0]->total_cancelled_bookings) ? $total_cancelled_bookings[0]->total_cancelled_bookings : 0 ;
        }
    }
}
