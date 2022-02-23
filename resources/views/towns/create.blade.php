@extends('layouts.app')

@section('title','Add Town')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Town </h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Setting</a></li>
                <li class="breadcrumb-item active">Towns</li>
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
                <h3 class="card-title text-center">Town Form</h3>
              </div>

              <form method="POST" action="{{ route('setting.towns.store') }}" >
                @csrf

                <div class="card-body">

                  <div class="form-group">
                    <label>Name <span style="color:red">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Town Name" >

                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Country <span style="color:red">*</span></label>
                    <select name="country_id" class="form-control select2single @error('country_id') is-invalid @enderror" >
                      <option value="">Select Country</option>
                        @foreach ($countries as $country)
                          <option value="{{$country->id}}" {{ (old('country_id') == $country->id) ? 'selected' : '' }}> {{$country->name}} </option>
                        @endforeach
                    </select>

                    @error('country_id')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div> 


                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-base float-right">Submit</button>
                  <a href="{{ route('setting.towns.index') }}" class="btn btn-danger float-right  mr-2">Cancel</a>
                  
                </div>

              </form>
            </div>


          </div>

        </div>
      </div>
    </section>

  </div>
@endsection
