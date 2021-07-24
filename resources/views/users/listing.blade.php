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
                    <div class="card-header">
                        <h3 class="card-title"><b>Filters</b></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-{{ (request()->has('search'))? 'minus' : 'plus' }}"></i>
                            </button>
                        </div>
                    </div>
        
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
                                            <select class="form-control" name="role">
                                                <option value="">Search with Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{ (old('search') == $role->id)? 'selected' :((request()->get('role') == $role->id)? 'selected' : null ) }}>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select class="form-control" name="brand">
                                                <option value="">Search with Brand Name</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ (old('search') == $brand->id)? 'selected' :((request()->get('brand') == $brand->id)? 'selected' : null ) }}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Currencys</label>
                                            <select class="form-control" name="currency">
                                                <option value="">Search with Currency</option>
                                                @foreach ($currencies as $currency)
                                                    <option value="{{ $currency->id }}" {{ (old('search') == $currency->id)? 'selected' :((request()->get('currency') == $currency->id)? 'selected' : null ) }}>{{ $currency->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="row mt-1">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Search</button>
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
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
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
                                            @foreach ($users as $key => $value)
                                            <tr>
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
                                                        <button class="mr-2  btn btn-outline-danger btn-xs" onclick="return confirm('Are you sure want to Delete this record?');">
                                                          <span class="fa fa-trash"></span>
                                                        </button>
                                                    </form>
                                                    {{-- <a href="{{ route('users.delete', encrypt($value->id)) }}" title="Delete"><i class="fa fa-fw fa-trash text-danger"></i></a> --}}
                                                </td>
                                            </tr>
                                            @endforeach
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
