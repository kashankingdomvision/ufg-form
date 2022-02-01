@extends('layouts.app')

@section('title','Edit Supplier')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6"><h4>Edit Supplier</h4></div>
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
            <div class="card card-primary shadow-sm">
              <div class="card-header">
                <h3 class="card-title">Supplier Form</h3>
              </div>

              <form method="POST" action="{{ route('suppliers.update', encrypt($supplier->id) ) }}" id="update_supplier">
                @csrf @method('put')

                <div class="card-body">

                  <div class="form-group">
                    <label for="inputEmail3" class="">Supplier Code</label>
                    <input type="text" name="code" value="{{$supplier->code}}" class="form-control" placeholder="Supplier Code">
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Supplier Name <span style="color:red">*</span></label>
                    <input type="text" name="username" id="username" value="{{$supplier->name}}" class="form-control" placeholder="Supplier Name">
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Email</label>
                    <input type="email" name="email" value="{{$supplier->email}}" class="form-control" placeholder="Email">
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Phone Number</label>
                    <input type="tel" class="form-control phone phone0" type="tel" name="phone" value="{{$supplier->phone}}" placeholder="12345678">
                    <span class="text-danger error_msg0 hide" role="alert"></span>
                    <span class="text-success valid_msg0 hide" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Contact Person </label>
                    <input type="text" name="contact_person" class="form-control" placeholder="Contact Person" value="{{$supplier->contact_person}}"  >
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label>Group Owner </label>
                    <select name="group_owner_id" class="form-control select2single" >
                      <option value="">Select Group Owner</option>
                      @foreach ($group_owners as $group_owner)
                        <option value="{{$group_owner->id}}" {{ $group_owner->id == $supplier->group_owner_id  ? 'selected' : '' }}> {{$group_owner->name}} </option>
                      @endforeach
                    </select>
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Country <span style="color:red">*</span></label>
                        <select name="country_id[]" id="country_id" class="form-control select2-multiple getCountryToLocation" multiple="multiple">
                          @foreach ($countries as $country)
                            <option value="{{$country->id}}" {{ (in_array($country->id, $supplier->getCountries()->pluck('id')->toArray() )) ? 'selected' : '' }}> {{$country->name}} </option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div> 
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Location <span style="color:red">*</span></label>
                        <select name="location_id[]" id="location_id"  class="form-control select2-multiple location-id appendCountryLocation" multiple="multiple">
                          @if(isset($supplier->getLocations) && $supplier->getLocations)
                            @foreach ($supplier->getLocations as $location )
                            <option value="{{ $location->id }}" {{ (in_array($location->id, $supplier->getLocations()->pluck('id')->toArray() )) ? 'selected' : NULL }}>{{ $location->name }} {{ isset($location->getCountry->name) && !empty($location->getCountry->name) ? '('.$location->getCountry->name.')' : '' }}</option>
                            @endforeach
                          @endif
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Category <span style="color:red">*</span></label>
                    <select name="categories[]" class="form-control select2-multiple @error('categories') is-invalid @enderror" multiple >
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (in_array($category->id, $supplier->getCategories()->pluck('id')->toArray()))? 'selected' : '' }}>{{ $category->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" role="alert"></span>
                  </div>
    
                  <div class="form-group">
                    <label for="inputEmail3" class="">Currency</label>
                    <select name="currency" class="form-control  select2single">
                      <option value="">Select Currency</option>
                      @foreach ($currencies as $currency)
                        <option value="{{$currency->id}}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}"  {{ ($currency->id == $supplier->currency_id)? "selected" : ((old('currency') == $currency->id)? 'selected' : '') }}>&nbsp; {{$currency->code}} - {{$currency->name}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="">Commission Rate</label>
                    <input type="text" name="commission_rate" class="form-control @error('commission_rate') is-invalid @enderror" placeholder="Commission Rate" value="{{$supplier->commission_rate}}" >
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label  class="">Description :</label>
                    <textarea name="description"  class="form-control summernote">{{ $supplier->description }}</textarea>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                  <a href="{{ route('suppliers.index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
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

{{-- <div class="form-group">
<label for="inputEmail3" class=""> Products </label>
<select name="products[]" class="form-control select2-multiple @error('products') is-invalid @enderror" multiple >
@foreach ($products as $product)
<option value="{{$product->id}}" {{ (in_array($product->id, $supplier->getProducts()->pluck('id')->toArray()) )? 'selected' : NULL}} >{{$product->name}}</option>
@endforeach
</select>

@error('products')
<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
@enderror
</div> --}}

{{-- <div class="col-md-6">
  <div class="form-group">
    <label>Town <span style="color:red">*</span></label>
    <select name="town_id" class="form-control select2single town-id appendCountryTown @error('town_id') is-invalid @enderror" >
      <option value="">Select Town</option>
      @if(isset($supplier->getCountry) && $supplier->getCountry->getTowns)
        @foreach ($supplier->getCountry->getTowns as $town )
        <option value="{{ $town->id }}"  {{ ($supplier->town_id == $town->id)? 'selected' : NULL}}  >{{ $town->name }}</option>
        @endforeach
      @endif
    </select>

    @error('town_id')
      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
  </div> 
</div> --}}