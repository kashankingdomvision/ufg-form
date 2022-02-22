@extends('layouts.app')

@section('title','Add Booking Method')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Booking Method</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Setting</a></li>
                <li class="breadcrumb-item active">Booking Method</li>
              </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-outline card-base">
              <div class="card-header">
                <h3 class="card-title text-center">Booking Method Form</h3>
              </div>

              <form method="POST" action="{{ route('setting.booking_methods.store') }}">
                @csrf

                <div class="card-body">

                  <div class="form-group">
                    <label>Name <span style="color:red">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Booking Method Name" required>

                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary float-right">Submit</button>
                  <a href="{{ route('setting.booking_methods.index') }}" class="btn btn-danger float-right  mr-2">Cancel</a>
                  
                </div>

              </form>
            </div>


          </div>

        </div>
      </div>
    </section>

  </div>
@endsection
