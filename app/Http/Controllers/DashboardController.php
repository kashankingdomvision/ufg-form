<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Helper;
use PDF;

use App\Booking;
use App\Quote;
use App\QuoteUpdateDetail;
use App\Supplier;
use App\User;
use App\ReferenceCredential;

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

    public function refresh_token()
    {
        $zoho_credentials = ReferenceCredential::find(1);
        $refresh_token    = $zoho_credentials->refresh_token;
        $url = "https://accounts.zoho.com/oauth/v2/token?refresh_token=" . $refresh_token . "&client_id=1000.0VJP33J6LLOQ63896U88RWYIVJRSFD&client_secret=81212149f53ee4039b280b420835d64b8443c96a83&grant_type=refresh_token";
        $args = array('ssl' => false, 'format' => 'ARRAY');
        $response = Helper::cf_remote_request($url, $args);

        if ($response && $response['status'] == 200) {
            $body = $response['body'];
            $zoho_credentials->update(['access_token' => $body['access_token']]);
        }
        
        return "Token updated Successfully.";
    }

}
