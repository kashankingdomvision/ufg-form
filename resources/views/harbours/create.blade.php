@extends('layouts.app')

@section('title','Add Harbours, Train and Points of Interest')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Harbours, Train and Points of Interest</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Setting</a></li>
                <li class="breadcrumb-item active">Harbours, Train and Points of Interest</li>
              </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center">Harbours, Train and Points of Interest Form</h3>
              </div>

              <form method="POST" action="{{ route('setting.harbours.store') }}">
                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label>Port ID <span style="color:red">*</span></label>
                        <input type="text" name="port_id" class="form-control @error('port_id') is-invalid @enderror" placeholder="Port ID" >

                        @error('port_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                    <label>Harbours, Train and Points of Interest Name <span style="color:red">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Harbours, Train and Points of Interest  Name" >

                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                    </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary float-right">Submit</button>
                  <a href="{{ route('setting.harbours.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                </div>

              </form>
            </div>


          </div>

        </div>
      </div>
    </section>

  </div>
@endsection
