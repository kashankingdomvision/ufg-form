<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommissionGroupRequest;

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
            
            if($request->has('commission_id') && !empty($request->commission_id)){
                $commission_group->where('commission_id', $request->commission_id );
            }

            if($request->has('group_id') && !empty($request->group_id)){
                $commission_group->where('group_id', $request->group_id );
            }

        }

        $data['commission_groups'] = $commission_group->paginate($this->pagination);
        $data['commissions']      = Commission::orderBy('id', 'ASC')->get();
        $data['groups']           = Group::orderBy('id', 'ASC')->get();

        return view('commission_groups.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['commissions'] = Commission::orderBy('id', 'ASC')->get();
        $data['groups']      = Group::orderBy('id', 'ASC')->get();

        return view('commission_groups.create', $data);
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
            'commission_id' => $request->commission_id,
            'group_id'      => $request->group_id,
            'percentage'    => $request->percentage
        ]);

        return redirect()->route('commissions.commission-group.index')->with('success_message', 'Commission Group created successfully');
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
        $data['commissions']      = Commission::orderBy('id', 'ASC')->get();
        $data['groups']           = Group::orderBy('id', 'ASC')->get();
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
    public function update(Request $request, $id)
    {
        CommissionGroup::find(decrypt($id))->update([
            'percentage' => $request->percentage
        ]);

        return redirect()->route('commissions.commission-group.index')->with('success_message', 'Commission Group updated successfully');
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
        return redirect()->route('commissions.commission-group.index')->with('success_message', 'Commission Group deleted successfully'); 
    }
}
