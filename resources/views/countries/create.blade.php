@extends('layouts.app')

@section('title','Add Country')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Add Country</h4></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Countries</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">

          <div class="card card-secondary shadow-sm">
            <div class="card-header">
              <h3 class="card-title text-center">Country Form</h3>
            </div>

            <form method="POST" id="store_country" action="{{ route('countries.store') }}">
              @csrf

              <div class="card-body">
                <div class="form-group">
                  <label>Country Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Country Name">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Phone Code <span style="color:red">*</span></label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Code">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Sort Order <span style="color:red">*</span></label>
                  <input type="number" name="sort_order" id="sort_order" class="form-control" placeholder="Sort Name">
                  <span class="text-danger" role="alert"></span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('countries.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
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