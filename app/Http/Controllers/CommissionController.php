<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CommissionRequest;
use App\Http\Requests\UpdateCommissionRequest;
use Illuminate\Support\Facades\DB;

use App\Commission;
use App\Brand;
use App\HolidayType;
use App\Currency;
use App\CommissionGroup;
use App\Season;
use App\CommissionSeason;

class CommissionController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $commission = Commission::orderBy('id', 'ASC');
        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $commission->where('name', 'like', '%'.$request->search.'%');
            }
        }
        $data['commissions'] = $commission->paginate($this->pagination);
        
        return view('commissions.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['brands']             = Brand::orderBy('id','ASC')->get();
        $data['commission_groups']  = CommissionGroup::orderBy('id','ASC')->get();
        $data['currencies']         = Currency::active()->orderBy('id', 'ASC')->get();
        $data['booking_seasons']    = Season::all();

        return view('commissions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommissionRequest $request)
    {
        $commission = Commission::create([ 'name' => $request->name ]);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Commission Created Successfully.',
            'redirect_url'    => route('commissions.index') 
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
        $data['commission'] = Commission::findOrFail(decrypt($id));
        
        return view('commissions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommissionRequest $request, $id)
    {
        Commission::findOrFail(decrypt($id))->update($request->all());

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Commission Updated Successfully.',
            'redirect_url'    => route('commissions.index') 
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
        Commission::destroy(decrypt($id));
        return redirect()->route('commissions.index')->with('success_message', 'Commission deleted successfully'); 
    }

    public function bulkAction(Request $request)
    {
        try {

            $message = "";
            $bulk_action_ids  = $request->bulk_action_ids;
            $bulk_action_type = $request->bulk_action_type;
            $bulk_action_ids  = explode(",", $bulk_action_ids);
    
            if($bulk_action_type == 'delete'){
                DB::table("commissions")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Commission Deleted Successfully.";
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
