<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Carbon;
use App\Brand;
use App\Currency;
use App\Role;
use App\User;

class ReportController extends Controller
{
    public function user_report(Request $request){

        $data['roles']      = Role::orderBy('name', 'ASC')->get();
        $data['brands']     = Brand::orderBy('id', 'ASC')->get();
        $data['currencies'] = Currency::where('status', 1)->orderBy('name', 'ASC')->get();
        
        $user = User::orderBy('id', 'ASC');

        if (!empty($request->all())) {
           

            if ($request->has('role') && !empty($request->role)) {
                $user = $user->whereHas('getRole', function ($q) use($request) {
                    $q->where('id', $request->role);
                });
            }

            if ($request->has('currency') && !empty($request->currency)) {
                $user = $user->whereHas('getCurrency', function ($q) use($request) {
                    $q->where('id', $request->currency);
                });
            }

            if ($request->has('brand') && !empty($request->brand)) {
                $user = $user->whereHas('getBrand', function ($q) use($request) {
                    $q->where('id', $request->brand);
                });
            }

            if($request->has('dates') && !empty($request->dates)){

                $dates = explode ("-", $request->dates); 

                $start_date = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d');
                $end_date   = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d');

                $user->whereDate('created_at', '>=', $start_date);
                $user->whereDate('created_at', '<=', $end_date);
            }

            if($request->has('month') && !empty($request->month)){
                $user = $user->whereMonth('created_at', $request->month);
            }

            if($request->has('year') && !empty($request->year)){
                $user = $user->whereYear('created_at', $request->year);
            }
           
        }

        $data['users'] = $user->get();

        return view('reports.user_report', $data);
    }

}
