<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BookingMethod;
class BookingMethodController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookingMethod = BookingMethod::orderBy('id', 'ASC');
        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $bookingMethod->where('name', 'like', '%'.$request->search.'%');
            }
        }
        $data['booking_methods'] = $bookingMethod->paginate($this->pagination);
        return view('booking_methods.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        BookingMethod::create($request->all());
        return redirect()->route('setting.booking_methods.index')->with('success_message', 'Booking method created successfully'); 
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['booking_method'] = BookingMethod::findOrFail(decrypt($id));
        return view('booking_methods.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string']);
        BookingMethod::findOrFail(decrypt($id))->update($request->all());
        return redirect()->route('setting.booking_methods.index')->with('success_message', 'Booking method updated successfully'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BookingMethod::destroy(decrypt($id));
        return redirect()->route('setting.booking_methods.index')->with('success_message', 'Booking method deleted successfully'); 
        
    }
}
