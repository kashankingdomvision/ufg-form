<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CurrencyRequest;
use Illuminate\Support\Facades\DB;

use App\Currency;
use App\AllCurrency;
use App\CurrencyConversion;

class CurrencyController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Currency = Currency::orderBy('id', 'ASC');
        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $Currency->where(function($q) use($request){
                    $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('code', 'like', '%'.$request->search.'%');
                });
            }
        }
        $data['currencies'] = $Currency->paginate($this->pagination);
        return view('currencies.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['all_currencies'] = AllCurrency::whereNotIn('code', Currency::get()->pluck('code')->toArray())->get();
        return view('currencies.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        // $nCurrency = AllCurrency::where('code', $request->currency)->first();
        // Currency::create([
        //     'name'          => $nCurrency->name,
        //     'code'          => $nCurrency->code,
        //     'is_obsolete'   => $nCurrency->isObsolete,
        //     'flag'          => $nCurrency->flag,
        //     'status'        => ($request->status == '1') ? 1 : 0, 
        // ]);

        //-- add new currency in currenvy table

        $new_currency = AllCurrency::where('code', $request->currency)->first();

        $currency = new Currency;
        $currency->name        = $new_currency->name;
        $currency->code        = $new_currency->code;
        $currency->is_obsolete = ($new_currency->isObsolete == 'false') ? '0' : '1';
        $currency->flag        = $new_currency->flag;
        $currency->status      = ($request->status == '1') ? 1 : 0;
        $currency->save();

        //-- end

        //-- creating possibilty of already added currency with new currency from(old_currency) - to(new_currency)

        $existing_currencies   = CurrencyConversion::groupBy('from')->get(['from']);
        
        foreach ($existing_currencies as $key => $existing_currency) {
            $cc       = new CurrencyConversion;
            $cc->from = $existing_currency->from;
            $cc->to   = $new_currency->code;
            $cc->save();
        }
            
        //-- end

        //-- creating possibilty of already added currency with new currency from(new_currency) - to(old_currency)

        $all_currencies = Currency::all();

        foreach ($all_currencies as $key => $all_currency) {
            $cc       = new CurrencyConversion;
            $cc->from = $currency->code;
            $cc->to   = $all_currency->code;
            $cc->save();
        }

        //-- end


        //-- updating cuurency rate of new added currencies

        // $values = CurrencyConversion::whereNull('live')->count();
        // $from   = CurrencyConversion::whereNull('live')->pluck('from');
        // $to     = CurrencyConversion::whereNull('live')->pluck('to');

        // for ($i=0 ; $i<$values; $i++) {
        //     $url = "https://free.currencyconverterapi.com/api/v6/convert?q=$from[$i]_$to[$i]&compact=ultra&apiKey=9910709386be4f00aa5b";
        //     $output2 =  json_decode($this->curl_data($url));

        //     $key = "$from[$i]_$to[$i]";
    
        //     CurrencyConversion::where('from', "$from[$i]")->where('to', "$to[$i]")->update(['live' => floatval($output2->{$key}) ]);
        // }

        //-- end

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Currency Added Successfully.',
            'redirect_url'    => route('currencies.index') 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::findOrFail(decrypt($id));
        $data['currencies'] = Currency::all();
        $data['currency']       = $currency;
        
        return view('currencies.edit', $data);
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
        Currency::findOrFail(decrypt($id))->update([ 'status' => ($request->status == "1") ? 1 : 0 ]);
        
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Currency Updated Successfully.',
            'redirect_url'    => route('currencies.index') 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Currency::destroy(decrypt($id));
        return redirect()->route('currencies.index')->with('success_message', 'Currency updated successfully'); 
        
    }

    public function bulkAction(Request $request)
    {
        try {

            $message = "";
            $bulk_action_ids  = $request->bulk_action_ids;
            $bulk_action_type = $request->bulk_action_type;
            $bulk_action_ids  = explode(",", $bulk_action_ids);
    
            if($bulk_action_type == 'active'){
                DB::table("currencies")->whereIn('id', $bulk_action_ids)->update([ 'status' => 1 ]);
                $message = "Currency Active Successfully.";
            }

            if($bulk_action_type == 'inactive'){
                DB::table("currencies")->whereIn('id', $bulk_action_ids)->update([ 'status' => 0 ]);
                $message = "Currency Inactive Successfully.";
            }
    
            return response()->json([ 
                'status'  => true, 
                'message' => $message,
            ]);
          
        } catch (\Exception $e) {

            // $e->getMessage(),
            return response()->json([ 
                'status'  => false, 
                'message' => "Something Went Wrong, Please Try Again."
            ]);
        }
    }
}
