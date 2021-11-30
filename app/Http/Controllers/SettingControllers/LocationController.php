<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\UpdateLocationRequest;

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

        return redirect()->route('setting.locations.index')->with('success_message', 'Location created successfully');
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

        return redirect()->route('setting.locations.index')->with('success_message', 'Location updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::destroy(decrypt($id));
        return redirect()->route('setting.locations.index')->with('success_message', 'Location deleted successfully');
    }
}
