@extends('layouts.app')

@section('title','Edit Harbours, Train and Points of Interest')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Edit Harbours, Train and Points of Interest</h4></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Harbours, Train and Points of Interests</li>
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
              <h3 class="card-title text-center">Harbours, Train and Points of Interest Form</h3>
            </div>

            <form method="POST" id="update_harbour" action="{{ route('harbours.update',  encrypt($harbour->id)) }}">
              @csrf @method('put')

              <div class="card-body">
                <div class="form-group">
                  <label>Port ID <span style="color:red">*</span></label>
                  <input type="text" name="port_id" id="port_id" value="{{ $harbour->port_id }}" class="form-control" placeholder="Port ID">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Harbours, Train and Points of Interest Name <span style="color:red">*</span></label>
                  <input type="text" name="name"  id="name" value="{{ $harbour->name }}" class="form-control" placeholder="Harbours, Train and Points of Interest  Name">
                  <span class="text-danger" role="alert"></span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('harbours.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
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
