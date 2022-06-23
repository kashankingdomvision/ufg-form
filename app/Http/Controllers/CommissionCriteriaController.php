<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommissionCriteriaRequest;
use App\Http\Requests\UpdateCommissionCriteriaRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Commission;
use App\CommissionGroup;
use App\CommissionCriteria;
use App\Brand;
use App\Currency;
use App\HolidayType;
use App\Season;

class CommissionCriteriaController extends Controller
{
    public $pagination = 10;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $commission_criterias = CommissionCriteria::
        with([
            'getCurrencies' => function ($query) {
                $query->select('name', 'code');
            },
            'getBrands' => function ($query) {
                $query->select('name');
            },
            'getHolidayTypes' => function ($query) {
                $query->select('name');
            },
            'getSeasons' => function ($query) {
                $query->select('name');
            },
        ]) 
        ->orderBy('id', 'ASC');

        if(count($request->all()) >0){
            $commission_criterias = $this->searchFilters($commission_criterias, $request);
        }

        $data['commission_criterias'] = $commission_criterias->paginate($this->pagination);
        $data['booking_seasons']  = Season::get(['id','name']);
        $data['brands']           = Brand::orderBy('id','ASC')->get(['id','name']);
        $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
        $data['holiday_types']  = HolidayType::get(['id','name']);
        
