@extends('layouts.app')
@section('title', 'View Booking Version')
@section('content')
<div class="content-wrapper">

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

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-base">
            <div class="card-header">
              <h3 class="card-title text-center lh-2">Version Bookings #{{ $log->log_no }} {{ $log->version_no }} </h3>

              <a href="{{ route('bookings.edit', encrypt($log->booking_id)) }}" class="btn btn-dark btn-sm float-right" title="Back">
                <span class="fa fa-arrow-left"></span>&nbsp;&nbsp;Back
              </a>
            </div>

            <form method="POST" id="version_booking"> 
              @csrf @method('put')
              <div class="card-body">
                <!-- For Commission Calculation -->
                <div class="row d-none">

                  <div class="col-sm-6">
                    <label>User ID <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" value="{{ isset($booking->id) && !empty($booking->id) ? $booking->id : '' }}" name="user_id" id="user_id" class="form-control user-id">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <label>Commission <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" value="{{ isset($booking->commission_id) && !empty($booking->commission_id) ? $booking->commission_id : '' }}" name="commission_id" id="commission_id" class="form-control commission-id">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <label>Commission Group <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" value="{{ isset($booking->commission_group_id) && !empty($booking->commission_group_id) ? $booking->commission_group_id : '' }}" name="commission_group_id" id="commission_group_id" class="form-control commission-group-id">
                    </div>
                  </div>
                </div>
                <!-- For Commission Calculation -->

                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Zoho Reference <span class="text-danger">*</span></label>
                      <input type="text" value="{{ $booking->ref_no }}" name="ref_no" class="form-control" placeholder="Enter Reference Number" autofocus>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Quote Reference <span class="text-danger">*</span></label>
                      <input type="text" name="quote_no" value="{{ $booking->quote_ref }}" class="form-control" placeholder="Quote Reference Number" readonly>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label>Booking Details <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" name="booking_details" id="booking_details" class="form-control" value="{{ isset($booking->booking_details) & !empty($booking->booking_details) ? $booking->booking_details : '' }}" placeholder="Enter Booking Details" autofocus>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label>Reason for Trip <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" name="reason_for_trip" id="reason_for_trip" class="form-control" value="{{ $booking->reason_for_trip }}" placeholder="Enter Reason for Trip">
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Destination Country <span style="color:red">*</span></label>
                      <select name="country_destination_ids[]" id="country_destination_ids" class="form-control select2-multiple country-destination" data-placeholder="Select Destination Country" multiple>
                        @foreach ($supplier_countries as $country)
                          <option value="{{ $country->id }}" {{ in_array($country->id, json_decode($booking->country_destination_ids)) ? 'selected' : NULL}} >{{ $country->name }} - {{ $country->code}}</option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-md-4 d-flex justify-content-end">
                    <div class="form-group">
                      <label>Markup Type <span style="color:red">*</span></label>
                      <div class="d-flex flex-row">
                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" name="markup_type" id="itemised" value="itemised" class="booking-markup-type custom-control-input custom-control-input-success custom-control-input-outline" {{ ($booking->markup_type == 'itemised') ? 'checked': '' }}>
                          <label class="custom-control-label" for="itemised">Itemised Markup </label>
                        </div>

                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" name="markup_type" id="whole" value="whole" class="booking-markup-type custom-control-input custom-control-input-success custom-control-input-outline" {{ ($booking->markup_type == 'whole') ? 'checked': '' }} >
                          <label class="custom-control-label" for="whole">Whole Markup</label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Currency Rate Type <span style="color:red">*</span><a href="javascript:void(0);" class="ml-2 view-rates"> (View Rates)</a> </label>
                      <div class="d-flex flex-row">
                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" name="rate_type" id="live_rate" data-status="booking" class="rate-type custom-control-input custom-control-input-success custom-control-input-outline" value="live" {{ ($booking->rate_type == 'live') ? 'checked': '' }} {{ (Auth::user()->id != 1) ? 'disabled' : '' }}>
                          <label class="custom-control-label" for="live_rate">Live Rate</label>
                        </div>

                        <div class="custom-control custom-radio">
                          <input type="radio" name="rate_type" id="manual_rate" data-status="booking" class="rate-type custom-control-input custom-control-input-success custom-control-input-outline" value="manual" {{ ($booking->rate_type == 'manual') ? 'checked': '' }}>
                          <label class="custom-control-label" for="manual_rate">Manual Rate</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Sales Person <span style="color:red">*</span></label>
                      <select name="sale_person_id" id="sale_person_id" class="form-control  select2single  sales-person-id">
                        <option value="">Select Sales Person</option>
                        @foreach ($sale_persons as $person)
                          <option  value="{{ $person->id }}" data-email="{{ $person->email }}"  {{ $booking->sale_person_id == $person->id ? 'selected' : '' }}>{{ $person->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>
                
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Brand <span style="color:red">*</span></label>
                      <select name="brand_id" id="brand_id" class="form-control  select2single  getBrandtoHoliday brand-id ">
                        <option value="">Select Brand</option>
                        @foreach ($brands as $brand)
                          <option value="{{ $brand->id }}" {{ $booking->brand_id == $brand->id ? 'selected': ''  }}> {{ $brand->name }} </option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Type Of Holiday <span class="text-danger">*</span></label> 
                      <select name="holiday_type_id" id="holiday_type_id" class="form-control select2single appendHolidayType holiday-type-id">
                        <option value="">Select Type Of Holiday</option>
                        @if(!empty($log->getQueryData($booking->brand_id, 'Brand')->first()->getHolidayTypes))
                          @foreach ($log->getQueryData($booking->brand_id, 'Brand')->first()->getHolidayTypes as $holiday_type)
                            <option value="{{ $holiday_type->id }}" {{ $booking->holiday_type_id == $holiday_type->id ? 'selected' : '' }} >{{ $holiday_type->name }}</option>
                          @endforeach
                        @endif
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Booking Season <span class="text-danger">*</span></label>
                      <select name="season_id" id="season_id" class="form-control select2single season-id">
                        <option value="">Select Booking Season</option>
                        @foreach ($seasons as $season)
                          <option value="{{ $season->id }}" {{ $booking->season_id == $season->id ? 'selected' : '' }}> {{ $season->name }} </option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Booking Currency <span class="text-danger">*</span></label>
                      <select name="currency_id" data-status="booking"  id="currency_id" class="form-control select2single booking-currency-id">
                        <option value="">Select Booking Currency </option>
                        @foreach ($currencies as $currency)
                          <option value="{{ $currency->id }}"  data-image="data:image/png;base64, {{$currency->flag}}" {{ $currency->id == $booking->currency_id ? 'selected' : ''  }} > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Supplier Currency <span style="color:red">*</span></label>
                      <select name="default_supplier_currency_id" id="default_supplier_currency_id" class="form-control select2single default-supplier-currency-id">
                        <option selected value="">Select Currency</option>
                        @foreach ($currencies as $currency)
                          <option value="{{ $currency->id }}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}" {{ $currency->id == $booking->default_supplier_currency_id ? 'selected' : '' }}> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Departure Date <span style="color:red">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend"> <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> </div>
                        <input type="text" placeholder="DD/MM/YYYY" value="{{$booking->departure_date}}" name="booking_departure_date" id="quote_departure_date" class="form-control departure-date datepicker" autocomplete="off">
                      </div>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Return Date <span style="color:red">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend"> <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> </div>
                        <input type="text" placeholder="DD/MM/YYYY" value="{{$booking->return_date}}" name="booking_return_date" id="quote_return_date" class="form-control return-date datepicker" autocomplete="off">
                      </div>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Agency Booking <span style="color:red">*</span></label>
                      <div class="d-flex flex-row">
                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" class="select-agency custom-control-input custom-control-input-success custom-control-input-outline" value="1" name="agency" id="agency_yes" {{ ($booking->agency ==  1) ? 'checked' : '' }}> 
                          <label class="custom-control-label" for="agency_yes">Yes</label>
                        </div>

                        <div class="custom-control custom-radio">
                          <input type="radio" class="select-agency custom-control-input custom-control-input-success custom-control-input-outline" value="0" name="agency" id="agency_no" {{ ($booking->agency ==  0 || $booking->agency == null) ? 'checked' : '' }}>
                          <label class="custom-control-label" for="agency_no">No</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Agency "Yes" / "No" fields -->
                  <div class="col-md-12 agency-columns">

                    <!-- Agency "Yes" fields -->
                    <div class="row agencyField {{ ($booking->agency == 0) ? 'd-none': '' }}">

                      <div class="col form-group">
                        <label> Agency Name</label> <span style="color:red"> *</span>
                        <input type="text" name="agency_name" id="agency_name" class="form-control" value="{{ $booking->agency_name }}" placeholder="Agency Name">
                        <span class="text-danger" role="alert"></span>
                      </div>

                      <div class="col form-group">
                        <label> Agency Contact Name </label> <span style="color:red"> *</span>
                        <input type="text" name="agency_contact_name" id="agency_contact_name" value="{{ $booking->agency_contact_name }}" class="form-control" placeholder="Agency Contact Name">
                        <span class="text-danger" role="alert"></span>
                      </div>

                      <div class="col form-group">
                        <label> Agency Contact No.</label> <span style="color:red"> *</span>
                        <input type="tel" name="agency_contact" id="agency_contact" value="{{ $booking->agency_contact }}" class="form-control phone phonegc">
                        <span class="text-danger error_msggc hide" role="alert"></span>
                        <span class="text-success valid_msggc" role="alert"></span>
                      </div>

                      <div class="col form-group">
                        <label> Agency Email </label> <span style="color:red"> *</span>
                        <input type="email" name="agency_email" id="agency_email" value="{{ $booking->agency_email }}" class="form-control" placeholder="Agency Email Address">
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <!-- Agency "No" fields -->
                    <div class="row mt-1 PassengerField {{ ($booking->agency == 1) ? 'd-none': '' }}">

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Lead Passenger Name <span style="color:red">*</span></label>
                          <input type="text" name="lead_passenger_name" id="lead_passenger_name" value="{{ $booking->lead_passenger_name }}" class="form-control" placeholder="Lead Passenger Name">
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Email Address <span style="color:red">*</span></label> 
                          <input type="email" name="lead_passenger_email" id="lead_passenger_email" value="{{ $booking->lead_passenger_email }}" class="form-control" placeholder="Email Address">
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Contact Number <span style="color:red">*</span></label> 
                          <input type="tel" value="{{ $booking->lead_passenger_contact }}" name="lead_passenger_contact" id="lead_passenger_contact"  class="form-control phone phone0">
                          <span class="text-danger error_msg0" role="alert"></span>
                          <span class="text-success valid_msg0" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Date Of Birth </label> 
                          <input type="text" name="lead_passenger_dbo" id="lead_passenger_dbo"  value="{{ $booking->lead_passenger_dbo }}" max="{{ date('Y-m-d') }}" class="form-control lead-passenger-dbo" placeholder="Date Of Birth">
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Nationality (Passport)</label>
                          <select name="lead_passsenger_nationailty_id" id="lead_passsenger_nationailty_id" class="form-control select2single nationality-id">
                            <option selected value="" >Select Nationality</option>
                            @foreach ($countries as $country)
                              <option value="{{ $country->id }}" {{ $booking->lead_passsenger_nationailty_id == $country->id ? 'selected': '' }}> {{ $country->name }} </option>
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
                              <option value="{{ $country->id }}" {{ ($booking->lead_passenger_resident == $country->id) ? 'selected': '' }}> {{ $country->name }} </option>
                            @endforeach
                          </select>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Bedding Preferences </label>
                          <input type="text" name="lead_passenger_bedding_preference" id="lead_passenger_bedding_preference" value="{{ $booking->lead_passenger_bedding_preference }}" class="form-control" placeholder="Bedding Preferences">
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>  

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Dietary Preferences </label>
                          <input type="text"  name="lead_passenger_dietary_preferences" id="lead_passenger_dietary_preferences" value="{{ $booking->lead_passenger_dietary_preferences }}" class="form-control" placeholder="Dietary Preferences">
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Medical Requirements</label>
                          <input type="text" name="lead_passenger_medical_requirement" id="lead_passenger_medical_requirement" value="{{ $booking->lead_passenger_medical_requirement }}" class="form-control" placeholder="Medical Requirements">
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Up To Date Covid Vaccination Status</label>
                          <div class="d-flex flex-row">
                            <div class="custom-control custom-radio mr-1">
                              <input type="radio" name="lead_passenger_covid_vaccinated" id="lpcv_yes" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="1" {{ ($booking->lead_passenger_covid_vaccinated ==  1) ? 'checked' : '' }}>
                              <label class="custom-control-label" for="lpcv_yes">Yes</label>
                            </div>

                            <div class="custom-control custom-radio mr-1">
                              <input type="radio" name="lead_passenger_covid_vaccinated" id="lpcv_no" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="0" {{ ($booking->lead_passenger_covid_vaccinated ==  0 || $booking->lead_passenger_covid_vaccinated == null) ? 'checked' : '' }} >
                              <label class="custom-control-label" for="lpcv_no">No</label>
                            </div>

                            <div class="custom-control custom-radio mr-1">
                              <input type="radio" name="lead_passenger_covid_vaccinated" id="lpcv_not_sure" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="2" {{ ($booking->lead_passenger_covid_vaccinated ==  2 || $booking->lead_passenger_covid_vaccinated == null) ? 'checked' : '' }}>
                              <label class="custom-control-label" for="lpcv_not_sure">Not Sure</label>
                            </div>
                          </div>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Pax No. <span class="text-danger">*</span></label>
                      <select name="pax_no" id="pax_no" class="form-control select2single paxNumber pax-number">
                        <option value="">Select Pax No</option>
                        @for($i=1; $i<=30; $i++)
                          <option value="{{$i}}" {{ $booking->pax_no == $i ? 'selected': '' }}> {{$i}} </option>
                        @endfor
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div id="appendPaxName" class="col-md-12">
                    @if($booking->pax_no >= 1)
                      @foreach ($booking->pax as $paxKey => $pax )
                        @php 
                          $count = $paxKey + 1; 
                          $pax = (object) $pax;
                        @endphp
                        <div class="mt-1 appendCount border rounded p-3 mb-1" id="appendCount{{ $count }}">
                          <div class="row">

                            <div class="col-md-12">
                              <button type="button" class="remove-pax-column btn btn-sm btn-dark float-right"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="mainLabel">Passenger #{{ ($booking->agency == 1)? $count : $count +1 }} Full Name</label> 
                                <input type="text" name="pax[{{$count}}][full_name]" value="{{ $pax->full_name }}" class="form-control" placeholder="Passsenger Name">
                                <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Email Address</label> 
                                <input type="email" name="pax[{{$count}}][email_address]" value="{{ $pax->email_address }}" class="form-control" placeholder="Email Address">
                                <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Contact Number</label> 
                                <input type="tel" name="pax[{{$count}}][contact_number]" value="{{ $pax->contact_number }}" class="form-control phone phone{{ $count }}">
                                <span class="text-danger error_msg{{ $count }}" role="alert" > </span>
                                <span class="text-success valid_msg{{ $count }}" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Date Of Birth</label> 
                                <input type="date" max="{{ date("Y-m-d") }}" name="pax[{{$count}}][date_of_birth]" value="{{ $pax->date_of_birth }}" class="form-control" placeholder="Date Of Birth">
                                <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                              </div>
                            </div>
                      
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Nationality</label>
                                <select name="pax[{{ $count }}][nationality_id]" class="form-control select2single nationality-id">
                                  <option selected value="" >Select Nationality</option>
                                  @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ $pax->nationality_id == $country->id ? 'selected' : '' }}> {{ $country->name }} </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Resident In</label>
                                <select name="pax[{{ $count }}][resident_in]" class="form-control select2single resident-in-id">
                                  <option selected value="" >Select Resident In</option>
                                  @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ $pax->resident_in == $country->id ? 'selected' : '' }}> {{ $country->name }} </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                        
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Bedding Preference</label> 
                                <input type="text" name="pax[{{$count}}][bedding_preference]" value="{{ $pax->bedding_preference }}" class="form-control" placeholder="Bedding Preferences">
                                <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                              </div>
                            </div>
                            
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Dietary Preferences</label> 
                                <input type="text" name="pax[{{$count}}][dietary_preferences]" value="{{ $pax->dietary_preferences }}" class="form-control" placeholder="Dietary Preferences">
                                <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Medical Requirements </label>
                                <input type="text" name="pax[{{$count}}][medical_requirement]" value="{{ $pax->medical_requirement }}" class="form-control" placeholder="Medical Requirements">
                                <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                              </div>
                            </div>


                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Up To Date Covid Vaccination Status</label>
                                <div class="d-flex flex-row">

                                  <div class="custom-control custom-radio mr-1">
                                    <input type="radio" name="pax[{{$count}}][covid_vaccinated]" id="pax_cv_yes_{{$count}}" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="1" @if($pax->covid_vaccinated == 1) checked @endif>
                                    <label class="custom-control-label" for="pax_cv_yes_{{$count}}"> Yes</label>
                                  </div>

                                  <div class="custom-control custom-radio mr-1">
                                    <input type="radio" name="pax[{{$count}}][covid_vaccinated]" id="pax_cv_no_{{$count}}" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="0" @if($pax->covid_vaccinated == 0) checked @endif>
                                    <label class="custom-control-label" for="pax_cv_no_{{$count}}">No</label>
                                  </div>

                                  <div class="custom-control custom-radio mr-1">
                                    <input type="radio" name="pax[{{$count}}][covid_vaccinated]" id="pax_cv_not_sure_{{$count}}" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="2" @if($pax->covid_vaccinated == 2) checked @endif> 
                                    <label class="custom-control-label" for="pax_cv_not_sure_{{$count}}">Not Sure</label>
                                  </div>

                                </div>
                              </div>
                            </div>
                          
                          </div>
                        </div>
                      @endforeach
                    @endif
                  </div>

                  <div class="col-md-12">
                    <button type="button" class="add-pax-column btn btn-sm btn-dark float-right"><i class="fa fa-plus" aria-hidden="true"></i></button>
                  </div>
                </div>

                <div class="parent" id="parent">
                  @include('quote_booking_includes.expand_collapse_quote_detail_cards')

                  @if($booking->booking && count($booking->booking))
                  <div class="sortable sortable-spacing">
                    @foreach ($booking->booking as $key => $booking_detail)

                      @php
                      $booking_detail = (object) $booking_detail;
                      @endphp

                      {{-- {{
                        dd($booking_detail )
                      }} --}}
                      <div class="quote card card-default quote-{{$key}}" data-key="{{$key}}">

                        <div class="card-header">
                          <h3 class="card-title card-title-style quote-title">
                            <div class="badge-service-status d-inline">
                              @if($booking_detail->status == 'not_booked')
                                <span class="badge badge-warning">Not Booked</span> 
                              @elseif($booking_detail->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                              @elseif($booking_detail->status == 'booked')
                                <span class="badge badge-success">Booked</span>
                              @elseif($booking_detail->status == 'pending')
                                <span class="badge badge-danger">Cancelled</span>
                              @endif
                            </div>
                              
                            <span class="badge badge-info badge-date-of-service">{{ isset($booking_detail->date_of_service) && !empty($booking_detail->date_of_service) ? $booking_detail->date_of_service : '' }}</span>
                            <span class="badge badge-info badge-end-date-of-service">{{ isset($booking_detail->end_date_of_service) && !empty($booking_detail->end_date_of_service) ? $booking_detail->end_date_of_service : '' }}</span>
                            <span class="badge badge-info badge-time-of-service">{{ isset($booking_detail->time_of_service) && !empty($booking_detail->time_of_service) ? $booking_detail->time_of_service : '' }}</span>
                            <span class="badge badge-info badge-category-id">{{ isset($booking_detail->getCategory->name) && !empty($booking_detail->getCategory->name) ? $booking_detail->getCategory->name : '' }}</span>
                            <span class="badge badge-info badge-group-owner-id">{{ isset($booking_detail->getGroupOwner->name) && !empty($booking_detail->getGroupOwner->name) ? $booking_detail->getGroupOwner->name : '' }}</span>
                            <span class="badge badge-info badge-supplier-id">{{ isset($booking_detail->getSupplier->name) && !empty($booking_detail->getSupplier->name) ? $booking_detail->getSupplier->name : ''}}</span>
                            <span class="badge badge-info badge-product-id">{{ isset($booking_detail->getProduct->name) && !empty($booking_detail->getProduct->name) ? $booking_detail->getProduct->name : '' }}</span>
                            {{-- <span class="badge badge-info badge-supplier-currency-id">{{ isset($booking_detail->getSupplierCurrency->name) && !empty($booking_detail->getSupplierCurrency->name) ? $booking_detail->getSupplierCurrency->code.' - '.$booking_detail->getSupplierCurrency->name : '' }}</span> --}}
                            <span class="badge badge-info badge-pick-up-location"></span>
                            <span class="badge badge-info badge-drop-off-location"></span>
                            <span class="badge badge-info badge-room-type"></span>
                            <span class="badge badge-info badge-departure-harbour"></span>
                            <span class="badge badge-info badge-arrival-harbour"></span>
                            <span class="badge badge-info badge-departure-airport"></span>
                            <span class="badge badge-info badge-arrival-airport"></span>
                            <span class="badge badge-info badge-misc-details"></span>
                            <span class="badge badge-info badge-departure-station"></span>
                            <span class="badge badge-info badge-arrival-station"></span>
                          </h3>

                          <div class="card-tools">
                            <input type="hidden" name="quote[{{ $key }}][booking_detail_unique_ref_id]" value="{{ $booking_detail->booking_detail_unique_ref_id }}" >
                            <input type="hidden" name="quote[{{ $key }}][created_by]" id="quote_{{ $key }}_created_by" value="{{ isset($booking_detail->getBookingCancellation->cancelled_by_id) && !empty($booking_detail->getBookingCancellation->cancelled_by_id) ? $booking_detail->getBookingCancellation->cancelled_by_id : Auth::id() }}" >
                            <input type="hidden" name="quote[{{ $key }}][status]" id="quote_{{ $key }}_status" value="{{ isset($booking_detail->status) && !empty($booking_detail->status) ? $booking_detail->status : '' }}" >
                
                            <div class="status-setting btn-group dropleft m-point-3">
                              <button type="button" class="btn btn-sm btn-outline-dark rounded" title="Status Setting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                              </button>
                              <div class="dropdown-menu">
                                <button type="button" data-action_type="not_booked" data-action="{{ route('bookings.booking.detail.status', ['not_booked', encrypt($booking_detail->id)]) }}" class="dropdown-item booking-detail-status"><i class="fa fa-question-circle text-warning m-point-3" aria-hidden="true"></i> Not Booked</button>
                                <button type="button" data-action_type="pending" data-action="{{ route('bookings.booking.detail.status', ['pending', encrypt($booking_detail->id)]) }}" class="dropdown-item booking-detail-status"><i class="fa fa-clock text-info m-point-3" aria-hidden="true"></i> Pending</button>
                                <button type="button" data-action_type="booked" data-action="{{ route('bookings.booking.detail.status', ['booked', encrypt($booking_detail->id)]) }}" class="dropdown-item booking-detail-status"><i class="fa fa-check text-success m-point-3" aria-hidden="true"></i> Booked</button>
                                <button type="button" data-action_type="cancelled" data-action="{{ route('bookings.booking.detail.status', ['cancelled', encrypt($booking_detail->id)]) }}" class="dropdown-item booking-detail-status"><i class="fa fa-times text-danger m-point-3" aria-hidden="true"></i> Cancelled</button>
                              </div>
                            </div>

                            <button type="button" class="btn btn-sm btn-outline-dark add-new-service-below m-point-3"><i class="fas fa-plus"></i> &nbsp;<i class="fas fa-level-down-alt"></i></i></button>
                            <button type="button" class="btn btn-sm btn-outline-dark collapse-expand-btn m-point-3" title="Minimize/Maximize" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="remove-booking-detail-service btn btn-sm btn-outline-dark m-point-3" title="Remove"><i class="fas fa-times"></i></button>
                          </div>
                        </div>

                        <div class="card-body">
                          <div class="row">

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Status</label>
                                <select name="quote[{{ $key }}][status]" data-name="status" id="quote_{{ $key }}_status" class="form-control select2single booking-detail-status">
                                  <option value="">Select Status</option>
                                  @foreach ($booking_detail_statuses as $status)
                                    <option value="{{ $status }}" data-name="{{ $status }}" {{ $booking_detail->status == $status ? 'selected' : '' }} >{{ ucwords(str_replace('_', ' ', $status)) }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Date of Service <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                  </div>
                                  <input type="text" value="{{ $booking_detail->date_of_service }}" name="quote[{{ $key }}][date_of_service]" data-name="date_of_service" id="quote_{{ $key }}_date_of_service" class="form-control date-of-service datepicker checkDates bookingDateOfService"  placeholder="DD/MM/YYYY" autocomplete="off">
                                </div>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>End Date of Service <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                  </div>
                                  <input type="text" placeholder="DD/MM/YYYY" value="{{ $booking_detail->end_date_of_service }}" name="quote[{{ $key }}][end_date_of_service]" data-name="end_date_of_service" id="quote_{{ $key }}_end_date_of_service" class="form-control end-date-of-service datepicker bookingEndDateOfService" autocomplete="off">
                                </div>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Number of Nights</label>
                                <input type="text" name="quote[{{ $key }}][number_of_nights]" value="{{ $booking_detail->number_of_nights }}" id="quote_{{ $key }}_number_of_nights" class="form-control number-of-nights" readonly>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3 show-tf {{ isset($log->getQueryData($booking_detail->category_id, 'Category')->first()->show_tf) && ($log->getQueryData($booking_detail->category_id, 'Category')->first()->show_tf == 0) ? 'd-none' : '' }}">
                              <div class="form-group">
                                <label class="label-of-time-label">{{ isset($log->getQueryData($booking_detail->category_id, 'Category')->first()->label_of_time) && !empty($log->getQueryData($booking_detail->category_id, 'Category')->first()->label_of_time) ? $log->getQueryData($booking_detail->category_id, 'Category')->first()->label_of_time : '' }}</label>
                                <input type="time" value="{{ $booking_detail->time_of_service }}" name="quote[{{ $key }}][time_of_service]" data-name="time_of_service" id="quote_{{ $key }}_time_of_service" class="form-control time-of-service" placeholder="Time of Service" autocomplete="off">
                              </div>
                            </div>

                            <div class="col-md-3 {{ isset($log->getQueryData($booking_detail->category_id, 'Category')->first()->second_tf) && ($log->getQueryData($booking_detail->category_id, 'Category')->first()->second_tf == 0) ? 'd-none' : '' }} second-tf">
                              <div class="form-group">
                                <label class="second-label-of-time">{{ isset($log->getQueryData($booking_detail->category_id, 'Category')->first()->label_of_time) && !empty($log->getQueryData($booking_detail->category_id, 'Category')->first()->second_label_of_time) ? $log->getQueryData($booking_detail->category_id, 'Category')->first()->second_label_of_time : '' }}</label>
                                <input type="time" name="quote[{{ $key }}][second_time_of_service]" value="{{ $booking_detail->second_time_of_service }}" data-name="second_time_of_service" id="quote_{{ $key }}_second_time_of_service" class="form-control second-time-of-service"  autocomplete="off">
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Category</label>
                                <select name="quote[{{ $key }}][category_id]" data-name="category_id" id="quote_{{ $key }}_category_id" class="form-control select2single category-select2 category-id">
                                  <option value="">Select Category</option>
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" data-name="{{ $category->name }}" {{ ($booking_detail->category_id == $category->id)? 'selected' : ''}} > {{ $category->name }} </option>
                                  @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3 d-none">
                              <div class="form-group">
                                <label>Category Details</label>
                                <input type="text" name="quote[{{ $key }}][category_details]" value="{{ $booking_detail->category_details }}" id="quote_{{ $key }}_category_details" class="form-control category-details">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Supplier Country <span style="color:red">*</span></label>
                                <select name="quote[{{ $key }}][supplier_country_ids][]" class="form-control select2-multiple supplier-country-id" data-placeholder="Select Supplier Country" multiple>
                                  @foreach ($supplier_countries as $country)
                                    <option value="{{ $country->id }}" {{ in_array($country->id, json_decode($booking_detail->supplier_country_ids)) ? 'selected' : '' }}>{{ $country->name }} - {{ $country->code}}</option>
                                  @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3 group-owner-feild {{ !isset($booking_detail->group_owner_id) && empty($booking_detail->group_owner_id) ? 'd-none' : '' }} ">
                              <div class="form-group">
                                <label>Group Owner <button type="button" class="btn btn-xs btn-outline-dark ml-1 group-owner-modal"> <i class="fas fa-plus"></i></button></label>
                                <select name="quote[{{ $key }}][group_owner_id]" data-name="group_owner_id" id="quote_{{ $key }}_group_owner_id" class="form-control group-owner-id select2single">
                                  <option value="">Select Group Owner</option>
                                  @foreach ($group_owners as $group_owner)
                                    <option value="{{ $group_owner->id }}"  data-name="{{ $group_owner->name }}"  {{ $booking_detail->group_owner_id == $group_owner->id ? 'selected' : '' }}>{{ $group_owner->name }}</option>
                                  @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            @php
                        
                              $supplier_url = \Helper::getSupplierRateSheetUrl($booking_detail->supplier_id, $booking->season_id);
                              $url          = !empty($supplier_url) ? $supplier_url : '';
                              $text         = !empty($supplier_url) ? "(View Rate Sheet)" : '';

                              // $suppliers = App\Supplier::whereHas('getCountries', function($query) use ($q_detail) {
                              //   $query->whereIn('id', json_decode($q_detail['supplier_country_ids']));
                              // })->get();

                              $query = App\Supplier::orderBy('id', 'ASC');

                              $query->whereHas('getCountries', function($query) use ($booking_detail) {
                                $query->whereIn('id', json_decode($booking_detail->supplier_country_ids));
                              });
                              $query->whereHas('getCategories', function($query) use ($booking_detail) {
                                $query->where('id', $booking_detail->category_id);
                              });

                              if(isset($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && !empty($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && ($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug == 'cruise') && is_null($booking_detail->group_owner_id)){
                                $query->whereNull('group_owner_id');
                              }

                              if(isset($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && !empty($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && ($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug == 'cruise') && !is_null($booking_detail->group_owner_id)){
                                $query->where('group_owner_id', $booking_detail->group_owner_id);
                              }

                              $suppliers = $query->get();
                            @endphp

                            <div class="col">
                              <div class="form-group">
                                <label>
                                  Supplier 
                                  <span style="color:red">*</span>
                                  <a href="{{ $url }}" target="_blank" class="ml-1 view-supplier-rate">{{ $text }}</a>
                                </label>
                                <button type="button" class="btn btn-xs btn-outline-dark ml-1 add-new-supplier"> <i class="fas fa-plus"></i></button>
                                <select name="quote[{{ $key }}][supplier_id]" data-name="supplier_id" id="quote_{{ $key }}_supplier_id" class="form-control select2single supplier-id @error('supplier_id') is-invalid @enderror">
                                  <option value="">Select Supplier</option>
                                  @if(isset($suppliers) && !empty($suppliers))
                                    @foreach ($suppliers as $supplier )
                                      <option value="{{ $supplier->id }}" data-name="{{ $supplier->name }}" {{ ($booking_detail->supplier_id == $supplier->id) ? 'selected' : NULL}}  >{{ $supplier->name }}</option>
                                    @endforeach
                                  @endif 
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>
                          
                            <div class="col-md-3 product-id-feild">
                              <div class="form-group">
                                <label>Product <button type="button" class="btn btn-xs btn-outline-dark ml-1 store-product"> <i class="fas fa-plus"></i></button></label>
                                <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control select2single  product-id @error('product_id') is-invalid @enderror">
                                  <option value="">Select Product</option>
                                  @if(isset($booking_detail->supplier_id) && !empty($booking_detail->supplier_id))
                                    @foreach ($log->getQueryData($booking_detail->supplier_id, 'Supplier')->first()->getProducts()->get() as $product)
                                      <option value="{{ $product->id }}" data-name="{{ $product->name }}" {{ ($booking_detail->product_id == $product->id) ? 'selected' : '' }}>{{ $product->name }} - {{ $product->code }}</option>
                                    @endforeach
                                  @endif
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3 d-none">
                              <div class="form-group">
                                <label>Product Details</label>
                                <input type="text" name="quote[{{ $key }}][product_details]" value="{{ $booking_detail->product_details }}" id="quote_{{ $key }}_product_details" class="form-control product-details">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3 tour-feilds {{ isset($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && !empty($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && ($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug == 'tours') ? '' : 'd-none' }}">
                              <div class="form-group">
                                <label>Meeting Point</label>
                                <input type="text" name="quote[{{ $key }}][tour_meeting_point]" data-name="tour_meeting_point" id="quote_{{ $key }}_tour_meeting_point" value="{{ $booking_detail->tour_meeting_point }}" class="form-control tour-meeting-point">
                              </div>
                            </div>

                            <div class="col-md-3 tour-feilds {{ isset($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && !empty($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && ($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug == 'tours') ? '' : 'd-none' }}">
                              <div class="form-group">
                                <label>Contact</label>
                                <input type="text" name="quote[{{ $key }}][tour_contact]" data-name="tour_meeting_point" id="quote_{{ $key }}_tour_contact" value="{{ $booking_detail->tour_contact }}" class="form-control tour-contact">
                              </div>
                            </div>

                            <div class="col-md-3 tour-feilds {{ isset($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && !empty($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && ($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug == 'tours') ? '' : 'd-none' }}">
                              <div class="form-group">
                                <label>Telephone</label>
                                <input type="tel" name="quote[{{ $key }}][tour_telephone]" data-name="tour_telephone" id="quote_{{ $key }}_tour_telephone" value="{{ $booking_detail->tour_telephone }}" class="form-control tour-telephone">
                              </div>
                            </div>
                            
                            <div class="col-md-3 tour-feilds {{ isset($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && !empty($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug) && ($log->getQueryData($booking_detail->category_id, 'Category')->first()->slug == 'tours') ? '' : 'd-none' }}">
                              <div class="form-group">
                                <label>Address</label>
                                <textarea name="quote[{{ $key }}][tour_address]" data-name="tour_address" id="quote_{{ $key }}_tour_address" rows="1" class="form-control tour-address">{{ !empty($booking_detail->tour_address) ? $booking_detail->tour_address : '' }}</textarea>
                              </div>
                            </div>

                            <div class="col-md-3 payment-type-feild">
                              <div class="form-group">
                                <label>Payment Type</label>
                                <select name="quote[{{ $key }}][booking_type_id]" data-name="booking_type_id" id="quote_{{ $key }}_booking_type_id" class="form-control select2single   booking-type-id @error('booking_type_id') is-invalid @enderror">
                                  <option value="">Select Payment Type</option>
                                  @foreach ($booking_types as $booking_type)
                                    <option value="{{ $booking_type->id }}" data-slug="{{ $booking_type->slug }}" {{ $booking_detail->booking_type_id == $booking_type->id  ? "selected" : "" }}> {{ $booking_type->name }} </option>
                                  @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3 refundable-percentage-feild {{ isset($booking_detail->booking_type_id) && !empty($booking_detail->booking_type_id) && $booking_detail->booking_type_id == 2 ? '' : 'd-none'  }}">
                              <div class="form-group">
                                <label>Refundable % <span style="color:red">*</span></label>
                                <input type="number" name="quote[{{ $key }}][refundable_percentage]" value="{{ $booking_detail->refundable_percentage }}" data-name="refundable_percentage" id="quote_{{ $key }}_refundable_percentage" class="form-control refundable-percentage" placeholder="Refundable %">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Supplier Currency</label>
                                  <select name="quote[{{ $key }}][supplier_currency_id]" data-name="supplier_currency_id" id="quote_{{ $key }}_supplier_currency_id" class="form-control booking-supplier-currency-id">
                                    <option value="">Select Supplier Currency</option>
                                    @foreach ($currencies as $currency)
                                      <option value="{{ $currency->id }}" data-name="{{ $currency->code.' - '.$currency->name }}" {{ $booking_detail->supplier_currency_id == $currency->id  ? "selected" : "" }}  data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                                    @endforeach
                                  </select>
                                  <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Estimated Cost <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="text" value="{{ \Helper::number_format($booking_detail->estimated_cost) }}" name="quote[{{ $key }}][estimated_cost]" data-name="estimated_cost" data-type="currency" id="quote_{{ $key }}_estimated_cost" class="form-control estimated-cost change hide-arrows" value="0.00">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Actual Cost <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="text" value="{{ \Helper::number_format($booking_detail->actual_cost) }}" name="quote[{{ $key }}][actual_cost]" data-name="actual_cost" data-status="booking" id="quote_{{ $key }}_actual_cost" class="form-control actual-cost change" value="0.00">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }}">
                              <div class="form-group">
                                <label>Markup Amount <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="text" step="any" value="{{ \Helper::number_format($booking_detail->markup_amount) }}" name="quote[{{ $key }}][markup_amount]" data-name="markup_amount" id="quote_{{ $key }}_markup_amount" class="form-control markup-amount change" value="0.00">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }}">
                              <div class="form-group">
                                <label>Markup % <span class="text-danger">*</span></label>
                                <div class="input-group">

                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_percentage) }}" name="quote[{{ $key }}][markup_percentage]" data-name="markup_percentage" id="quote_{{ $key }}_markup_percentage" class="form-control markup-percentage change" value="0.00">
                                  <div class="input-group-append">
                                    <div class="input-group-text">%</div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }}">
                              <div class="form-group">
                                <label>Selling Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="text" step="any" value="{{ \Helper::number_format($booking_detail->selling_price) }}" name="quote[{{ $key }}][selling_price]" data-name="selling_price" id="quote_{{ $key }}_selling_price" class="form-control selling-price hide-arrows" value="0.00" readonly>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }}">
                              <div class="form-group">
                                  <label>Profit % <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->profit_percentage) }}" name="quote[{{ $key }}][profit_percentage]" data-name="profit_percentage" id="quote_{{ $key }}_profit_percentage" class="form-control profit-percentage hide-arrows" value="0.00" readonly>
                                  <div class="input-group-append">
                                    <div class="input-group-text">%</div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Actual Cost in Booking Currency <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking->currency_id, 'Currency')->first()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="text" value="{{ \Helper::number_format($booking_detail->actual_cost_bc) }}" name="quote[{{ $key }}][actual_cost_in_booking_currency]" data-name="actual_cost_in_booking_currency" id="quote_{{ $key }}_actual_cost_in_booking_currency" class="form-control actual-cost-in-booking-currency"  readonly>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-4 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }} ">
                              <div class="form-group">
                                <label>Markup Amount in Booking Currency <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking->currency_id, 'Currency')->first()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="text" step="any" value="{{ \Helper::number_format($booking_detail->markup_amount_in_booking_currency) }}" name="quote[{{ $key }}][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_{{ $key }}_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly> 
                                </div>
                              </div>
                            </div>

                            <div class="col-md-4 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }} ">
                              <div class="form-group">
                                <label>Selling Price in Booking Currency <span class="text-danger">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking->currency_id, 'Currency')->first()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                                  </div>
                                  <input type="text" step="any" value="{{ \Helper::number_format($booking_detail->selling_price_in_booking_currency) }}" name="quote[{{ $key }}][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_{{ $key }}_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
                                </div>
                              </div>
                            </div>
                        
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Service Details</label>
                                <textarea name="quote[{{ $key }}][service_details]" data-name="service_details" id="quote_{{ $key }}_service_details" class="form-control service-details" rows="1" placeholder="Enter Service Details">{{ $booking_detail->service_details }}</textarea>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Internal Comments <button type="button" class="btn btn-xs btn-outline-dark ml-1 insert-quick-text"> <i class="fas fa-plus"></i> </button></label>
                                <textarea name="quote[{{ $key }}][comments]" data-name="comments" id="quote_{{ $key }}_comments" class="form-control comments" rows="1" placeholder="Enter Comments">{{ $booking_detail->comments }}</textarea>
                              </div>
                            </div>

                            @if($booking_detail->invoice)
                              <div class="col-md-3">
                                <label>Invoice Preview</label>
                                <div class="form-group">
                                  <a href="{{ url(Storage::url($booking_detail->invoice)) }}" class="btn btn-outline-dark">Invoice</a>
                                </div>
                              </div>
                            @endif

                            <div class="col-sm-2 d-none">
                              <div class="form-group">
                                <label>Outstanding Amount left</label>
                                <input type="text" value="{{ \Helper::number_format($booking_detail->outstanding_amount_left) }}" name="quote[{{ $key }}][outstanding_amount_left]" data-name="outstanding_amount_left" id="quote_{{ $key }}_outstanding_amount_left" class="form-control outstanding_amount_left hide-arrows">
                              </div>
                            </div>
                          </div>

                          <!-- Administration row -->
                          <hr>
                          <h3 class="mt-1 mb-1-half"><span class="double-underline">Operations</span></h3>
                          <div class="row administraion-row">

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Booking Date</label>
                                <input type="text" value="{{ $booking_detail->booking_date }}" name="quote[{{ $key }}][booking_date]" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" autocomplete="off" placeholder="Booking Date">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Booking Due Date  <span style="color:red">*</span></label>
                                <input type="text" value="{{ $booking_detail->booking_due_date }}" name="quote[{{ $key }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Booking Method</label>
                                <select name="quote[{{ $key }}][booking_method_id]" data-name="booking_method_id" id="quote_{{ $key }}_booking_method_id" class="form-control  select2single  booking-method-id @error('booking_method_id') is-invalid @enderror">
                                  <option value="">Select Booking Method</option>
                                  @foreach ($booking_methods as $booking_method)
                                    <option value="{{ $booking_method->id }}" {{ $booking_detail->booking_method_id == $booking_method->id  ? "selected" : "" }}> {{ $booking_method->name }} </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Booked By</label>
                                <select name="quote[{{ $key }}][booked_by_id]" databooking="booked_by_id" id="quote_{{ $key }}_booked_by_id" class="form-control   select2single   booked-by-id @error('booked_by_id') is-invalid @enderror">
                                  <option value="">Select Booked By </option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id }}" 
                                      @if(isset($booking_detail->booked_by_id) && !empty($booking_detail->booked_by_id) && $booking_detail->booked_by_id == $user->id || auth()->user()->id == $user->id)
                                      selected
                                      @endif
                                    > {{ $user->name }} </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Supervisor</label>
                                <select name="quote[{{ $key }}][supervisor_id]" data-name="supervisor_id" id="quote_{{ $key }}_supervisor_id" class="form-control   select2single   supervisor-id @error('supervisor_id') is-invalid @enderror">
                                  <option value="">Select Supervisor</option>
                                  @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}" 
                                      @if(isset($booking_detail->supervisor_id) && !empty($booking_detail->supervisor_id) && $booking_detail->supervisor_id == $supervisor->id || isset($booking->getSalePerson->getSupervisor->id) && !empty($booking->getSalePerson->getSupervisor->id) && $booking->getSalePerson->getSupervisor->id == $supervisor->id)
                                      selected
                                      @endif
                                    > {{ $supervisor->name }} </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Booking Reference</label>
                                <input type="text" value="{{ $booking_detail->booking_reference }}" name="quote[{{ $key }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $key }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
                              </div>
                            </div>

                            {{-- @if(isset(Auth::user()->getRole->slug) && in_array(Auth::user()->getRole->slug, ['admin', 'accountant']) )
                              <div class="col-md-3 d-flex justify-content-center">
                                <div class="form-group">
                                  <label>Sage</label>
                                  <div class="custom-control custom-checkbox">
                                    <input name="quote[{{ $key }}][added_in_sage]" type="checkbox" id="quote_{{ $key }}_added_in_sage" value="{{$booking_detail->added_in_sage}}" data-name="added_in_sage" class="zero-one-checkbox custom-control-input custom-control-input-success custom-control-input-outline" {{ ($booking_detail->added_in_sage == 1) ? 'checked': '' }}>
                                    <label for="quote_{{ $key }}_added_in_sage" class="custom-control-label">Added in Sage</label>
                                  </div>
                                </div>
                              </div>
                            @endif --}}
                            
                          </div>
                          <!-- End Administration row -->

                          <!-- Payments section -->
                          <div class="card card-outline card-base payment-section collapsed-card">
                            <div class="card-header">
                              <h1 class="card-title"><b>Payments Section</b></h1>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool version-payment-section" data-card-widget="collapse">
                                  <i class="fas fa-plus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body" style="display: none;">
                          @if($booking_detail->finance && count($booking_detail->finance) > 0)
                            @foreach ($booking_detail->finance as $fkey => $finance)

                              @php 
                                $count   =  $fkey + 1; 
                                $finance = (object) $finance;
                              @endphp

                              <h3 class="mt-1 mb-1-half"><span class="double-underline">Finance</span></h3>

                              <div class="row finance-clonning row-cols-lg-7 g-0 g-lg-2 {{ $finance->status == 'cancelled' ? 'cancelled-payment-styling' : '' }}" data-financekey="{{$fkey}}">

                                <div class="col-md-12">
                                  <button type="button" onclick="this.closest('.finance-clonning').remove()" class="finance-clonning-btn btn btn-outline-dark btn-xs float-right {{ $finance->status == 'cancelled' ? 'd-none' : '' }}" ><i class="fas fa-times"></i></button>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label class="depositeLabel" id="deposite_heading{{ $fkey }}"> Payment #{{ $count }}</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
                                      </div>
                                      <input type="text" value="{{ \Helper::number_format($finance->deposit_amount) }}" name="quote[{{ $key }}][finance][{{ $fkey }}][deposit_amount]" data-name="deposit_amount" id="quote_{{$key}}_finance_{{$fkey}}_deposit_amount" class="form-control deposit-amount hide-arrows" {{ $finance->status == 'cancelled' ? 'readonly' : '' }}>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Due Date</label>
                                    <input type="date" value="{{ $finance->deposit_due_date }}" name="quote[{{ $key }}][finance][{{ $fkey }}][deposit_due_date]" data-name="deposit_due_date" id="quote_{{$key}}_finance_{{$fkey}}_deposit_due_date" class="form-control deposit-due-date" {{ $finance->status == 'cancelled' ? 'readonly' : '' }}>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Paid Date</label>
                                    <input type="date" value="{{ $finance->paid_date }}" name="quote[{{ $key }}][finance][{{ $fkey }}][paid_date]" data-name="paid_date" id="quote_{{$key}}_finance_{{$fkey}}_paid_date" class="form-control paid-date" {{ $finance->status == 'cancelled' ? 'readonly' : '' }}>
                                  </div>
                                </div>

                                <div class="col-sm-2 d-flex justify-content-center">
                                  <div class="form-group">
                                    <label>Calender</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="icheck-primary">
                                          <input type="hidden" name="quote[{{ $key }}][finance][{{ $fkey }}][upload_to_calender]" value="{{ $finance->upload_to_calender }}"><input data-name="upload_to_calendar" id="quote_{{$key}}_finance_{{$fkey}}_upload_to_calendar" class="checkbox" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($finance->upload_to_calender == 1)? 'checked': NULL }}> 
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Payment Method</label>
                                    <select  name="quote[{{ $key }}][finance][{{ $fkey }}][payment_method]" data-name="payment_method" id="quote_{{$key}}_finance_{{$fkey}}_payment_method" class="form-control payment-method select2single" {{ $finance->status == 'cancelled' ? 'disabled' : '' }}>
                                      <option value="">Select Payment Method</option>
                                      @foreach ($payment_methods as $payment_method)
                                      <option value="{{ $payment_method->id }}" {{ $payment_method->id == $finance->payment_method_id ? 'selected' : '' }}> {{ $payment_method->name }} </option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>

                                <div class="col-sm-3 {{ isset($finance->deposit_due_date) && !empty($finance->deposit_due_date) ? 'd-none' : '' }}">
                                  <div class="form-group">
                                    <label>Alert before the following days </label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <button type="button" class="input-group-text minus increment"><i class="fas fa-minus"></i></button>
                                      </div>
                                      <input type="text"  name="quote[{{ $key }}][finance][{{$fkey}}][ab_number_of_days]" step="any" name="ab_number_of_days" class="form-control ab_number_of_days"  size="10" value="{{ $finance->additional_date??0 }}" {{ isset($finance->deposit_due_date) && !empty($finance->deposit_due_date) ? 'readonly' : '' }}>
                                        <div class="input-group-append">
                                        <button type="button" class="input-group-text plus increment"><i class="fas fa-plus"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label class="outstanding_amount_label">Outstanding Amount</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
                                      </div>
                                      <input type="text" value="{{ \Helper::number_format($finance->outstanding_amount) }}" name="quote[{{ $key }}][finance][{{$fkey}}][outstanding_amount]" data-name="outstanding_amount" id="quote_{{$key}}_finance_{{$fkey}}_outstanding_amount" value="0.00" class="form-control outstanding-amount hide-arrows" step="any" readonly>
                                    </div>
                                  </div>
                                </div>

                                @if(isset(Auth::user()->getRole->slug) && in_array(Auth::user()->getRole->slug, ['admin', 'accountant']) )
                                  <div class="col-md-3 d-flex justify-content-center">
                                    <div class="form-group">
                                      <label>Sage</label>
                                      <div class="custom-control custom-checkbox">
                                        <input type="hidden" name="quote[{{ $key }}][finance][{{ $fkey }}][added_in_sage]" value="0"> 
                                        <input name="quote[{{ $key }}][finance][{{$fkey}}][added_in_sage]" type="checkbox" id="quote_{{$key}}_finance_{{$fkey}}_added_in_sage" value="{{$finance->added_in_sage}}" data-name="added_in_sage" class="zero-one-checkbox checkbox custom-control-input custom-control-input-success custom-control-input-outline" {{ ($finance->added_in_sage == 1) ? 'checked': '' }}>
                                        <label for="quote_{{$key}}_finance_{{$fkey}}_added_in_sage" data-name="added_in_sage" class="finance-custom-control-label custom-control-label">Added in Sage</label>
                                      </div>
                                    </div>
                                  </div>
                                @endif
                                
                              </div>
                            @endforeach
                          @else
                            <h3 class="mt-1 mb-1-half"><span class="double-underline">Finance</span></h3>
                            <div class="row finance-clonning row-cols-lg-7 g-0 g-lg-2 mt-2" data-financekey="0">
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label class="depositeLabel" id="deposite_heading{{ $key }}"> Payment #1</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
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
                                  <button type="button" onclick="this.closest('.finance-clonning').remove()" class="btn btn-outline-dark btn-xs"><i class="fa fa-times"></i></button>
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
                                      <span class="input-group-text minus increment"><i class="fas fa-minus"></i></span>
                                    </div>
                                      <input type="text"  name="quote[{{ $key }}][finance][0][ab_number_of_days]" step="any" name="ab_number_of_days" id="quote_{{$key}}_finance_0_ab_number_of_days" class="form-control ab_number_of_days"  size="10" value="0">
                                    <div class="input-group-append">
                                      <span class="input-group-text plus increment"><i class="fas fa-plpus"></i></span>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label class="outstanding_amount_label">Outstanding Amount</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
                                    </div>
                                    <input type="number" value="" name="quote[{{ $key }}][finance][0][outstanding_amount]" data-name="outstanding_amount" id="quote_{{$key}}_finance_0_outstanding_amount" value="0.00" class="form-control outstanding-amount hide-arrows" step="any" readonly>
                                  </div>
                                </div>
                              </div>

                              @if(isset(Auth::user()->getRole->slug) && in_array(Auth::user()->getRole->slug, ['admin', 'accountant']) )
                                <div class="col-md-3 d-flex justify-content-center">
                                  <div class="form-group">
                                    <label>Sage</label>
                                    <div class="custom-control custom-checkbox">
                                      <input type="hidden" name="quote[{{ $key }}][finance][0][added_in_sage]" value="0"> 
                                      <input type="checkbox" name="quote[{{ $key }}][finance][0][added_in_sage]" id="quote_{{$key}}_finance_0_added_in_sage" value="0" data-name="added_in_sage" class="zero-one-checkbox custom-control-input custom-control-input-success custom-control-input-outline">
                                      <label for="quote_{{$key}}_finance_0_added_in_sage" data-name="added_in_sage" class="finance-custom-control-label custom-control-label">Added in Sage</label>
                                    </div>
                                  </div>
                                </div>
                              @endif

                          
                            </div>
                          @endif

                          <!-- refund-by-bank-section -->
                          @if($booking_detail->refund_payments && count($booking_detail->refund_payments) > 0)
                            <section class="refund-by-credit-note-section" >
                              <hr><h3 class="mt-1 mb-1-half"><span class="double-underline">Refund - By Bank</span></h3>
                              @foreach ($booking_detail->refund_payments as $rpkey => $payment)
                                @php 
                                  $payment = (object) $payment;
                                @endphp

                                <div class="refund-payment-section">
                                  <div class="row refund-payment-row row-cols-lg-7 g-0 g-lg-2">

                                    <div class="col-md-12">
                                      <button type="button" class="refund-payment-hidden-btn btn btn-outline-dark btn-xs float-right d-none"><i class="fas fa-times"></i></button>
                                    </div>

                                    <div class="col">
                                      <div class="form-group">
                                        <label class="refund-payment-label" id="refund_payment_label_{{ $key }}">Refund Payment #{{ $count }}</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
                                          </div>
                                          <input type="text" value="{{ \Helper::number_format($payment->refund_amount) }}" name="quote[{{ $key }}][refund][{{$rpkey}}][refund_amount]" id="quote_{{$key}}_refund_{{$rpkey}}_refund_amount" data-name="refund_amount"  class="form-control refund_amount amount remove-zero-values hide-arrows" step="any">
                                        </div>
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>

                                    <div class="col">
                                      <div class="form-group">
                                        <label>Refund Date <span style="color:red">*</span></label>
                                        <input type="date" value="{{ $payment->refund_date }}" name="quote[{{ $key }}][refund][0][refund_date]" id="quote_{{$key}}_refund_{{$rpkey}}_refund_date" data-name="refund_date"  class="form-control">
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>

                                    <div class="col">
                                      <div class="form-group">
                                        <label>Bank <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][refund][0][bank]" id="quote_{{$key}}_refund_{{$rpkey}}_bank" data-name="bank"  class="form-control bank select2single">
                                          <option value="">Select Bank</option>
                                          @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}" {{ ($bank->id == $payment->bank_id) ? 'selected' : '' }}> {{ $bank->name }} </option>
                                          @endforeach
                                        </select>
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>

                                    <div class="col">
                                      <div class="form-group">
                                        <label>Refund Confirmed By <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][refund][0][refund_confirmed_by]" id="quote_{{$key}}_refund_{{$rpkey}}_refund_confirmed_by"  data-name="refund_confirmed_by"  class="form-control refund_confirmed_by select2single">
                                          <option value="">Select User</option>
                                          @foreach ($sale_persons as $person)
                                            <option  value="{{ $person->id }}" {{ ($person->id == $payment->refund_confirmed_by) ? 'selected' : '' }}>{{ $person->name }}</option>
                                          @endforeach
                                        </select>
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>

                                    <div class="col d-flex justify-content-center">
                                      <div class="form-group">
                                        <label></label>
                                        <div class="custom-control custom-checkbox">
                                          <input type="hidden" name="quote[{{ $key }}][refund][{{ $rpkey }}][refund_recieved]" value="0"> 
                                          <input name="quote[{{ $key }}][refund][{{ $rpkey }}][refund_recieved]" type="checkbox" id="quote_{{$key}}_refund_{{$fkey}}_refund_recieved" value="{{$payment->refund_recieved}}" data-name="refund_recieved" class="zero-one-checkbox checkbox custom-control-input custom-control-input-success custom-control-input-outline" {{ ($payment->refund_recieved == 1) ? 'checked': '' }}>
                                          <label for="quote_{{$key}}_refund_{{$fkey}}_refund_recieved" data-name="refund_recieved" class="finance-custom-control-label custom-control-label">Refund Recieved</label>
                                        </div>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              @endforeach
                            </section>
                          @endif

                          <!-- refund-by-credit-note-section -->
                          @if($booking_detail->credit_notes && count($booking_detail->credit_notes) > 0)
                            <section class="refund-by-credit-note-section" >
                              <hr><h3 class="mt-1 mb-1-half"><span class="double-underline">Refund - By Credit Notes</span></h3>

                              @foreach ($booking_detail->credit_notes as $cnkey => $payment)
                                @php 
                                  $payment = (object) $payment;
                                  $count = $cnkey + 1;
                                @endphp

                                <div class="credit-note-section">
                                  <div class="row credit-note-row else-here row-cols-lg-7 g-0 g-lg-2">

                                    <div class="col">
                                      <div class="form-group">
                                        <label class="credit_note_label" id="credit_note_label_{{ $cnkey }}">Credit Note Amount Payment #{{$count}} <span style="color:red">*</span></label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
                                          </div>
                                          <input type="text" value="{{ \Helper::number_format($payment->credit_note_amount) }}" name="quote[{{ $key }}][credit_note][{{$cnkey}}][credit_note_amount]" id="quote_{{ $key }}_credit_note_{{$cnkey}}_credit_note_amount" data-name="credit_note_amount" class="form-control credit-note-amount amount hide-arrows">
                                        </div>
                                      </div>
                                    </div>
                          
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Credit Note Date <span style="color:red">*</span></label>
                                        <input type="date" value="{{ $payment->credit_note_recieved_date }}" name="quote[{{ $key }}][credit_note][{{$cnkey}}][credit_note_recieved_date]" id="quote_{{ $key }}_credit_note_{{$cnkey}}_credit_note_recieved_date" data-name="credit_note_recieved_date" class="form-control" >
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>

                                    <div class="col">
                                      <div class="form-group">
                                        <label>Credit Note Received By <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][credit_note][{{$cnkey}}][credit_note_recieved_by]" id="quote_{{ $key }}_credit_note_{{$cnkey}}_credit_note_recieved_by" data-name="credit_note_recieved_by" class="form-control credit_note_recieved_by select2single" >
                                          <option value="">Select User</option>
                                          @foreach ($sale_persons as $person)
                                            <option  value="{{ $person->id }}" {{ ($person->id == $payment->credit_note_recieved_by) ? 'selected' : '' }}>{{ $person->name }}</option>
                                          @endforeach
                                        </select>
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              @endforeach
                            </section>
                          @endif

                        </div>
                      </div>

                      </div>
                    @endforeach
                  </div>
                  @endif
                </div>

                <div class="row">
                  <div class="col-md-12 agencyField {{ ($booking->agency == 0) ? 'd-none' : '' }}">
                    <div class="form-group">
                      <label>Agency Commission Type <span style="color:red">*</span></label>
                      <div class="d-flex flex-row">

                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" name="agency_commission_type" class="agency-commission-type custom-control-input custom-control-input-success custom-control-input-outline" id="agency_yes_net_price" value="net-price" {{ $booking->agency == 1 && $booking->agency_commission_type == 'net-price' ? 'checked' : '' }}>
                          <label class="custom-control-label" for="agency_yes_net_price">Net Price</label>
                        </div>

                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" name="agency_commission_type" class="agency-commission-type custom-control-input custom-control-input-success custom-control-input-outline" id="agency_yes_paid_net_of_commission" value="paid-net-of-commission" {{ $booking->agency == 1 && $booking->agency_commission_type == 'paid-net-of-commission' ? 'checked' : '' }}>
                          <label class="custom-control-label" for="agency_yes_paid_net_of_commission">Paid Net of Commission</label>
                        </div>

                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" name="agency_commission_type" class="agency-commission-type custom-control-input custom-control-input-success custom-control-input-outline" id="agency_yes_we_pay_commission_on_departure" value="we-pay-commission-on-departure" {{ $booking->agency == 1 && $booking->agency_commission_type == 'we-pay-commission-on-departure' ? 'checked' : '' }}> 
                          <label class="custom-control-label" for="agency_yes_we_pay_commission_on_departure">We pay Commission on Departure</label>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="form-group row mt-3">
                  <label for="inputEmail3" class="col-md-4 col-form-label">Total Net Price</label>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking->currency_id, 'Currency')->first()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="text" name="total_net_price" step="any" class="form-control total-net-price hide-arrows" step="any" min="0"  value="{{ \Helper::number_format($booking->net_price) }}" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="inputEmail3" class="col-md-4 col-form-label">Total Markup Amount (Gross Margin)</label>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking->currency_id, 'Currency')->first()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="text" value="{{ \Helper::number_format($booking->markup_amount) }}"  step="any" class="form-control total-markup-amount hide-arrows" step="any" min="0" name="total_markup_amount" value="0.00" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
            
                        <input type="number" value="{{ \Helper::number_format($booking->markup_percentage) }}"  step="any" class="form-control total-markup-percent hide-arrows" min="0" name="total_markup_percent" value="0.00" readonly>
                        <div class="input-group-append">
                          <div class="input-group-text">%</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="paid-net-commission-on-departure {{ $booking->agency == 1 && $booking->agency_commission_type == 'paid-net-of-commission' || $booking->agency == 1 && $booking->agency_commission_type == 'we-pay-commission-on-departure' ? '' : 'd-none' }} ">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-4 col-form-label">Agency Commission</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ ($booking->currency_id && $log->getQueryData($booking->currency_id, 'Currency')->count()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                          </div>
                          <input type="text" step="any" class="form-control agency-commission remove-zero-values" step="any" min="0" name="agency_commission" value="{{ \Helper::number_format($booking->agency_commission) }}" >
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-3 col-form-label">Net Margin</label>
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ ($booking->currency_id && $log->getQueryData($booking->currency_id, 'Currency')->count()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                          </div>
                          <input type="text" step="any" class="form-control total-net-margin remove-zero-values" step="any" min="0" name="total_net_margin" value="{{ \Helper::number_format($booking->total_net_margin) }}" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="inputEmail3" class="col-md-4 col-form-label">Total Selling Price</label>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking->currency_id, 'Currency')->first()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="text" value="{{ \Helper::number_format($booking->selling_price) }}" step="any" name="total_selling_price" class="form-control total-selling-price hide-arrows" min="0.00" step="any"  value="0.00" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-md-4 col-form-label">Total Profit Percentage</label>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" value="{{ \Helper::number_format($booking->profit_percentage) }}" step="any" name="total_profit_percentage" class="form-control total-profit-percentage hide-arrows" min="0" step="any" value="0.00" readonly>
                        <div class="input-group-append">
                          <div class="input-group-text">%</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-md-4 col-form-label">Booking Amount Per Person</label>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking->currency_id, 'Currency')->first()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="text" value="{{ \Helper::number_format($booking->amount_per_person) }}" step="any" class="form-control booking-amount-per-person hide-arrows" step="any" min="0" name="booking_amount_per_person" value="0.00" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-md-4 col-form-label">
                    Staff Commission
                    <h5>
                      <span class="badge badge-secondary badge-commission-name" title="Commission Name">{{ isset($log->getQueryData($booking->commission_criteria_id, 'CommissionCriteria')->first()->name) && !empty($log->getQueryData($booking->commission_criteria_id, 'CommissionCriteria')->first()->name) ? $log->getQueryData($booking->commission_criteria_id, 'CommissionCriteria')->first()->name : ''}}</span>
                      <span class="badge badge-secondary badge-commission-group-name" title="Commission Group">{{ isset($booking->commission_group_id) && $log->getQueryData($booking->commission_group_id, 'CommissionGroup')->count() ? $log->getQueryData($booking->commission_group_id, 'CommissionGroup')->first()->name : ''}}</span>
                      <span class="badge badge-secondary badge-commission-percentage" title="Commission Percentage">{{ isset($booking->commission_percentage) && !empty($booking->commission_percentage) ? $booking->commission_percentage.' %' : ''}}</span>
                    </h5>
                  </label>

                  <div class="col-md-3 d-flex align-items-end">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking->currency_id, 'Currency')->first()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="text" step="any" name="commission_amount" class="form-control commission-amount hide-arrows" min="0" step="any" value="{{ \Helper::number_format($booking->commission_amount) }}" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-2 d-none align-items-end">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" step="any" name="commission_percentage" value="{{ \Helper::number_format($booking->commission_percentage) }}" class="form-control commission-percentage hide-arrows" min="0" step="any" readonly>
                        <div class="input-group-append">
                          <div class="input-group-text">%</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2 d-none align-items-end">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" name="commission_criteria_id" value="{{ $booking->commission_criteria_id }}" class="form-control commission-criteria-id hide-arrows" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-md-4 col-form-label">
                    Com. Amount in Sale Person's Currency
                  </label>

                  <div class="col-md-3 d-flex align-items-end">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text sale-person-currency-code">
                            {{ ($booking->sale_person_currency_id && $log->getQueryData($booking->sale_person_currency_id, 'Currency')->count()) ? $log->getQueryData($booking->sale_person_currency_id, 'Currency')->first()->code : '' }}
                          </span>
                        </div>
                        <input type="text" name="commission_amount_in_sale_person_currency" class="form-control commission-amount-in-sale-person-currency hide-arrows" value="{{ Helper::number_format($booking->commission_amount_in_sale_person_currency) }}" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2 align-items-end">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" name="sale_person_currency_id" data-currency_code="{{ ($booking->sale_person_currency_id && $log->getQueryData($booking->sale_person_currency_id, 'Currency')->count()) ? $log->getQueryData($booking->sale_person_currency_id, 'Currency')->first()->code : '' }}" 
                        value="{{ isset($booking->sale_person_currency_id) && !empty($booking->sale_person_currency_id) ? $booking->sale_person_currency_id : '' }}" class="form-control sale-person-currency-id hide-arrows" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Selling Price in Other Currency</label>
                      <select  name="selling_price_other_currency" class="form-control selling-price-other-currency" style="width: 68%;">
                        <option value="">Select Currency</option>
                        @foreach ($currencies as $currency)
                          <option value="{{ $currency->code }}" {{ ($booking->selling_currency_oc == $currency->code)? 'selected':NULL }} data-image="data:image/png;base64, {{$currency->flag}}" > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text selling-price-other-currency-code">{{ isset($booking->selling_currency_oc) && !empty($booking->selling_currency_oc) ? $booking->selling_currency_oc : '' }}</span>
                        </div>
                        <input type="text" value="{{ \Helper::number_format($booking->selling_price_ocr) }}" step="any" name="selling_price_other_currency_rate" min="0" step="any" class="form-control selling-price-other-currency-rate hide-arrows" value="0.00" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-md-4 col-form-label">Booking Amount Per Person In Other Currency</label>
                  <div class="col-md-3 align-items-end">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text selling-price-other-currency-code">{{ isset($booking->selling_currency_oc) && !empty($booking->selling_currency_oc) ? $booking->selling_currency_oc : '' }}</span>
                        </div>
                        <input type="text" name="booking_amount_per_person_in_osp" value="{{ \Helper::number_format($booking->booking_amount_per_person_in_osp) }}" class="form-control booking-amount-per-person-in-osp hide-arrows" step="any" min="0" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                @if($booking->booking_status == 'cancelled' && count($booking->booking_cancellation_refund_payments) > 0)
                  <section class="cancellation-payments-section mb-2">
                    <div class="cancellation-payments">
                      <hr><h3 class="mt-1 mb-1-half"><span class="double-underline">Booking Cancellation Refund Payments</span></h3>
                      <div class="row mb-1">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Total Refund Amount</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking->booking_cancellations['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking->booking_cancellations['currency_id'], 'Currency')->first()->code : '' }}</span>
                              </div>
                              <input type="text" value="{{ isset($booking->booking_cancellations['total_refund_amount']) && !empty($booking->booking_cancellations['total_refund_amount']) ? Helper::number_format($booking->booking_cancellations['total_refund_amount']) : '' }}" name="cancellation_refund_total_amount" data-name="cancellation_refund_total_amount" id="cancellation_refund_total_amount" class="form-control cancellation-refund-total-amount amount hide-arrows" step="any" readonly disabled>
                            </div>
                          </div>
                        </div>
                      </div>

                      @foreach ($booking->booking_cancellation_refund_payments as $bcrpdKey => $payment)
                        @php
                          $count = $bcrpdKey + 1;
                          $payment = (object) $payment;
                        @endphp

                        <div class="row cancellation-refund-payment-row mb-2">

                          <div class="col-md-12">
                            <button type="button" onclick="this.closest('.cancellation-refund-payment-row').remove()" class="cancellation-refund-payment-row-remove-btn btn btn-outline-dark float-right btn-sm d-none" ><i class="fa fa-times" aria-hidden="true"></i></button>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="cancellation-refund-payment-label" id="cancellation_refund_payment_label_{{$bcrpdKey}}">Refund Amount #{{$count}} </label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking->currency_id, 'Currency')->first()) ? $log->getQueryData($booking->currency_id, 'Currency')->first()->code : '' }}</span>
                                </div>
                                <input type="text" value="{{ \Helper::number_format($payment->refund_amount) }}" name="cancellation_refund[{{$bcrpdKey}}][refund_amount]" data-name="refund_amount" id="cancellation_refund_{{$bcrpdKey}}_refund_amount" class="form-control cancellation-refund-amount amount hide-arrows">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Refund Date </label>
                              <input type="date" value="{{ $payment->refund_date }}" name="cancellation_refund[{{$bcrpdKey}}][refund_date]" id="cancellation_refund_{{$bcrpdKey}}_refund_date" data-name="refund_date"  class="form-control">
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Refund Approved Date </label>
                              <input type="date" value="{{ $payment->refund_approved_date }}" name="cancellation_refund[{{$bcrpdKey}}][refund_approved_date]" id="cancellation_refund_{{$bcrpdKey}}_refund_approved_date" data-name="refund_approved_date"  class="form-control">
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Refund Approved By </label>
                              <select  name="cancellation_refund[{{$bcrpdKey}}][refund_approved_by]" data-name="refund_approved_by" id="cancellation_refund_{{$bcrpdKey}}_refund_approved_by" class="form-control refund_approved_by select2single" >
                                <option value="">Select User</option>
                                @foreach ($sale_persons as $person)
                                  <option  value="{{ $person->id }}" {{ ($person->id == $payment->refund_approved_by) ? 'selected' : '' }}>{{ $person->name }}</option>
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
                                  <option  value="{{ $person->id }}" {{ ($person->id == $payment->refund_processed_by) ? 'selected' : '' }}>{{ $person->name }}</option>
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
                                  <option value="{{ $bank->id }}" {{ ($bank->id == $payment->bank_id) ? 'selected' : '' }}> {{ $bank->name }} </option>
                                @endforeach
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>



                        </div>

                      @endforeach
                
                    </div>
                  </section>
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

  
  <!-- Modals -->
    <!-- quote_booking -->
    @include('quote_booking_includes.currency_conversion_modal')
  <!-- End Modals  -->
@endsection

@push('js')
  <script src="{{ asset('js/booking_management.js') }}" ></script>
@endpush

  {{-- <div class="col-sm-3">
    <div class="form-group">
      <label>TAS Reference <span class="text-secondary">(Optional)</span></label>
      <input type="text" name="tas_ref" class="form-control" value="{{ isset($booking->tas_ref) & !empty($booking->tas_ref) ? $booking->tas_ref : '' }}"  placeholder="TAS Reference Number" >
      <span class="text-danger" role="alert"></span>
    </div>
  </div> --}}

{{-- @if($booking_detail->status == 'active')
<span class="badge badge-success">Booked</span>
@elseif($booking_detail->status == 'cancelled')
<span class="badge badge-danger">Cancelled</span>
@endif --}}

   {{-- @if(Auth::user()->getRole->slug == 'admin' || Auth::user()->getRole->slug == 'accountant')
                          <div class="col-sm-2 d-flex justify-content-center">
                            <div class="form-group">
                              <label>Added in Sage</label>
                              <div class="input-group"> 
                                <div class="input-group-prepend">
                                  <div class="icheck-primary">
                                    <input type="hidden" name="quote[{{ $key }}][added_in_sage]" value="{{ $booking_detail->added_in_sage }}"><input data-name="added_in_sage" id="quote_{{ $key }}_added_in_sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($booking_detail->added_in_sage == 1) ? 'checked': '' }}> 
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif --}}


{{-- <div class="col-sm-6">
      <div class="form-group">
        <label>Commission Type <span style="color:red">*</span></label>
        <select name="commission_id" id="commission_id" class="form-control select2single commission-id">
          <option selected value="" >Select Commission Type </option>
          @foreach ($commission_types as $commission_type)
            <option value="{{ $commission_type->id }}" {{  $commission_type->id == $booking->commission_id ? 'selected' : '' }}>{{ $commission_type->name }} ({{ $commission_type->percentage.' %' }})</option>
          @endforeach
        </select>
        <span class="text-danger" role="alert"></span>
      </div>
    </div> --}}


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

     
                          {{-- <div class="col-sm-2">
                            <div class="form-group">
                              <label>Product</label>
                              <input type="text" name="quote[{{ $key }}][product_id]"  data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control product-id" value="{{ $booking_detail->product_id }}" placeholder="Enter Product">
                            </div>
                          </div> --}}

                          {{-- <div class="col-sm-2">
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
                          </div> --}}

                          {{-- <div class="col-sm-3">
                            <div class="form-group">
                              <label>Product <a href="javascript:void(0)" class="ml-1 add-new-product d-none"> ( Add New Product ) </a></label>
                              <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control select2single  product-id @error('product_id') is-invalid @enderror">
                                <option value="">Select Product</option>
                                @if(isset($booking_detail->supplier_id) && !empty($booking_detail->supplier_id))
                                  @foreach ($log->getQueryData($booking_detail->supplier_id, 'Supplier')->first()->getProducts()->get() as  $product)
                                    <option value="{{ $product->id }}" data-name="{{ $product->name }}" {{ ($booking_detail->product_id == $product->id)? 'selected' : NULL}}>{{ $product->name }}</option>
                                  @endforeach
                                @endif
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div> --}}


                                      {{-- <div class="input-group-prepend">
                        <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                      </div> --}}

                          {{-- <div class="col-1">
                                  <button type="button" onclick="this.closest('.finance-clonning').remove()" class="btn btn-sm btn-outline-dark">X</button>
                            </div> --}}

                                      {{-- <div class="col-sm-2">
                                    <div class="form-group">
                                      <label>Credit Note No. <span style="color:red">*</span></label>
                                      <input type="text" value="{{$payment->credit_note_no}}" name="quote[{{ $key }}][credit_note][0][credit_note_no]" data-name="credit_note_no"  class="form-control" >
                                    </div>
                                  </div> --}}

                                  
                          {{-- <div class="col-sm-2">
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
                          </div> --}}


                               {{-- @if(isset($booking_detail->category_id) && isset($booking_detail['supplier_location_id']) && !empty($booking_detail['supplier_location_id']))
                                    @foreach ($log->getQueryData($booking_detail->category_id, 'Category')->first()->getSupplierWithLocation($booking_detail['supplier_location_id'])->get() as $supplier )
                                    <option value="{{ $supplier->id }}" data-name="{{ $supplier->name }}" {{ ($booking_detail->supplier_id == $supplier->id)? 'selected' : NULL}}  >{{ $supplier->name }}</option>
                                    @endforeach
                                  @endif --}}

                                   {{-- <div class="col-sm-2">
                            <div class="form-group">
                              <label>Supervisor</label>
                              <select name="quote[{{ $key }}][supervisor_id]" data-name="supervisor_id" id="quote_{{ $key }}_supervisor_id" class="form-control  select2single  supervisor-id @error('supervisor_id') is-invalid @enderror">
                                <option value="">Select Supervisor</option>
                                @foreach ($supervisors as $supervisor)
                                  <option value="{{ $supervisor->id }}" {{ ($booking_detail->supervisor_id == $supervisor->id)? 'selected' : NULL}}> {{ $supervisor->name }} </option>
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
                              <input type="text" value="{{ $booking_detail->booking_date }}" name="quote[{{ $key }}][booking_date]" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" placeholder="Booking Date">
                            </div>
                          </div> --}}

                          {{-- <div class="col-sm-2">
                            <div class="form-group">
                              <label>Booking Due Date</label>
                              <input type="text" value="{{ $booking_detail->booking_due_date }}" name="quote[{{ $key }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date">
                            </div>
                          </div> --}}

                          {{-- <div class="col-sm-2">
                            <div class="form-group">
                              <label>Booking Reference</label>
                              <input type="text" value="{{ $booking_detail->booking_reference }}" name="quote[{{ $key }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $key }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
                            </div>
                          </div> --}}

                          {{-- <div class="col-sm-2">
                            <div class="form-group">
                              <label>Booking Method</label>
                              <select name="quote[{{ $key }}][booking_method_id]" data-name="booking_method_id" id="quote_{{ $key }}_booking_method_id" class="form-control select2single booking-method-id @error('booking_method_id') is-invalid @enderror">
                                <option value="">Select Booking Method</option>
                                @foreach ($booking_methods as $booking_method)
                                    <option value="{{ $booking_method->id }}" {{ $booking_detail->booking_method_id == $booking_method->id  ? "selected" : "" }}> {{ $booking_method->name }} </option>
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
                                    <option value="{{ $book_id->id }}" {{ $booking_detail->booked_by_id == $book_id->id  ? "selected" : "" }}> {{ $book_id->name }} </option>
                                @endforeach
                              </select>
                              @error('booked_by_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                            </div>
                          </div> --}}

{{-- <div class="input-group-prepend">
<span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()) ? $log->getQueryData($booking_detail->supplier_currency_id, 'Currency')->first()->code : '' }}</span>
</div> --}}