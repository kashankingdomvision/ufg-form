
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
        <div class="row d-flex justify-content-center">
          <div class="col-md-10">
            <div class="card card-outline card-base">
              <div class="card-header">
                <h3 class="card-title">Supplier Form</h3>
              </div>
              
              <form method="POST" action="{{ route('suppliers.store') }}" id="store_supplier">
                @csrf
                <div class="card-body">

                  <div class="form-group">
                    <label for="inputEmail3" class="">Supplier Code</label>
                    <input type="text" name="code" class="form-control" placeholder="Supplier Code" value="{{old('code')}}"  >
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Supplier Name <span style="color:red">*</span></label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Supplier Name" value="{{old('username')}}"  >
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Email </label>
                    <input type="email" name="email"  class="form-control" placeholder="Email" value="{{old('email')}}"  >
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Phone Number</label><br/>
                    <input type="tel" name="phone" class="form-control phone phone0" value="{{old('phone')}}">
                    <span class="text-danger error_msg0 hide" role="alert"></span>
                    <span class="text-success valid_msg0 hide" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Contact Person </label>
                    <input type="text" name="contact_person" class="form-control" placeholder="Contact Person" value="{{old('contact_person')}}"  >
                  </div>

                  <div class="form-group">
                    <label>Group Owner </label>
                    <select name="group_owner_id" class="form-control select2single" >
                      <option value="">Select Group Owner</option>
                        @foreach ($group_owners as $group_owner)
                          <option value="{{$group_owner->id}}" {{ (old('group_owner_id') == $group_owner->id) ? 'selected' : '' }}> {{$group_owner->name}} </option>
                        @endforeach
                    </select>
                  </div> 

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Country <span style="color:red">*</span></label>
                        <select name="country_id[]" id="country_id" class="form-control select2-multiple getCountryToLocation" multiple="multiple">
                          @foreach ($countries as $country)
                            <option value="{{$country->id}}" {{ in_array($country->id, old('country_id') ?? []) ? 'selected' : '' }}> {{$country->name}} </option>
                          @endforeach
                        </select>
    
                        <span class="text-danger" role="alert"></span>
                      </div> 
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Location <span style="color:red">*</span></label>
                        <select name="location_id[]" id="location_id" class="form-control select2-multiple location-id appendCountryLocation" multiple="multiple">
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Categories <span style="color:red">*</span></label>
                    <select name="categories[]" id="categories" class="form-control select2-multiple" multiple="multiple">
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{ in_array($category->id, old('categories') ?? []) ? 'selected' : '' }} >{{$category->name}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" role="alert"></span>
                  </div>
                                    
                  <div class="form-group">
                    <label for="inputEmail3" class="">Products </label>
                    <select name="products[]" class="form-control select2-multiple" multiple="multiple">
                      @foreach ($products as $product)
                        <option value="{{$product->id}}" {{ in_array($product->id, old('products') ?? []) ? 'selected' : '' }} >{{$product->name}}</option>
                      @endforeach
                    </select>
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
                    <label for="inputEmail3" class="">Commission Rate</label>
                    <input type="text" name="commission_rate" class="form-control" placeholder="Commission Rate" value="{{old('commission_rate')}}"  >
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label>Description :</label>
                    <textarea name="description" class="form-control summernote">{{ old('description') }}</textarea>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success buttonSumbit float-right">Submit</button>
                  <a href="{{ route('suppliers.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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
  <script src="{{ asset('js/supplier_management.js') }}" ></script>
@endpush

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


{{-- <div class="form-group">
  <label for="inputEmail3" class="">Products </label>
  <select name="products[]" class="form-control select2-multiple @error('products') is-invalid @enderror" multiple="multiple"  >
    @foreach ($products as $product)
      <option value="{{$product->id}}" {{ in_array($product->id, old('products') ?? []) ? 'selected' : '' }} >{{$product->name}}</option>
    @endforeach
  </select>
  @error('products')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
  @enderror
</div> --}}