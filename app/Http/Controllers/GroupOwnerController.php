<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\GroupOwnerRequest;
use App\Http\Requests\UpdateGroupOwnerRequest;

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

        return redirect()->route('group_owners.index')->with('success_message', 'Group Owner created successfully'); 
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

        return redirect()->route('group_owners.index')->with('success_message', 'Group Owner updated successfully'); 
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
}
