<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CurrencyConversion;
use App\Currency;
class CurrencyConversionController extends Controller
{
    public $pagination = 10;
    
    public function index(Request $request){

        $data['currency_conversions'] = CurrencyConversion::orderBy('id', 'desc')->paginate($this->pagination);
        return view('currency_conversions.listing',$data);
    }

    public function edit(Request $request, $id){
        
        $data['currency']        = CurrencyConversion::findOrFail(decrypt($id));
        $data['currencies']      = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        return view('currency_conversions.edit',$data);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        // $this->validate($request, ['manual_rate' => 'required'], ['required' => 'Manual Rate is required']);
        CurrencyConversion::findOrFail(decrypt($id))->update([
                'manual'   =>  $request->manual
            ]);

        return redirect()->route('setting.currency_conversions.index')->with('success_message', 'Currency rate Updated Successfully');
    }
}
