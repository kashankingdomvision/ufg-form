<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Role;

class RoleController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $roles = Role::orderBy('id', 'ASC');

        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $roles = $roles->where('name', 'like', '%'.$request->search.'%');
            }
        }

        $data['roles'] = $roles->paginate($this->pagination);

        return view('roles.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), 
        ]);

        return response()->json([ 'status' => true, 'success_message' => 'Role Created Successfully.' ]);
    }

    public function edit($id)
    {
        $data['role'] = Role::findOrFail(decrypt($id));

        return view('roles.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::findOrFail(decrypt($id))->update([

            'name' => $request->name,
            'slug' => Str::slug($request->name), 
        ]);

        return response()->json([ 'status' => true, 'success_message' => 'Role Updated Successfully.' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::destroy(decrypt($id));
        return redirect()->route('roles.index')->with('success_message', 'Role deleted successfully');
    }
}
