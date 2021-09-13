<?php
namespace App\Http;
use App\Quote;
use App\BookingCreditNote;
use App\QuoteUpdateDetail;
use Auth;

class Helper
{
    public static function number_format($number){
		return str_replace( ',', '', number_format($number,2));
    }

    public static function getQuoteID(){
        
        $last_id = Quote::latest()->pluck('id')->first();
       return "QR-".sprintf("%04s", ++$last_id);
    }

	public static function getCreditNote(){
        $last_id = BookingCreditNote::latest()->pluck('id')->first();
       return "CN-".sprintf("%04s", ++$last_id);
    }

	public static function get_payment_detial_by_ref_no($zoho_booking_reference) {

		// $url = "https://payments.unforgettabletravel.com/backend/api/payment/zoho_payment_status";
		$url = "https://utcstaging.unforgettabletravel.com/backend/api/payment/zoho_payment_status";

		$args = array(
            'body' => json_encode(
                array('param' => array(
                    'zoho_booking_reference' => $zoho_booking_reference
                ))
            ),

            'headers' => array( "Content-Type: application/json" ),
        );

        return \Helper::cf_remote_request($url, $args);
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

        // if(is_null($quote_update_detail)){

            QuoteUpdateDetail::create([
                'user_id'      =>  Auth::id(),
                'foreign_id'   =>  decrypt($id),
                'status'       =>  $status
            ]);

			$response['exist']   = null;
            $response['user_id'] = null;
        // }
		
		return $response;
	}

}