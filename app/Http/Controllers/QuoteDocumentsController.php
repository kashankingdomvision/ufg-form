<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\QuoteExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Helper;

use App\Brand;
use App\BookingMethod;
use App\BookingType;
use App\Currency;
use App\Category;
use App\Commission;
use App\Country;
use App\QuoteDocument;
use App\Quote;
use App\Season;
use App\Template;
use App\User;
use App\StoreText;
use PDF;

class QuoteDocumentsController extends Controller
{

    public function index($id)
    {
        $quote          = Quote::findOrFail(decrypt($id));
        if($quote->stored_text != null ){
            $storedText     = StoreText::whereIn('id', $quote->stored_text)->orderBy('id', 'desc')->get();
            $data['storetexts']     =  $storedText;
        }

        $quoteDetails   = $quote->getQuoteDetails()->orderBy('time_of_service', 'DESC')->orderBy('date_of_service', 'ASC')->get(['date_of_service', 'end_date_of_service', 'time_of_service', 'category_id', 'product_id', 'id', 'image', 'service_details'])->groupBy('date_of_service');
        $startDate      = $quote->getQuoteDetails()->min('date_of_service');
        $endDate        = $quote->getQuoteDetails()->max('date_of_service');
        $data['quote_details']  = $quoteDetails;
        $data['created_at']     =  $quote->doc_formated_created_at;
        $data['title']          =  $quote->booking_details;
        $data['person_name']    =  $quote->getSalePerson->name;
        $data['brand_about']    =  $quote->getBrand->about_us;
        $data['startdate']      =  date('l, d M Y', strtotime($startDate));
        $data['enddate']        =  date('l, d M Y', strtotime($endDate));
        $data['quote_id']       =  $quote->id;
        $data['booking_amount_person']       =  $quote->amount_per_person;
        $data['selling_amount']              =  $quote->selling_price;
        $data['booking_currency']            =  $quote->getCurrency->code;

        return view('quote_documents.index', $data);
    }


    
    public function generatePDF(Request $request, $id)
    {       
        $quote          = Quote::findOrFail(decrypt($id));
        if($quote->stored_text != null ){
            $storedText     = StoreText::whereIn('id', $quote->stored_text)->orderBy('id', 'desc')->get();
            $data['storetexts']     =  $storedText;
        }
        $quoteDetails   = $quote->getQuoteDetails()->orderBy('time_of_service', 'DESC')->get(['date_of_service', 'end_date_of_service', 'time_of_service', 'category_id', 'product_id', 'id', 'image', 'service_details'])->groupBy('date_of_service');
        $startDate      = $quote->getQuoteDetails()->min('date_of_service');
        $endDate        = $quote->getQuoteDetails()->max('date_of_service');
        $data['quote_details']  = $quoteDetails;
        $data['created_at']     =  $quote->doc_formated_created_at;
        $data['title']          =  $quote->booking_details;
        $data['person_name']    =  $quote->getSalePerson->name;
        $data['brand_about']    =  $quote->getBrand->about_us;
        $data['startdate']      =  date('l, d M Y', strtotime($startDate));
        $data['enddate']        =  date('l, d M Y', strtotime($endDate));
        $data['quote_id']       =  $quote->id;
        $data['selling_price']       =  $quote->id;
        $data['booking_amount_person']       =  $quote->amount_per_person;
        $data['selling_amount']              =  $quote->selling_price;
        $pdf  = PDF::loadView('quote_documents.pdf', $data);
        return $pdf->stream();
        // return view('quote_documents.pdf', $data);
    }
    

    // quote export work 
    public function generateExport($id) {
        $quote = Quote::with('getSalePerson','getCommission','getBrand','getHolidayType','getSeason','getCurrency','getNationality','getPaxDetail','getQuoteDetails')->findOrFail(decrypt($id));
        $data['quote']            = $quote;
        $data['countries']        = Country::orderBy('sort_order', 'ASC')->get();
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
        // dd($data);
        return Excel::download(new QuoteExport($data), "$quote->quote_ref.xlsx");
    }

    
    
}
