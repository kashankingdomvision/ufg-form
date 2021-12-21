<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
    public function __CONSTRUCT()
    {

    }

    public function index(Request $request)
    {
        $user = User::orderBy('id', 'ASC');
        if (count($request->all()) > 0) {
            if ($request->has('search') && !empty($request->search)) {
                $user = $user->where(function ($query) use($request) {
                    $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%')
                    ->orWhereHas('getBrand', function ($query) use($request) {
                        $query->where('name', 'like', '%'.$request->search.'%');
                    })->orWhereHas('getSupervisor', function ($query) use($request) {
                        $query->where('name', 'like', '%'.$request->search.'%');
                    });
                });
            }
                             
            if ($request->has('role') && !empty($request->role)) {
                $user = $user->whereHas('getRole', function ($q) use($request) {
                    $q->where('id', $request->role);
                });
            }
            if ($request->has('currency') && !empty($request->currency)) {
                $user = $user->whereHas('getCurrency', function ($q) use($request) {
                    $q->where('id', $request->currency);
                });
            }
            if ($request->has('brand') && !empty($request->brand)) {
                $user = $user->whereHas('getBrand', function ($q) use($request) {
                    $q->where('id', $request->brand);
                });
            }
        }
        
        $data['users'] = $user->paginate($this->pagination);
        $data['roles']      = Role::orderBy('name', 'ASC')->get();
        $data['currencies'] = Currency::where('status', 1)->orderBy('name', 'ASC')->get();
        $data['brands']     = Brand::orderBy('id', 'ASC')->get();
        return view('users.listing', $data);
    }

    public function create()
    {
        $data['supervisors'] = User::whereHas('getRole', function ($query) {
            $query->where('slug', 'supervisor');
        })->orderBy('name', 'ASC')->get();

        $data['roles']             = Role::orderBy('name', 'ASC')->get();
        $data['currencies']        = Currency::where('status', 1)->orderBy('name', 'ASC')->get();
        $data['brands']            = Brand::orderBy('id', 'ASC')->get();
        $data['commisions']        = Commission::orderBy('id', 'ASC')->get();
        $data['commission_groups'] = CommissionGroup::orderBy('id','ASC')->get();

        return view('users.create', $data);
    }

    public function store(UserRequest $request)
    {
        $request->validate(['password' => 'required|min:8', 'email' => 'unique:users']);

        User::create([
            'name'                => $request->name,
            'email'               => $request->email,
            'role_id'             => $request->role,
            'password'            => Hash::make($request->password),
            'supervisor_id'       => $request->supervisor_id,
            'currency_id'         => $request->currency,
            'brand_id'            => $request->brand,
            'holiday_type_id'     => $request->holiday_type,
            'commission_id'       => $request->commission_id,
            'commission_group_id' => $request->commission_group_id,
            'rate_type'           => $request->rate_type,
            'markup_type'         => $request->markup_type,
        ]);

        return redirect()->route('users.index')->with('success_message', 'User created successfully');
    }
    public function edit($id, $status = null)
    {
        $data['user']              = User::findOrFail(decrypt($id));
        $data['roles']             = Role::orderBy('name', 'ASC')->get();
        $data['currencies']        = Currency::where('status', 1)->orderBy('name', 'ASC')->get();
        $data['brands']            = Brand::orderBy('id', 'ASC')->get();
        $data['commisions']        = Commission::orderBy('id', 'ASC')->get();
        $data['commission_groups'] = CommissionGroup::orderBy('id','ASC')->get();
        $data['supervisors']       = User::whereHas('getRole', function ($query) {
            $query->where('slug', 'supervisor');
        })->orderBy('name', 'ASC')->get();

        $data['status']     = $status;
        
        return view('users.edit', $data);

    }

    public function update(UpdateUserRequest $request, $id, $status = null )
    {
        $user = User::findOrFail(decrypt($id));
        
        $data = [
            'name'                => $request->name,
            'email'               => $request->email,
            'supervisor_id'       => $request->supervisor_id,
            'currency_id'         => $request->currency,
            'brand_id'            => $request->brand,
            'holiday_type_id'     => $request->holiday_type,
            'commission_id'       => $request->commission_id,
            'commission_group_id' => $request->commission_group_id,
            'rate_type'           => $request->rate_type,
            'markup_type'         => $request->markup_type,
        ];
        if($request->has('role') && $request->role){
            $data['role_id']  = $request->role;
        }

        if ($request->has('password') && !empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        if($status == 'profile'){
            return redirect()->route('dashboard.index')->with('success_message', 'profile updated successfully');
        }
        return redirect()->route('users.index')->with('success_message', 'User updated successfully');
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
        $column_preferences = json_encode($request->all());
        User::where('id' , Auth::id())->update(['column_preferences' => $column_preferences ]);

        return \Response::json(['status' => true, 'success_message' => 'Column Preferences Updated']);
    }
}
