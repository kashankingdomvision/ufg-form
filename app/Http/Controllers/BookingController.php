<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Season;
use Cache;
use App\User;
use App\Booking;
use App\PaymentMethod;
use App\Airline;
use App\Brand;
use App\HolidayType;
use App\Currency;
use App\Category;
use App\Supplier;
use App\BookingMethod;

class BookingController extends Controller
{
    public $pagination = 10;

    public function view_seasons()
    {
        $data['seasons'] = Season::orderBy('seasons.created_at', 'desc')->groupBy('seasons.id', 'seasons.name')->get(['seasons.id', 'seasons.name', 'seasons.default']);
        return view('bookings.season_listing', $data);
    }

    public function index($id)
    {
        $season = Season::findOrFail(decrypt($id));
        $data['bookings'] = $season->getBooking()->paginate($this->pagination);

        // dd($data);

        return view('bookings.listing', $data);
    }
    

    private function curl_data($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return $output = curl_exec($ch);
    }
}
