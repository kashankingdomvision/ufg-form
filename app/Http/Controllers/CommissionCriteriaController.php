<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommissionCriteriaRequest;
use Illuminate\Validation\ValidationException;
use App\Commission;
use App\CommissionGroup;
use App\CommissionCriteria;
use App\Brand;
use App\Currency;
use App\Season;

class CommissionCriteriaController extends Controller
{
    public $pagination = 10;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commission_criterias = CommissionCriteria::orderBy('id', 'ASC');
     
        $data['commission_criterias'] = $commission_criterias->paginate($this->pagination);
        
        return view('commission_criteria.listing', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['brands']             = Brand::orderBy('id','ASC')->get();
        $data['commission_types']   = Commission::orderBy('id','ASC')->get();
        $data['commission_groups']  = CommissionGroup::orderBy('id','ASC')->get();
        $data['currencies']         = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['booking_seasons']    = Season::all();

        return view('commission_criteria.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommissionCriteriaRequest $request)
    {

        $commission_criterias = CommissionCriteria::where([
            'commission_id'       => $request->commission_id,
            'commission_group_id' => $request->commission_group_id,
            'brand_id'            => $request->brand_id,
            'holiday_type_id'     => $request->holiday_type_id,
            'currency_id'         => $request->currency_id,
            'user_id'             => Auth::id()
        ])
        ->whereHas('seasons', function($query) use($request){
            $query->whereIn('season_id', $request->season_id );
        });

        if($commission_criterias->exists()){

            throw ValidationException::withMessages([ 'percentage' => 'The Percentage has already been taken with these Criteria.']);
        }

        $commission_criterias = CommissionCriteria::create([
            'commission_id'       => $request->commission_id,
            'percentage'          => $request->percentage,
            'commission_group_id' => $request->commission_group_id,
            'brand_id'            => $request->brand_id,
            'holiday_type_id'     => $request->holiday_type_id,
            'currency_id'         => $request->currency_id
        ]);

        $commission_criterias->seasons()->sync($request->season_id);
        
        return redirect()->route('commissions.commission-criteria.index')->with('success_message', 'Commission Criteria created successfully'); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $data['brands']               = Brand::orderBy('id','ASC')->get();
        $data['commission_types']     = Commission::orderBy('id','ASC')->get();
        $data['commission_groups']    = CommissionGroup::orderBy('id','ASC')->get();
        $data['currencies']           = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['booking_seasons']      = Season::all();

        $data['commission_criteria']  = CommissionCriteria::find(decrypt($id));

        return view('commission_criteria.edit', $data);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // CommissionCriteriaRequest
    public function update(CommissionCriteriaRequest $request, $id)
    {
        $commission_criterias = CommissionCriteria::where([
            'commission_id'       => $request->commission_id,
            'commission_group_id' => $request->commission_group_id,
            'brand_id'            => $request->brand_id,
            'holiday_type_id'     => $request->holiday_type_id,
            'currency_id'         => $request->currency_id
        ])
        ->whereHas('seasons', function($query) use($request, $id){
            $query->whereIn('season_id', $request->season_id );
        })
        ->where('id', '!='  , decrypt($id));

        if($commission_criterias->exists()){
            throw ValidationException::withMessages([ 'percentage' => 'The Percentage has already been taken with these Criteria.']);
        }

        $commission_criterias = CommissionCriteria::find(decrypt($id));
        $commission_criterias->update([
            'commission_id'       => $request->commission_id,
            'percentage'          => $request->percentage,
            'commission_group_id' => $request->commission_group_id,
            'brand_id'            => $request->brand_id,
            'holiday_type_id'     => $request->holiday_type_id,
            'currency_id'         => $request->currency_id
        ]);

        $commission_criterias->seasons()->sync($request->season_id);
      
        return redirect()->route('commissions.commission-criteria.index')->with('success_message', 'Commission Criteria updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CommissionCriteria::destroy(decrypt($id));
        return redirect()->route('commissions.commission-criteria.index')->with('success_message', 'Commission Criteria Deleted Successfully'); 
    }
}
