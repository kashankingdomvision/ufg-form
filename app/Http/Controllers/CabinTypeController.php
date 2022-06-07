<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CabinType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CabinTypeRequest;
use App\Http\Requests\UpdateCabinTypeRequest;
use Illuminate\Support\Facades\DB;

class CabinTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $pagination = 10;

    public function index()
    {
        $data['cabins'] = CabinType::paginate($this->pagination);

        return view('cabins.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cabins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CabinTypeRequest $request)
    {
        CabinType::create([
            'name'  =>  $request->name
        ]);
        
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Cabin Type Created Successfully.',
            'redirect_url'    => route('cabins.index') 
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
        $data['cabin'] = CabinType::findOrFail(decrypt($id));

        return view('cabins.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCabinTypeRequest $request, $id)
    {
        $cabin = CabinType::findOrFail(decrypt($id))->update([
            'name' => $request->name,
        ]);
        
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Cabin Type Updated Successfully.',
            'redirect_url'    => route('cabins.index') 
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
        $cabin_type = CabinType::findOrFail(decrypt($id));
        try
        {
            $cabin_type->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Cabin Type Deleted Successfully.',
                'redirect_url'    => route('cabins.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Cabin type can not be deleted beacuse it is associated one or more record.',
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
                DB::table("cabin_types")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Cabins Deleted Successfully.";
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
