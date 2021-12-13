@extends('layouts.app')
@section('title','Add Product')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Product</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Supplier Management</a></li>
              </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title text-center">Product Form</h3>
              </div>
              <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Product Code <span style="color:red">*</span></label>
                    <input type="text" name="code" value="{{ !empty(\Helper::getProductCode()) ? \Helper::getProductCode() : '' }}" class="form-control @error('code') is-invalid @enderror" placeholder="Product Code" >
                    @error('code')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Product Name <span style="color:red">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Product Name" >
                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Product Location <span style="color:red">*</span></label>
                    <select name="location_id" class="form-control select2single @error('location_id') is-invalid @enderror" >
                      <option value="">Select Location</option>
                      @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ ($location->id == old('location_id')) ? 'selected' : ''}} > {{ $location->name }} {{ isset($location->getCountry->name) && !empty($location->getCountry->name) ? ' ('.$location->getCountry->name.')' : '' }}</option>
                      @endforeach
                    </select>

                    @error('location_id')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div> 

                  <div class="form-group">
                    <label>Duration </label>
                    <input type="text" name="duration"  class="form-control @error('duration') is-invalid @enderror" placeholder="Duration" >
                    @error('duration')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Currency</label>
                    <select name="currency_id" class="form-control select2single" >
                      <option value="">Select Currency</option>
                      @foreach ($currencies as $currency)
                        <option value="{{$currency->id}}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}"  {{ (old("currency") == $currency->id ? "selected" : "") }} >&nbsp; {{$currency->code}} - {{$currency->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Payment Type </label>
                    <select name="booking_type_id" class="form-control select2single booking-type-id">
                      <option value="" >Select Payment Type</option>
                      @foreach ($booking_types as $booking_type)
                        <option value="{{ $booking_type->id }}" data-slug="{{ $booking_type->slug }}" > {{$booking_type->name}} </option>
                      @endforeach
                    </select>

                    @error('booking_type_id')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Price </label>
                    <input type="text" name="price"  class="form-control @error('price') is-invalid @enderror" placeholder="Price" >
                    @error('price')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <textarea name="description"  class="form-control summernote">{{ old('description') }}</textarea>
                    @error('description')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Inclusions</label>
                    <textarea name="inclusions" class="form-control summernote">{{ old('inclusions') }}</textarea>
                    @error('inclusions')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                    <label>Packing List</label>
                    <textarea name="packing_list" class="form-control summernote">{{ old('packing_list') }}</textarea>
                    @error('packing_list')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>
                
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                  <a href="{{ route('products.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
