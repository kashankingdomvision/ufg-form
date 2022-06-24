<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Role Created Successfully.',
            'redirect_url'    => route('roles.index') 
        ]);
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

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Role Updated Successfully.',
            'redirect_url'    => route('roles.index') 
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
        $role = Role::findOrFail(decrypt($id));
        try
        {
            $role->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Role Deleted Successfully.',
                'redirect_url'    => route('roles.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Role can not be deleted beacuse it is associated one or more record.',
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
                DB::table("roles")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Role Deleted Successfully.";
            }
    
            return response()->json([ 
                'status'  => true, 
                'message' => $message,
            ]);
          
        } catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Role can not be deleted beacuse it is associated one or more record.',
                ]);
            }
        }
    }
}
