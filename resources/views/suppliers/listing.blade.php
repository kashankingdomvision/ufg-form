@extends('layouts.app')
@section('title','View Supplier')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>View Supplier</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item active">Supplier Managment</li>
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
                    <div class="row">
                        <button type="button" class="btn btn-tool m-0 text-dark  col-md-10" data-card-widget="collapse">
                            <div class="card-header">
                              <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters</b></h3>
                            </div>
                        </button>
          
                        <div class="float-right col-md-2">
                            <a href="{{ route('suppliers.create') }}" class="btn btn-secondary btn-sm  m-12 float-right">
                                <span class="fa fa-plus"></span>
                                <span>Add New</span>
                            </a>
                        </div>
                      </div>
                    <div class="card-body">
                        <form method="get" action="{{ route('suppliers.index') }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Search</label>
                                            <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control select2single" name="category">
                                                <option value="">Select Category </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->name }}" {{ (old('category') == $category->name)? 'selected' :((request()->get('category') == $category->name)? 'selected' : null ) }}>{{ $category->name }}</option>
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
                                                    <option value="{{ $currency->name }}" data-image="data:image/png;base64, {{$currency->flag}}" {{ (old('currency') == $currency->name)? 'selected' :((request()->get('currency') == $currency->name)? 'selected' : null ) }}> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                                <a href="{{ route('suppliers.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="content p-2">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                    <a href="" id="delete_all" class="btn btn-danger btn-sm ">
                        <span class="fa fa-trash"></span> &nbsp;
                        <span>Delete Selected Record</span>
                    </a>
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
                                <h3 class="card-title">Supplier List</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped  table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="icheck-primary">
                                                      <input type="checkbox" class="parent">
                                                    </div>
                                                </th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact No</th>
                                                <th>Currency</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($suppliers && $suppliers->count())
                                            @foreach ($suppliers as $key => $supplier)
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                      <input type="checkbox" class="child" value="{{$supplier->id}}" >
                                                    </div>
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $supplier->name }}</td>
                                                <td>{{ $supplier->email }}</td>
                                                <td>{{ $supplier->phone }}</td>
                                                <td>{{ $supplier->getCurrency->name??NULL }}</td>
                                                <td class="d-flex">
                                                <form method="post" action="{{ route('suppliers.destroy', encrypt($supplier->id)) }}">
                                                <a  href="{{ route('suppliers.edit', encrypt($supplier->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                                <a class="mr-2  btn btn-outline-info btn-xs" href="{{ route('suppliers.show', encrypt($supplier->id)) }}" title="View"><i class="fa fa-fw fa-eye"></i></a>
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

                            @include('includes.multiple_delete',['table_name' => 'suppliers'])

                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                  {{ $suppliers->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
