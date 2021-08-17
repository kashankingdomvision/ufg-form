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
        $x = [];
        foreach ($quote->getQuoteDetailWithPackage as $packages) {
            $data = [];

                $data['day_date']       =   $packages->getQuoteDetail[0]['date_of_service'];
                $trasfer_product_name   =   $packages->getQuoteDetail[0]->getProduct->name;
                $acc_product_name       =   (isset($packages->getQuoteDetail[1]))? $packages->getQuoteDetail[1]->getProduct->name : NULL;
                $data['transfer']       =   "Transfer to ".$acc_product_name." via ".$trasfer_product_name." on ". $packages->getQuoteDetail[0]['date_of_service'].' '.$packages->getQuoteDetail[0]['time_of_service'];
                $data['accommodation']  =   $acc_product_name;
                $data['check_in']       =   $packages->getQuoteDetail[0]['date_of_service'].' '.$packages->getQuoteDetail[0]['time_of_service'];
                $data['transfer_to']    =   "Transfer to ".$acc_product_name." via ".$trasfer_product_name." at ".$packages->getQuoteDetail[0]['time_of_service'];
                array_push($x, $data);
        }
        
        $_data['quote_id']  = $quote->id;
        $_data['documents'] = $x;
        
            return view('quote_documents.index', $_data);       
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
