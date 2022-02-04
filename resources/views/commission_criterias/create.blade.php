@extends('layouts.app')

@section('title','Add Commission Criteria')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <h4>Add Commission Criteria</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item"><a>Commission Managment</a></li>
              <li class="breadcrumb-item active">Commission Criteria</li>
            </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card card-secondary shadow-sm">
            <div class="card-header">
              <h3 class="card-title text-center">Commission Criteria Form</h3>
            </div>

            <form method="POST" id="store_commission_criteria" action="{{ route('commission_criterias.store') }}" >
              @csrf
              <div class="card-body">
              
                <div class="form-group">
                  <label>Commission  <span style="color:red">*</span></label>
                  <select name="commission_id" id="commission_id" class="form-control select2single commission-id">
                    <option selected value="" >Select Commission  </option>
                    @foreach ($commission_types as $commission_type)
                      <option value="{{ $commission_type->id }}">{{ $commission_type->name }} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Commision Percentage % <span style="color:red">*</span></label>
                  <input type="number" name="percentage" id="percentage" class="form-control" placeholder="Commision percentage %">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Commission Group <span style="color:red">*</span> </label>
                  <select name="commission_group_id[]" id="commission_group_id" data-placeholder="Select Commission Group" class="form-control select2-multiple" data-placeholder="Select Commission Group" multiple>
                    @foreach ($commission_groups as $commission_group)
                      <option value="{{ $commission_group->id }}" {{ in_array($commission_group->id, old('commission_group_id') ?? []) ? 'selected' : '' }}>{{$commission_group->name}} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div> 

                <div class="form-group">
                  <label>Brand <span style="color:red">*</span></label>
                  <select name="brand_id[]" id="brand_id" data-placeholder="Select Brand" class="form-control select2-multiple getMultipleBrandtoHoliday brand-id" multiple>
                    @foreach ($brands as $brand)
                      <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Type Of Holiday <span style="color:red">*</span></label>
                  <select name="holiday_type_id[]" id="holiday_type_id" data-placeholder="Select Type Of Holiday" class="form-control select2-multiple appendMultipleHolidayType holiday-type-id" multiple>
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Booking Currency <span style="color:red">*</span></label>
                  <select name="currency_id[]" id="currency_id" data-placeholder="Select Booking Currency" class="form-control select2-multiple booking-currency-id" multiple>
                    @foreach ($currencies as $currency)
                      <option value="{{ $currency->id }}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Booking Season <span style="color:red">*</span></label>
                  <select name="season_id[]" id="season_id" data-placeholder="Select Booking Season" class="form-control select2-multiple" multiple>
                    @foreach ($booking_seasons as $booking_season)
                      <option value="{{ $booking_season->id }}" {{ in_array($booking_season->id, old('season_id') ?? []) ? 'selected' : '' }}>{{$booking_season->name}} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('commission_criterias.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
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
