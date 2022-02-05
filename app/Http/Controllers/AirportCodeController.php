<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AirportCodeRequest;
use App\Http\Requests\UpdateAirportCodeRequest;

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
            if($request->has('search') && !empty($request->search)){
                $query->where('name', 'like', '%'.$request->search.'%');
                $query->orWhere('iata_code', 'like', '%'.$request->search.'%');
            }
        }

        $data['airport_codes'] = $query->paginate($this->pagination);

        return view('airport_codes.listing',$data);
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

        return response()->json([ 'status' => true, 'success_message' => 'Airport created Successfully.' ]);
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

        return response()->json([ 'status' => true, 'success_message' => 'Airport Updated Successfully.' ]);
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
}
