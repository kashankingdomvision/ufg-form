<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommissionGroupRequest;
use App\Http\Requests\UpdateCommissionGroupRequest;

use App\CommissionGroup;
use App\Commission;
use App\Group;

class CommissionGroupController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $commission_group = CommissionGroup::orderBy('id', 'ASC');

        if(count($request->all()) > 0){
            
            if($request->has('search') && !empty($request->search)){
                $commission_group->where('name', 'like', '%'.$request->search.'%' );
            }
        }

        $data['commission_groups'] = $commission_group->paginate($this->pagination);

        return view('commission_groups.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('commission_groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommissionGroupRequest $request)
    {
        CommissionGroup::create([
            'name'          => $request->name
        ]);

        return response()->json(['status' => true, 'success_message' => 'Commission Group Created Successfully.']);
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
        $data['commission_group'] = CommissionGroup::find(decrypt($id));

        return view('commission_groups.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommissionGroupRequest $request, $id)
    {
        CommissionGroup::find(decrypt($id))->update([
            'name'          => $request->name
        ]);

        return response()->json(['status' => true, 'success_message' => 'Commission Group Updated Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CommissionGroup::destroy(decrypt($id));
        return redirect()->route('commission_group.index')->with('success_message', 'Commission Group Deleted Successfully'); 
    }
}
