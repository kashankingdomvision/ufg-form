@extends('layouts.app')

@section('title','Edit Holiday Type')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Edit Holiday Type</h4>
            </div>
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
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center">Holiday Type Form</h3>
              </div>

              <form action="{{ route('setting.holidaytypes.update', encrypt($holiday_type->id)) }}" method="POST">
                @csrf @method('put')

                <div class="card-body">

                  <div class="form-group">
                    <label>Name <span style="color:red">*</span></label>
                    <input type="text" name="name" value="{{ $holiday_type->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Holiday Type Name" required>

                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Brand <span style="color:red">*</span></label>
                    <select name="brand_id" class="form-control select2single @error('brand_id') is-invalid @enderror" required>
                      <option value="">Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}" {{ ($holiday_type->brand_id == $brand->id)? 'selected': ((old('brand_id') == $brand->id) ? 'selected' : '') }}> {{$brand->name}} </option>
                        @endforeach
                    </select>

                    @error('brand_id')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div> 


                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary float-right">Submit</button>
                  <a href="{{ route('setting.holidaytypes.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                  
                </div>

              </form>
            </div>


          </div>

        </div>
      </div>
    </section>

  </div>
@endsection
