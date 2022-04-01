<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CurrencyConversionRequest;

use App\CurrencyConversion;
use App\Currency;

class CurrencyConversionController extends Controller
{
    public $pagination = 10;
    
    public function index(Request $request){
        
        $currency_conver  = CurrencyConversion::orderBy('id', 'desc');
        if(count($request->all()) > 0){
            
            if($request->has('from') && !empty($request->from)){
                $currency_conver = $currency_conver->where('from' , 'like', '%'.$request->form.'%');
            }
            if($request->has('to') && !empty($request->to)){
                $currency_conver = $currency_conver->where('to' , 'like', '%'.$request->to.'%');
            }
            
            if($request->has('live_rate') && !empty($request->live_rate)){
                $currency_conver = $currency_conver->where('live' , 'like', '%'.$request->live_rate.'%');
            }
            
            if($request->has('manaul_rate') && !empty($request->manual_rate)){
                $currency_conver = $currency_conver->where('manual' , 'like', '%'.$request->manaul_rate.'%');
            }
        }
        
        $data['currency_conversions'] = $currency_conver->paginate($this->pagination);

        return view('currency_conversions.listing',$data);
    }

    public function edit(Request $request, $id){
        
        $data['currency']        = CurrencyConversion::findOrFail(decrypt($id));
        $data['currencies']      = Currency::active()->orderBy('id', 'ASC')->get();

        return view('currency_conversions.edit',$data);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyConversionRequest $request, $id)
    { 
        CurrencyConversion::findOrFail(decrypt($id))->update([
            'manual' => $request->manual
        ]);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Currency Rate Updated Successfully.',
            'redirect_url'    => route('currency_conversions.index') 
        ]);
    }
}
