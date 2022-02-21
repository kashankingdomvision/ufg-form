<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupQuoteRequest;
use App\Http\Requests\UpdateGroupQuoteRequest;
use App\Group;
use App\Quote;

use Illuminate\Validation\ValidationException;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class GroupController extends Controller
{
    public $pagination = 10;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $group = Group::with('quotes')->orderBy('id', 'Desc');

        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $group->where('name', 'like', '%'.$request->search.'%');
            }
        }

        $data['groups'] = $group->paginate($this->pagination);
        return view('groups.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data['quotes'] = Quote::orderBy('created_at', 'DESC')->get();
        return view('groups.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array
     */

    public function validateSameCurrencies($quote_ids)
    {
        $quote_currency_ids = Quote::whereIn('id', $quote_ids)->pluck('currency_id')->toArray();

        if((count(array_unique($quote_currency_ids)) === 1)) {
            return true;
        } else {
            return false;
        }
    }

    public function getSumOfQuotesTotal($quote_ids)
    {
        $sum_of_quotes_total = DB::table('quotes')
        ->select(DB::raw('
            sum(net_price)         as total_net_price,
            sum(markup_amount)     as total_markup_amount,
            sum(markup_percentage) as total_markup_percentage,
            sum(selling_price)     as total_selling_price,
            sum(profit_percentage) as total_profit_percentage,
            sum(commission_amount) as total_commission_amount
        '))
        ->whereIn('id', $quote_ids)
        ->first();

        return $sum_of_quotes_total;
    }


    public function groupArray($request, $sum_of_quotes_total)
    {
        if($request->has('quote_ids')){
            $quote_ids = $request->quote_ids;
        }

        if($request->has('bulk_action_ids')){
            $quote_ids = explode(",", $request->bulk_action_ids);
        }

        $currency  = Quote::select('currency_id')->where('id', $quote_ids[0])->first();

        $data = [
            'name'                    => $request->name,
            'total_net_price'         => $sum_of_quotes_total->total_net_price,
            'total_markup_amount'     => $sum_of_quotes_total->total_markup_amount,
            'total_markup_percentage' => $sum_of_quotes_total->total_markup_percentage,
            'total_selling_price'     => $sum_of_quotes_total->total_selling_price,
            'total_profit_percentage' => $sum_of_quotes_total->total_profit_percentage,
            'total_commission_amount' => $sum_of_quotes_total->total_commission_amount,
            'currency_id'             => $currency->currency_id
        ];

        return $data;
    }

    /*
       Also used in store Group through Modal
    */
    // GroupQuoteRequest
    // Request
    public function store(GroupQuoteRequest $request)
    {
        // dd($request->all());

        // Explode the ID put them in array respectively.
        if($request->has('quote_ids')){
            $quote_ids = $request->quote_ids;
        }

        if($request->has('bulk_action_ids')){
            $quote_ids = explode(",", $request->bulk_action_ids);
        }

        $validate_same_currencies = $this->validateSameCurrencies($quote_ids);

        /* through error if currencies is not same */ 
        if(!$validate_same_currencies){
            throw ValidationException::withMessages([ 'quote_ids' => 'Quotes Booking Currency should be Same.']);
        }

        // Sum of all the total amounts of selected quotes.
        $sum_of_quotes_total = $this->getSumOfQuotesTotal($quote_ids);

        $group = Group::create($this->groupArray($request, $sum_of_quotes_total));
        $group->quotes()->sync($quote_ids);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Quote Group Created Successfully.',
            'redirect_url'    => route('groups.index') 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $data['group'] = Group::with('quotes')->find(decrypt($id));
        /*dd($data['group']->currency_id);*/
        $data['quotes'] = Quote::where('currency_id', $data['group']->currency_id)->get();
        return view('groups.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateGroupQuoteRequest $request, $id)
    {
        // Explode the ID put them in array respectively.
        if($request->has('quote_ids')){
            $quote_ids = $request->quote_ids;
        }

        if($request->has('bulk_action_ids')){
            $quote_ids = explode(",", $request->bulk_action_ids);
        }

        $validate_same_currencies = $this->validateSameCurrencies($quote_ids);

        /* through error if currencies is not same */ 
        if(!$validate_same_currencies){
            throw ValidationException::withMessages([ 'quote_ids' => 'Quotes Booking Currency should be Same.']);
        }

        // Sum of all the total amounts of selected quotes.
        $sum_of_quotes_total = $this->getSumOfQuotesTotal($quote_ids);

        $group = Group::find(decrypt($id));
        
        $group->update($this->groupArray($request, $sum_of_quotes_total));
        $group->quotes()->sync($quote_ids);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Quote Group Updated Successfully.',
            'redirect_url'    => route('groups.index') 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Group::destroy(decrypt($id));
        return redirect()->route('groups.index')->with('success_message', 'Group quote deleted successfully');
    }
}


// // Check if currencies are same or not.
// $currency = Quote::select('currency_id')->where('id', $quote_ids[0])->first();
// $totalQuotesIds = count($quote_ids);
// $totalAcceptedQuotes = 0;
// foreach($quote_ids as $qoute_id) {
//     $quotes_currency = Quote::select('currency_id')->where('id', $qoute_id)->get();
//     foreach($quotes_currency as $quote_currency) {
//         if($quote_currency->currency_id == $currency->currency_id) {
//             $totalAcceptedQuotes++;
//         }
//     }
// }

// if($totalQuotesIds != $totalAcceptedQuotes) {
//     return [ 'status' => false, 'type' => 'Info', 'icon' => 'info', 'msg' => 'Quotes Booking Currency should be Same.'];
// }

// $validator = Validator::make($request->all(), [
//     'name'      => 'required|unique:groups|max:255',
//     'quote_ids' => 'required',
// ],[
//     'quote_ids.required' => 'You have to choose the file!',
// ]);

// if ($validator->errors()->first('name')) {
//     return ['status' => false, 'type' => 'Warning', 'icon' => 'error', 'msg' => $validator->errors()->first('name')];
// }

// if ($validator->errors()->first('quote_ids')) {
//     return ['status' => false, 'type' => 'Warning', 'icon' => 'error', 'msg' => "Please select atleast Two Quotes"];
// }

// $new_group->quotes()->attach($quote_ids);