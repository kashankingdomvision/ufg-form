@extends('layouts.app')

@section('title','Edit Airline')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <h4>Edit Airline</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item"><a>Setting</a></li>
              <li class="breadcrumb-item active">Airline</li>
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
              <h3 class="card-title text-center">Airline Form</h3>
            </div>

            <form method="POST" action="{{ route('setting.airlines.update',  encrypt($airline->id)) }}">
              @csrf
              @method('put')

              <div class="card-body">

                <div class="form-group">
                  <label>Name <span style="color:red">*</span></label>
                  <input type="text" name="name" value="{{$airline->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Airline Name" required>

                  @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-secondary float-right">Submit</button>
                <a href="{{ route('setting.airlines.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                
              </div>

            </form>
          </div>


        </div>

      </div>
    </div>
  </section>

</div>
@endsection
