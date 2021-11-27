<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HotelRequest;
use App\Http\Requests\UpdateHotelRequest;

use App\Hotel;

class HotelController extends Controller
{
    public $pagination = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Hotel::orderBy('id', 'ASC');

        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $query->where('name', 'like', '%'.$request->search.'%');
            }
        }

        $data['hotels'] = $query->paginate($this->pagination);

        return view('hotels.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelRequest $request)
    {
        Hotel::create([
            'name'       =>  $request->name,
            'accom_code' =>  $request->accom_code
        ]);

        return redirect()->route('setting.hotels.index')->with('success_message', 'Hotel created successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['hotel'] = Hotel::find(decrypt($id));
        return view('hotels.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHotelRequest $request, $id)
    {
        Hotel::find(decrypt($id))->update([
            'name'       =>  $request->name,
            'accom_code' =>  $request->accom_code
        ]);

        return redirect()->route('setting.hotels.index')->with('success_message', 'Hotel updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hotel::destroy(decrypt($id));
        return redirect()->route('setting.hotels.index')->with('success_message', 'Hotel deleted successfully'); 
    }
}
