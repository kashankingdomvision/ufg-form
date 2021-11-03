@extends('layouts.app')

@section('title','Edit Brand')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Edit Brand</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Setting</a></li>
                <li class="breadcrumb-item active">Brand</li>
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
                <h3 class="card-title text-center">Brand Form</h3>
              </div>

              <form method="POST" action="{{ route('setting.brands.update', encrypt($brand->id)) }}" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="card-body">

                  <div class="form-group">
                    <label>Name <span style="color:red">*</span></label>
                    <input type="text" name="name" value="{{ $brand->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Brand Name" required>

                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $brand->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com" required>

                    @error('email')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" rows="3" placeholder="Enter Address">{{ $brand->address }}</textarea>

                    @error('address')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Contact Number <span style="color:red">*</span></label>
                    <input type="tel" value="{{ $brand->phone }}" name="phone" id="phone" class="form-control phone phone0" >
                    <span class="text-danger error_msg0" role="alert"></span>
                    <span class="text-success valid_msg0" role="alert"></span>
                  </div>

                  {{-- <div class="form-group">
                    <label>Phone</label>
                    <input type="number" name="phone" value="{{ $brand->phone }}" class="form-control hide-arrows @error('phone') is-invalid @enderror"  placeholder="132456789" required>

                    @error('phone')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div> --}}

                  <div class="form-group">
                    <label>Logo</label>
                    <input type="file" name="logo" value="{{ old('logo') }}" class="form-control @error('logo') is-invalid @enderror">

                    @error('logo')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>About Us</label>
                    <textarea name="about_us" class="form-control summernote">{{ old('about_us')??$brand->about_us }}</textarea>
                    @error('about_us')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group text-center">
                    @if($brand->image_path)
                      <img src="{{ $brand->image_path }}" width="100" height="100" alt="brand logo" />
                    @endif
                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary float-right">Submit</button>
                  <a href="{{ route('setting.brands.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                  
                </div>

              </form>
            </div>


          </div>

        </div>
      </div>
    </section>

  </div>
@endsection
