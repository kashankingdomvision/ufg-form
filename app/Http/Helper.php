<?php
namespace App\Http;

class Helper
{
    public static function number_format($number){

        return number_format($number,2);
    }
}