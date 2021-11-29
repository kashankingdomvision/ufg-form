@extends('layouts.app')

@section('title','Edit Airport')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <h4>Edit Airport</h4>
          </div>
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
      <div class="row">
        <div class="offset-md-2 col-md-8">

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title text-center">Airport Form</h3>
            </div>

            <form method="POST" action="{{ route('setting.airport_codes.update',  encrypt($airport_code->id)) }}">
              @csrf
              @method('put')

                <div class="card-body">

                    <div class="form-group">
                        <label>Airport Name <span style="color:red">*</span></label>
                        <input type="text" name="name" value="{{ $airport_code->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Airport Name">

                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>IATA Code <span style="color:red">*</span></label>
                        <input type="text" name="iata_code" value="{{ $airport_code->iata_code }}" class="form-control @error('iata_code') is-invalid @enderror" placeholder="IATA Code" >

                        @error('iata_code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-secondary float-right">Submit</button>
                    <a href="{{ route('setting.airport_codes.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                    
                </div>

            </form>
          </div>


        </div>

      </div>
    </div>
  </section>

</div>
@endsection