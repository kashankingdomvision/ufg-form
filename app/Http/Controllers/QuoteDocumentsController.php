<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use App\QuoteDocument;
use App\QuoteDetail;
use App\Product;
class QuoteDocumentsController extends Controller
{
    public function documentIndex($id)
    {

        
        $quote = Quote::findOrFail(decrypt($id));
        $parentQuote = $quote->getQuoteDetails()->where('parent_id', NULL)->get();
        $data = [];
        foreach ($parentQuote as $parent) {
            $_data = [];
            $parent_product = $parent->getProduct->name;
            $x = [];
            foreach ($parent->getChildQuote as $child) {
                $text = (isset($child->getCategory) && $child->getCategory->slug == 'service-excursion')? 'Service Excursion' : 'Transfer';
                $child_product = $child->getProduct->name??NULL;
                if($child->getCategory->slug == 'accommodation'){
                    $x = [
                        "text"                      => "Transfer to ".$child_product." via ".$parent_product." on ".$parent->date_of_service??NULL." ".$parent->time_of_service??NULL,
                        "accomodation_product_name" => $child_product,
                        "check_in"                  => "Check in: ".$child->date_of_service??NULL." ".$child->time_of_service??NULL,
                        "service_exucrsion"         => ($parent->getChildQuote[1]->getCategory->slug == 'service-excursion')? $parent->getChildQuote[1]->getProduct->name??NULL." ".$parent->getChildQuote[1]['date_of_service']??NULL." ".$parent->getChildQuote[1]['time_of_service']??NULL : NULL,
                    ];
                    array_push($_data, $x);
                }
            }      
            $_data['date'] = $parent->date_of_service;
            array_push($data, $_data);

        }
        // $quote = Quote::findOrFail(decrypt($id));
        // // $quoteDetail = $quote->getQuoteDetails()->orderByRaw('(category_id) DESC')->get();
        // $quoteDetail = $quote->getQuoteDetails()->whereHas('getCategory', function ($query){ 
        //                         $query->orderByRaw('FIELD(sort_by, "1", "2", "3")'); 
        //                     })->toSql();
        // dd($quoteDetail);
        // dd($quote->getQuoteDetails()->orderByRaw('category_id')->orderBy('time_of_service', 'ASC')->get());
        // dd($this->dataSorting($quote->getQuoteDetails));
        // $data['quote_details'] = $quote->getQuoteDetails()->orderBy('raw')->orderBy('time_of_service', 'DESC')->get(); 
        // $doc = QuoteDocument::where('quote_id', decrypt($id))->first();
        $c['quote_id']      = $id;
        $c['quoteDetail']   = $data;
        // if($doc){
        //     if($doc->exists()){
        //         $data['doc']      = $doc;
        //     }
        // }
        return view('quote_documents.index', $c);
    }
    
    public function generatePDF(Request $request, $id)
    {
        QuoteDocument::create([
            'quote_id'  => decrypt($id),
            'data'      => $request->data,
        ]);
        dd('quote doc create successfully');
        // $pdf = PDF::loadView('quote_documents.index')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->download('invoice.pdf');
    }
    
    // public function dataSorting($quoteDetail)
    // {
    //     // $x = [];
    //     $t_product = null;
    //     $date_of_service_and_time = null;
    //     $accProduct = null;
    //     $data = [];
    //     $x =[];
    //     foreach ($quoteDetail as $quoteDetail) {
    //         $data = [];
    //         if($quoteDetail->getCategory->slug == 'transfer'){
    //             $t_product = null;
    //             $date_of_service_and_time= null;
    //             $t_product = $quoteDetail->getProduct->name;
    //             $date_of_service_and_time = $quoteDetail->date_of_service.' '.$quoteDetail->time_of_service;
           
    //         }else if($quoteDetail->getCategory->slug == 'accommodation'){
    //             $accProduct = null;
    //             $accProduct = $quoteDetail->getProduct->name;
    //             $text = 'Transfer To'.$accProduct.' via '.$t_product.' '.$date_of_service_and_time;
    //             $data['acco_product'] = $accProduct;
    //             $data['text'] = $text;  
    //             $data['checkIn'] = $date_of_service_and_time;
    //             array_push($x,$data);
    //         }else{
    //             $text = 'Transfer To via '.$t_product.' '.$date_of_service_and_time;
    //             $data['text'] = $text;
    //             $data['checkIn'] = $date_of_service_and_time;
    //             array_push($x,$data);
    //         }
    //     }
    //     dd($x);
    //     // $data['transfer_to'] = 'Transfer to '.$AProduct.' via '.$TProduct.' on '.$dataOFService.''.$timeservice;
    // }
    
    
    
    
}
