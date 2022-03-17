<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AirportCodeRequest;
use App\Http\Requests\UpdateAirportCodeRequest;
use Illuminate\Support\Facades\DB;

use App\AirportCode;

class AirportCodeController extends Controller
{
    public $pagination = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = AirportCode::orderBy('id', 'ASC');

        if(count($request->all()) > 0){
            $query = $this->searchFilters($query, $request);
        }

        $data['airport_codes'] = $query->paginate($this->pagination);

        return view('airport_codes.listing',$data);
    }

    public function searchFilters($query, $request)
    {
        if($request->has('search') && !empty($request->search)){
            $query->where('name', 'like', '%'.$request->search.'%');
            $query->orWhere('iata_code', 'like', '%'.$request->search.'%');
        }

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('airport_codes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AirportCodeRequest $request)
    {
        AirportCode::create([
            'name'      => $request->name,
            'iata_code' => $request->iata_code
        ]);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Airport Created Successfully.',
            'redirect_url'    => route('airport_codes.index') 
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
        $data['airport_code'] = AirportCode::find(decrypt($id));

        return view('airport_codes.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAirportCodeRequest $request, $id)
    {
        AirportCode::find(decrypt($id))->update([
            'name'      => $request->name,
            'iata_code' => $request->iata_code
        ]);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Airport Updated Successfully.',
            'redirect_url'    => route('airport_codes.index') 
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
        AirportCode::destroy(decrypt($id));

        return redirect()->route('airport_codes.index')->with('success_message', 'Airport deleted successfully'); 
    }

    public function bulkAction(Request $request)
    {
        try {

            $message = "";
            $bulk_action_ids  = $request->bulk_action_ids;
            $bulk_action_type = $request->bulk_action_type;
            $bulk_action_ids  = explode(",", $bulk_action_ids);
    
            if($bulk_action_type == 'delete'){
                DB::table("airport_codes")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Airports Deleted Successfully.";
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
