<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use App\QuoteDocument;
class QuoteDocumentsController extends Controller
{
    public function documentIndex($id)
    {
        $quote = Quote::findOrFail(decrypt($id));
        // $quoteDetail = $quote->getQuoteDetails()->orderByRaw('(category_id) DESC')->get();
        $quoteDetail = $quote->getQuoteDetails()->whereHas('getCategory', function ($query){ 
                                $query->orderByRaw('FIELD(sort_by, "1", "2", "3")'); 
                            })->toSql();
        dd($quoteDetail);
        dd($quote->getQuoteDetails()->orderByRaw('category_id')->orderBy('time_of_service', 'ASC')->get());
        dd($this->dataSorting($quote->getQuoteDetails));
        $data['quote_details'] = $quote->getQuoteDetails()->orderBy('raw')->orderBy('time_of_service', 'DESC')->get(); 
        $doc = QuoteDocument::where('quote_id', decrypt($id))->first();
        $data['quote_id'] = $id;
        if($doc){
            if($doc->exists()){
                $data['doc']      = $doc;
            }
        }
        return view('quote_documents.index', $data);
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
    
    public function dataSorting($quoteDetail)
    {
        // $x = [];
        $t_product = null;
        $date_of_service_and_time = null;
        $accProduct = null;
        $data = [];
        $x =[];
        foreach ($quoteDetail as $quoteDetail) {
            $data = [];
            if($quoteDetail->getCategory->slug == 'transfer'){
                $t_product = null;
                $date_of_service_and_time= null;
                $t_product = $quoteDetail->getProduct->name;
                $date_of_service_and_time = $quoteDetail->date_of_service.' '.$quoteDetail->time_of_service;
           
            }else if($quoteDetail->getCategory->slug == 'accommodation'){
                $accProduct = null;
                $accProduct = $quoteDetail->getProduct->name;
                $text = 'Transfer To'.$accProduct.' via '.$t_product.' '.$date_of_service_and_time;
                $data['acco_product'] = $accProduct;
                $data['text'] = $text;  
                $data['checkIn'] = $date_of_service_and_time;
                array_push($x,$data);
            }else{
                $text = 'Transfer To via '.$t_product.' '.$date_of_service_and_time;
                $data['text'] = $text;
                $data['checkIn'] = $date_of_service_and_time;
                array_push($x,$data);
            }
        }
        dd($x);
        // $data['transfer_to'] = 'Transfer to '.$AProduct.' via '.$TProduct.' on '.$dataOFService.''.$timeservice;
    }
}
