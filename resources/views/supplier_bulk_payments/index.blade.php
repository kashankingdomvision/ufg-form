


@extends('layouts.app')

@section('title','View Supplier Bulk Payment')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>View Supplier Bulk Payment </h4>
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

  <section class="content">
    <form method="get" action="{{ route('supplier-rate-sheet.index') }}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
      
                    <div class="card card-default ">
                            <button type="button" class="btn btn-tool m-0 text-dark " data-card-widget="collapse">
                                <div class="card-header">
                                <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters &nbsp;<i class="fa fa-angle-down"></i></b></h3>
                                </div>
                            </button>
                        <div class="card-body">

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

                           
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                                        <a href="{{ route('supplier-rate-sheet.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
    
  
{{-- <x-page-filters :route="route('supplier-rate-sheet.index')"></x-page-filters> --}}

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
              <h3 class="card-title float-left">
                Supplier Bulk Payment List
              </h3>
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
                      <th class="text-center">Supplier</th>
                    </tr>
                  </thead>
                  <tbody>
                  {{-- @if($supplier_rate_sheets && $supplier_rate_sheets->count())
                    @foreach ($supplier_rate_sheets as $supplier_rate_sheet) --}}
                      <tr>
                     
                        <td></td>

                      </tr>
                    {{-- @endforeach
                  @else
                    <tr align="center"><td colspan="100%">No record found.</td></tr>
                  @endif --}}
                    
                  </tbody>
                </table>
              </div>
            </div>

            @include('includes.multiple_delete',['table_name' => 'supplier_rate_sheets'])

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
              </ul>
            </div>
            
          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
