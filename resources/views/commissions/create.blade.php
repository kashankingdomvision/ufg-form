@extends('layouts.app')

@section('title','Add Commissions')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6"><h4>Add Commissions</h4></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item"><a>Commission Managment</a></li>
              <li class="breadcrumb-item active">Commissions</li>
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
                <h3 class="card-title text-center">Commissions Form</h3>
              </div>

              <form method="POST" id="store_commission" action="{{ route('commissions.store') }}" >
                @csrf

                <div class="card-body">
                  <div class="form-group">
                    <label>Commision Name <span style="color:red">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Commision Name">
                    <span class="text-danger" role="alert"></span>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success float-right">Submit</button>
                  <a href="{{ route('commissions.index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
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
  <script src="{{ asset('js/commission_management.js') }}" ></script>
@endpush

{{-- <div class="form-group">
  <label>Percentage % <span style="color:red">*</span></label>
  <input type="number" name="percentage" value="{{ old('percentage') }}" class="form-control @error('percentage') is-invalid @enderror" placeholder="Commision percentage %" >
  @error('percentage')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
  @enderror
</div> --}}

{{-- <div class="form-group">
  <label>Commission Group <span style="color:red">*</span> </label>
  <select name="commission_group_id" id="commission_group_id" value="{{ old('commission_group_id') }}" class="form-control select2single commission-group-id  @error('commission_group_id') is-invalid @enderror" >
    <option value="">Select Commission Group</option>
    @foreach ($commission_groups as $commission_group)
      <option value="{{ $commission_group->id }}" {{ old('commission_group_id') == $commission_group->id ? 'selected' : null }}> {{ $commission_group->name }}</option>
    @endforeach
  </select>

  @error('commission_group_id')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
  @enderror
</div>  --}}

{{-- <div class="form-group">
  <label>Brand <span style="color:red">*</span></label>
  <select name="brand_id" id="brand_id" class="form-control select2single getBrandtoHoliday brand-id @error('brand_id') is-invalid @enderror">
    <option value="" >Select Brand</option>
    @foreach ($brands as $brand)
      <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : null }}> {{ $brand->name }} </option>
    @endforeach
  </select>
  @error('brand_id')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
  @enderror
</div>

@if(old('brand_id'))
  @php
    $holiday_types = App\Brand::where('id', old('brand_id'))->first()->getHolidayTypes;
  @endphp
@endif --}}

{{-- <div class="form-group">
  <label>Type Of Holiday <span style="color:red">*</span></label>
  <select name="holiday_type_id" id="holiday_type_id" value="{{ old('holiday_type_id') }}" class="form-control select2single appendHolidayType holiday-type-id @error('holiday_type_id') is-invalid @enderror">
    <option value="" >Select Type Of Holiday</option>
    @if(old('brand_id') && !is_null($holiday_types))
      @foreach ($holiday_types as $holiday_type)
        <option value="{{ $holiday_type->id }}" {{ old('holiday_type_id') == $holiday_type->id ? 'selected' : null }}>{{ $holiday_type->name }}</option>
      @endforeach
    @endif
  </select>
  @error('holiday_type_id')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
  @enderror
</div> --}}

{{-- <div class="form-group">
  <label>Booking Currency <span style="color:red">*</span></label>
  <select name="currency_id" id="currency_id" class="form-control select2single booking-currency-id @error('currency_id') is-invalid @enderror">
    <option selected value="">Select Booking Currency </option>
    @foreach ($currencies as $currency)
      <option value="{{ $currency->id }}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}" {{ old('currency_id') == $currency->id ? 'selected' : null }}> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
    @endforeach
  </select>
  @error('currency_id')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
  @enderror
</div> --}}

{{-- <div class="form-group">
  <label>Booking Season <span style="color:red">*</span></label>
  <select class="form-control select2-multiple"  data-placeholder="Select Season" multiple name="season_id[]">
    @foreach ($booking_seasons as $booking_season)
      <option value="{{ $booking_season->id }}" >{{$booking_season->name}} </option>
    @endforeach
  </select>
</div> --}}
       
