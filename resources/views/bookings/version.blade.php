@extends('layouts.app')
@section('title', 'View Booking Version')
@section('content')
  <div class="content-wrapper">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>View Booking Version</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item">Booking</li>
                <li class="breadcrumb-item active">Booking Version</li>
              </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content" id="bookingVersion">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center lh-2">Version Bookings #{{ $log->log_no }} {{ $log->version_no }} </h3>
                <a href="{{ route('bookings.edit', encrypt($log['booking_id'])) }}" data-recall="true" class="btn btn-outline-dark btn-md float-right">Back</a>
              </div>
              <div class="card-body">
                <!-- For Commission Calculation -->
                <div class="row d-none">
                  <div class="col-sm-6">
                    <label>User ID <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" value="{{ isset($booking['id']) && !empty($booking['id']) ? $booking['id'] : '' }}" name="user_id" id="user_id" class="form-control user-id">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <label>Commission <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" value="{{ isset($booking['commission_id']) && !empty($booking['commission_id']) ? $booking['commission_id'] : '' }}" name="commission_id" id="commission_id" class="form-control commission-id">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <label>Commission Group <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" value="{{ isset($booking['commission_group_id']) && !empty($booking['commission_group_id']) ? $booking['commission_group_id'] : '' }}" name="commission_group_id" id="commission_group_id" class="form-control commission-group-id">
                    </div>
                  </div>
                </div>
                <!-- For Commission Calculation -->



                <div class="row mb-2">

                  <div class="col-sm-6">
                    <label>Booking Title <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" name="booking_title" id="booking_title" class="form-control" value="{{ isset($booking['booking_title']) & !empty($booking['booking_title']) ? $booking['booking_title'] : '' }}" placeholder="Enter Booking Title">
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Currency Rate Type <span style="color:red">*</span><a href="javascript:void(0);" class="ml-2 view-rates"> (View Rates)</a> </label>
                      <div>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="rate_type" data-status="booking" {{ ($booking['rate_type'] == 'live')? 'checked': NULL }} value="live" >
                          <span>&nbsp;Live Rate</span>
                        </label>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="rate_type" data-status="booking" {{ ($booking['rate_type'] == 'manual')? 'checked': NULL }} value="manual">
                          <span>&nbsp;Manual Rate</span>
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Zoho Reference <span class="text-danger">*</span></label>
                      <input type="text" value="{{ old('ref_no')??$booking['ref_no'] }}" name="ref_no" class="form-control" placeholder="Enter Reference Number">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Quote Reference <span class="text-danger">*</span></label>
                      <input type="text" value="{{ old('quote_no')??$booking['quote_ref'] }}" name="quote_no" class="form-control" placeholder="Quote Reference Number" readonly>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>TAS Reference <span class="text-secondary">(Optional)</span></label>
                      <input type="text" name="tas_ref" class="form-control" value="{{ isset($booking['tas_ref']) & !empty($booking['tas_ref']) ? $booking['tas_ref'] : '' }}"  placeholder="TAS Reference Number" >
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>
                

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Markup Type <span style="color:red">*</span></label>
                      <div>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="markup_type" {{ ($booking['markup_type'] == 'itemised') ? 'checked': NULL }} value="itemised" class="booking-markup-type">
                          <span>&nbsp;Itemised Markup </span>
                        </label>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="markup_type" {{ ($booking['markup_type'] == 'whole') ? 'checked': NULL }} value="whole" class="booking-markup-type">
                          <span>&nbsp;Whole Markup</span>
                        </label>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Sales Person <span class="text-danger">*</span></label>
                      <select name="sale_person_id" id="sales_person_id" class="form-control select2single sales-person-id @error('sales_person_id') is-invalid @enderror">
                        <option value="">Select Sales Person</option>
                        @foreach ($sale_persons as $person)
                          <option  value="{{ $person->id }}" {{  (old('sale_person_id') == $person->id)? "selected" : ($booking['sale_person_id'] == $person->id ? 'selected' : '') }}>{{ $person->name }}</option>
                        @endforeach
                      </select>
                      @error('sales_person_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>
                
                  {{-- <div class="col-sm-6">
                    <div class="form-group">
                      <label>Commission Type <span style="color:red">*</span></label>
                      <select name="commission_id" id="commission_id" class="form-control select2single commission-id">
                        <option selected value="" >Select Commission Type </option>
                        @foreach ($commission_types as $commission_type)
                          <option value="{{ $commission_type->id }}" {{  $commission_type->id == $booking['commission_id'] ? 'selected' : '' }}>{{ $commission_type->name }} ({{ $commission_type->percentage.' %' }})</option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div> --}}
                
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Brand <span class="text-danger">*</span></label>
                      <select name="brand_id" id="brand_id" class="form-control select2single getBrandtoHoliday  brand-id @error('brand_id') is-invalid @enderror">
                        <option value="">Select Brand</option>
                        @foreach ($brands as $brand)
                          <option value="{{ $brand->id }}" {{ (old('brand_id') == $brand->id)? "selected" : (($booking['brand_id'] == $brand->id)? 'selected':NULL) }}> {{ $brand->name }} </option>
                        @endforeach
                      </select>
                      @error('brand_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Type Of Holiday <span class="text-danger">*</span></label> 
                      <select name="holiday_type_id" id="holiday_type_id" class="form-control select2single appendHolidayType  holiday-type-id @error('holiday_type_id') is-invalid @enderror">
                        <option value="">Select Type Of Holiday</option>
                        @if(!empty($log->getQueryData($booking['brand_id'], 'Brand')->first()->getHolidayTypes))
                          @foreach ($log->getQueryData($booking['brand_id'], 'Brand')->first()->getHolidayTypes as $holiday_type)
                              <option value="{{ $holiday_type->id }}" {{  (old('holiday_type_id') == $holiday_type->id)? "selected" : ($booking['holiday_type_id'] == $holiday_type->id ? 'selected' : '') }} >{{ $holiday_type->name }}</option>
                          @endforeach
                        @endif
                        <option value="">Select Type Of Holiday</option>
                      </select>
                      @error('holiday_type_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Booking Season <span class="text-danger">*</span></label>
                      <select name="season_id" id="season_id" class="form-control select2single season-id">
                        <option value="">Select Booking Season</option>
                        @foreach ($seasons as $season)
                          <option value="{{ $season->id }}" {{ old('season_id') == $season->id  ? "selected" : ($booking['season_id'] == $season->id ? 'selected' : '') }}> {{ $season->name }} </option>
                        @endforeach
                      </select>
                      @error('season_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Booking Currency <span class="text-danger">*</span></label>
                      <select name="currency_id" data-status="booking"  id="currency_id" class="form-control select2single booking-currency-id @error('currency_id') is-invalid @enderror">
                        <option value="">Select Booking Currency </option>
                        @foreach ($currencies as $currency)
                          <option value="{{ $currency->id }}"  data-image="data:image/png;base64, {{$currency->flag}}" 
                            {{ $currency->id == $booking['currency_id'] ? 'selected' : ''  }}
                          > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                        @endforeach
                      </select>
                      @error('currency_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Agency Booking <span class="text-danger">*</span></label>
                      <div>
                        <label class="radio-inline">
                          <input class="select-agency" {{ old('agency') == 'yes' ? "checked" : ($booking['agency'] ==  1 ? 'checked' : '') }}  value="yes" type="radio" name="agency" > Yes
                        </label>
                        <label class="radio-inline">
                          <input  class="select-agency" {{ old('agency') == 'no'  ? "checked" : (($booking['agency'] ==  0 || $booking['agency'] ==  null)? 'checked' : '') }}  value="no" type="radio" name="agency" > No
                        </label>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-12 agency-columns" >
                    @if($booking['agency'] == 1)  {{--  Agency  --}}
                      <div class="row mt-1" >
                        <div class="col form-group">
                          <label for="inputEmail3" class="">Agency Name</label> <span style="color:red"> *</span>
                          <input type="text" value="{{ $booking['agency_name'] }}" name="agency_name" id="agency_name" class="form-control">
                          <span class="text-danger" role="alert" > </span>
                        </div>
                        <div class="col form-group">
                          <label for="inputEmail3" class="">Agency Contact Name </label> <span style="color:red"> *</span>
                          <input type="text" value="{{ $booking['agency_contact_name'] }}" name="agency_contact_name" id="agency_contact_name" class="form-control">
                          <span class="text-danger" role="alert" > </span>
                        </div>
                        <div class="col form-group">
                          <label for="inputEmail3" class="">Agency Contact No.</label> <span style="color:red"> *</span>
                          <input type="tel" value="{{ $booking['agency_contact'] }}" name="agency_contact" id="agency_contact" class="form-control phone phone0">
                          <span class="text-danger error_msg0 hide" role="alert"></span>
                        </div>
                      
                        <div class="col form-group">
                          <label for="inputEmail3" class="">Agency Email </label> <span style="color:red"> *</span>
                          <input type="email" value="{{ $booking['agency_email'] }}" name="agency_email" id="agency_email" class="form-control">
                          <span class="text-danger" role="alert" > </span>
                        </div>
                      </div>
                    @else  {{--  lead passenger  --}}
                      <div class="row mt-1" >
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Lead Passenger Name <span style="color:red">*</span></label>
                            <input type="text" value="{{ $booking['lead_passenger_name'] }}" name="lead_passenger_name" id="lead_passenger_name" class="form-control" placeholder="Lead Passenger Name" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Email Address <span style="color:red">*</span></label> 
                            <input type="email" value="{{ $booking['lead_passenger_email'] }}" name="lead_passenger_email" id="lead_passenger_email" class="form-control" placeholder="EMAIL ADDRESS" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Contact Number <span style="color:red">*</span></label> 
                            <input type="tel" value="{{ $booking['lead_passenger_contact'] }}" name="lead_passenger_contact" id="lead_passenger_contact"  class="form-control phone phone0" >
                            <span class="text-danger error_msg0" role="alert"></span>
                          </div>
                        </div>
                      
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Date Of Birth </label> 
                            <input type="date" value="{{ $booking['lead_passenger_dbo'] }}" max="{{ date('Y-m-d') }}" id="lead_passenger_dbo" name="lead_passenger_dbo" class="form-control" placeholder="Date Of Birth" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Nationality (Passport) </label>
                            <select name="lead_passsenger_nationailty_id" id="lead_passsenger_nationailty_id" class="form-control select2single nationality-id">
                              <option selected value="" >Select Nationality</option>
                              @foreach ($countries as $country)
                                  <option value="{{ $country->id }}" {{ ($booking['lead_passsenger_nationailty_id'] == $country->id)? 'selected': null }}> {{ $country->name }} </option>
                              @endforeach
                            </select>
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Resident In</label>
                            <select name="lead_passenger_resident" id="lead_passsenger_resident" class="form-control select2single resident-id">
                              <option selected value="" >Select Resident</option>
                              @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ ($booking['lead_passenger_resident'] == $country->id)? 'selected': null }}> {{ $country->name }} </option>
                              @endforeach
                            </select>
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Dinning Preferences </label>
                            <input type="text" value="{{ $booking['lead_passenger_dinning_preference'] }}" name="lead_passenger_dinning_preference" id="lead_passenger_dinning_preference" class="form-control" placeholder="Dinning Preferences" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>
                        
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Bedding Preferences </label>
                            <input type="text" value="{{ $booking['lead_passenger_bedding_preference'] }}" name="lead_passenger_bedding_preference" id="lead_passenger_bedding_preference" class="form-control " placeholder="Bedding Preferences" id="bedding_preference" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>  

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Up To Date Covid Vaccination Status </label>
                            <div>
                              <label class="radio-inline">
                                <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="1" {{ ( $booking['lead_passenger_covid_vaccinated']  ==  1) ? 'checked' : '' }}> Yes &nbsp;&nbsp;
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="0" {{ ( $booking['lead_passenger_covid_vaccinated']  ==  0 ||  $booking['lead_passenger_covid_vaccinated']  == null) ? 'checked' : '' }} > No &nbsp;&nbsp;
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="2" {{ ( $booking['lead_passenger_covid_vaccinated']  ==  2 ||  $booking['lead_passenger_covid_vaccinated']  == null) ? 'checked' : '' }} > Not Sure
                              </label>
                            </div>
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>


                      </div>
                    @endif
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Pax No. <span class="text-danger">*</span></label>
                      <select name="pax_no" id="pax_no" class="form-control select2single paxNumber pax-number @error('pax_no') is-invalid @enderror">
                        <option value="">Select Pax No</option>
                        @for($i=1;$i<=30;$i++)
                          <option value={{$i}} {{ (old('pax_no') == $i)? "selected" : (($booking['pax_no'] == $i)? 'selected': NULL) }}>{{$i}}</option>
                        @endfor
                      </select>
                      @error('pax_no')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>
                  <div id="appendPaxName" class="col-md-12">
                      @if($booking['pax_no'] >= 1)
                          @foreach ($booking['pax'] as $paxKey => $pax )
                          @php $count = $paxKey + 1; @endphp
                              <div class="mb-2 appendCount" id="appendCount{{ $count }}">
                                  <div class="row" >
                                      <div class="col-md-3 mb-2">
                                          <label >Passenger #{{ ($booking['agency'] == 1)? $count : $count +1  }} Full Name</label> 
                                          <input type="text" name="pax[{{$count}}][full_name]" value="{{ $pax['full_name'] }}" class="form-control" placeholder="PASSENGER #2 FULL NAME" >
                                          <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                      </div>
                                      <div class="col-md-3 mb-2">
                                          <label >Email Address</label> 
                                          <input type="email" name="pax[{{$count}}][email_address]" value="{{ $pax['email'] }}" class="form-control" placeholder="EMAIL ADDRESS" >
                                          <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                      </div>

                                      <div class="col-md-3 mb-2">
                                        <label >Contact Number</label> 
                                        <input type="tel" name="pax[{{$count}}][contact_number]" value="{{ $pax['contact'] }}" class="form-control phone phone{{ $count }}" >
                                        <span class="text-danger error_msg{{ $count }}" role="alert" > </span>
                                        <span class="text-danger valid_msg{{ $count }}" role="alert" > </span>
                                      </div>

                                      <div class="col-md-3 mb-2">
                                        <label>Date Of Birth</label> 
                                        <input type="date" max="{{  date("Y-m-d") }}" name="pax[{{$count}}][date_of_birth]" value="{{ $pax['date_of_birth'] }}" class="form-control" placeholder="DBO" >
                                        <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                      </div>

                                 
                                   
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-3">
                                        <label>Nationality</label>
                                        <select name="pax[{{ $count }}][nationality_id]" class="form-control select2singlesingle nationality-id">
                                                <option selected value="" >Select Nationality</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ (old('nationality_id') == $country->id)? 'selected':( ($pax['nationality_id'] == $country->id)? 'selected':null) }}> {{ $country->name }} </option>
                                            @endforeach
                                        </select>
                                      </div>

                                      <div class="col-sm-3">
                                        <label>Resident In </label>
                                        <select name="pax[{{ $count }}][resident_in]" class="form-control select2single resident-in-id">
                                                <option selected value="" >Select Resident In</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ ($pax['resident_in'] == $country->id)? 'selected':null }}> {{ $country->name }} </option>
                                            @endforeach
                                        </select>
                                      </div>

                                      <div class="col-md-3 mb-2">
                                          <label>Bedding Preference</label> 
                                          <input type="text" name="pax[{{$count}}][bedding_preference]" value="{{ $pax['bedding_preference'] }}" class="form-control" placeholder="BEDDING PREFERENCES" >
                                          <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                      </div>
                                      <div class="col-md-3 mb-2">
                                          <label>Dinning Preference</label> 
                                          <input type="text" name="pax[{{$count}}][dinning_preference]" value="{{ $pax['dinning_preference'] }}" class="form-control" placeholder="DINNING PREFERENCES" >
                                          <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                      </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label>Up To Date Covid Vaccination Status</label>
                                          <div>
                                            <label class="radio-inline">
                                              <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="1" 
                                              @if($pax['covid_vaccinated'] == 1)
                                              checked
                                              @endif> Yes &nbsp;&nbsp;
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="0"
                                              @if($pax['covid_vaccinated'] == 0)
                                              checked
                                              @endif > No &nbsp;&nbsp;
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="2"
                                              @if($pax['covid_vaccinated'] == 2)
                                              checked
                                              @endif > Not Sure
                                            </label>
                                          </div>
                                        </div>
                                      </div>

                                      
                                  </div>
                              </div>
                          @endforeach
                      @endif
                  </div>
                </div>
                <div class="parent" id="parent">
                  <div class="row">
                    <div class="col-md-12 text-right mb-2 p-1">
                      <button type="button" class="btn btn-sm btn-outline-dark mr-2 expand-all-btn" >Expand All</button>
                      <button type="button" class="btn btn-sm btn-outline-dark mr-2 collapse-all-btn" >Collapse All</button>
                    </div>
                  </div>
                  @if($booking['booking'] && count($booking['booking']))
                  <div class="sortable sortable-spacing">
                    @foreach ($booking['booking'] as $key => $booking_detail )
                      <div class="quote card card-default quote-{{$key}}" data-key="{{$key}}">

                        <div class="card-header">
                          <h3 class="card-title card-title-style quote-title">
                            @if($booking_detail['status'] == 'active')
                              <span class="badge badge-success">Booked</span>
                            @elseif($booking_detail['status'] == 'cancelled')
                              <span class="badge badge-danger">Cancelled</span>
                            @endif
                            <span class="border-right mr-2 ml-1"></span>
                            <span class="badge badge-info badge-date-of-service">{{ isset($booking_detail['date_of_service']) && !empty($booking_detail['date_of_service']) ? $booking_detail['date_of_service'] : '' }}</span>
                            <span class="badge badge-info badge-time-of-service">{{ isset($booking_detail['time_of_service']) && !empty($booking_detail['time_of_service']) ? $booking_detail['time_of_service'] : '' }}</span>
                            <span class="badge badge-info badge-category-id">{{ isset($booking_detail['category_id']) && ($log->getQueryData($booking_detail['category_id'], 'Category')->count() > 0) ? $log->getQueryData($booking_detail['category_id'], 'Category')->first()->name : '' }}</span>
                            <span class="badge badge-info badge-supplier-id">{{ (isset($booking_detail['supplier_id']) && $log->getQueryData($booking_detail['supplier_id'], 'Supplier')->count() > 0 ) ? $log->getQueryData($booking_detail['supplier_id'], 'Supplier')->first()->name : '' }}</span>
                            <span class="badge badge-info badge-product-id">{{ (isset($booking_detail['product_id']) && $log->getQueryData($booking_detail['product_id'], 'Product')->count() > 0 ) ? $log->getQueryData($booking_detail['product_id'], 'Product')->first()->name : '' }}</span>
                            <span class="badge badge-info badge-supplier-currency-id">{{ (isset($booking_detail['supplier_currency_id']) && $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->count() > 0 ) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code.' - '.$log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->name : '' }}</span>
                          </h3>

                          <div class="card-tools">
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 collapse-expand-btn" title="Minimize/Maximize" data-card-widget="collapse"><i class="fas fa-minus"></i></a>
                          </div>
                        </div>

                        <div class="card-body">

                          <div class="row">

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Start Date of Service <span style="color:red">*</span></label>
                                <input type="text" value="{{ $booking_detail['date_of_service']}}" name="quote[{{ $key }}][date_of_service]" data-name="date_of_service" id="quote_{{ $key }}_date_of_service" class="form-control date-of-service datepicker checkDates bookingDateOfService"  placeholder="Date of Service" autocomplete="off">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>
                            
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>End Date of Service <span style="color:red">*</span></label>
                                <input type="text" value="{{ $booking_detail['end_date_of_service'] }}" name="quote[{{ $key }}][end_date_of_service]" data-name="date_of_service" id="quote_{{ $key }}_end_date_of_service" class="form-control end-date-of-service datepicker"  placeholder="Date of Service" autocomplete="off">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Number of Nights</label>
                                <input type="text" name="quote[{{ $key }}][number_of_nights]" value="{{ $booking_detail['number_of_nights'] }}" id="quote_{{ $key }}_number_of_nights" class="form-control number-of-nights" readonly>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Time of Service</label>
                                <input type="time" value="{{ $booking_detail['time_of_service'] }}" name="quote[{{ $key }}][time_of_service]" data-name="time_of_service" id="quote_{{ $key }}_time_of_service" class="form-control time-of-service" placeholder="Time of Service" autocomplete="off">
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Category</label>
                                <select name="quote[{{ $key }}][category_id]" data-name="category_id" id="quote_{{ $key }}_category_id" class="form-control select2single category-select2 category-id @error('category_id') is-invalid @enderror">
                                  <option value="">Select Category</option>
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" data-name="{{ $category->name }}" {{ ($booking_detail['category_id'] == $category->id)? 'selected' : NULL}} > {{ $category->name }} </option>
                                  @endforeach
                                </select>
                                @error('category_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Supplier Location <span style="color:red">*</span></label>
                                <select name="quote[{{ $key }}][supplier_location_id]" data-name="supplier_location_id" id="quote_{{ $key }}_supplier_location_id" class="form-control supplier-location-id select2single">
                                  <option value="">Select Location</option>
                                  @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" {{ ($booking_detail['supplier_location_id'] == $location->id)? 'selected' : NULL}}> {{ $location->name }} </option>
                                  @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            @php
                              $supplier_url = \Helper::getSupplierRateSheetUrl($booking_detail['supplier_id'], $booking['season_id']);
                              $url          = !empty($supplier_url) ? $supplier_url : '';
                              $text         = !empty($supplier_url) ? "(View Rate Sheet)" : '';
                            @endphp

                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>
                                  Supplier <span style="color:red">*</span>
                                  <a href="{{ $url }}" target="_blank" class="ml-1 view-supplier-rate">{{ $text }}</a>
                                </label>

                                  <select name="quote[{{ $key }}][supplier_id]" data-name="supplier_id" id="quote_{{ $key }}_supplier_id" class="form-control select2single supplier-id @error('supplier_id') is-invalid @enderror">
                                    <option value="">Select Supplier</option>
                                    @if(isset($booking_detail['category_id']) && isset($booking_detail['supplier_location_id']) && !empty($booking_detail['supplier_location_id']))
                                      @foreach ($log->getQueryData($booking_detail['category_id'], 'Category')->first()->getSupplierWithLocation($booking_detail['supplier_location_id'])->get() as $supplier )
                                      <option value="{{ $supplier->id }}" data-name="{{ $supplier->name }}" {{ ($booking_detail['supplier_id'] == $supplier->id)? 'selected' : NULL}}  >{{ $supplier->name }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                  @error('supplier_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                  @enderror
                              </div>
                            </div>
                            
                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Product</label>
                                <input type="text" name="quote[{{ $key }}][product_id]"  data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control product-id" value="{{ $booking_detail['product_id'] }}" placeholder="Enter Product">
                              </div>
                            </div> --}}

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Product Location </label>
                                <select name="quote[{{ $key }}][product_location_id]" data-name="product_location_id" id="quote_{{ $key }}_product_location_id" class="form-control product-location-id select2single @error('product_location_id') is-invalid @enderror">
                                  <option value="">Select Location</option>
                                  @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" {{ ($booking_detail['product_location_id'] == $location->id)? 'selected' : NULL}}> {{ $location->name }} </option>
                                  @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Product <a href="javascript:void(0)" class="ml-1 add-new-product d-none"> ( Add New Product ) </a></label>
                                <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control select2single  product-id @error('product_id') is-invalid @enderror">
                                  <option value="">Select Product</option>
                                  @if(isset($booking_detail['supplier_id']) && isset($booking_detail['product_location_id']) && !empty($booking_detail['product_location_id']))
                                    @foreach ($log->getQueryData($booking_detail['supplier_id'], 'Supplier')->first()->getProductsWithLocation($booking_detail['product_location_id'])->get() as  $product)
                                      <option value="{{ $product->id }}" data-name="{{ $product->name }}" {{ ($booking_detail['product_id'] == $product->id)? 'selected' : NULL}}>{{ $product->name }}</option>
                                    @endforeach
                                  @endif
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Supervisor</label>
                                <select name="quote[{{ $key }}][supervisor_id]" data-name="supervisor_id" id="quote_{{ $key }}_supervisor_id" class="form-control  select2single  supervisor-id @error('supervisor_id') is-invalid @enderror">
                                  <option value="">Select Supervisor</option>
                                  @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}" {{ ($booking_detail['supervisor_id'] == $supervisor->id)? 'selected' : NULL}}> {{ $supervisor->name }} </option>
                                  @endforeach
                                </select>
                                @error('supervisor_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div> --}}

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Date</label>
                                <input type="text" value="{{ $booking_detail['booking_date'] }}" name="quote[{{ $key }}][booking_date]" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" placeholder="Booking Date">
                              </div>
                            </div> --}}

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Due Date</label>
                                <input type="text" value="{{ $booking_detail['booking_due_date'] }}" name="quote[{{ $key }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date">
                              </div>
                            </div> --}}

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Reference</label>
                                <input type="text" value="{{ $booking_detail['booking_reference'] }}" name="quote[{{ $key }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $key }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
                              </div>
                            </div> --}}

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Method</label>
                                <select name="quote[{{ $key }}][booking_method_id]" data-name="booking_method_id" id="quote_{{ $key }}_booking_method_id" class="form-control select2single booking-method-id @error('booking_method_id') is-invalid @enderror">
                                  <option value="">Select Booking Method</option>
                                  @foreach ($booking_methods as $booking_method)
                                      <option value="{{ $booking_method->id }}" {{ $booking_detail['booking_method_id'] == $booking_method->id  ? "selected" : "" }}> {{ $booking_method->name }} </option>
                                  @endforeach
                                </select>
                                @error('booking_method_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div> --}}

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booked By</label>
                                <select name="quote[{{ $key }}][booked_by_id]" data-name="booked_by_id" id="quote_{{ $key }}_booked_by_id" class="form-control  select2single  booked-by-id @error('booked_by_id') is-invalid @enderror">
                                  <option value="">Select Booked By</option>
                                  @foreach ($booked_by as $book_id)
                                      <option value="{{ $book_id->id }}" {{ $booking_detail['booked_by_id'] == $book_id->id  ? "selected" : "" }}> {{ $book_id->name }} </option>
                                  @endforeach
                                </select>
                                @error('booked_by_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div> --}}

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Payment Type</label>
                                <select name="quote[{{ $key }}][booking_type_id]" data-name="booking_type_id" id="quote_{{ $key }}_booking_type_id" class="form-control select2single   booking-type-id @error('booking_type_id') is-invalid @enderror">
                                  <option value="">Select Payment Type</option>
                                  @foreach ($booking_types as $booking_type)
                                    <option value="{{ $booking_type->id }}" data-slug="{{ $booking_type->slug }}" {{ $booking_detail['booking_type_id'] == $booking_type->id  ? "selected" : "" }}> {{ $booking_type->name }} </option>
                                  @endforeach
                                </select>
                                @error('booking_type_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-sm-2 refundable-percentage-feild {{ isset($booking_detail['booking_type_id']) && !empty($booking_detail['booking_type_id']) && $booking_detail['booking_type_id'] == 2 ? '' : 'd-none'  }}">
                              <div class="form-group">
                                <label>Refundable % <span style="color:red">*</span></label>
                                <input type="number" name="quote[{{ $key }}][refundable_percentage]" value="{{ $booking_detail['refundable_percentage'] }}" data-name="refundable_percentage" id="quote_{{ $key }}_refundable_percentage" class="form-control refundable-percentage" placeholder="Refundable %">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Supplier Currency</label>
                                  <select name="quote[{{ $key }}][supplier_currency_id]" data-name="supplier_currency_id" id="quote_{{ $key }}_supplier_currency_id" class="form-control booking-supplier-currency-id @error('currency_id') is-invalid @enderror">
                                    <option value="">Select Supplier Currency</option>
                                    @foreach ($currencies as $currency)
                                      <option value="{{ $currency->id }}" data-name="{{ $currency->code.' - '.$currency->name }}" {{ $booking_detail['supplier_currency_id'] == $currency->id  ? "selected" : "" }}  data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                                    @endforeach
                                  </select>
                                  @error('currency_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                  @enderror
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Estimated Cost <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['estimated_cost']) }}" name="quote[{{ $key }}][estimated_cost]" data-name="estimated_cost" id="quote_{{ $key }}_estimated_cost" class="form-control estimated-cost change hide-arrows" value="0.00">
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Actual Cost <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['actual_cost']) }}" name="quote[{{ $key }}][actual_cost]" data-name="actual_cost" data-status="booking" id="quote_{{ $key }}_actual_cost" class="form-control actual-cost change" value="0.00">
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-2 booking-whole-markup-feilds {{ $booking['markup_type'] == 'whole' ? 'd-none' : '' }}">
                              <div class="form-group">
                                <label>Markup Amount <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['markup_amount']) }}" name="quote[{{ $key }}][markup_amount]" data-name="markup_amount" id="quote_{{ $key }}_markup_amount" class="form-control markup-amount change" value="0.00">
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-2 booking-whole-markup-feilds {{ $booking['markup_type'] == 'whole' ? 'd-none' : '' }}">
                              <div class="form-group">
                                <label>Markup % <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  {{-- <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                  </div> --}}
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['markup_percentage']) }}" name="quote[{{ $key }}][markup_percentage]" data-name="markup_percentage" id="quote_{{ $key }}_markup_percentage" class="form-control markup-percentage change" value="0.00">
                                  <div class="input-group-append">
                                    <div class="input-group-text">%</div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-2 booking-whole-markup-feilds {{ $booking['markup_type'] == 'whole' ? 'd-none' : '' }}">
                              <div class="form-group">
                                <label>Selling Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['selling_price']) }}" name="quote[{{ $key }}][selling_price]" data-name="selling_price" id="quote_{{ $key }}_selling_price" class="form-control selling-price hide-arrows" value="0.00" readonly>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-2 booking-whole-markup-feilds {{ $booking['markup_type'] == 'whole' ? 'd-none' : '' }}">
                              <div class="form-group">
                                  <label>Profit % <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['profit_percentage']) }}" name="quote[{{ $key }}][profit_percentage]" data-name="profit_percentage" id="quote_{{ $key }}_profit_percentage" class="form-control profit-percentage hide-arrows" value="0.00" readonly>
                                  <div class="input-group-append">
                                    <div class="input-group-text">%</div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Actual Cost in Booking Currency <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['actual_cost_bc']) }}" name="quote[{{ $key }}][actual_cost_in_booking_currency]" data-name="actual_cost_in_booking_currency" id="quote_{{ $key }}_actual_cost_in_booking_currency" class="form-control actual-cost-in-booking-currency"  readonly>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-3 booking-whole-markup-feilds {{ $booking['markup_type'] == 'whole' ? 'd-none' : '' }} ">
                              <div class="form-group">
                                <label>Markup Amount in Booking Currency <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['markup_amount_in_booking_currency']) }}" name="quote[{{ $key }}][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_{{ $key }}_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly> 
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-3 booking-whole-markup-feilds {{ $booking['markup_type'] == 'whole' ? 'd-none' : '' }} ">
                              <div class="form-group">
                                <label>Selling Price in Booking Currency <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['selling_price_in_booking_currency']) }}" name="quote[{{ $key }}][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_{{ $key }}_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
                                </div>
                              </div>
                            </div>
                            
                            {{-- @if(Auth::user()->getRole->slug == 'admin' || Auth::user()->getRole->slug == 'accountant')
                            <div class="col-sm-2 d-flex justify-content-center">
                              <div class="form-group">
                                <label>Added in Sage</label>
                                <div class="input-group"> 
                                  <div class="input-group-prepend">
                                    <div class="icheck-primary">
                                      <input type="hidden" name="quote[{{ $key }}][added_in_sage]" value="{{ $booking_detail['added_in_sage'] }}"><input data-name="added_in_sage" id="quote_{{ $key }}_added_in_sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($booking_detail['added_in_sage'] == 1) ? 'checked': '' }}> 
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endif --}}

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Service Details</label>
                                <textarea name="quote[{{ $key }}][service_details]" data-name="service_details" id="quote_{{ $key }}_service_details" class="form-control service-details" rows="2" placeholder="Enter Service Details">{{ $booking_detail['service_details'] }}</textarea>
                              </div>
                            </div>

                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Internal Comments</label>
                                <textarea name="quote[{{ $key }}][comments]" data-name="comments" id="quote_{{ $key }}_comments" class="form-control comments" rows="2" placeholder="Enter Comments">{{ $booking_detail['comments'] }}</textarea>
                              </div>
                            </div>

                            @if($booking_detail['invoice'])
                            <div class="col-sm-2">
                              <label>Invoice Preview</label>
                              <div class="form-group">
                                <a href="{{ url(Storage::url($booking_detail['invoice'])) }}" class="btn btn-outline-dark">Invoice</a>
                              </div>
                            </div>
                            @endif

                            <div class="col-sm-2 d-none">
                              <div class="form-group">
                                <label>Outstanding Amount left</label>
                                <input type="number" value="{{ \Helper::number_format($booking_detail['outstanding_amount_left']) }}" name="quote[{{ $key }}][outstanding_amount_left]" data-name="outstanding_amount_left" id="quote_{{ $key }}_outstanding_amount_left" class="form-control outstanding_amount_left hide-arrows">
                              </div>
                            </div>

                          </div>

                          <!-- Administration row -->
                          <h3 class="mt-2 mb-1-half">Administration</h3>
                          <div class="row administraion-row">

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Date</label>
                                <input type="text" value="{{ $booking_detail['booking_date'] }}" name="quote[{{ $key }}][booking_date]" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" autocomplete="off" placeholder="Booking Date">
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Due Date  <span style="color:red">*</span></label>
                                <input type="text" value="{{ $booking_detail['booking_due_date'] }}" name="quote[{{ $key }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Method</label>
                                <select name="quote[{{ $key }}][booking_method_id]" data-name="booking_method_id" id="quote_{{ $key }}_booking_method_id" class="form-control  select2single  booking-method-id @error('booking_method_id') is-invalid @enderror">
                                  <option value="">Select Booking Method</option>
                                  @foreach ($booking_methods as $booking_method)
                                      <option value="{{ $booking_method->id }}" {{ $booking_detail['booking_method_id'] == $booking_method->id  ? "selected" : "" }}> {{ $booking_method->name }} </option>
                                  @endforeach
                                </select>
                                @error('booking_method_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booked By</label>
                                <select name="quote[{{ $key }}][booked_by_id]" databooking="booked_by_id" id="quote_{{ $key }}_booked_by_id" class="form-control   select2single   booked-by-id @error('booked_by_id') is-invalid @enderror">
                                  <option value="">Select Booked By </option>
                                  @foreach ($booked_by as $book_id)
                                      <option value="{{ $book_id->id }}" {{ $booking_detail['booked_by_id'] == $book_id->id  ? "selected" : "" }}> {{ $book_id->name }} </option>
                                  @endforeach
                                </select>
                                @error('booked_by_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Supervisor</label>
                                <select name="quote[{{ $key }}][supervisor_id]" data-name="supervisor_id" id="quote_{{ $key }}_supervisor_id" class="form-control   select2single   supervisor-id @error('supervisor_id') is-invalid @enderror">
                                  <option value="">Select Supervisor</option>
                                  @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}" {{ ($booking_detail['supervisor_id'] == $supervisor->id) ? 'selected' : NULL }}> {{ $supervisor->name }} </option>
                                  @endforeach
                                </select>
                                @error('supervisor_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div>
                            
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Reference</label>
                                <input type="text" value="{{ $booking_detail['booking_reference'] }}" name="quote[{{ $key }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $key }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
                              </div>
                            </div>

                            @if(Auth::user()->getRole->slug == 'admin' || Auth::user()->getRole->slug == 'accountant')
                              <div class="col-sm-2 d-flex justify-content-center">
                                <div class="form-group">
                                  <label>Added in Sage</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="icheck-primary">
                                        <input type="hidden" name="quote[{{ $key }}][added_in_sage]" value="{{ $booking_detail['added_in_sage'] }}"><input data-name="added_in_sage" id="quote_{{ $key }}_added_in_sage" class="added-in-sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($booking_detail['added_in_sage'] == 1) ? 'checked': '' }}> 
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endif

                          </div>
                          <!-- End Administration row -->

                          @if($booking_detail['finance'] && count($booking_detail['finance']) > 0)
                            @foreach ($booking_detail['finance'] as $fkey => $finance)
                              @php $count =  $fkey + 1; @endphp
                              <h3 class="mt-2 mb-1-half">Payments</h3>
                              <div class="row finance-clonning row-cols-lg-7 g-0 g-lg-2 mt-2" data-financekey="{{$fkey}}">
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label class="depositeLabel" id="deposite_heading{{ $fkey }}"> Payment #{{ $count }}</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                      </div>
                                      <input type="number" value="{{ \Helper::number_format($finance['deposit_amount']) }}" name="quote[{{ $key }}][finance][{{ $fkey }}][deposit_amount]" data-name="deposit_amount" id="quote_{{$key}}_finance_{{$fkey}}_deposit_amount" value="0.00" class="form-control deposit-amount hide-arrows" step="any" >
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Due Date</label>
                                    <input type="date" value="{{ $finance['deposit_due_date'] }}" name="quote[{{ $key }}][finance][{{ $fkey }}][deposit_due_date]" data-name="deposit_due_date" id="quote_{{$key}}_finance_{{$fkey}}_deposit_due_date" class="form-control deposit-due-date">
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Paid Date</label>
                                    <input type="date" value="{{ $finance['paid_date'] }}" name="quote[{{ $key }}][finance][{{ $fkey }}][paid_date]" data-name="paid_date" id="quote_{{$key}}_finance_{{$fkey}}_paid_date" class="form-control paid-date">
                                  </div>
                                </div>

                                <div class="col-sm-2 d-flex justify-content-center">
                                  <div class="form-group">
                                    <label>Calender</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="icheck-primary">
                                          <input type="hidden" name="quote[{{ $key }}][finance][{{ $fkey }}][upload_to_calender]" value="{{ $finance['upload_to_calender'] }}"><input data-name="upload_to_calendar" id="quote_{{$key}}_finance_{{$fkey}}_upload_to_calendar" class="checkbox" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($finance['upload_to_calender'] == 1)? 'checked': NULL }}> 
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-1 d-flex justify-content-center">
                                  <div class="form-group">
                                    <button type="button" onclick="this.closest('.finance-clonning').remove()" class=" btn btn-outline-dark btn-sm">X</button>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Payment Method</label>
                                    <select  name="quote[{{ $key }}][finance][{{ $fkey }}][payment_method]" data-name="payment_method" id="quote_{{$key}}_finance_{{$fkey}}_payment_method" class="form-control payment-method select2single" >
                                      <option value="">Select Payment Method</option>
                                      @foreach ($payment_methods as $payment_method)
                                      <option value="{{ $payment_method->id }}" {{ $payment_method->id == $finance['payment_method_id'] ? 'selected' : '' }}> {{ $payment_method->name }} </option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Alert before the following days </label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <button type="button" class="input-group-text minus increment">-</button>
                                      </div>
                                      <input type="text"  name="quote[{{ $key }}][finance][{{$fkey}}][ab_number_of_days]" step="any" name="ab_number_of_days" class="form-control ab_number_of_days"  size="10" value="{{ $finance->additional_date??0 }}" {{ isset($finance->deposit_due_date) && !empty($finance->deposit_due_date) ? 'readonly' : '' }}>
                                        <div class="input-group-append">
                                        <button type="button" class="input-group-text plus increment">+</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label class="outstanding_amount_label">Outstanding Amount</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                      </div>
                                      <input type="number" value="{{ \Helper::number_format($finance['outstanding_amount']) }}" name="quote[{{ $key }}][finance][{{$fkey}}][outstanding_amount]" data-name="outstanding_amount" id="quote_{{$key}}_finance_{{$fkey}}_outstanding_amount" value="0.00" class="form-control outstanding-amount hide-arrows" step="any" readonly>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          @else
                            <h3 class="mt-2 mb-1-half">Payments</h3>
                            <div class="row finance-clonning row-cols-lg-7 g-0 g-lg-2 mt-2" data-financekey="0">
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label class="depositeLabel" id="deposite_heading{{ $key }}"> Payment #1</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                    </div>
                                    <input type="number" name="quote[{{ $key }}][finance][0][deposit_amount]" data-name="deposit_amount" id="quote_{{$key}}_finance_0_deposit_amount" value="0.00" class="form-control deposit-amount hide-arrows" step="any">
                                  </div>
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label>Deposit Due Date</label>
                                  <input type="date" name="quote[{{ $key }}][finance][0][deposit_due_date]" data-name="deposit_due_date" id="quote_{{$key}}_finance_0_deposit_due_date" value="" class="form-control deposit-due-date" >
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label>Paid Date</label>
                                  <input type="date" name="quote[{{ $key }}][finance][0][paid_date]" data-name="paid_date" id="quote_{{$key}}_finance_0_paid_date" value="" class="form-control paid-date" >
                                </div>
                              </div>

                              <div class="col-2 d-flex justify-content-center">
                                <div class="form-group">
                                  <label>Calender</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="icheck-primary">
                                        <input type="hidden" name="quote[{{ $key }}][finance][0][upload_to_calender]" value="0" ><input data-name="upload_to_calendar" id="quote_{{$key}}_finance_0_upload_to_calendar" class="checkbox" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"> 
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-sm-1 d-flex justify-content-center">
                                <div class="form-group">
                                  <button type="button" onclick="this.closest('.finance-clonning').remove()" class=" btn btn-outline-dark btn-sm">X</button>
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label>Payment</label>
                                  <select  name="quote[{{ $key }}][finance][0][payment_method]" data-name="payment_method" id="quote_{{$key}}_finance_0_payment_method" class="form-control payment-method select2single" >
                                    <option value="">Select Payment Method</option>
                                    @foreach ($payment_methods as $payment_method)
                                      <option value="{{ $payment_method->id }}"> {{ $payment_method->name }} </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label>Alert before the following days </label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text minus increment">-</span>
                                    </div>
                                      <input type="text"  name="quote[{{ $key }}][finance][0][ab_number_of_days]" step="any" name="ab_number_of_days" id="quote_{{$key}}_finance_0_ab_number_of_days" class="form-control ab_number_of_days"  size="10" value="0">
                                    <div class="input-group-append">
                                      <span class="input-group-text plus increment">+</span>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label class="outstanding_amount_label">Outstanding Amount</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                    </div>
                                    <input type="number" value="" name="quote[{{ $key }}][finance][0][outstanding_amount]" data-name="outstanding_amount" id="quote_{{$key}}_finance_0_outstanding_amount" value="0.00" class="form-control outstanding-amount hide-arrows" step="any" readonly>
                                  </div>
                                </div>
                              </div>

                              {{-- <div class="col-1">
                                    <button type="button" onclick="this.closest('.finance-clonning').remove()" class="btn btn-sm btn-outline-dark">X</button>
                              </div> --}}
                            </div>
                          @endif

                          @if($booking_detail['refund_payments'] && count($booking_detail['refund_payments']) > 0)
                            <section class="refund-by-credit-note-section" >
                              <h3 class="mt-2 mb-1-half">Refund - By Bank</h3>
                              @foreach ($booking_detail['refund_payments'] as $rpkey => $payment)
                                <div class="refund-payment-section">
                                  <div class="row refund-payment-row row-cols-lg-7 g-0 g-lg-2">
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label class="refund-payment-label" id="refund_payment_label_{{ $key }}">Refund Payment #{{ $count }}</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                          </div>
                                          <input type="number" value="{{ \Helper::number_format($payment['refund_amount']) }}" name="quote[{{ $key }}][refund][0][refund_amount]" id="quote_{{$key}}_refund_{{$rpkey}}_refund_amount" data-name="refund_amount"  class="form-control refund_amount amount hide-arrows" step="any">
                                          <span class="text-danger" role="alert"></span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label>Refund Date <span style="color:red">*</span></label>
                                        <input type="date" value="{{ $payment['refund_date'] }}" name="quote[{{ $key }}][refund][0][refund_date]" id="quote_{{$key}}_refund_{{$rpkey}}_refund_date" data-name="refund_date"  class="form-control">
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label>Bank <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][refund][0][bank]" id="quote_{{$key}}_refund_{{$rpkey}}_bank" data-name="bank"  class="form-control bank select2single">
                                          <option value="">Select Bank</option>
                                          @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}" {{ ($bank->id == $payment['bank_id']) ? 'selected' : '' }}> {{ $bank->name }} </option>
                                          @endforeach
                                        </select>
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Refund Confirmed By <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][refund][0][refund_confirmed_by]" id="quote_{{$key}}_refund_{{$rpkey}}_refund_confirmed_by"  data-name="refund_confirmed_by"  class="form-control refund_confirmed_by select2single">
                                          <option value="">Select User</option>
                                          @foreach ($sale_persons as $person)
                                            <option  value="{{ $person->id }}" {{ ($person->id == $payment['refund_confirmed_by']) ? 'selected' : '' }}>{{ $person->name }}</option>
                                          @endforeach
                                        </select>
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>

                                    <div class="col-sm-2 d-flex justify-content-center">
                                      <div class="form-group">
                                        <label>Refund Recieved</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="icheck-primary">
                                              <input type="hidden" name="quote[{{ $key }}][refund][{{ $fkey }}][refund_recieved]" value="{{ $payment['refund_recieved'] }}"><input data-name="refund_recieved" id="quote_{{$key}}_refund_{{$rpkey}}_refund_recieved" class="checkbox" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"  {{ ($payment['refund_recieved'] == 1)? 'checked': NULL }}> 
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-sm-1 d-flex justify-content-end">
                                      <div class="form-group">
                                        <button type="button" class="refund-payment-hidden-btn btn btn-outline-dark btn-sm d-none">X</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              @endforeach
                            </section>
                          @endif

                          @if($booking_detail['credit_notes'] && count($booking_detail['credit_notes']) > 0)
                            <section class="refund-by-credit-note-section" >
                              <h3 class="mt-2 mb-1-half">Refund - By Credit Notes</h3>
                              @foreach ($booking_detail['credit_notes'] as $cnkey => $payment)
                                @php
                                  $count = $cnkey + 1;
                                @endphp

                                <div class="credit-note-section">
                                  <div class="row credit-note-row else-here row-cols-lg-7 g-0 g-lg-2">
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label class="credit_note_label" id="credit_note_label_{{ $cnkey }}">Credit Note Amount Payment #{{$count}} <span style="color:red">*</span></label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                          </div>
                                          <input type="number" value="{{ \Helper::number_format($payment['credit_note_amount']) }}" name="quote[{{ $key }}][credit_note][{{$cnkey}}][credit_note_amount]" id="quote_{{ $key }}_credit_note_{{$cnkey}}_credit_note_amount" data-name="credit_note_amount" class="form-control credit-note-amount amount hide-arrows" step="any">
                                        </div>
                                      </div>
                                    </div>
                                    {{-- <div class="col-sm-2">
                                      <div class="form-group">
                                        <label>Credit Note No. <span style="color:red">*</span></label>
                                        <input type="text" value="{{$payment->credit_note_no}}" name="quote[{{ $key }}][credit_note][0][credit_note_no]" data-name="credit_note_no"  class="form-control" >
                                      </div>
                                    </div> --}}
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Credit Note Date <span style="color:red">*</span></label>
                                        <input type="date" value="{{ $payment['credit_note_recieved_date'] }}" name="quote[{{ $key }}][credit_note][{{$cnkey}}][credit_note_recieved_date]" id="quote_{{ $key }}_credit_note_{{$cnkey}}_credit_note_recieved_date" data-name="credit_note_recieved_date" class="form-control" >
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Credit Note Received By <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][credit_note][{{$cnkey}}][credit_note_recieved_by]" id="quote_{{ $key }}_credit_note_{{$cnkey}}_credit_note_recieved_by" data-name="credit_note_recieved_by" class="form-control credit_note_recieved_by select2single" >
                                          <option value="">Select User</option>
                                          @foreach ($sale_persons as $person)
                                            <option  value="{{ $person->id }}" {{ ($person->id == $payment['credit_note_recieved_by']) ? 'selected' : '' }}>{{ $person->name }}</option>
                                          @endforeach
                                        </select>
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>

                                    <div class="col-sm-1 d-flex justify-content-end">
                                      <div class="form-group">
                                        <button type="button" class="credit-note-hidden-btn btn btn-outline-dark btn-sm d-none">X</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              @endforeach
                            </section>
                          @endif

                        </div>

                      </div>
                    @endforeach
                  </div>
                  @endif
                </div>

                <div class="col-sm-6 agencyField {{ ($booking['agency'] == 0) ? 'd-none': '' }}">
                  <div class="form-group">
                    <label>Agency Commission Type <span style="color:red">*</span></label>
                    <div>
                      <label class="radio-inline">
                        <input type="radio" name="agency_commission_type" class="agency-commission-type" value="net-price" {{ $booking['agency'] == 1 && $booking['agency_commission_type'] == 'net-price' ? 'checked' : '' }}>&nbsp; Net Price &nbsp;&nbsp;
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="agency_commission_type" class="agency-commission-type" value="paid-net-of-commission" {{ $booking['agency'] == 1 && $booking['agency_commission_type'] == 'paid-net-of-commission' ? 'checked' : '' }}>&nbsp; Paid Net of Commission &nbsp;&nbsp;
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="agency_commission_type" class="agency-commission-type" value="we-pay-commission-on-departure" {{ $booking['agency'] == 1 && $booking['agency_commission_type'] == 'we-pay-commission-on-departure' ? 'checked' : '' }}>&nbsp; We pay Commission on Departure
                      </label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group row  mt-3">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Total Net Price</label>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="number" name="total_net_price" step="any" class="form-control total-net-price hide-arrows" step="any" min="0"  value="{{ \Helper::number_format($booking['net_price']) }}" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Total Markup Amount (Gross Margin)</label>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="number" value="{{ \Helper::number_format($booking['markup_amount']) }}"  step="any" class="form-control total-markup-amount hide-arrows" step="any" min="0" name="total_markup_amount" value="0.00" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">
                        {{-- <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                        </div> --}}
                        <input type="number" value="{{ \Helper::number_format($booking['markup_percentage']) }}"  step="any" class="form-control total-markup-percent hide-arrows" min="0" name="total_markup_percent" value="0.00" readonly>
                        <div class="input-group-append">
                          <div class="input-group-text">%</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="paid-net-commission-on-departure {{ $booking['agency'] == 1 && $booking['agency_commission_type'] == 'paid-net-of-commission' || $booking['agency'] == 1 && $booking['agency_commission_type'] == 'we-pay-commission-on-departure' ? '' : 'd-none' }} ">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Agency Commission</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ ($booking['currency_id'] && $log->getQueryData($booking['currency_id'], 'Currency')->count()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                          </div>
                          <input type="number" step="any" class="form-control agency-commission remove-zero-values" step="any" min="0" name="agency_commission" value="{{ \Helper::number_format($booking['agency_commission']) }}" >
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Net Margin</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ ($booking['currency_id'] && $log->getQueryData($booking['currency_id'], 'Currency')->count()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                          </div>
                          <input type="number" step="any" class="form-control total-net-margin remove-zero-values" step="any" min="0" name="total_net_margin" value="{{ \Helper::number_format($booking['total_net_margin']) }}" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Total Selling Price</label>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="number" value="{{ \Helper::number_format($booking['selling_price']) }}" step="any" name="total_selling_price" class="form-control total-selling-price hide-arrows" min="0.00" step="any"  value="0.00" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Total Profit Percentage</label>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" value="{{ \Helper::number_format($booking['profit_percentage']) }}" step="any" name="total_profit_percentage" class="form-control total-profit-percentage hide-arrows" min="0" step="any" value="0.00" readonly>
                        <div class="input-group-append">
                          <div class="input-group-text">%</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Booking Amount Per Person</label>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="number" value="{{  \Helper::number_format($booking['amount_per_person']) }}" step="any" class="form-control booking-amount-per-person hide-arrows" step="any" min="0" name="booking_amount_per_person" value="0.00" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Staff Commission</label>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="number" step="any" name="commission_amount" class="form-control commission-amount hide-arrows" min="0" step="any" value="{{ \Helper::number_format($booking['commission_amount']) }}" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Selling Price in Other Currency</label>
                      <select  name="selling_price_other_currency" class="form-control selling-price-other-currency @error('selling_price_other_currency') is-invalid @enderror">
                        <option value="">Select Currency</option>
                        @foreach ($currencies as $currency)
                        <option value="{{ $currency->code }}" {{ ($booking['selling_currency_oc'] == $currency->code) ? 'selected':NULL }} data-image="data:image/png;base64, {{$currency->flag}}" > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                        @endforeach
                      </select>
                      @error('selling_price_other_currency')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text selling-price-other-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="number" value="{{ \Helper::number_format($booking['selling_price_ocr']) }}" step="any" name="selling_price_other_currency_rate" min="0" step="any" class="form-control selling-price-other-currency-rate hide-arrows" value="0.00" readonly>
                      </div>
                    </div>
                  </div>
                </div>


                {{-- <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3 ">
                      <label for="inputEmail3" class="col-form-label">Relevant Quotes</label>
                    </div>
                    <div class="col-md-9">
                      <div class="row">
                        <div class="col-sm-3 relevant-quote">
                          <select  name="revelant_quote[]" multiple class="form-control select2-multiple">
                            @if(isset($booking['revelant_quote']) && !empty($booking['revelant_quote']))
                              @foreach ($booking['revelant_quote'] as $revQuote)
                                <option selected value="{{$revQuote}}"> {{ $revQuote }} </option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}

              @if($booking['booking_status'] == 'cancelled' && count($booking['cancel_booking_refund_payments']) > 0)
              
                <section class="cancellation-payments-section mt-3 mb-2">

                  <div class="cancellation-payments">
                    <h3 class="mb-2">Booking Cancellation Refund Payments</h3>
                    <div class="row mb-2">
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Total Refund Amount</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['booking_cancellations']['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['booking_cancellations']['currency_id'], 'Currency')->first()->code : '' }}</span>
                            </div>
                            <input type="number" value="{{ isset($booking['booking_cancellations']['total_refund_amount']) && !empty($booking['booking_cancellations']['total_refund_amount']) ? $booking['booking_cancellations']['total_refund_amount'] : '' }}" name="cancellation_refund_total_amount" data-name="cancellation_refund_total_amount" id="cancellation_refund_total_amount" class="form-control cancellation-refund-total-amount amount hide-arrows" step="any" readonly disabled>
                          </div>
                        </div>
                      </div>
                    </div>

                    @foreach ($booking['cancel_booking_refund_payments'] as $bcrpdKey => $payment)
                      @php
                        $count = $bcrpdKey + 1;
                      @endphp

                      <div class="row cancellation-refund-payment-row mb-2">
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label class="cancellation-refund-payment-label" id="cancellation_refund_payment_label_{{$bcrpdKey}}">Refund Amount #{{$count}} </label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                              </div>
                              <input type="number" value="{{ \Helper::number_format($payment['refund_amount']) }}" name="cancellation_refund[{{$bcrpdKey}}][refund_amount]" data-name="refund_amount" id="cancellation_refund_{{$bcrpdKey}}_refund_amount" class="form-control cancellation-refund-amount amount hide-arrows" step="any">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Refund Date </label>
                            <input type="date" value="{{ $payment['refund_date'] }}" name="cancellation_refund[{{$bcrpdKey}}][refund_date]" id="cancellation_refund_{{$bcrpdKey}}_refund_date" data-name="refund_date"  class="form-control">
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Refund Approved Date </label>
                            <input type="date" value="{{ $payment['refund_approved_date'] }}" name="cancellation_refund[{{$bcrpdKey}}][refund_approved_date]" id="cancellation_refund_{{$bcrpdKey}}_refund_approved_date" data-name="refund_approved_date"  class="form-control">
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Refund Approved By </label>
                            <select  name="cancellation_refund[{{$bcrpdKey}}][refund_approved_by]" data-name="refund_approved_by" id="cancellation_refund_{{$bcrpdKey}}_refund_approved_by" class="form-control refund_approved_by select2single" >
                              <option value="">Select User</option>
                              @foreach ($sale_persons as $person)
                                <option  value="{{ $person->id }}" {{ ($person->id == $payment['refund_approved_by']) ? 'selected' : '' }}>{{ $person->name }}</option>
                              @endforeach
                            </select>
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Refund Processed By </label>
                            <select  name="cancellation_refund[{{$bcrpdKey}}][refund_processed_by]" data-name="refund_processed_by" id="cancellation_refund_{{$bcrpdKey}}_refund_processed_by" class="form-control refund_processed_by select2single" >
                              <option value="">Select User</option>
                              @foreach ($sale_persons as $person)
                                <option  value="{{ $person->id }}" {{ ($person->id == $payment['refund_processed_by']) ? 'selected' : '' }}>{{ $person->name }}</option>
                              @endforeach
                            </select>
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Refund Process From </label>
                            <select  name="cancellation_refund[{{$bcrpdKey}}][refund_process_from]" data-name="refund_process_from" id="cancellation_refund_{{$bcrpdKey}}_refund_process_from" class="form-control refund_process_from select2single" >
                              <option value="">Select Bank</option>
                              @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}" {{ ($bank->id == $payment['bank_id']) ? 'selected' : '' }}> {{ $bank->name }} </option>
                              @endforeach
                            </select>
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>

                        <div class="col-sm-1 d-flex justify-content-center">
                          <div class="form-group">
                            <button type="button" onclick="this.closest('.cancellation-refund-payment-row').remove()" class="cancellation-refund-payment-row-remove-btn btn btn-outline-dark btn-sm d-none" >X</button>
                          </div>
                        </div>

                      </div>

                    @endforeach
              
                  </div>
                </section>
              @endif
          
            </div>


            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @include('partials.view_rates_modal')
@endsection
