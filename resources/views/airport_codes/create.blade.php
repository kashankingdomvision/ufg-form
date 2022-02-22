@extends('layouts.app')

@section('title','Add Airport')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Add Airport</h4></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Airports</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card card-outline card-base">
            <div class="card-header">
              <h3 class="card-title text-center">Airport Form</h3>
            </div>

            <form method="POST" id="store_airport_code" action="{{ route('airport_codes.store') }}">
              @csrf

              <div class="card-body">
                <div class="form-group">
                  <label>Airport Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Airport Name">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>IATA Code <span style="color:red">*</span></label>
                  <input type="text" name="iata_code" id="iata_code" class="form-control" placeholder="IATA Code">
                  <span class="text-danger" role="alert"></span>
                </div>
              </div>


              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('airport_codes.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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
  <script src="{{ asset('js/setting.js') }}" ></script>
@endpush
