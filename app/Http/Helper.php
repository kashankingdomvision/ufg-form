<?php
namespace App\Http;
use App\Quote;

class Helper
{
    public static function number_format($number){

        return number_format($number,2);
    }

    public static function getQuoteID(){
        
        $last_id = Quote::latest()->pluck('id')->first();
       return "QR-".sprintf("%04s", ++$last_id);
    }

}