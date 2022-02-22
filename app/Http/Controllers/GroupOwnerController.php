<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\GroupOwnerRequest;
use App\Http\Requests\UpdateGroupOwnerRequest;
use Illuminate\Support\Facades\DB;

use App\GroupOwner;

class GroupOwnerController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = GroupOwner::orderBy('id', 'ASC');

        if(count($request->all()) > 0){

            if($request->has('search') && !empty($request->search)){
                $query->where('name', 'like', '%'.$request->search.'%');
            }
        }

        $data['group_owners'] = $query->paginate($this->pagination);

        return view('group_owners.listing', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group_owners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupOwnerRequest $request)
    {
        GroupOwner::create([
            'name'       => $request->name,
        ]);

        return response()->json([ 'status' => true, 'success_message' => 'Group Owner Created Successfully.' ]);
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
        $data['group_owners'] = GroupOwner::findOrFail(decrypt($id));

        return view('group_owners.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupOwnerRequest $request, $id)
    {
        GroupOwner::find(decrypt($id))->update([
            'name'       => $request->name,
        ]);

        return response()->json([ 'status' => true, 'success_message' => 'Group Owner Updated Successfully.' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GroupOwner::destroy(decrypt($id));
        return redirect()->route('group_owners.index')->with('success_message', 'Group Owner deleted successfully'); 
    }

    public function bulkAction(Request $request)
    {
        try {

            $message = "";
            $bulk_action_ids  = $request->bulk_action_ids;
            $bulk_action_type = $request->bulk_action_type;
            $bulk_action_ids  = explode(",", $bulk_action_ids);
    
            if($bulk_action_type == 'delete'){
                DB::table("group_owners")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Group Owner Deleted Successfully.";
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
