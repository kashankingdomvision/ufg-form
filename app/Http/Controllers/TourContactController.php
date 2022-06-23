<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTourContactRequest;
use App\Http\Requests\UpdateTourContactRequest;
use Illuminate\Support\Facades\DB;
use App\TourContact;

class TourContactController extends Controller
{
    public $pagination = 10;
        
    public function __CONSTRUCT()
    {
        # code...
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TourContact::orderBy('id', 'ASC');

        if(count($request->all()) > 0){
            $query = $this->searchFilters($query, $request);
        }

        $data['contacts'] = $query->paginate($this->pagination);
        return view('tour_contacts.listing',$data);
    }

    public function searchFilters($query, $request)
    {
        if($request->has('search') && !empty($request->search)){
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tour_contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTourContactRequest $request)
    {
        TourContact::create([
            'name'  =>  $request->name
        ]);
        
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Tour Contact Created Successfully.',
            'redirect_url'    => route('tour_contacts.index') 
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
        // dd($id);
        $data['contact'] = TourContact::findOrFail(decrypt($id));
        return view('tour_contacts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourContactRequest $request, $id)
    {
        $contact = TourContact::findOrFail(decrypt($id))->update([
            'name' => $request->name,
        ]);
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Tour Contact Updated Successfully.',
            'redirect_url'    => route('tour_contacts.index') 
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
        $tour_contact = TourContact::findOrFail(decrypt($id));
        try
        {
            $tour_contact->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Store Text Deleted Successfully.',
                'redirect_url'    => route('tour_contacts.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Tour Contact can not be deleted beacuse it is associated one or more record.',
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
                DB::table("tour_contacts")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Tour Contacts Deleted Successfully.";
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
