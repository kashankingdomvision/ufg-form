@extends('layouts.app')
@section('title','View User')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>View User</h4>
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
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default {{ (request()->has('search'))? '' : 'collapsed-card' }}">
                    <button type="button" class="btn btn-tool m-0 text-dark" data-card-widget="collapse">
                        <div class="card-header">
                          <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters</b></h3>
                          <div class="card-tools">
                              <i class="fas fa-{{ (request()->has('search'))? 'minus' : 'plus' }}"></i>
                          </div>
                        </div>
                    </button>
        
                    <div class="card-body">
                        <form method="get" action="{{ route('users.index') }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Search</label>
                                    <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
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
                            </div>
                        </div>
    
                        <div class="row mt-1">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
                            </div>
                        </div>
    
                    </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">User List</h3>
                            </div>

                            <div class="card-header">
                                <h3 class="card-title float-left">
                                  <a href="" id="delete_all" class="btn btn-danger btn-xs btn-sm float-right">
                                    <span class="fa fa-trash"></span> &nbsp;
                                    <span>Delete Selected Record</span>
                                  </a>
                                </h3>
                                <a href="{{ route('users.create') }}" class="btn btn-secondary btn-sm float-right">
                                    <span class="fa fa-plus"></span>
                                    <span>Add New</span>
                                </a>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="icheck-primary">
                                                      <input type="checkbox" class="parent">
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
                                                        <div class="icheck-primary">
                                                        <input type="checkbox" class="child" value="{{$value->id}}" >
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
                                                    {{-- <a href="{{ route('users.delete', encrypt($value->id)) }}" title="Delete"><i class="fa fa-fw fa-trash text-danger"></i></a> --}}
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

                            @include('includes.multiple_delete',['table_name' => 'users'])

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
