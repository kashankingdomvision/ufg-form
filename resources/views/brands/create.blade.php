@extends('layouts.app')

@section('title','Add Brand')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Add Brand</h4></div>
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
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card card-outline card-base">
            <div class="card-header">
              <h3 class="card-title text-center">Brand Form</h3>
            </div>

            <form method="POST" id="store_brand" action="{{ route('brands.store') }}" enctype="multipart/form-data">
              @csrf

              <div class="card-body">
                <div class="form-group">
                  <label>Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Brand Name">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="example@example.com" >
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <textarea name="address" class="form-control" rows="1" placeholder="Enter Address"></textarea>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Supplier Country </label>
                  <select name="supplier_country_ids[]" id="supplier_country_ids" class="form-control select2-multiple" data-placeholder="Select Supplier Country" multiple>
                    @foreach ($countries as $country)
                      <option value="{{ $country->id }}" >{{ $country->name }} - {{ $country->code}}</option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Contact Number <span style="color:red">*</span></label>
                  <input type="tel" name="phone" id="phone" class="form-control phone phone0">
                  <span class="text-danger error_msg0" role="alert"></span>
                  <span class="text-success valid_msg0" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>About Us</label>
                  <textarea name="about_us" class="form-control summernote"></textarea>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Logo</label>
                  <input type="file" name="logo" value="{{ old('logo') }}" class="form-control">
                  <span class="text-danger" role="alert"></span>
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success buttonSumbit float-right">Submit</button>
                <a href="{{ route('brands.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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

{{-- <div class="form-group">
<label>Phone</label>
<input type="number" name="phone" value="{{ old('phone') }}" class="form-control hide-arrows @error('phone') is-invalid @enderror"  placeholder="132456789" >

@error('phone')
<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
@enderror
</div> --}}