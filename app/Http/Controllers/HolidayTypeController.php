<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HolidayTypeRequest;
use Illuminate\Support\Facades\DB;

use App\Brand;
use App\HolidayType;

class HolidayTypeController extends Controller
{
    public $pagination = 10;
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $HolidayType = HolidayType::   
        with([
            'getBrand' => function ($query) {
                $query->select('id','name');
            }
        ])->orderBy('id', 'ASC');
        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $HolidayType->where(function($q) use($request){
                    $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhereHas('getBrand', function($query) use($request){
                        $query->where('name', 'like', '%'.$request->search.'%');
                    });
                });
            }
        }

        $data['holiday_types'] = $HolidayType->paginate($this->pagination);
        
        return view('holiday_types.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['brands'] = Brand::get();
        return view('holiday_types.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HolidayTypeRequest $request)
    {
        HolidayType::create($request->all());

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Holiday Type Created Successfully.',
            'redirect_url'    => route('holiday_types.index') 
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
        $data['holiday_type'] = HolidayType::findOrFail(decrypt($id));
        $data['brands'] = Brand::get();
        return view('holiday_types.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HolidayTypeRequest $request, $id)
    {
        HolidayType::findOrFail(decrypt($id))->update($request->all());

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Holiday Type Updated Successfully.',
            'redirect_url'    => route('holiday_types.index') 
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
        $holidaytype = HolidayType::findOrFail(decrypt($id));
        try
        {
            $holidaytype->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Holiday Type Deleted Successfully.',
                'redirect_url'    => route('holiday_types.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Holiday Type can not be deleted beacuse it is associated one or more record.',
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
                DB::table("holiday_types")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Holiday Type Deleted Successfully.";
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
