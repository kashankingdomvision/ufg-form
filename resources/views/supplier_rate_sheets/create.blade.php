

@extends('layouts.app')

@section('title','Add Supplier Rate')

@section('content')



<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Add Supplier Rate Sheet</h4></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item"><a>Supplier Managment</a></li>
              <li class="breadcrumb-item active">Add Supplier Rate Sheet</li>
            </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Supplier Rate Sheet Form</h3>
            </div>

            <form method="POST" id="store_supplier_rate_sheet" action="{{ route('supplier-rate-sheet.store') }}" accept-charset="UTF-8" enctype="multipart/form-data"> 
              @csrf

              <div class="card-body">
                <div class="form-group">
                  <label>Supplier <span style="color:red">*</span></label>
                  <select name="supplier_id" id="supplier_id" class="form-control select2single">
                    <option value="">Select Supplier</option>
                    @foreach ($suppliers as $supplier)
                      <option value="{{$supplier->id}}" >{{$supplier->name}}</option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div> 
      
                <div class="form-group">
                  <label>Season <span style="color:red">*</span></label>
                  <select name="season_id" id="season_id" class="form-control select2single" >
                    <option value="">Select Season</option>
                    @foreach ($booking_seasons as $booking_season)
                      <option value="{{$booking_season->id}}"> {{$booking_season->name}} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div> 

                <div class="form-group">
                  <label>Rate Sheet <span style="color:red">*</span></label>
                  <input name="file" id="file" type="file" class="form-control" >
                  <span class="text-danger" role="alert"></span>
                </div> 
              </div>
            
              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
                <a href="{{ route('supplier-rate-sheet.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
              </div>
            </form>

            <div id="overlay" class=""></div>
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
