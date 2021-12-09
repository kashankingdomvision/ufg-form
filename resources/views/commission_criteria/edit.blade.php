@extends('layouts.app')

@section('title','Edit Commission Criteria')

@section('content')

  <div class="content-wrapper">
    
    @include('includes.print_errors')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Edit Commission Criteria</h4>
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
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center">Commission Criteria Form</h3>
              </div>

              <form action="{{ route('commissions.commission-criteria.update', encrypt($commission_criteria->id)) }}" method="POST">
                @csrf @method('put')

                <div class="card-body">

                  <div class="form-group">
                    <label>Commission <span style="color:red">*</span></label>
                    <select name="commission_id" id="commission_id" class="form-control select2single commission-id @error('commission_id') is-invalid @enderror">
                      <option selected value="" >Select Commission Type </option>
                      @foreach ($commission_types as $commission_type)
                        <option value="{{ $commission_type->id }}" {{  $commission_type->id == $commission_criteria->commission_id ? 'selected' : '' }}>{{ $commission_type->name }} </option>
                      @endforeach
                    </select>

                    @error('commission_id')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Commision Percentage  <span style="color:red">*</span></label>
                    <input type="number" name="percentage" value="{{ $commission_criteria->percentage }}" class="form-control @error('percentage') is-invalid @enderror" placeholder="Commission Percentage %" required>

                    @error('percentage')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Commission Group <span style="color:red">*</span></label>
                      <select name="commission_group_id[]" class="form-control select2-multiple" data-placeholder="Select Commission Group" multiple>
                      <option value="">Select Commission Group</option>
                      @foreach ($commission_groups as $commission_group)
                        <option value="{{ $commission_group->id }}" 
                          @if(old('commission_group_id'))
                          {{ in_array($commission_group->id, old('commission_group_id') ?? []) ? 'selected' : '' }}
                          @else 
                          {{ (in_array($commission_group->id, $commission_criteria->getCommissionGroups()->pluck('commission_group_id')->toArray()) )? 'selected' : NULL}} 
                          @endif
                        >{{$commission_group->name}} </option>
                      @endforeach
                    </select>

                    @error('commission_group_id')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Brand <span style="color:red">*</span></label>
                    <select name="brand_id[]" id="brand_id" data-placeholder="Select Brand" class="form-control select2-multiple getMultipleBrandtoHoliday brand-id @error('brand_id') is-invalid @enderror" multiple>
                        @foreach ($brands as $brand)
                          <option value="{{ $brand->id }}" 
                            @if(old('commission_group_id'))
                            {{ in_array($brand->id, old('brand_id') ?? []) ? 'selected' : '' }}
                            @else 
                            {{ (in_array($brand->id, $commission_criteria->getBrands()->pluck('brand_id')->toArray()) )? 'selected' : NULL}} 
                            @endif
                          >{{$brand->name}} </option>
                        @endforeach
                    </select>

                    @error('brand_id')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Type Of Holiday <span style="color:red">*</span></label>
                    <select name="holiday_type_id[]" id="holiday_type_id" data-placeholder="Select Type Of Holiday" class="form-control select2-multiple appendMultipleHolidayType holiday-type-id @error('holiday_type_id') is-invalid @enderror" multiple>
                      @foreach ($holiday_types as $holiday_type)
                        <option value="{{ $holiday_type->id }}" 
                          @if(old('holiday_type_id'))
                          {{ in_array($holiday_type->id, old('holiday_type_id') ?? []) ? 'selected' : '' }}
                          @else 
                          {{ (in_array($holiday_type->id, $commission_criteria->getHolidayTypes()->pluck('holiday_type_id')->toArray()) )? 'selected' : NULL}} 
                          @endif
                        >{{$holiday_type->name}} </option>
                      @endforeach
                    </select>
                    
                    @error('holiday_type_id')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Booking Currency <span style="color:red">*</span></label>
                    <select name="currency_id[]" id="currency_id" data-placeholder="Select Booking Currency" class="form-control select2-multiple booking-currency-id @error('currency_id') is-invalid @enderror" multiple>
                      @foreach ($currencies as $currency) 
                        <option value="{{ $currency->id }}"  data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}" 
                          @if(old('currency_id'))
                          {{ in_array($currency->id, old('currency_id') ?? []) ? 'selected' : '' }}
                          @else 
                          {{ (in_array($currency->id, $commission_criteria->getCurrencies()->pluck('currency_id')->toArray()) )? 'selected' : NULL}} 
                          @endif
                        >&nbsp; {{$currency->code}} - {{$currency->name}}</option>
                      @endforeach
                    </select>
                    @error('currency_id')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Booking Season <span style="color:red">*</span></label>
                    <select class="form-control select2-multiple"  data-placeholder="Select Season" multiple name="season_id[]">
                      @foreach ($booking_seasons as $booking_season)
                        <option value="{{ $booking_season->id }}" 
                          @if(old('season_id'))
                          {{ in_array($booking_season->id, old('season_id') ?? []) ? 'selected' : '' }}
                          @else 
                          {{ (in_array($booking_season->id, $commission_criteria->getSeasons()->pluck('season_id')->toArray()) )? 'selected' : NULL}} 
                          @endif
                        >{{$booking_season->name}} </option>
                      @endforeach
                    </select>
                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary float-right">Submit</button>
                  <a href="{{ route('commissions.commission-criteria.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                </div>

              </form>
            </div>

          </div>
        </div>
    </section>

  </div>
@endsection
