@extends('layouts.app')
@section('title','View Holiday Types')
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>View Holiday Type <x-add-new-button :route="route('holiday_types.create')" /> </h4>
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Holiday Type</li>
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
  
  <x-page-filters :route="route('holiday_types.index')">
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
              <h3 class="card-title float-left">
                Holiday Type List
              </h3>
            </div>

            <!-- Multi Actions -->
            <div class="card-header">
              <div class="row justify-content-between">
                <form method="POST" id="holiday_type_bulk_action" action="{{ route('holiday_types.bulk.action') }}" >
                  @csrf
                  <input type="hidden" name="bulk_action_type" value="">
                  <input type="hidden" name="bulk_action_ids" value="">

                  <div class="dropdown show btn-group">
                    <button type="button" class="btn btn-base btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Action
                    </button>
                    <div class="dropdown-menu">
                      <button type="button" data-action_type="delete" class="dropdown-item holiday-type-bulk-action-item"><i class="fa fa-trash text-red mr-2"></i>Delete</button>
                    </div>
                  </div>
                </form>

                <button id="fetch_holiday_types" class="btn btn-base" type="button">
                  <span class="fas fa-sync" role="status" aria-hidden="true"></span>
                  Fetch Holiday Types
                </button>
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
                    <th>Holiday Type</th>
                    <th>Brand</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if($holiday_types && $holiday_types->count())
                    @foreach ($holiday_types as $value)
                      <tr>
                        <td>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="child_{{$value->id}}" value="{{$value->id}}" class="child custom-control-input custom-control-input-success custom-control-input-outline">
                            <label for="child_{{$value->id}}" class="custom-control-label"></label>
                          </div>
                        </td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->getBrand->name ?? NULL }}</td>
                        <td class="d-flex justify-content-center ml-2">
                          <a href="{{ route('holiday_types.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                          <form method="post" action="{{ route('holiday_types.destroy', encrypt($value->id)) }}" class="delete-holiday-type">
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
                {{ $holiday_types->links() }}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('holiday_types.includes.store_holiday_types_modal')
</div>
@endsection
@push('js')
  <script src="{{ asset('js/setting.js') }}" ></script>
@endpush
 {{-- @include('includes.multiple_delete',['table_name' => 'holiday_types']) --}}


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