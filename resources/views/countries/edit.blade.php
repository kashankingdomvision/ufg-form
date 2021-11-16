@extends('layouts.app')

@section('title','Edit Country')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <h4>Edit Country</h4>
          </div>
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
      <div class="row">
        <div class="offset-md-2 col-md-8">

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title text-center">Country Form</h3>
            </div>

            <form method="POST" action="{{ route('setting.countries.update',  encrypt($country->id)) }}">
              @csrf
              @method('put')

              <div class="card-body">

                <div class="form-group">
                  <label>Name <span style="color:red">*</span></label>
                  <input type="text" name="name" value="{{ !empty(old('name')) ? old('name') : $country->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Country Name" >

                  @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Sort Name <span style="color:red">*</span></label>
                  <input type="text" name="sortname" value="{{ !empty(old('sortname')) ? old('sortname') : $country->sortname  }}" class="form-control @error('sortname') is-invalid @enderror" placeholder="Sort Name" >

                  @error('sortname')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Phone Code <span style="color:red">*</span></label>
                  <input type="text" name="phonecode" value="{{  !empty(old('phonecode')) ? old('phonecode') : $country->phonecode }}" class="form-control @error('phonecode') is-invalid @enderror" placeholder="Phone Code" >

                  @error('phonecode')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-secondary float-right">Submit</button>
                <a href="{{ route('setting.countries.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                
              </div>

            </form>
          </div>


        </div>

      </div>
    </div>
  </section>

</div>
@endsection
