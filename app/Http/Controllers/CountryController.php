<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\CountryRequest;
use App\Http\Requests\UpdateCountryRequest;

use App\Country;

class CountryController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Country::orderBy('sort_order', 'ASC');

        if($request->filled('search')){
            $query->where('name', 'like', '%'.$request->search.'%');
            $query->orWhere('sort_order', 'like', '%'.$request->search.'%');
            $query->orWhere('phone', 'like', '%'.$request->search.'%');
        }

        $data['countries'] = $query->paginate($this->pagination);

        return view('countries.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(CountryRequest $request)
    {
        Country::create([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'sort_order' => $request->sort_order,
        ]);
        
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Country Created Successfully.',
            'redirect_url'    => route('countries.index') 
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
        $data['country'] = Country::find(decrypt($id));

        return view('countries.edit', $data);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, $id)
    {
        Country::findOrFail(decrypt($id))->update([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'sort_order' => $request->sort_order,
        ]);
        
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Country Updated Successfully.',
            'redirect_url'    => route('countries.index') 
        ]);
    }

    public function destroy($id)
    {
        $country = Country::findOrFail(decrypt($id));
        try
        {
            $country->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Country Deleted Successfully.',
                'redirect_url'    => route('countries.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Country can not be deleted beacuse it is associated one or more record.',
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
                DB::table("countries")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Country Deleted Successfully.";
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
