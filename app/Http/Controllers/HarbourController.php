<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HarboursRequest;
use App\Http\Requests\UpdateHarboursRequest;
use Illuminate\Support\Facades\DB;
use App\Harbour;

class HarbourController extends Controller
{
    public $pagination = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Harbour::orderBy('id', 'ASC');

        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $query->where('name', 'like', '%'.$request->search.'%');
                $query->orWhere('port_id', 'like', '%'.$request->search.'%');
            }
        }

        $data['harbours'] = $query->paginate($this->pagination);

        return view('harbours.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('harbours.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HarboursRequest $request)
    {
        Harbour::create([
            'port_id' =>  $request->port_id,
            'name'    =>  $request->name
        ]);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Harbours, Train and POI Created Successfully.',
            'redirect_url'    => route('harbours.index') 
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
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['harbour'] = Harbour::find(decrypt($id));

        return view('harbours.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHarboursRequest $request, $id)
    {
        Harbour::find(decrypt($id))->update([
            'port_id' =>  $request->port_id,
            'name'    =>  $request->name
        ]);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Harbours, Train and POI Updated Successfully.',
            'redirect_url'    => route('harbours.index') 
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
        $harbour = Harbour::findOrFail(decrypt($id));
        try
        {
            $harbour->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Harbour Deleted Successfully.',
                'redirect_url'    => route('harbours.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Harbour can not be deleted beacuse it is associated one or more record.',
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
                DB::table("harbours")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Harbours, Train & POI Deleted Successfully.";
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
