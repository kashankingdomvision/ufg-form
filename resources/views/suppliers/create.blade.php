
@extends('layouts.app')
@section('title','Add Supplier')
@section('content')
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
                <h4>Add Supplier</h4>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a>Home</a></li>
                  <li class="breadcrumb-item active">Supplier Management</li>
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
                  <h3 class="card-title">Supplier Form</h3>
                </div>
                <form method="POST" action="{{ route('suppliers.store') }}">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="">Name <span style="color:red">*</span></label>
                      <input type="text" name="username"  class="form-control @error('username') is-invalid @enderror" placeholder="Name" value="{{old('username')}}"  >

                      @error('username')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="">Email </label>
                      <input type="email" name="email"  class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}"  >
                      @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="">Phone Number</label>
                      <br />
                      <input type="tel"  name="phone" class="form-control phone phone0" value="{{old('phone')}}">
                      <div class="alert-danger" style="text-align:center">{{$errors->first('phone')}}</div>
                      <span class="text-danger error_msg0 hide" role="alert"></span>
                      <span class="text-success valid_msg0 hide" role="alert"></span>
                    </div>

                    <div class="form-group">
                      <label>Group Owner </label>
                      <select name="group_owner_id" class="form-control select2single @error('group_owner_id') is-invalid @enderror" >
                        <option value="">Select Group Owner</option>
                          @foreach ($group_owners as $group_owner)
                            <option value="{{$group_owner->id}}" {{ (old('group_owner_id') == $group_owner->id) ? 'selected' : '' }}> {{$group_owner->name}} </option>
                          @endforeach
                      </select>
  
                      @error('group_owner_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div> 

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Country <span style="color:red">*</span></label>
                          <select name="country_id" class="form-control select2single getCountryToTown getCountryToLocation @error('country_id') is-invalid @enderror" >
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

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Location <span style="color:red">*</span></label>
                          <select name="location_id" class="form-control select2single location-id appendCountryLocation @error('location_id') is-invalid @enderror" >
                            <option value="">Select Location</option>
                          </select>
      
                          @error('location_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                          @enderror
                        </div> 
                      </div>

                      {{-- <div class="col-md-6">
                        <div class="form-group">
                          <label>Town <span style="color:red">*</span></label>
                          <select name="town_id" class="form-control select2single town-id appendCountryTown @error('town_id') is-invalid @enderror" >
                            <option value="">Select Town</option>
                          </select>
      
                          @error('town_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                          @enderror
                        </div> 
                      </div> --}}

                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="">Categories <span style="color:red">*</span></label>
                      <select name="categories[]" class="form-control select2-multiple @error('categories') is-invalid @enderror" multiple="multiple"  >
                          @foreach ($categories as $category)
                          <option value="{{$category->id}}" {{ in_array($category->id, old('categories') ?? []) ? 'selected' : '' }} >{{$category->name}}</option>
                          @endforeach
                      </select>
                      @error('categories')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="">Products <span style="color:red">*</span></label>
                      <select name="products[]" class="form-control select2-multiple @error('products') is-invalid @enderror" multiple="multiple"  >
                        @foreach ($products as $product)
                          <option value="{{$product->id}}" {{ in_array($product->id, old('products') ?? []) ? 'selected' : '' }} >{{$product->name}}</option>
                        @endforeach
                      </select>
                      @error('products')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="">Currency</label>
                      <select name="currency" class="form-control select2single" >
                          @foreach ($currencies as $currency)
                          <option value="{{$currency->id}}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}"  {{ (old("currency") == $currency->id ? "selected" : "") }} >&nbsp; {{$currency->code}} - {{$currency->name}}</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label  class="">Description :</label>
                      <textarea name="description"  class="form-control summernote">{{ old('description') }}</textarea>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary buttonSumbit float-right">Submit</button>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-outline-danger buttonSumbit float-right mr-3">Cancel</a>
                    
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection
