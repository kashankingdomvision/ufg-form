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
        dd($this->dataSorting($quote->getQuoteDetails));
        $data['quote_details'] = $quote->getQuoteDetails()->orderBy('date_of_service', 'ASC')->orderBy('time_of_service', 'ASC')->get(); 
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
        $x = [];
        foreach ($quoteDetail as $quoteDetail) {
            if($quoteDetail->getCategory->slug == 'transfer'){
                $data = [];
                $data['transfer'] = $quoteDetail;
            }else if($quoteDetail->getCategory->slug == 'accommodation'){
                $data['accommodation'] = $quoteDetail;
            }elseif ($quoteDetail->getCategory->slug == 'accommodation') {
                # code...
            }
            if($quoteDetail)
            array_push($x, $data);
        }
        // $data['transfer_to'] = 'Transfer to '.$AProduct.' via '.$TProduct.' on '.$dataOFService.''.$timeservice;
        return $x;
    }
}
