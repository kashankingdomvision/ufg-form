<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Season;
use App\User;
use App\Supplier;
use App\BookingMethod;
use App\Currency;
use App\Template;
use App\Brand;
use App\HolidayType;
use App\BookingType;
use App\CurrencyConversion;

class QuoteController extends Controller
{
    public function create()
    {

        $data['categories']       = Category::all()->sortBy('name');
        // $data['products']         = Product::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']            = User::all()->sortBy('name');
        $data['supervisors']      = User::where('role_id', 5)->orderBy('name', 'ASC')->get();
        // $data['suppliers']        = Supplier::all()->sortBy('name');
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        // $data['templates']        = Template::all()->sortBy('name');
        $data['brands']           = Brand::orderBy('id','ASC')->get();
        // $data['holiday_types']    = HolidayType::where('brand_id',Auth::user()->brand_id)->get();
        $data['booking_types']       = BookingType::all();
   
 
        return view('quotes.create', $data);
    }

    public function get_currency_conversion(){

        return CurrencyConversion::all();
    }
}
