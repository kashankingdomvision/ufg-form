<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\Support\Facades\DB;

use App\Country;
use App\Location;

class LocationController extends Controller
{
    public $pagination = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Location::orderBy('id', 'ASC');
        if(count($request->all()) > 0){

            if($request->has('search') && !empty($request->search)){
                $query->where('name', 'like', '%'.$request->search.'%');
            }
            
            if($request->has('country_id') && !empty($request->country_id)){
                $query->where('country_id', $request->country_id);
            }
        }

        $data['countries'] = Country::orderBy('sort_order', 'ASC')->get();
        $data['locations'] = $query->paginate($this->pagination);

        return view('locations.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['countries'] = Country::orderBy('sort_order', 'ASC')->get();

        return view('locations.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        Location::create([
            'country_id' => $request->country_id,
            'name'       => $request->name,
        ]);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Location Created Successfully.',
            'redirect_url'    => route('locations.index') 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['location']  = Location::findOrFail(decrypt($id));
        $data['countries'] = Country::orderBy('sort_order', 'ASC')->get();

        return view('locations.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, $id)
    {
        Location::find(decrypt($id))->update([
            'country_id' => $request->country_id,
            'name'       => $request->name,
        ]);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Location Updated Successfully.',
            'redirect_url'    => route('locations.index') 
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
        $location = Location::findOrFail(decrypt($id));
        try
        {
            $location->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message'         => 'Location Deleted Successfully.',
                'redirect_url'    => route('locations.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Location can not be deleted beacuse it is associated one or more record.',
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
                DB::table("locations")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Location Deleted Successfully.";
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
