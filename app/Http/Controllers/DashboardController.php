<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
// use Illuminate\View\View;
use App\Booking;
use App\Quote;
use App\User;
use App\Supplier;
use App\QuoteUpdateDetail;
use DB;
use Auth;

use Illuminate\Support\Facades\View;
use PDF;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        
        $data['booking'] = Booking::count();
        $data['quote']   = Quote::where('booking_status', 'quote')->count();
        $data['users']   = User::count();
        $data['supplier']= Supplier::count();
        
        return view('home',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function multiple_delete(Request $request,$id)
    {
        $ids = explode(",", $id);
        $table_name = $request->tableName;
        DB::table($table_name)->whereIn('id', $ids)->delete(); 

        return ['status' => true, 'message' => 'Records Deleted Successfully !!'];
    }

    public function has_user_edit(Request $request,$id)
    {
        QuoteUpdateDetail::where('foreign_id',decrypt($id))->where('user_id',Auth::id())->where('status',$request->status)->delete();
    }

    public function update_override(Request $request,$id)
    {
        QuoteUpdateDetail::where("foreign_id", decrypt($id))->where("status", $request->status)->update([ "user_id" => $request->user_id ]);
        return \Response::json(['success_message' => 'User Updated'], 200);
    }


}
