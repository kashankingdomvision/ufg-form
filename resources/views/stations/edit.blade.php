@extends('layouts.app')

@section('title','Edit Cabins')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <h4>Edit Station</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item"><a>Setting</a></li>
              <li class="breadcrumb-item active">Station</li>
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
              <h3 class="card-title text-center">Station Form</h3>
            </div>

            <form method="POST" id="update_station" action="{{ route('stations.update', encrypt($station->id)) }}">
              @csrf @method('put')

              <div class="card-body">
                <div class="form-group">
                  <label>Station Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" value="{{ $station->name }}" class="form-control" placeholder="Station Name">
                  <span class="text-danger" role="alert"></span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('stations.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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