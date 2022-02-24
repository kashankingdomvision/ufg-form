@extends('layouts.app')
@section('title','View User')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h4>View User <x-add-new-button :route="route('users.create')" /> </h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item active">User Management</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-md-offset-3">
                    @include('includes.flash_message')
                </div>
            </div>
        </div>
    </section>
    
    <x-page-filters :route="route('users.index')">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Roles </label>
                    <select class="form-control select2single" name="role">
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ (old('search') == $role->id)? 'selected' :((request()->get('role') == $role->id)? 'selected' : null ) }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Brand</label>
                    <select class="form-control select2single" name="brand">
                        <option value="">Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ (old('search') == $brand->id)? 'selected' :((request()->get('brand') == $brand->id)? 'selected' : null ) }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Currency</label>
                    <select class="form-control select2single" name="currency">
                        <option value="">Select Currency</option>
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" data-image="data:image/png;base64, {{$currency->flag}}" {{ (old('search') == $currency->id)? 'selected' :((request()->get('currency') == $currency->id)? 'selected' : null ) }}> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Search</label>
                    <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
                </div>
            </div>
        </div>
    </x-page-filters>

    

        
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User List</h3>
                        </div>
                        <!-- Multi Actions -->
                        <div class="card-header">
                            <div class="row">
                                <form method="POST" id="user_bulk_action" action="{{ route('users.bulk.action') }}" >
                                @csrf
                                <input type="hidden" name="bulk_action_type" value="">
                                <input type="hidden" name="bulk_action_ids" value="">

                                <div class="dropdown show btn-group">
                                    <button type="button" class="btn btn-base btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <button type="button" data-action_type="delete" class="dropdown-item user-bulk-action-item"><i class="fa fa-trash text-red mr-2"></i>Delete</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Multi Actions -->

                        
                        <div class="card-body p-0" id="listing_card_body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="parent custom-control-input custom-control-input-success custom-control-input-outline" id="parent">
                                                    <label for="parent" class="custom-control-label"></label>
                                                </div>
                                            </th>
                                            <th>Name</th>
                                            <th>User Role</th>
                                            <th>Email</th>
                                            <th>Default Currency</th>
                                            <th>Default Brand</th>
                                            <th>Supervisor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($users && $users->count())
                                        @foreach ($users as $key => $value)
                                        <tr>
                                            <td>
                                                @if($value->getRole->id != 1)
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="child_{{$value->id}}" value="{{$value->id}}" class="child custom-control-input custom-control-input-success custom-control-input-outline">
                                                        <label for="child_{{$value->id}}" class="custom-control-label"></label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $value->name }}</td>
                                            <td style="text-transform: capitalize;">{{ $value->getRole->name ?? null }}
                                            <td>{{ $value->email }}</td>
                                            <td>{{ !empty($value->getCurrency->code) && !empty($value->getCurrency->name) ? $value->getCurrency->code . ' - ' . $value->getCurrency->name : null }}</td>
                                            <td>{{ $value->getBrand->name ?? null }}</td>
                                            <td>{{ $value->getSupervisor->name ?? null }}</td>
                                            <td>
                                                <form method="post" action="{{ route('users.delete', encrypt($value->id)) }}">
                                                <a href="{{ route('users.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('delete')
                                                    <button class="mr-2  btn btn-outline-danger btn-xs" title="Delete" onclick="return confirm('Are you sure want to Delete this record?');">
                                                        <span class="fa fa-trash"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr align="center"><td colspan="100%">No record found.</td></tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $users->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('js')
  <script src="{{ asset('js/user_management.js') }}"></script>
@endpush

{{-- <a href="{{ route('users.delete', encrypt($value->id)) }}" title="Delete"><i class="fa fa-fw fa-trash text-danger"></i></a> --}}
{{-- @include('includes.multiple_delete',['table_name' => 'users']) --}}
{{-- <section class="content p-2">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <a href="" id="delete_all" class="btn btn-danger btn-sm">
                <span class="fa fa-trash"></span> &nbsp;
                <span>Delete Selected Record</span>
            </a>
        </div>
        </div>
    </div>
</section> --}}