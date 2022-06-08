@extends('layouts.app')

@section('title','Edit Product')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Edit Product</h4></div>
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
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card card-outline card-base">
            <div class="card-header">
              <h3 class="card-title text-center">Product Form</h3>
            </div>
          
            <div class="card-body">
              <form method="POST" id="update_product" action="{{ route('products.update') }}" >
                @csrf

                <input type="hidden" name="id" value="{{ encrypt($product->id) }}">
                
                <div class="form-group">
                  <label>Product Code <span style="color:red">*</span></label>
                  <input type="text" name="code" id="code" value="{{ old('code')??$product->code }}" class="form-control @error('code') is-invalid @enderror" placeholder="Product Code" required>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Product Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" value="{{ old('name')??$product->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Product Name" >
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Category <span style="color:red">*</span></label>
                  <select name="category_id" id="category_id" class="form-control select2single @error('category_id') is-invalid @enderror">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" data-slug="{{ $category->slug }}" data-name="{{ $category->name }}" {{ ($product->category_id == $category->id)? 'selected' : ''}}> {{ $category->name }} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Duration </label>
                  <input type="number" name="duration" value="{{ old('duration')??$product->duration }}"  class="form-control @error('duration') is-invalid @enderror" placeholder="Duration" >
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="">Currency</label>
                  <select name="currency_id" class="form-control select2single" >
                    <option value="">Select Currency</option>
                    @foreach ($currencies as $currency)
                      <option value="{{$currency->id}}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}"  {{ ($currency->id == $product->currency_id) ? "selected" : ((old('currency_id') == $currency->id)? 'selected' : NULL) }}>&nbsp; {{$currency->code}} - {{$currency->name}}</option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Payment Type</label>
                  <select name="booking_type_id" class="form-control select2single booking-type-id @error('booking_type_id') is-invalid @enderror">
                    <option value="">Select Payment Type</option>
                    @foreach ($booking_types as $booking_type)
                      <option value="{{ $booking_type->id }}" data-slug="{{ $booking_type->slug }}" {{ $product->booking_type_id == $booking_type->id  ? "selected" : "" }}> {{ $booking_type->name }} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Price </label>
                  <input type="text" name="price" value="{{ old('price')??$product->price }}" class="form-control @error('price') is-invalid @enderror" data-type="currency" placeholder="Price" >
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <textarea name="description" class="form-control summernote" rows="3">{{ old('description')??$product->description }}</textarea>
                  <span class="text-danger" role="alert"></span>
                </div>

              </form>

              <input type="hidden" id="preset_product_form_data" value="{{ isset($product->feilds) ? $product->feilds : ''  }}">
              <div id="update_product_form_builder_div"></div>
            </div>

            <div class="card-footer">
              <button type="button" id="update_product_submit" class="btn btn-success float-right">Submit</button>
              <a href="{{ route('products.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
            </div>

            <div id="overlay" class=""></div>
          </div>

        </div>

      </div>
    </div>
  </section>
</div>

@endsection

@push('js')
  <script src="{{ asset('js/supplier_management.js') }}" ></script>
@endpush

{{-- <div class="form-group">
  <label>Inclusions</label>
  <textarea name="inclusions" class="form-control summernote" rows="3">{{ old('inclusions')??$product->inclusions }}</textarea>
  @error('inclusions')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
  @enderror
</div>

<div class="form-group">
  <label>Packing List</label>
  <textarea name="packing_list" class="form-control summernote" rows="3">{{ old('packing_list')??$product->packing_list }}</textarea>
  @error('packing_list')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
  @enderror
</div> --}}

{{-- <div class="form-group">
<label>Product Location <span style="color:red">*</span></label>
<select name="location_id" class="form-control select2single @error('location_id') is-invalid @enderror" >
  <option value="">Select Location</option>
  @foreach ($locations as $location)
    <option value="{{ $location->id }}" {{ ($location->id == $product->location_id) ? "selected" : ((old('location_id') == $location->id)? 'selected' : NULL) }} > {{ $location->name }} {{ isset($location->getCountry->name) && !empty($location->getCountry->name) ? ' ('.$location->getCountry->name.')' : '' }}</option>
  @endforeach
</select>

@error('location_id')
  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
@enderror
</div>  --}}
