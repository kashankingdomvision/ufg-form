<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Brand;
use App\Currency;
use App\Role;
use App\Group;
use App\CommissionGroup;
use App\User;
use App\Commission;

class UserController extends Controller
{
    public $pagination = 10;

    public function index(Request $request)
    {
        $user = User::select([
            'id',
            'role_id',
            'name',
            'email',
            'currency_id',
            'brand_id',
            'supervisor_id'
        ])
        ->with([
            'getRole',
            'getCurrency',
            'getBrand',
            'getSupervisor'
        ]) 
        ->orderBy('id', 'ASC');

        if (count($request->all()) > 0) {
            $user = $this->searchFilters($user, $request);
        }

        $data['users']      = $user->paginate($this->pagination);
        $data['roles']      = Role::orderBy('id', 'ASC')->get(['id','name'])->sortBy('name');
        $data['currencies'] = Currency::active()->orderBy('id', 'ASC')->get(['id','name','code','flag','status']);
        $data['brands']     = Brand::orderBy('id', 'ASC')->get(['id','name']);

        return view('users.listing', $data);
    }

    // public function index(Request $request)
    // {
    //     $user = User::orderBy('id', 'ASC');

    //     if (count($request->all()) > 0) {
    //         $user = $this->searchFilters($user, $request);
    //     }
        
    //     $data['users']      = $user->paginate($this->pagination);
    //     $data['roles']      = Role::orderBy('name', 'ASC')->get();
    //     $data['currencies'] = Currency::active()->orderBy('id', 'ASC')->get();
    //     $data['brands']     = Brand::orderBy('id', 'ASC')->get();

    //     return view('users.listing', $data);
    // }

    // ->with([
    //     'getRole' => function ($query) {
    //         $query->select('id','name');
    //     },
    //     'getCurrency' => function ($query) {
    //         $query->select('id','name');
    //     },
    //     'getBrand' => function ($query) {
    //         $query->select('id','name');
    //     },
    //     'getSupervisor' => function ($query) {
    //         $query->select('id','name');
    //     },
    // ]) 

    
    public function searchFilters($user, $request)
    {
        if ($request->has('search') && !empty($request->search)) {

            $user = $user->where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%')
                    ->orWhereHas('getBrand', function ($query) use($request) {
                        $query->where('name', 'like', '%'.$request->search.'%');
                    })
                    ->orWhereHas('getSupervisor', function ($query) use($request) {
                        $query->where('name', 'like', '%'.$request->search.'%');
                    });
            });
        }
                         
        if ($request->has('role') && !empty($request->role)) {
            $user = $user->whereHas('getRole', function ($query) use ($request) {
                $query->where('id', $request->role);
            });
        }

        if ($request->has('currency') && !empty($request->currency)) {
            $user = $user->whereHas('getCurrency', function ($query) use ($request) {
                $query->where('id', $request->currency);
            });
        }

        if ($request->has('brand') && !empty($request->brand)) {
            $user = $user->whereHas('getBrand', function ($query) use ($request) {
                $query->where('id', $request->brand);
            });
        }

        return $user;
    }

    public function userArray($request, $method)
    {
        $data = [
            
            'name'                  => $request->name,
            'email'                 => $request->email,
            'role_id'               => $request->role_id,
            'supervisor_id'         => $request->supervisor_id,
            'currency_id'           => $request->currency,
            'brand_id'              => $request->brand,
            'holiday_type_id'       => $request->holiday_type,
            'commission_id'         => $request->commission_id,
            'commission_group_id'   => $request->commission_group_id,
            'rate_type'             => $request->rate_type,
            'markup_type'           => $request->markup_type,
            'supplier_currency_id'  => $request->supplier_currency_id,
        ];

        if($method == 'store'){
            $data['password'] = Hash::make($request->password);
        }

        if($method == 'update'){
            
            if($request->has('password') && !empty($request->password)) {
                $data['password'] = Hash::make($request->password);
            }
        }
    
        return $data;
    }

    public function create()
    {
        $data['supervisors']       = User::role(['supervisor'])->get();
        $data['roles']             = Role::orderBy('id', 'ASC')->get()->sortBy('name');
        $data['currencies']        = Currency::active()->orderBy('id', 'ASC')->get();
        $data['brands']            = Brand::orderBy('id', 'ASC')->get();
        $data['commisions']        = Commission::orderBy('id', 'ASC')->get();
        $data['commission_groups'] = CommissionGroup::orderBy('id','ASC')->get();

        return view('users.create', $data);
    }

    // UserRequest
    public function store(UserRequest $request)
    {
        User::create($this->userArray($request, 'store'));

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'User Created Successfully.',
            'redirect_url'    => route('users.index') 
        ]);
    }

    public function edit($id, $status = null)
    {
        $data['user']              = User::findOrFail(decrypt($id));
        $data['roles']             = Role::orderBy('id', 'ASC')->get()->sortBy('name');
        $data['currencies']        = Currency::active()->orderBy('id', 'ASC')->get();
        $data['brands']            = Brand::orderBy('id', 'ASC')->get();
        $data['commisions']        = Commission::orderBy('id', 'ASC')->get();
        $data['commission_groups'] = CommissionGroup::orderBy('id','ASC')->get();
        $data['supervisors']       = User::role(['supervisor'])->get();
        $data['status']            = $status;
        
        return view('users.edit', $data);

    }

    public function update(UpdateUserRequest $request, $id, $status = null)
    {
        $user = User::find(decrypt($request->id))->update($this->userArray($request, 'update'));
        
        if($status == 'profile'){

            return response()->json([ 
                'status'          => true, 
                'success_message' => 'Profile Updated Successfully.',
                'redirect_url'    => route('users.index')
            ]);
        }

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'User Updated Successfully.',
            'redirect_url'    => route('users.index')
        ]);
    }

    public function delete($id)
    {
        $user = User::findOrFail(decrypt($id));

        if (count($user->getSaleAgent) > 0) {
            return redirect()->back()->with('error_message', 'You can not delete this user because it assosiated with more sales agent ');
        } else {
            $user->delete();
        }
        
        return redirect()->route('users.index')->with('success_message', 'User deleted successfully');
    }
    
    public function transfer_report_column(Request $request)
    {
        $collection = collect($request->all())->map(function ($item, $key) {
            return (boolean) json_decode(strtolower($item));
        });
        
        User::where('id' , Auth::id())->update(['column_preferences' => json_encode($collection) ]);

        return \Response::json(['status' => true, 'success_message' => 'Column Preferences Updated']);
    }

    public function bulkAction(Request $request)
    {
        try {

            $message = "";
            $bulk_action_ids  = $request->bulk_action_ids;
            $bulk_action_type = $request->bulk_action_type;
            $bulk_action_ids  = explode(",", $bulk_action_ids);
    
            if($bulk_action_type == 'delete'){
                DB::table("users")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Users Deleted Successfully.";
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
