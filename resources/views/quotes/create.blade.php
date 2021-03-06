@extends('layouts.app')
@section('title', 'Add Quote')
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Add Quote</h4></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item active">Quote Management</li>
            </ol>
        </div>
      </div>
    </div>
  </section>

  <section id="content" class="content" data-countries="{{$countries}}">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="card card-outline card-base">
            <div class="card-header">
              <h3 class="card-title text-center">Quote Form</h3>
            </div>

            <form method="POST" action="{{ route('quotes.store') }}" id="store_quote" class="create-template"> 
              @csrf

              <div class="card-body">
                <!-- For Commission Calculation -->
                <div class="row d-none">
                  <div class="col-sm-6">
                    <label>User ID <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" value="{{ isset(Auth::user()->id) && !empty(Auth::user()->id) ? Auth::user()->id : '' }}" name="user_id" id="user_id" class="form-control user-id">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <label>Commission <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" value="{{ isset(Auth::user()->commission_id) && !empty(Auth::user()->commission_id) ? Auth::user()->commission_id : '' }}" name="commission_id" id="commission_id" class="form-control commission-id">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <label>Commission Group <span style="color:red">*</span></label>
                    <div class="form-group">
                      <input type="text" value="{{ isset(Auth::user()->commission_group_id) && !empty(Auth::user()->commission_group_id) ? Auth::user()->commission_group_id : '' }}" name="commission_group_id" id="commission_group_id" class="form-control commission-group-id">
                    </div>
                  </div>
                </div>
                <!-- For Commission Calculation -->

                <div class="row d-none">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Quote Detail Model Name</label>
                      <input type="text" value="QuoteDetail" name="model_name" id="model_name" class="form-control model-name">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Zoho Reference <span style="color:red">*</span></label>
                      <div class="input-group">
                        <input type="text" name="ref_no" id="ref_no" class="reference-name form-control" placeholder="Enter Reference Number" aria-label="Recipient's username" aria-describedby="basic-addon2" autofocus>
                        <div class="input-group-append">
                          <button id="search-reference-btn" class="btn search-reference-btn search-reference" type="button"><span class="mr-2 " role="status" aria-hidden="true"></span>Search</button>
                        </div>
                      </div>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Quote Reference <span style="color:red">*</span></label>
                      <input type="text" name="quote_no" class="form-control" value="{{ isset($quote_id) & !empty($quote_id) ? $quote_id : '' }}"  placeholder="Quote Reference Number" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Booking Details <span style="color:red">*</span></label>
                      <input type="text" name="booking_details" id="booking_details" class="form-control" placeholder="Enter Booking Details" >
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Reason for Trip <span style="color:red">*</span></label>
                      <input type="text" name="reason_for_trip" id="reason_for_trip" class="form-control" placeholder="Enter Reason for Trip">
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Destination Country <span style="color:red">*</span></label>
                      <select name="country_destination_ids[]" id="country_destination_ids" class="form-control select2-multiple country-destination" data-placeholder="Select Destination Country" multiple>
                        @foreach ($supplier_countries as $country)
                          <option value="{{ $country->id }}" >{{ $country->name }} - {{ $country->code}}</option>
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
                          <input type="radio" name="markup_type" id="itemised" value="itemised" class="markup-type custom-control-input custom-control-input-success custom-control-input-outline" {{ (Auth::user()->markup_type == 'itemised') ? 'checked': '' }} >
                          <label class="custom-control-label" for="itemised">Itemised Markup </label>
                        </div>

                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" name="markup_type" id="whole" value="whole" class="markup-type custom-control-input custom-control-input-success custom-control-input-outline" {{ (Auth::user()->markup_type == 'whole') ? 'checked': '' }} >
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
                          <input type="radio" name="rate_type" id="live_rate" class="rate-type custom-control-input custom-control-input-success custom-control-input-outline" value="live" {{ (Auth::user()->rate_type == 'live') ? 'checked': '' }} {{ (Auth::user()->id != 1) ? 'disabled' : '' }}>
                          <label class="custom-control-label" for="live_rate">Live Rate</label>
                        </div>

                        <div class="custom-control custom-radio">
                          <input type="radio" name="rate_type" id="manual_rate" class="rate-type custom-control-input custom-control-input-success custom-control-input-outline" value="manual" {{ (Auth::user()->rate_type == 'manual') ? 'checked': '' }}>
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
                      <select name="sale_person_id" id="sale_person_id" class="form-control select2single sales-person-id">
                        <option selected value="">Select Sales Person</option>
                        @foreach ($sale_persons as $person)
                          <option value="{{ $person->id }}" data-email="{{ $person->email }}" {{ $person->id == Auth::id() ? 'selected' : '' }}>{{ $person->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Brand <span style="color:red">*</span></label>
                      <select name="brand_id" id="brand_id" class="form-control select2single getBrandtoHoliday brand-id">
                        <option selected value="">Select Brand</option>
                        @foreach ($brands as $brand)
                          <option value="{{ $brand->id }}" {{ isset(Auth::user()->brand_id) && !empty(Auth::user()->brand_id) && $brand->id == Auth::user()->brand_id ? 'selected' : '' }}> {{ $brand->name }} </option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Type Of Holiday <span style="color:red">*</span></label>
                      <select name="holiday_type_id" id="holiday_type_id" class="form-control select2single appendHolidayType holiday-type-id">
                        <option value="">Select Type Of Holiday</option>
                        @if(!empty(Auth::user()->brand_id) && Auth::user()->getBrand->getHolidayTypes->count())
                          @foreach (Auth::user()->getBrand->getHolidayTypes as $holiday_type)
                            <option data-value="{{ $holiday_type->name }}" value="{{ $holiday_type->id }}" {{ isset(Auth::user()->holiday_type_id) && !empty(Auth::user()->holiday_type_id) && $holiday_type->id == Auth::user()->holiday_type_id ? 'selected' : '' }}> {{ $holiday_type->name }} </option>
                          @endforeach
                        @endif
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Booking Season <span style="color:red">*</span></label>
                      <select name="season_id" id="season_id" class="form-control select2single season-id">
                        <option value="">Select Booking Season</option>
                        @foreach ($seasons as $season)
                          <option value="{{ $season->id }}" data-start="{{ $season->start_date }}" data-end="{{ $season->end_date }}" {{ $season->default == 1 ? 'selected' : '' }}> {{ $season->name }} </option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Booking Currency <span style="color:red">*</span></label>
                      <select name="currency_id" id="currency_id" class="form-control select2single booking-currency-id">
                        <option selected value="">Select Booking Currency</option>
                        @foreach ($currencies as $currency)
                          <option value="{{ $currency->id }}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}" {{ isset(Auth::user()->getCurrency->id) && !empty(Auth::user()->getCurrency->id) && Auth::user()->getCurrency->id == $currency->id ? 'selected' : '' }}> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                      <input type="hidden" value="{{ url('quotes/getGroups/') }}" id="routeForGroups">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Supplier Currency <span style="color:red">*</span></label>
                      <select name="default_supplier_currency_id" id="default_supplier_currency_id"  class="form-control select2single default-supplier-currency-id">
                        <option selected value="">Select Currency</option>
                        @foreach ($currencies as $currency)
                          <option value="{{ $currency->id }}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}" {{ isset(Auth::user()->getSupplierCurrency->id) && !empty(Auth::user()->getSupplierCurrency->id) && Auth::user()->getSupplierCurrency->id == $currency->id ? 'selected' : '' }}> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                        <input type="text" placeholder="DD/MM/YYYY" name="departure_date" id="quote_departure_date" class="form-control departure-date datepicker" autocomplete="off">
                      </div>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Return Date <span style="color:red">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend"> <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> </div>
                        <input type="text" placeholder="DD/MM/YYYY" name="return_date" id="quote_return_date" class="form-control return-date datepicker" autocomplete="off">
                      </div>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Agency Booking <span style="color:red">*</span></label>
                      <div class="d-flex flex-row">
                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" class="select-agency custom-control-input custom-control-input-success custom-control-input-outline" value="1" name="agency" id="agency_yes"> 
                          <label class="custom-control-label" for="agency_yes">Yes</label>
                        </div>

                        <div class="custom-control custom-radio">
                          <input type="radio" class="select-agency custom-control-input custom-control-input-success custom-control-input-outline" value="0" name="agency" id="agency_no" checked>
                          <label class="custom-control-label" for="agency_no">No</label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 agency-columns">
                    <div class="row mt-1 agencyField d-none">
                      <div class="col form-group">
                        <label>Agency Name</label> <span style="color:red">*</span>
                        <input type="text" name="agency_name" id="agency_name" class="form-control" placeholder="Agency Name">
                        <span class="text-danger" role="alert"> </span>
                      </div>

                      <div class="col form-group">
                        <label>Agency Contact Name </label> <span style="color:red">*</span>
                        <input type="text" name="agency_contact_name" id="agency_contact_name" class="form-control" placeholder="Agency Contact Name">
                        <span class="text-danger" role="alert"> </span>
                      </div>
                      
                      <div class="col form-group">
                        <label>Agency Contact No.</label> <span style="color:red">*</span>
                        <input type="tel" name="agency_contact" id="agency_contact" class="form-control phone phonegc ">
                        <span class="text-danger error_msggc hide" role="alert"></span>
                        <span class="text-success valid_msggc" role="alert"></span>
                      </div>

                      <div class="col form-group">
                        <label>Agency Email </label> <span style="color:red">*</span>
                        <input type="email" name="agency_email" id="agency_email" class="form-control" placeholder="Agency Email Address">
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="row mt-1 PassengerField">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Lead Passenger Name <span style="color:red">*</span></label>
                          <input type="text" name="lead_passenger_name" id="lead_passenger_name" class="form-control" placeholder="Lead Passenger Name">
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Email Address <span style="color:red">*</span></label>
                          <input type="email" name="lead_passenger_email" id="lead_passenger_email" class="form-control" placeholder="Email Address">
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Contact Number <span style="color:red">*</span></label>
                          <input type="tel" name="lead_passenger_contact" id="lead_passenger_contact"  class="form-control phone phone0">
                          <span class="text-danger error_msg0" role="alert"></span>
                          <span class="text-success valid_msg0" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Date Of Birth</label>
                          <input type="text" max="{{ date('Y-m-d') }}" id="lead_passenger_dbo" name="lead_passenger_dbo" class="form-control lead-passenger-dbo" placeholder="Date Of Birth" >
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Nationality (Passport)</label>
                          <select name="lead_passsenger_nationailty_id" id="lead_passsenger_nationailty_id" class="form-control select2single nationality-id">
                            <option selected value="" >Select Nationality</option>
                            @foreach ($countries as $country)
                              <option value="{{ $country->id }}"> {{ $country->name }} </option>
                            @endforeach
                          </select>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Resident In</label>
                          <select name="lead_passenger_resident" id="lead_passsenger_resident" class="form-control select2single resident-id">
                            <option selected value="" >Select Resident</option>
                            @foreach ($countries as $country)
                              <option value="{{ $country->id }}"> {{ $country->name }} </option>
                            @endforeach
                          </select>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Bedding Preferences</label>
                          <input type="text" name="lead_passenger_bedding_preference" id="lead_passenger_bedding_preference" class="form-control " placeholder="Bedding Preferences" id="bedding_preference" >
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Dietary Preferences</label>
                          <input type="text" name="lead_passenger_dietary_preferences" id="lead_passenger_dietary_preferences" class="form-control" placeholder="Dietary Preferences" >
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Medical Requirements</label>
                          <input type="text" name="lead_passenger_medical_requirement" id="lead_passenger_medical_requirement" class="form-control" placeholder="Medical Requirements" >
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Up To Date Covid Vaccination Status</label>
                          <div class="d-flex flex-row">

                            <div class="custom-control custom-radio mr-1">
                              <input type="radio" name="lead_passenger_covid_vaccinated" id="lpcv_yes" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="1">
                              <label class="custom-control-label" for="lpcv_yes">Yes</label>
                            </div>

                            <div class="custom-control custom-radio mr-1">
                              <input type="radio" name="lead_passenger_covid_vaccinated" id="lpcv_no" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="0" checked>
                              <label class="custom-control-label" for="lpcv_no">No</label>
                            </div>

                            <div class="custom-control custom-radio mr-1">
                              <input type="radio" name="lead_passenger_covid_vaccinated" id="lpcv_not_sure" class="covid-vaccinated custom-control-input custom-control-input-success custom-control-input-outline" value="2">
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
                      <label>Pax No. <span style="color:red">*</span></label>
                      <select name="pax_no" id="pax_no" class="form-control select2single paxNumber pax-number">
                        <option selected value="">Select Pax No</option>
                        @for($i=1;$i<=30;$i++)
                          <option value={{$i}} {{ $i == 1 ? 'selected' : '' }}>{{$i}}</option>
                        @endfor
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div id="appendPaxName" class="col-md-12">
                  </div>

                  <div class="col-md-12 col-offset-md-4">
                    <button type="button" class="add-pax-column btn btn-sm btn-dark float-right">Add Passenger </button>
                  </div>
                </div>

                <div class="row justify-content-end mb-2">
                  <div class="col-md-3">
                    <label>Public Template</label>
                    <select name="template" class="float-right select2single form-control template tempalte-id">
                      <option disabled selected value="">Select Template</option>
                      @foreach($public_templates as $template)
                        <option  value="{{ encrypt($template->id) }}">{{ $template->title }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label for="">Private Template</label>
                    <select name="template" class="float-right select2single form-control template tempalte-id">
                      <option disabled selected value="">Select Template</option>
                      @foreach($private_templates as $template)
                        <option  value="{{ encrypt($template->id) }}">{{ $template->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="parent" id="parent">
                  @include('quote_booking_includes.expand_collapse_quote_detail_cards')

                  <div class="sortable sortable-spacing">
                    <div class="quote card card-default quote-0 unsortable" data-key="0">

                      <div class="card-header">
                        <h3 class="card-title card-title-style quote-title">
                          <span class="badge badge-info badge-date-of-service"></span>
                          <span class="badge badge-info badge-end-date-of-service"></span>
                          <span class="badge badge-info badge-time-of-service"></span>
                          <span class="badge badge-info badge-category-id"></span>
                          <span class="badge badge-info badge-group-owner-id"></span>
                          <span class="badge badge-info badge-supplier-id"></span>
                          <span class="badge badge-info badge-product-id"></span>
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
                          <button type="button" class="btn btn-sm btn-outline-dark mr-2 add-new-service-below"><i class="fas fa-plus"></i> &nbsp;<i class="fas fa-level-down-alt"></i></i></button>
                          <button type="button" class="btn btn-sm btn-outline-dark mr-2 collapse-expand-btn" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                          <button type="button" class="btn btn-sm btn-outline-dark mr-2 remove-quote-detail-service d-none" title="Remove"><i class="fas fa-times"></i></button>
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="row d-flex justify-content-end pb-2 pr-2">
                          <div class="modal fade calladdmediaModal" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            @include('quotes.includes.quote_detail_media_modal')
                          </div>
                          <button data-show="calladdmediaModal" type="button" class="float-right btn btn-sm btn-dark addmodalforquote" data-toggle="modal" data-target=".exampleModalCenter"><i class="fa fa-upload" aria-hidden="true"></i></button>
                        </div>

                        <div class="row">
                          <div class="col-sm-2 d-none">
                            <div class="form-group">
                              <label>Quote Detail ID</label>
                              <input type="text" value="" name="quote[0][detail_id]"  id="quote_0_detail_id"  class="form-control detail-id">
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Date of Service <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend"> <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> </div>
                                <input type="text" placeholder="DD/MM/YYYY" name="quote[0][date_of_service]" data-name="date_of_service" id="quote_0_date_of_service" class="form-control date-of-service datepicker  checkDates bookingDateOfService " autocomplete="off">
                              </div>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>
                    
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>End Date of Service <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend"> <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> </div>
                                <input type="text" placeholder="DD/MM/YYYY"  name="quote[0][end_date_of_service]" data-name="end_date_of_service" id="quote_0_end_date_of_service" class="form-control end-date-of-service bookingEndDateOfService datepicker" autocomplete="off">
                              </div>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Number of Nights</label>
                              <input type="text" name="quote[0][number_of_nights]" id="quote_0_number_of_nights" class="form-control number-of-nights" readonly>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-md-3 d-none show-tf">
                            <div class="form-group">
                              <label class="label-of-time-label"></label>
                              <input type="time" name="quote[0][time_of_service]" data-name="time_of_service" id="quote_0_time_of_service" class="form-control time-of-service"  autocomplete="off">
                            </div>
                          </div>

                          <div class="col-md-3 d-none second-tf">
                            <div class="form-group">
                              <label class="second-label-of-time"></label>
                              <input type="time" name="quote[0][second_time_of_service]" data-name="second_time_of_service" id="quote_0_second_time_of_service" class="form-control second-time-of-service"  autocomplete="off">
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Category <span style="color:red">*</span></label>
                              <select name="quote[0][category_id]" data-name="category_id" id="quote_0_category_id" class="form-control category-id select2single">
                                <option selected value="">Select Category</option>
                                @foreach ($categories as $category)
                                  <option value="{{ $category->id }}" data-slug="{{ $category->slug }}" data-name="{{ $category->name }}" data-enddateofservice="{{ $category->set_end_date_of_service }}"> {{ $category->name }} </option>
                                @endforeach
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-md-3 d-none">
                            <div class="form-group">
                              <label>Category Details</label>
                              <input type="text" name="quote[0][category_details]" value="" id="quote_0_category_details" class="form-control category-details">
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          {{-- @if(!empty(Auth::user()->brand_id) && count(Auth::user()->getBrand->getSupplierCountries->pluck('id')->toArray()) > 0)
                          {{ (in_array($country->id, Auth::user()->getBrand->getSupplierCountries->pluck('id')->toArray())) ? 'selected' : '' }}
                          @endif --}}
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Supplier Country <span style="color:red">*</span></label>
                              <select name="quote[0][supplier_country_ids][]" data-name="supplier_country_ids" id="quote_0_supplier_country_ids" class="form-control select2-multiple supplier-country-id" data-placeholder="Select Supplier Country" multiple>
                                @foreach ($supplier_countries as $country)
                                  <option value="{{ $country->id }}"> {{ $country->name }} - {{ $country->code}}</option>
                                @endforeach
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-md-3 group-owner-feild d-none">
                            <div class="form-group">
                              <label>Group Owner <button type="button" class="btn btn-xs btn-outline-dark ml-1 group-owner-modal"> <i class="fas fa-plus"></i></button></label>
                              <select name="quote[0][group_owner_id]" data-name="group_owner_id" id="quote_0_group_owner_id" class="form-control group-owner-id select2single">
                                <option value="">Select Group Owner</option>
                                @foreach ($group_owners as $group_owner)
                                  <option value="{{ $group_owner->id }}" data-name="{{ $group_owner->name }}">{{ $group_owner->name }}</option>
                                @endforeach
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Supplier <span style="color:red">*</span> <a href="" target="_blank" class="ml-1 view-supplier-rate"></a></label>
                              <button type="button" class="btn btn-xs btn-outline-dark ml-1 add-new-supplier"> <i class="fas fa-plus"></i></button>
                              <select name="quote[0][supplier_id]" data-name="supplier_id" id="quote_0_supplier_id" class="form-control supplier-id select2single">
                                <option selected value="">Select Supplier</option>
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-md-3 product-id-feild">
                            <div class="form-group">
                              <label>Product </label>
                              <button type="button" class="btn btn-xs btn-outline-dark ml-1 store-product"> <i class="fas fa-plus"></i></button>
                              <select name="quote[0][product_id]" data-name="product_id" id="quote_0_product_id" class="form-control select2single product-id" disabled>
                                <option selected value="">Select Product</option>
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-md-3 d-none">
                            <div class="form-group">
                              <label>Product Details</label>
                              <input type="text" name="quote[0][product_details]" id="quote_0_product_details" class="form-control product-details">
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-md-3 payment-type-feild">
                            <div class="form-group">
                              <label>Payment Type </label>
                              <select name="quote[0][booking_type_id]" data-name="booking_type_id" id="quote_0_booking_type_id" class="form-control select2single booking-type-id">
                                <option value="" >Select Payment Type</option>
                                @foreach ($booking_types as $booking_type)
                                  <option value="{{ $booking_type->id }}" data-slug="{{ $booking_type->slug }}" > {{$booking_type->name}} </option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-md-3 refundable-percentage-feild d-none">
                            <div class="form-group">
                              <label>Refundable % <span style="color:red">*</span></label>
                              <input type="number" name="quote[0][refundable_percentage]" data-name="refundable_percentage" id="quote_0_refundable_percentage" class="form-control refundable-percentage" placeholder="Refundable %">
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Supplier Currency <span style="color: red">*</span></label>
                              <select name="quote[0][supplier_currency_id]" data-name="supplier_currency_id" id="quote_0_supplier_currency_id" class="form-control select2single supplier-currency-id">
                                <option selected value="" >Select Supplier Currency</option>
                                @foreach ($currencies as $currency)
                                  <option value="{{ $currency->id }}" {{ isset(Auth::user()->getSupplierCurrency->id) && !empty(Auth::user()->getSupplierCurrency->id) && Auth::user()->getSupplierCurrency->id == $currency->id ? 'selected' : '' }} data-name="{{ $currency->code.' - '.$currency->name }}" data-code="{{ $currency->code }}" data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                                  <span class="input-group-text supplier-currency-code">{{ isset(Auth::user()->getSupplierCurrency->code) && !empty(Auth::user()->getSupplierCurrency->code) ? Auth::user()->getSupplierCurrency->code : '' }}</span>
                                </div>
                                <input type="text" name="quote[0][estimated_cost]" data-name="estimated_cost" data-type="currency" id="quote_0_estimated_cost" class="form-control estimated-cost change-calculation remove-zero-values" value="0.00">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3 whole-markup-feilds {{ isset(Auth::user()->markup_type) && !empty(Auth::user()->markup_type) && Auth::user()->markup_type == 'whole' ? 'd-none' : '' }}">
                            <div class="form-group">
                              <label>Markup Amount <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text supplier-currency-code">{{ isset(Auth::user()->getSupplierCurrency->code) && !empty(Auth::user()->getSupplierCurrency->code) ? Auth::user()->getSupplierCurrency->code : '' }}</span>
                                </div>
                                <input type="text" name="quote[0][markup_amount]" data-name="markup_amount"  data-type="currency"  id="quote_0_markup_amount" class="form-control markup-amount change-calculation remove-zero-values" value="0.00" min="0" step="any">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3 whole-markup-feilds {{ isset(Auth::user()->markup_type) && !empty(Auth::user()->markup_type) && Auth::user()->markup_type == 'whole' ? 'd-none' : '' }}">
                            <div class="form-group">
                              <label>Markup % <span style="color:red">*</span></label>
                              <div class="input-group">
                                <input type="text" name="quote[0][markup_percentage]" data-name="markup_percentage"  id="quote_0_markup_percentage" class="form-control markup-percentage change-calculation remove-zero-values" min="0" value="0.00">
                                <div class="input-group-append">
                                  <div class="input-group-text">%</div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3 whole-markup-feilds {{ isset(Auth::user()->markup_type) && !empty(Auth::user()->markup_type) && Auth::user()->markup_type == 'whole' ? 'd-none' : '' }}">
                            <div class="form-group">
                              <label>Selling Price <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text supplier-currency-code">{{ isset(Auth::user()->getSupplierCurrency->code) && !empty(Auth::user()->getSupplierCurrency->code) ? Auth::user()->getSupplierCurrency->code : '' }}</span></div>
                                <input type="text" name="quote[0][selling_price]" data-name="selling_price" id="quote_0_selling_price" class="form-control selling-price hide-arrows" value="0.00" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3 whole-markup-feilds {{ isset(Auth::user()->markup_type) && !empty(Auth::user()->markup_type) && Auth::user()->markup_type == 'whole' ? 'd-none' : '' }}">
                            <div class="form-group">
                              <label>Profit % <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text supplier-currency-code">{{ isset(Auth::user()->getSupplierCurrency->code) && !empty(Auth::user()->getSupplierCurrency->code) ? Auth::user()->getSupplierCurrency->code : '' }}</span></div>
                                <input type="text" name="quote[0][profit_percentage]" data-name="profit_percentage" id="quote_0_profit_percentage" class="form-control profit-percentage hide-arrows" value="0.00" readonly>
                                <div class="input-group-append">
                                  <div class="input-group-text">%</div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Estimated Cost in Booking Currency <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                                </div>
                                <input type="text" name="quote[0][estimated_cost_in_booking_currency]" data-name="estimated_cost_in_booking_currency" id="quote_0_estimated_cost_in_booking_currency" class="form-control estimated-cost-in-booking-currency" value="0.00" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4 whole-markup-feilds {{ isset(Auth::user()->markup_type) && !empty(Auth::user()->markup_type) && Auth::user()->markup_type == 'whole' ? 'd-none' : '' }}">
                            <div class="form-group">
                              <label>Markup Amount in Booking Currency <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                                </div>
                                <input type="text" name="quote[0][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_0_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4 whole-markup-feilds {{ isset(Auth::user()->markup_type) && !empty(Auth::user()->markup_type) && Auth::user()->markup_type == 'whole' ? 'd-none' : '' }}">
                            <div class="form-group">
                              <label>Selling Price in Booking Currency <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                                </div>
                                <input type="text" name="quote[0][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_0_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Internal Comments</label>
                              <button type="button" class="btn btn-xs btn-outline-dark ml-1 insert-quick-text"> <i class="fas fa-plus"></i> </button>
                              <textarea name="quote[0][comments]" data-name="comments" id="quote_0_comments" class="form-control comments" rows="1" placeholder="Enter Comments"></textarea>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <label>Add Stored Text</label>
                            <div class="form-group">
                              <button type="button" data-show="callStoredTextModal" class="mr-3 btn btn-outline-dark btn-sm addmodalforquote" data-toggle="modal">Add Stored Text</button>
                              <div class="modal fade callStoredTextModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                @include('quotes.includes.quote_detail_stored_text_modal')
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="parent-spinner text-gray spinner-border-sm "></div>
                  </div><!-- End parent -->

                  <div class="row d-flex justify-content-end">
                    <button type="button" id="add_more" class="btn btn-outline-dark btn-sm pull-right mr-half"><i class="fa fa-plus" aria-hidden="true"></i> Add more </button>
                    <button type="button" id="save_template" class="btn btn-outline-success btn-sm pull-right">Save as Template</button>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 agencyField d-none">
                    <div class="form-group">
                      <label>Agency Commission Type <span style="color:red">*</span></label>
                      <div class="d-flex flex-row">

                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" name="agency_commission_type" class="agency-commission-type custom-control-input custom-control-input-success custom-control-input-outline" id="agency_yes_net_price" value="net-price" checked>
                          <label class="custom-control-label" for="agency_yes_net_price">Net Price</label>
                        </div>

                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" name="agency_commission_type" class="agency-commission-type custom-control-input custom-control-input-success custom-control-input-outline" id="agency_yes_paid_net_of_commission" value="paid-net-of-commission">
                          <label class="custom-control-label" for="agency_yes_paid_net_of_commission">Paid Net of Commission</label>
                        </div>

                        <div class="custom-control custom-radio mr-1">
                          <input type="radio" name="agency_commission_type" class="agency-commission-type custom-control-input custom-control-input-success custom-control-input-outline" id="agency_yes_we_pay_commission_on_departure" value="we-pay-commission-on-departure"> 
                          <label class="custom-control-label" for="agency_yes_we_pay_commission_on_departure">We pay Commission on Departure</label>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row mt-1">
                  <label for="inputEmail3" class="col-md-4 col-form-label">Total Net Price</label>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                        </div>
                        <input type="text" name="total_net_price" step="any" class="form-control total-net-price hide-arrows" step="any" min="0"  value="0.00" readonly>
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
                          <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                        </div>
                        <input type="text" name="total_markup_amount" data-name="total_markup_amount" data-type="currency" class="form-control total-markup-amount total-markup-change remove-zero-values hide-arrows" value="0.00" {{ isset(Auth::user()->markup_type) && !empty(Auth::user()->markup_type) && Auth::user()->markup_type == 'whole' ? '' : 'readonly' }}>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" step="any" class="form-control total-markup-percent total-markup-change remove-zero-values hide-arrows" min="0" name="total_markup_percent" data-name="total_markup_percent" value="0.00" {{ isset(Auth::user()->markup_type) && !empty(Auth::user()->markup_type) && Auth::user()->markup_type == 'whole' ? '' : 'readonly' }}>
                        <div class="input-group-append">
                          <div class="input-group-text">%</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="paid-net-commission-on-departure d-none">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-4 col-form-label">Agency Commission</label>
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div>
                          <input type="text" name="agency_commission" data-type="currency" class="form-control agency-commission remove-zero-values" value="0.00">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-md-4 col-form-label">Net Margin</label>
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div>
                          <input type="text" name="total_net_margin" class="form-control total-net-margin remove-zero-values" value="0.00" readonly>
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
                          <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                        </div>
                        <input type="text" name="total_selling_price" class="form-control total-selling-price hide-arrows" value="0.00" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-md-4 col-form-label">Total Profit Percentage</label>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" step="any" name="total_profit_percentage" class="form-control total-profit-percentage hide-arrows" min="0" step="any" value="0.00" readonly>
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
                          <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                        </div>
                        <input type="text" name="booking_amount_per_person" class="form-control booking-amount-per-person hide-arrows" value="0.00" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row" id="potential_commission_feild">
                  <label for="inputEmail3" class="col-md-4 col-form-label">
                    Staff Commission
                    <h5>
                      <span class="badge badge-secondary badge-commission-name" title="Commission Name"></span>
                      <span class="badge badge-secondary badge-commission-group-name" title="Commission Group"></span>
                      <span class="badge badge-secondary badge-commission-percentage" title="Commission Percentage"></span>
                    </h5>
                  </label>

                  <div class="col-md-3 d-flex align-items-end">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                        </div>
                        <input type="text" name="commission_amount" class="form-control commission-amount hide-arrows" value="0.00" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-2 d-none align-items-end">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" name="commission_percentage" class="form-control commission-percentage hide-arrows" min="0" step="any" value="0.00" readonly>
                        <div class="input-group-append">
                          <div class="input-group-text">%</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2 d-none align-items-end">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" name="commission_criteria_id" value="" class="form-control commission-criteria-id hide-arrows" readonly>
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
                            @if (isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code)) 
                              {{ Auth::user()->getCurrency->code }}
                            @endif
                          </span>
                        </div>
                        <input type="text" name="commission_amount_in_sale_person_currency" class="form-control commission-amount-in-sale-person-currency hide-arrows" value="0.00" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2 align-items-end d-none">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" name="sale_person_currency_id" data-currency_code="{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}" value="{{ isset(Auth::user()->currency_id) && !empty(Auth::user()->currency_id) ? Auth::user()->currency_id : '' }}" class="form-control sale-person-currency-id hide-arrows" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Selling Price in Other Currency</label>
                      <select  name="selling_price_other_currency" class="form-control selling-price-other-currency">
                        <option value="" selected >Select Currency</option>
                        @foreach ($currencies as $currency)
                        <option value="{{ $currency->code }}" data-image="data:image/png;base64, {{$currency->flag}}" > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text selling-price-other-currency-code"></span>
                        </div>
                        <input type="text" name="selling_price_other_currency_rate" class="form-control selling-price-other-currency-rate hide-arrows" value="0.00" readonly>
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
                          <span class="input-group-text selling-price-other-currency-code"></span>
                        </div>
                        <input type="text" name="booking_amount_per_person_in_osp" class="form-control booking-amount-per-person-in-osp hide-arrows" value="0.00" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-4">
                    <label for="group_quote" class="col-form-label">Add into Group</label>
                  </div>
                  <div class="col-md-3 relevant-quote">
                    <select name="quote_group" class="form-control select2single dynamic-group" id="group_quote">
                      <option value="" selected >Select Group</option>
                      @foreach($groups as $group)
                        <option value="{{ $group->id }}"> {{ $group->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div><!-- End card body -->

              <div class="sticky" id="sticky_btn">
                <button type="button" id="sticky_button" class="btn btn-secondary d-none float-right"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success buttonSumbit float-right">Submit</button>
                <a href="{{ route('quotes.index') }}" class="btn btn-danger buttonSumbit float-right mr-2">Cancel</a>
              </div>
            </form><!-- End form -->

            <div id="overlay" class=""></div>
          </div><!-- End card -->
        </div>

      </div>
    </div>
  </section>

  <!-- Modals -->
    <!-- quotes -->
    @include('quotes.includes.store_template_modal')

    <!-- quote_booking -->
    @include('quote_booking_includes.preset_comment_modal', [ 'preset_comments' => $preset_comments ])
    @include('quote_booking_includes.store_product_modal')
    @include('quote_booking_includes.store_supplier_modal')
    @include('quote_booking_includes.append_quote_details_modal', ['categories' => $categories, 'module_class' => 'quotes-service-category-btn' ])
    @include('quote_booking_includes.append_quote_details_below_modal', ['categories' => $categories, 'module_class' => 'quotes-service-category-btn-below' ])
    @include('quote_booking_includes.currency_conversion_modal')
    
    @include('quote_booking_includes.store_harbour_modal')
    @include('quote_booking_includes.store_airport_code_modal')
    @include('quote_booking_includes.store_hotel_modal')
    @include('quote_booking_includes.store_group_owner_modal')
    @include('quote_booking_includes.store_cabin_type_modal')
    @include('quote_booking_includes.store_station_modal')
  <!-- End Modals  -->
</div>

@endsection

@push('js')
  <script src="{{ asset('js/quote_management.js') }}" ></script>
@endpush

{{-- <div class="col-sm-3">
  <div class="form-group">
    <label>TAS Reference <span class="text-secondary">(Optional)</span></label>
    <input type="text" id="tas_ref" name="tas_ref" class="form-control" value="{{ isset($tas_ref) & !empty($tas_ref) ? $tas_ref : '' }}"  placeholder="TAS Reference Number" >
    <span class="text-danger" role="alert"></span>
  </div>
</div> --}}


{{-- @include('partials.category_detail_feilds') --}}

{{-- <div class="col-sm-2">
      <div class="form-group">
        <label>Supplier Location <span style="color:red">*</span></label>
        <select name="quote[0][supplier_location_id]" data-name="supplier_location_id" id="quote_0_supplier_location_id" class="form-control supplier-location-id select2single" disabled>
          <option value="">Select Location</option>
          @foreach ($locations as $location)
            <option value="{{ $location->id }}" > {{ $location->name }} </option>
          @endforeach
        </select>
        <span class="text-danger" role="alert"></span>
      </div>
    </div> --}}

                {{-- <div class="col-sm-2">
      <div class="form-group">
        <label>Product</label>
        <input type="text" name="quote[0][product_id]" data-name="product_id" id="quote_0_product_id" class="form-control product-id" placeholder="Enter Product">
      </div>
    </div> --}}

    {{-- <div class="col-sm-2">
      <div class="form-group">
        <label>Product Location </label>
        <select name="quote[0][product_location_id]" data-name="product_location_id" id="quote_0_product_location_id" class="form-control product-location-id select2single" disabled>
          <option value="">Select Location</option>
          @foreach ($locations as $location)
            <option value="{{ $location->id }}" > {{ $location->name }} </option>
          @endforeach
        </select>
        <span class="text-danger" role="alert"></span>
      </div>
    </div> --}}


    
    {{-- <div class="col-sm-1 justify-content-center quote-category-detail-btn-parent d-none">
      <div class="form-group ">
        <button type="button" data-id="" class="add-category-detail btn btn-dark float-right mt-1"><i class="fa fa-plus" aria-hidden="true"></i></button>
      </div>
    </div> --}}



    {{-- <div class="col-sm-2">
      <div class="form-group">
        <label>Supervisor</label>
        <select name="quote[0][supervisor_id]" data-name="supervisor_id" id="quote_0_supervisor_id" class="form-control select2single supervisor-id @error('supervisor_id') is-invalid @enderror">
          <option selected value="">Select Supervisor</option>
          @foreach ($supervisors as $supervisor)
            <option value="{{ $supervisor->id }}" {{ old('category_id') == $supervisor->id  ? "selected" : "" }}> {{ $supervisor->name }} </option>
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
        <input placeholder="DD/MM/YYYY" type="text" name="quote[0][booking_date]" data-name="booking_date" id="quote_0_booking_date"  class="form-control booking-date datepicker  bookingDate" autocomplete="off" >
      </div>
    </div>

    <div class="col-sm-2">
      <div class="form-group">
        <label>Booking Due Date <span style="color:red">*</span></label>
        <input placeholder="DD/MM/YYYY" type="text" name="quote[0][booking_due_date]" data-name="booking_due_date" id="quote_0_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" autocomplete="off">
        <span class="text-danger" role="alert"></span>
      </div>
    </div> --}}

    {{-- <div class="col-sm-2">
      <div class="form-group">
        <label>Booking Reference</label>
        <input type="text" name="quote[0][booking_reference]" data-name="booking_refrence" id="quote_0_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
      </div>
    </div> --}}

    {{-- <div class="col-sm-2">
      <div class="form-group">
        <label>Booking Method</label>
        <select name="quote[0][booking_method_id]" data-name="booking_method_id" id="quote_0_booking_method_id" class="form-control select2single booking-method-id @error('booking_method_id') is-invalid @enderror">
          <option selected value="">Select Booking Method</option>
          @foreach ($booking_methods as $booking_method)
            <option value="{{ $booking_method->id }}" {{ old('booking_method_id') == $booking_method->id  ? "selected" : "" }}> {{ $booking_method->name }} </option>
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
        <select name="quote[0][booked_by_id]" data-name="booked_by_id" id="quote_0_booked_by_id" class="form-control select2single booked-by-id @error('booked_by_id') is-invalid @enderror">
          <option selected value="">Select Booked By</option>
          @foreach ($booked_by as $booked_by)
            <option value="{{ $booked_by->id }}" > {{ $booked_by->name }} </option>
          @endforeach
        </select>
        @error('booked_by_id')
          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
      </div>
    </div> --}}

{{-- <div class="col-sm-6">
    <div class="form-group">
      <label>Commission Type <span style="color:red">*</span></label>
      <select name="commission_id" id="commission_id" class="form-control select2single  commission-id">
        <option selected value="" >Select Commission Type </option>
        @foreach ($commission_types as $commission_type)
          <option {{ (Auth::user()->commission_id == $commission_type->id)? 'selected': '' }} value="{{ $commission_type->id }}">{{ $commission_type->name }} </option>
        @endforeach
      </select>
      <span class="text-danger" role="alert"></span>
    </div>
  </div> --}}

  {{-- <div class="col-sm-6">
    <div class="form-group">
      <label>Commission Group <span style="color:red">*</span></label>
        <select name="commission_group_id" id="commission_group_id" class="form-control select2single  commission-group-id">
          <option value="">Select Commission Group</option>
          @if(Auth::user()->getCommission->getCommissionGroups && Auth::user()->getCommission->getCommissionGroups->count())
            @foreach (Auth::user()->getCommission->getCommissionGroups as $commission_group)
              <option data-name="{{ $commission_group->name }}" value="{{ $commission_group->id }}" {{ isset(Auth::user()->commission_group_id) && !empty(Auth::user()->commission_group_id) && $commission_group->id == Auth::user()->commission_group_id ? 'selected' : '' }}> {{ $commission_group->name }} </option>
            @endforeach
          @endif
        </select>
      </select>
      <span class="text-danger" role="alert"></span>
    </div>
  </div> --}}

<!-- <div class="row" id="storedText" style="display:none;">
  <div class="col-md-12">
    <div class="form-group">
      <label " class="col-sm-3 col-form-label">Stored Text</label>
      <select multiple="multiple" name="stored_text[]" class="form-control select2-multiple" id="selectstoretext" disabled>
        {{-- @foreach ($storetexts as $text ) --}}
          {{-- <option value="{{$text->id}}" >{{ $text->name }}</option> --}}
        {{-- @endforeach --}}
      </select>
    </div>
  </div>
</div> -->

{{-- <div class="input-group-prepend">
<span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
</div> --}}

{{-- @if(Auth::user()->getRole->slug == 'admin' || Auth::user()->getRole->slug == 'accountant')
  <div class="col-sm-2 d-flex justify-content-center">
    <div class="form-group">
      <label>Added in Sage </label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="icheck-primary">
            <input type="hidden" name="quote[0][added_in_sage]"  value="0"><input data-name="added_in_sage" id="quote_0_added_in_sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
          </div>
        </div>
      </div>
    </div>
  </div>
@endif --}}

{{-- @include('partials.insert_quick_text', [ 'preset_comments' => $preset_comments ])
@include('partials.add_new_product')
@include('partials.template_modal') --}}
{{-- @include('partials.new_service_modal', ['categories' => $categories, 'module_class' => 'quotes-service-category-btn' ]) --}}
{{-- @include('partials.new_service_modal_below', ['categories' => $categories, 'module_class' => 'quotes-service-category-btn-below' ]) --}}
{{-- @include('partials.view_rates_modal') --}}


{{-- <span class="badge badge-info badge-supplier-currency-id"></span> --}}
