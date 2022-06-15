@extends('layouts.app')
@section('title','View Supplier')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex">
                            <h4>View Supplier <x-add-new-button :route="route('suppliers.create')" /> </h4>
                        </div>
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
        
        <x-page-filters :route="route('suppliers.index')">
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
                                <h3 class="card-title">Supplier List</h3>
                            </div>
                            <!-- Multi Actions -->
                            <div class="card-header">
                                <div class="row">
                                <form method="POST" id="supplier_bulk_action" action="{{ route('suppliers.bulk.action') }}" >
                                    @csrf
                                    <input type="hidden" name="bulk_action_type" value="">
                                    <input type="hidden" name="bulk_action_ids" value="">
                
                                    <div class="dropdown show btn-group">
                                    <button type="button" class="btn btn-base btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <button type="button" data-action_type="delete" class="dropdown-item supplier-bulk-action-item"><i class="fa fa-trash text-red mr-2"></i>Delete</button>
                                    </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                            <!-- End Multi Actions -->

                            <div class="card-body p-0" id="listing_card_body">
                                <div class="table-responsive">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="parent custom-control-input custom-control-input-success custom-control-input-outline" id="parent">
                                                        <label for="parent" class="custom-control-label"></label>
                                                    </div>
                                                </th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact No</th>
                                                <th>Currency</th>
                                                <th>Group Owner</th>
                                                <th>Country</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($suppliers && $suppliers->count())
                                            @foreach ($suppliers as $key => $supplier)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="child_{{$supplier->id}}" value="{{$supplier->id}}" class="child custom-control-input custom-control-input-success custom-control-input-outline">
                                                        <label for="child_{{$supplier->id}}" class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $supplier->name }}</td>
                                                <td>{{ $supplier->email }}</td>
                                                <td>{{ $supplier->phone }}</td>
                                                <td>{{ isset($supplier->getCurrency->name) && !empty($supplier->getCurrency->name) ? $supplier->getCurrency->code.' - '.$supplier->getCurrency->name : '' }}</td>
                                                <td>{{ isset($supplier->getGroupOwner->name) && !empty($supplier->getGroupOwner->name) ? $supplier->getGroupOwner->name : '' }}</td>
                                                <td class="d-inline">
                                                    @if(isset($supplier->getCountries) && count($supplier->getCountries) > 0 )
                                                        @foreach ($supplier->getCountries as $country)
                                                            <h6>
                                                                <span class="badge badge-info m-point-3">{{ $country->name }}</span>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="justify-content-center">
                                                    <a  href="{{ route('suppliers.edit', encrypt($supplier->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                                    <a class="mr-2  btn btn-outline-info btn-xs" href="{{ route('suppliers.show', encrypt($supplier->id)) }}" title="View"><i class="fa fa-fw fa-eye"></i></a>
                                                    <form method="post" action="{{ route('suppliers.destroy', encrypt($supplier->id)) }}" class="delete-supplier">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="mr-2  btn btn-outline-danger btn-xs" title="Delete">
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
@push('js')
  <script src="{{ asset('js/supplier_management.js') }}" ></script>
@endpush
{{-- <section class="content p-2">
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
   --}}

 {{-- @include('includes.multiple_delete',['table_name' => 'suppliers']) --}}