        return view('commission_criterias.listing', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function searchFilters($commission_criterias, $request)
    {
        if($request->has('booking_currency') && !empty($request->booking_currency)){
            $commission_criterias->whereHas('getCurrencies', function($query) use($request){
                $query->whereIn('currency_id', $request->booking_currency );
            });
        }

        if($request->has('booking_season') && !empty($request->booking_season)){
            $commission_criterias->whereHas('getSeasons', function($query) use($request){
               $query->where('name', 'like', '%'. $request->booking_season.'%' );
            });
        }

        if($request->has('holiday_types') && !empty($request->holiday_types)){
            $commission_criterias->whereHas('getHolidayTypes', function($query) use($request){
               $query->where('name', 'like', '%'. $request->holiday_types.'%' );
            });
        }

        if($request->has('brand') && !empty($request->brand)){
            $commission_criterias->whereHas('getBrands', function($query) use($request){
                $query->whereIn('brand_id', $request->brand );
            });
        }

        if($request->has('search') && !empty($request->search)){
            $commission_criterias->where(function($query) use($request){
                $query->where('name', 'like', '%'.$request->search.'%');
            });
        }

        return $commission_criterias;
    }

    public function create()
    {
        $data['brands']          = Brand::orderBy('id','ASC')->get();
        $data['currencies']      = Currency::active()->orderBy('id', 'ASC')->get();
        $data['booking_seasons'] = Season::orderBy('id', 'ASC')->get(['id','name']);

        return view('commission_criterias.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommissionCriteriaRequest $request)
    {
        $commission_criterias = CommissionCriteria::
        whereHas('getBrands', function($query) use ($request){
            $query->whereIn('brand_id', $request->brand_id );
        }) 
        ->whereHas('getHolidayTypes', function($query) use ($request){
            $query->whereIn('holiday_type_id', $request->holiday_type_id );
        })
        ->whereHas('getCurrencies', function($query) use ($request){
            $query->whereIn('currency_id', $request->currency_id );
        })
        ->whereHas('getSeasons', function($query) use($request){
            $query->whereIn('season_id', $request->season_id );
        });
 
        if($commission_criterias->exists()){
            throw ValidationException::withMessages(array_fill_keys([
                    'brand_id',
                    'holiday_type_id',
                    'currency_id',
                    'season_id'
                ], 'The Criteria has already been taken.')
            );
        }

        $commission_criterias = CommissionCriteria::create([
            'name'       => $request->name,
            'percentage' => $request->percentage,
            'user_id'    => Auth::id()
        ]);

        $commission_criterias->getSeasons()->sync($request->season_id);
        $commission_criterias->getCurrencies()->sync($request->currency_id);
        $commission_criterias->getBrands()->sync($request->brand_id);
        $commission_criterias->getHolidayTypes()->sync($request->holiday_type_id);
        
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Commission Criteria Created Successfully.',
            'redirect_url'    => route('commission_criterias.index') 
        ]);

        // ->whereHas('getCommissionGroups', function($query) use($request){
        //     $query->whereIn('commission_group_id', $request->commission_group_id );
        // })
        // where([
        //     'commission_id'       => $request->commission_id,
        // ])

        // $commission_criterias->getCommissionGroups()->sync($request->commission_group_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $commission_criteria = CommissionCriteria::find(decrypt($id));

        $data['brands']               = Brand::orderBy('id','ASC')->get();
        $data['commission_types']     = Commission::orderBy('id','ASC')->get();
        $data['commission_groups']    = CommissionGroup::orderBy('id','ASC')->get();
        $data['currencies']           = Currency::active()->orderBy('id', 'ASC')->get();
        $data['booking_seasons']      = Season::orderBy('id', 'ASC')->get(['id','name']);
        $data['commission_criteria']  = $commission_criteria;
        $data['holiday_types']        = HolidayType::whereIn('brand_id', $commission_criteria->getBrands()->pluck('brand_id')->toArray())->leftJoin('brands', 'holiday_types.brand_id', '=', 'brands.id')->get(['holiday_types.id','brands.name as brand_name','holiday_types.name']);

        return view('commission_criterias.edit', $data);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateCommissionCriteriaRequest $request, $id)
    {
        $commission_criterias = CommissionCriteria::
        whereHas('getSeasons', function($query) use ($request){
            $query->whereIn('season_id', $request->season_id );
        })
        ->whereHas('getCurrencies', function($query) use ($request){
            $query->whereIn('currency_id', $request->currency_id );
        })
        ->whereHas('getBrands', function($query) use ($request){
            $query->whereIn('brand_id', $request->brand_id );
        }) 
        ->whereHas('getHolidayTypes', function($query) use ($request){
            $query->whereIn('holiday_type_id', $request->holiday_type_id );
        })
        ->where('id', '!='  , decrypt($id));

        if($commission_criterias->exists()){
            throw ValidationException::withMessages(array_fill_keys([
                    'brand_id',
                    'holiday_type_id',
                    'currency_id',
                    'season_id'
                ], 'The Criteria has already been taken.')
            );
        }

        $commission_criterias = CommissionCriteria::find(decrypt($id));
        $commission_criterias->update([
            'percentage'          => $request->percentage,
            'user_id'             => Auth::id()
        ]);

        $commission_criterias->getSeasons()->sync($request->season_id);
        $commission_criterias->getCurrencies()->sync($request->currency_id);
        $commission_criterias->getBrands()->sync($request->brand_id);
        $commission_criterias->getHolidayTypes()->sync($request->holiday_type_id);
      
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Commission Criteria Updated Successfully.',
            'redirect_url'    => route('commission_criterias.index') 
        ]);


        // where([
        //     'commission_id'       => $request->commission_id,
        // ])
       // ->whereHas('getCommissionGroups', function($query) use($request){
        //     $query->whereIn('commission_group_id', $request->commission_group_id );
        // })

        // $commission_criterias->getCommissionGroups()->sync($request->commission_group_id);
        // 'commission_id'       => $request->commission_id,
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $CommissionCriteria = CommissionCriteria::findOrFail(decrypt($id));
        try
        {
            $CommissionCriteria->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Commission Criteria Deleted Successfully.',
                'redirect_url'    => route('commission_criterias.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Commission Criteria can not be deleted beacuse it is associated one or more record.',
                ]);
            }
        } 
    }

    public function bulkAction(Request $request)
    {
        try {

            $message = "";
            $bulk_action_ids  = $request->bulk_action_ids;
            $bulk_action_type = $request->bulk_action_type;
            $bulk_action_ids  = explode(",", $bulk_action_ids);
    
            if($bulk_action_type == 'delete'){
                DB::table("commission_criterias")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Commission Criteria Deleted Successfully.";
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
