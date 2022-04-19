<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BookingMethod;
use App\Http\Requests\CreateBookingMethod;
use App\Http\Requests\UpdateBookingMethod;
use DB;
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
    public function store(CreateBookingMethod $request)
    {
        BookingMethod::create([
            'name'  =>  $request->name
        ]);
        
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Booking Method Created Successfully.',
            'redirect_url'    => route('booking_methods.index') 
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
        $data['booking_method'] = BookingMethod::findOrFail(decrypt($id));
        return view('booking_methods.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingMethod $request, $id)
    {
        $booking_method = BookingMethod::findOrFail(decrypt($id))->update([
            'name' => $request->name,
        ]);
        
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Booking Method Updated Successfully.',
            'redirect_url'    => route('booking_methods.index') 
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
        BookingMethod::destroy(decrypt($id));
        return redirect()->route('booking_methods.index')->with('success_message', 'Booking method deleted successfully'); 
        
    }

    public function bulkAction(Request $request)
    {
        try {

            $message = "";
            $bulk_action_ids  = $request->bulk_action_ids;
            $bulk_action_type = $request->bulk_action_type;
            $bulk_action_ids  = explode(",", $bulk_action_ids);
    
            if($bulk_action_type == 'delete'){
                DB::table("booking_methods")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Booking Methods Deleted Successfully.";
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
