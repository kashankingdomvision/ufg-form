@extends('layouts.app')

@section('title','Add Hotels')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Add Hotels</h4></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Hotels</li>
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
              <h3 class="card-title text-center">Hotel Form</h3>
            </div>

            <form method="POST" id="store_hotel" action="{{ route('hotels.store') }}">
              @csrf

              <div class="card-body">
                <div class="form-group">
                  <label>Accommodation Code <span style="color:red">*</span></label>
                  <input type="text" name="accom_code" id="accom_code" class="form-control" placeholder="Accommodation Code">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Hotel Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Hotels Name">
                  <span class="text-danger" role="alert"></span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('hotels.index') }}" class="btn btn-danger float-right  mr-2">Cancel</a>
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