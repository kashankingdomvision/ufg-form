@extends('layouts.app')

@section('title','Add Holiday Type')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Add Holiday Type</h4></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Holiday Type</li>
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
              <h3 class="card-title text-center">Holiday Type Form</h3>
            </div>

            <form method="POST" id="store_holiday_type" action="{{ route('holiday_types.store') }}" >
              @csrf

              <div class="card-body">
                <div class="form-group">
                  <label>Holiday Type Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Holiday Type Name">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Brand <span style="color:red">*</span></label>
                  <select name="brand_id" id="brand_id" class="form-control select2single">
                    <option value="">Select Brand</option>
                    @foreach ($brands as $brand)
                      <option value="{{$brand->id}}"> {{$brand->name}} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div> 
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('holiday_types.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
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

