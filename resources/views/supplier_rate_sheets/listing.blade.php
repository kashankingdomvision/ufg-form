


@extends('layouts.app')

@section('title','View Supplier Rate Sheet')

@section('content')

<div class="content-wrapper">
  
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>View Supplier Rate Sheet <x-add-new-button :route="route('supplier_rate_sheets.create')" /> </h4>
          </div>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Supplier Managment</a></li>
            <li class="breadcrumb-item active">Supplier Rate Sheet </li>
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
  
  <x-page-filters :route="route('supplier_rate_sheets.index')">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Supplier</label>
          <select class="form-control select2single" name="supplier_id">
            <option value="">Select Supplier </option>
            @foreach ($suppliers as $supplier)
              <option value="{{ $supplier->id }}" {{ request()->get('supplier_id') == $supplier->id  ? 'selected' : ''   }}>{{ $supplier->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label>Booking Season</label>
          <select class="form-control select2single" name="season_id">
            <option value="">Select Season </option>
            @foreach ($booking_seasons as $booking_season)
              <option value="{{ $booking_season->id }}" {{ request()->get('season_id') == $booking_season->id ? 'selected' : ''   }}>{{ $booking_season->name }}</option>
            @endforeach
          </select>
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
                Supplier Rate List
              </h3>
            </div>
            
            <!-- Multi Actions -->
            <div class="card-header">
              <div class="row">
              <form method="POST" id="supplier_rate_sheet_bulk_action" action="{{ route('supplier_rate_sheets.bulk.action') }}" >
                  @csrf
                  <input type="hidden" name="bulk_action_type" value="">
                  <input type="hidden" name="bulk_action_ids" value="">

                  <div class="dropdown show btn-group">
                  <button type="button" class="btn btn-base btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Action
                  </button>
                  <div class="dropdown-menu">
                      <button type="button" data-action_type="delete" class="dropdown-item supplier-rate-sheet-bulk-action-item"><i class="fa fa-trash text-red mr-2"></i>Delete</button>
                  </div>
                  </div>
              </form>
              </div>
            </div>
            <!-- End Multi Actions -->

            <div class="card-body p-0" id="listing_card_body">
              <div class="table-responsive">
                <table class="table table-hover text-nowrap text-nowrap">
                  <thead>
                    <tr>
                      <th>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="parent custom-control-input custom-control-input-success custom-control-input-outline" id="parent">
                          <label for="parent" class="custom-control-label"></label>
                        </div>
                      </th>
                      <th class="text-center">Supplier</th>
                      <th class="text-center">Season</th>
                      <th class="text-center">Rate Sheet</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @if($supplier_rate_sheets && $supplier_rate_sheets->count())
                      @foreach ($supplier_rate_sheets as $supplier_rate_sheet)
                        <tr>
                          <td>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" id="child_{{$supplier_rate_sheet->id}}" value="{{$supplier_rate_sheet->id}}" class="child custom-control-input custom-control-input-success custom-control-input-outline">
                              <label for="child_{{$supplier_rate_sheet->id}}" class="custom-control-label"></label>
                            </div>
                          </td>

                          <td class="text-center">{{ isset($supplier_rate_sheet->getSupplier->name) && !empty($supplier_rate_sheet->getSupplier->name) ? $supplier_rate_sheet->getSupplier->name : '' }}</td>
                          <td class="text-center">{{ isset($supplier_rate_sheet->getSeason->name) && !empty($supplier_rate_sheet->getSeason->name) ? $supplier_rate_sheet->getSeason->name : '' }}</td>
                          <td class="text-center">
                            @if (pathinfo($supplier_rate_sheet->file, PATHINFO_EXTENSION) == 'pdf')
                              <a href="{{ $supplier_rate_sheet->image_path }}" target="_blank" > View Rate Sheet </a>
                            @endif

                            @if (pathinfo($supplier_rate_sheet->file, PATHINFO_EXTENSION) == 'png' || pathinfo($supplier_rate_sheet->file, PATHINFO_EXTENSION) == 'jpg')
                              <a href="{{ $supplier_rate_sheet->image_path }}" target="_blank" > View Rate Sheet </a>
                              {{-- <img src="{{ $supplier_rate_sheet->image_path }}" height="70" width="70" class="rounded mx-auto d-block" alt="Rate Sheet"> --}}
                            @endif
                          </td>

                          <td class="text-center">
                            <form method="post" action="{{ route('supplier_rate_sheets.destroy', encrypt($supplier_rate_sheet->id)) }}">
                              <a href="{{ route('supplier_rate_sheets.edit', encrypt($supplier_rate_sheet->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
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
                {{ $supplier_rate_sheets->links() }}
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
  </section> --}}
{{-- @include('includes.multiple_delete',['table_name' => 'supplier_rate_sheets']) --}}
