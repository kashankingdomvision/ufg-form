<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Group;
use App\Quote;

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
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'      => 'required|unique:groups|max:255',
                'quote_ids' => 'required',
            ],[
                'quote_ids.required' => 'You have to choose the file!',
            ]);

            if ($validator->errors()->first('name')) {
                return ['status' => false, 'type' => 'Warning', 'icon' => 'error', 'msg' => $validator->errors()->first('name')];
            }

            if ($validator->errors()->first('quote_ids')) {
                return ['status' => false, 'type' => 'Warning', 'icon' => 'error', 'msg' => "Please select atleast Two Quotes"];
            }

            // Explode the ID put them in array respectively.
            $quote_ids = $request->quote_ids;

            // Check if currencies are same or not.
            $currency = Quote::select('currency_id')->where('id', $quote_ids[0])->first();
            $totalQuotesIds = count($quote_ids);
            $totalAcceptedQuotes = 0;
            foreach($quote_ids as $qoute_id) {
                $quotes_currency = Quote::select('currency_id')->where('id', $qoute_id)->get();
                foreach($quotes_currency as $quote_currency) {
                    if($quote_currency->currency_id == $currency->currency_id) {
                        $totalAcceptedQuotes++;
                    }
                }
            }

            if($totalQuotesIds != $totalAcceptedQuotes) {
                return [ 'status' => false, 'type' => 'Info', 'icon' => 'info', 'msg' => 'Quotes Booking Currency should be Same.'];
            }

            // Sum of all the total amounts of selected quotes.
            $quotes_amount_details = DB::table('quotes')
                ->select(DB::raw('
                    sum(net_price) as total_net_price,
                    sum(markup_amount) as total_markup_amount,
                    sum(markup_percentage) as total_markup_percentage,
                    sum(selling_price) as total_selling_price,
                    sum(profit_percentage) as total_profit_percentage,
                    sum(commission_amount) as total_commission_amount
                '))
                ->whereIn('id', $quote_ids)
                ->get()
                ->first();

            $new_group = Group::create([
                'name' => $request->name,
                'total_net_price' => $quotes_amount_details->total_net_price,
                'total_markup_amount' => $quotes_amount_details->total_markup_amount,
                'total_markup_percentage' => $quotes_amount_details->total_markup_percentage,
                'total_selling_price' => $quotes_amount_details->total_selling_price,
                'total_profit_percentage' => $quotes_amount_details->total_profit_percentage,
                'total_commission_amount' => $quotes_amount_details->total_commission_amount,
                'currency_id' => $currency->currency_id
            ]);
            $new_group->quotes()->attach($quote_ids);
            return [ 'status' => true, 'msg' => 'Group Created Successfully.', 'redirect' => route('quotes.group-quote.index')];
        } catch(\Exception $error) {
            return [ 'status' => false, 'msg' => $error->getMessage()];
        }
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
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'      => 'required|unique:groups,name,'.decrypt($id),
                'quote_ids' => 'required',
            ],[
                'quote_ids.required' => 'You have to choose the file!',
            ]);

            if ($validator->errors()->first('name')) {
                return redirect()->back()->with('error_message', "The Name feild is required.");
            }

            if($validator->errors()->first('quote_ids')) {
                return redirect()->back()->with('error_message', 'Select Atleast Two Quotes to Proceed.');
                // return ['status' => false, 'type' => 'Warning', 'icon' => 'error', 'msg' => "Please select atleast Two Quotes"];
            }

            if(count($request->quote_ids) < 2) {
                return redirect()->back()->with('error_message', 'Select Atleast Two Quotes to Proceed.');
            }

            // Sum of all the total amounts of selected quotes.
            $quotes_amount_details = DB::table('quotes')
                ->select(DB::raw('
                    sum(net_price) as total_net_price,
                    sum(markup_amount) as total_markup_amount,
                    sum(markup_percentage) as total_markup_percentage,
                    sum(selling_price) as total_selling_price,
                    sum(profit_percentage) as total_profit_percentage,
                    sum(commission_amount) as total_commission_amount
                '))
                ->whereIn('id', $request->quote_ids)
                ->get()
                ->first();

            $update_group = Group::find(decrypt($id))->update([
                'name' => $request->name,
                'total_net_price' => $quotes_amount_details->total_net_price,
                'total_markup_amount' => $quotes_amount_details->total_markup_amount,
                'total_markup_percentage' => $quotes_amount_details->total_markup_percentage,
                'total_selling_price' => $quotes_amount_details->total_selling_price,
                'total_profit_percentage' => $quotes_amount_details->total_profit_percentage,
                'total_commission_amount' => $quotes_amount_details->total_commission_amount,
            ]);
            $update_group = Group::find(decrypt($id));
            $update_group->quotes()->sync($request->quote_ids);

            return redirect()->route('quotes.group-quote.index')->with('success_message', 'Group quotes updated successfully.');
        } catch(\Exception $error) {
            return redirect()->back()->with('error_message', $error->getMessage());
        }
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
        return redirect()->route('quotes.group-quote.index')->with('success_message', 'Group quote deleted successfully');
    }
}
