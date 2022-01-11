@extends('layouts.app')

@section('title', 'View Booking')

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
          <div class="col-md-6">
            <div>
              @if($booking->getBookingLogs->count())
                <p>
                  <a class="btn btn-info btn-sm" data-toggle="collapse" href="#view_booking_version" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    View Booking Versions {{  (count($booking->getBookingLogs) > 0 ) ? '('.count($booking->getBookingLogs).')' : '' }}
                  </a>
                </p>
                <div class="row">
                  <div class="col">
                    <div class="collapse multi-collapse" id="view_booking_version">
                      <div class="card card-body">
                        <table>
                          @foreach ($booking->getBookingLogs as $logKey =>  $logs)
                            <thead>
                              <th><a href="{{ route('bookings.version', encrypt($logs->id)) }}" target="_blank">Booking Version {{ $logs->log_no }} : {{ $logs->version_no }}</a></th>
                            </thead>
                            @endforeach
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="float-right">
              @if($booking->getQuote->getQuotelogs->count())
                <p class="">
                  <a class="btn btn-info btn-sm " data-toggle="collapse" href="#view_quote_version" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    View Quote Versions {{  (count($booking->getQuote->getQuotelogs) > 0 ) ? '('.count($booking->getQuote->getQuotelogs).')' : '' }}
                  </a>
                </p>
                <div class="row">
                  <div class="col-md-12">
                    <div class="collapse multi-collapse" id="view_quote_version">
                      <div class="card card-body float-right">
                        <table>
                          @foreach ($booking->getQuote->getQuotelogs as $logKey =>  $logs)
                            <thead>
                              <th><a href="{{ route('quotes.view.version', [encrypt($logs->id), 'booking']) }}" target="_blank">Quote Version {{ $logs->log_no }} : {{ $logs->version_no }}</a></th>
                            </thead>
                            @endforeach
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <h4>View Booking</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item">Booking</li>
              <li class="breadcrumb-item active">Booking Season</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content booking-show" id="content" data-countries="{{ $countries }}">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">

            <div class="card card-secondary">
              <div class="card-header">
                <h1 class="card-title text-center card-title-style">View Booking</h1>
                <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm float-right" data-title="Final Quotation" data-target="#Final_Quotation">
                  <span class="fa fa-arrow-left"></span>  &nbsp;Back to Listing
                </a>

                <a href="{{ route('quotes.final', encrypt($booking->quote_id)) }}" target="_blank" class="float-right btn btn-primary mr-2 btn-sm" data-title="Final Quotation" data-target="#Final_Quotation">
                  View Final Quote
                </a>

                <a href="{{ route('bookings.edit', encrypt($booking->id)) }}" onclick="return confirm('Are you sure you want to Edit this Booking?');" data-title="Edit" data-target="#edit" title="Edit">
                  <button type="button" class="mr-2 btn btn-info btn-sm float-right" data-title="" data-target="#" title="Edit">Edit Booking</button>
                </a>

              </div>
              
              <form method="POST" action="{{ route('bookings.update', encrypt($booking->id)) }}" id="update-payment">
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

                    <div class="row mb-2">

                      <div class="col-sm-6">
                        <label>Booking Details <span style="color:red">*</span></label>
                        <div class="form-group">
                          <input type="text" name="booking_details" id="booking_details" class="form-control" value="{{ $booking->booking_details }}" placeholder="Enter Booking Details">
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <label>Reason for Trip <span style="color:red">*</span></label>
                        <div class="form-group">
                          <input type="text" name="reason_for_trip" id="reason_for_trip" class="form-control" value="{{ $booking->reason_for_trip }}" placeholder="Enter Reason for Trip">
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Currency Rate Type <span style="color:red">*</span><a href="javascript:void(0);" class="ml-2 view-rates"> (View Rates)</a> </label>
                          <div>
                            <label class="radio-inline mr-1">
                                <input type="radio" name="rate_type" data-status="booking" class="rate-type" value="live"  {{ ($booking->rate_type == 'live')? 'checked': NULL }} >
                                <span>&nbsp;Live Rate</span>
                            </label>
                          
                            <label class="radio-inline mr-1">
                              <input type="radio" name="rate_type" data-status="booking" class="rate-type" value="manual" {{ ($booking->rate_type == 'manual')? 'checked': NULL }}>
                              <span>&nbsp;Manual Rate</span>
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <label>Zoho Reference <span style="color:red">*</span></label>
                        <div class="form-group">
                          <div class="input-group">
                            <input type="text" name="ref_no" id="ref_no" value="{{ old('ref_no')??$booking->ref_no }}" class="form-control reference-name" placeholder="Enter Reference Number">
                            <div class="input-group-append">
                              <button class="btn search-reference-btn search-reference" type="button">Search</button>
                            </div>
                          </div>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Quote Reference <span style="color:red">*</span></label>
                          <input type="text" value="{{ old('quote_no')??$booking->quote_ref }}" name="quote_no" class="form-control" placeholder="Quote Reference Number" readonly>
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
                              <input type="radio" name="markup_type" {{ ($booking->markup_type == 'itemised') ? 'checked': NULL }} value="itemised" class="booking-markup-type">
                              <span>&nbsp;Itemised Markup </span>
                            </label>
                            <label class="radio-inline mr-1">
                              <input type="radio" name="markup_type" {{ ($booking->markup_type == 'whole') ? 'checked': NULL }} value="whole" class="booking-markup-type">
                              <span>&nbsp;Whole Markup</span>
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Sales Person <span style="color:red">*</span></label>
                          <select name="sale_person_id" id="sale_person_id" class="form-control  select2single  sales-person-id">
                            <option value="">Select Sales Person</option>
                            @foreach ($sale_persons as $person)
                              <option  value="{{ $person->id }}" {{  (old('sale_person_id') == $person->id)? "selected" : ($booking->sale_person_id == $person->id ? 'selected' : '') }}>{{ $person->name }}</option>
                            @endforeach
                          </select>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      {{-- <div class="col-sm-6">
                        <div class="form-group">
                          <label>Commission Type <span style="color:red">*</span></label>
                          <select name="commission_id" id="commission_id" class="form-control commission-id">
                            <option selected value="" >Select Commission Type </option>
                            @foreach ($commission_types as $commission_type)
                                <option value="{{ $commission_type->id }}" {{  $commission_type->id == $booking->commission_id ? 'selected' : '' }}>{{ $commission_type->name }} ({{ $commission_type->percentage.' %' }})</option>
                            @endforeach
                          </select>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div> --}}

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Brand <span style="color:red">*</span></label>
                          <select name="brand_id" id="brand_id" class="form-control  select2single  getBrandtoHoliday brand-id ">
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                              <option value="{{ $brand->id }}" {{ (old('brand_id') == $brand->id)? "selected" : (($booking->brand_id == $brand->id)? 'selected':NULL) }}> {{ $brand->name }} </option>
                            @endforeach
                          </select>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Type Of Holiday <span style="color:red">*</span></label>
                          <select name="holiday_type_id" id="holiday_type_id" class="form-control  select2single  appendHolidayType  holiday-type-id">
                            <option value="">Select Type Of Holiday</option>
                            @if(!empty($booking->getBrand->getHolidayTypes))
                              @foreach ($booking->getBrand->getHolidayTypes as $holiday_type)
                                <option value="{{ $holiday_type->id }}" {{  (old('holiday_type_id') == $holiday_type->id)? "selected" : ($booking->holiday_type_id == $holiday_type->id ? 'selected' : '') }} >{{ $holiday_type->name }}</option>
                              @endforeach
                            @endif
                            <option value="">Select Type Of Holiday</option>
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
                              <option value="{{ $season->id }}"  data-start="{{ $season->start_date }}" data-end="{{ $season->end_date }}"  {{ old('season_id') == $season->id  ? "selected" : ($booking->season_id == $season->id ? 'selected' : '') }}> {{ $season->name }} </option>
                            @endforeach
                          </select>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>
                    
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Booking Currency <span style="color:red">*</span></label>
                          <select name="currency_id" id="currency_id" data-status="booking" class="form-control booking-currency-id @error('currency_id') is-invalid @enderror">
                            <option value="">Select Booking Currency </option>
                            @foreach ($currencies as $currency)
                              <option value="{{ $currency->id }}" data-code="{{ $currency->code }}" data-image="data:image/png;base64, {{$currency->flag}}" {{ $currency->id == $booking->currency_id ? 'selected' : ''  }} > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                            @endforeach
                          </select>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Agency Booking <span style="color:red">*</span></label>
                          <div>
                            <label class="radio-inline">
                              <input class="select-agency" {{ ($booking->agency ==  1) ? 'checked' : '' }}  value="1" type="radio" name="agency" > Yes
                            </label>
                            <label class="radio-inline">
                              <input  class="select-agency" {{ ($booking->agency ==  0 || $booking->agency == null) ? 'checked' : '' }}  value="0" type="radio" name="agency" > No
                            </label>
                          </div>
                        </div>
                      </div>
                 
                      <div class="col-md-12 agency-columns">
                        @if($booking->agency == 1)
                          <div class="row mt-1" >
                            <div class="col form-group">
                              <label for="inputEmail3" class="">Agency Name</label> <span style="color:red"> *</span>
                              <input type="text" value="{{ $booking->agency_name }}" name="agency_name" id="agency_name" class="form-control">
                              <span class="text-danger" role="alert" > </span>
                            </div>
                            <div class="col form-group">
                              <label for="inputEmail3" class="">Agency Contact Name </label> <span style="color:red"> *</span>
                              <input type="text" value="{{ $booking->agency_contact_name }}" name="agency_contact_name" id="agency_contact_name" class="form-control">
                              <span class="text-danger" role="alert" > </span>
                            </div>
                            <div class="col form-group">
                              <label for="inputEmail3" class="">Agency Contact No.</label> <span style="color:red"> *</span>
                              <input type="tel" value="{{ $booking->agency_contact }}" name="agency_contact" id="agency_contact" class="form-control phone phone0">
                              <span class="text-danger error_msg0 hide" role="alert"></span>
                            </div>
                          
                            <div class="col form-group">
                              <label for="inputEmail3" class="">Agency Email </label> <span style="color:red"> *</span>
                              <input type="email" value="{{ $booking->agency_email }}" name="agency_email" id="agency_email" class="form-control">
                              <span class="text-danger" role="alert" > </span>
                            </div>
                          </div>
                        @else  {{--  lead passenger  --}}
                          <div class="row mt-1" >
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Lead Passenger Name <span style="color:red">*</span></label>
                                <input type="text" value="{{ $booking->lead_passenger_name }}" name="lead_passenger_name" id="lead_passenger_name" class="form-control" placeholder="Lead Passenger Name" >
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Email Address <span style="color:red">*</span></label> 
                                <input type="email" value="{{ $booking->lead_passenger_email }}" name="lead_passenger_email" id="lead_passenger_email" class="form-control" placeholder="EMAIL ADDRESS" >
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Contact Number <span style="color:red">*</span></label> 
                                <input type="tel" value="{{ $booking->lead_passenger_contact }}" name="lead_passenger_contact" id="lead_passenger_contact"  class="form-control phone phone0" >
                                <span class="text-danger error_msg0" role="alert"></span>
                              </div>
                            </div>
                          
                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Date Of Birth </label> 
                                <input type="date" value="{{ $booking->lead_passenger_dbo }}" max="{{ date('Y-m-d') }}" id="lead_passenger_dbo" name="lead_passenger_dbo" class="form-control" placeholder="Date Of Birth" >
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Nationality (Passport)</label>
                                <select name="lead_passsenger_nationailty_id" id="lead_passsenger_nationailty_id" class="form-control select2single nationality-id">
                                  <option selected value="" >Select Nationality</option>
                                  @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ ($booking->lead_passsenger_nationailty_id == $country->id)? 'selected': null }}> {{ $country->name }} </option>
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
                                    <option value="{{ $country->id }}" {{ ($booking->lead_passenger_resident == $country->id)? 'selected': null }}> {{ $country->name }} </option>
                                  @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Bedding Preferences </label>
                                <input type="text" value="{{ $booking->lead_passenger_bedding_preference }}" name="lead_passenger_bedding_preference" id="lead_passenger_bedding_preference" class="form-control " placeholder="Bedding Preferences" id="bedding_preference" >
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div> 
                            
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Dietary Preferences</label>
                                <input type="text" value="{{ $booking->lead_passenger_dietary_preferences }}" name="lead_passenger_dietary_preferences" id="lead_passenger_dietary_preferences" class="form-control" placeholder="Dietary Preferences" >
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>
                            
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Up To Date Covid Vaccination Status </label>
                                <div>
                                  <label class="radio-inline">
                                    <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="1" {{ ($booking->lead_passenger_covid_vaccinated ==  1) ? 'checked' : '' }}> Yes &nbsp;&nbsp;
                                  </label>
                                  <label class="radio-inline">
                                    <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="0" {{ ($booking->lead_passenger_covid_vaccinated ==  0 || $booking->lead_passenger_covid_vaccinated == null) ? 'checked' : '' }} > No &nbsp;&nbsp;
                                  </label>

                                  <label class="radio-inline">
                                    <input type="radio" name="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="2" {{ ($booking->lead_passenger_covid_vaccinated ==  2 || $booking->lead_passenger_covid_vaccinated == null) ? 'checked' : '' }} > Not Sure
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
                          <label>Pax No. <span style="color:red">*</span></label>
                          <select name="pax_no" id="pax_no" class="form-control  select2single  paxNumber pax-number @error('pax_no') is-invalid @enderror">
                            <option value="">Select Pax No</option>
                            @for($i=1;$i<=30;$i++)
                                <option value={{$i}} {{ (old('pax_no') == $i)? "selected" : (($booking->pax_no == $i)? 'selected': NULL) }}>{{$i}}</option>
                            @endfor
                          </select>
                          <span class="text-danger" role="alert"></span>
                        </div>
                      </div>

                      <div id="appendPaxName" class="col-md-12">
                        @if($booking->pax_no >= 1)
                          @foreach ($booking->getPaxDetail as $paxKey => $pax )
                          @php $count = $paxKey + 1; @endphp
                            <div class="mb-2 appendCount" id="appendCount{{ $count }}">
                              <div class="row">
                                <div class="col-md-3 mb-2">
                                  <label>Passenger #{{ ($booking->agency == 1)? $count : $count +1  }} Full Name</label> 
                                  <input type="text" name="pax[{{$count}}][full_name]" value="{{ $pax->full_name }}" class="form-control" placeholder="PASSENGER #2 FULL NAME" >
                                  <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                </div>

                                <div class="col-md-3 mb-2">
                                  <label >Email Address</label> 
                                  <input type="email" name="pax[{{$count}}][email_address]" value="{{ $pax->email_address }}" class="form-control" placeholder="EMAIL ADDRESS" >
                                  <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                </div>

                                <div class="col-md-3 mb-2">
                                  <label >Contact Number</label> 
                                  <input type="tel" name="pax[{{$count}}][contact_number]" value="{{ $pax->contact_number }}" class="form-control phone phone{{ $count }}"  >
                                  <span class="text-danger error_msg{{ $count }}" role="alert" > </span>
                                  <span class="text-danger valid_msg{{ $count }}" role="alert" > </span>
                                </div>
                                          
                                <div class="col-md-3 mb-2">
                                  <label>Date Of Birth</label> 
                                  <input type="date" max="{{  date("Y-m-d") }}" name="pax[{{$count}}][date_of_birth]" value="{{ $pax->date_of_birth }}" class="form-control" placeholder="CONTACT NUMBER" >
                                  <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-sm-3">
                                  <label>Nationality</label>
                                  <select name="pax[{{ $count }}][nationality_id]" class="form-control select2single nationality-id">
                                    <option selected value="" >Select Nationality</option>
                                    @foreach ($countries as $country)
                                      <option value="{{ $country->id }}" {{ (old('nationality_id') == $country->id)? 'selected':( ($pax->country_id == $country->id)? 'selected':null) }}> {{ $country->name }} </option>
                                    @endforeach
                                  </select>
                                </div>

                                <div class="col-sm-3">
                                  <label>Resident In</label>
                                  <select name="pax[{{ $count }}][resident_in]" class="form-control select2single resident-in-id">
                                    <option selected value="" >Select Resident In</option>
                                      @foreach ($countries as $country)
                                          <option value="{{ $country->id }}" {{ (old('resident_in') == $country->id)? 'selected':( ($pax->resident_in == $country->id)? 'selected':null) }}> {{ $country->name }} </option>
                                      @endforeach
                                  </select>
                                </div>
                      
                                <div class="col-md-3 mb-2">
                                  <label>Bedding Preference</label> 
                                  <input type="text" name="pax[{{$count}}][bedding_preference]" value="{{ $pax->bedding_preference }}" class="form-control" placeholder="BEDDING PREFERENCES" >
                                  <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                </div>
                                
                                <div class="col-md-3 mb-2">
                                  <label>Dietary Preferences</label> 
                                  <input type="text" name="pax[{{$count}}][dietary_preferences]" value="{{ $pax->dietary_preferences }}" class="form-control" placeholder="Dietary Preferences" >
                                  <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label>Up To Date Covid Vaccination Status</label>
                                    <div>
                                      <label class="radio-inline">
                                        <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="1" 
                                        @if($pax->covid_vaccinated == 1)
                                        checked
                                        @endif> Yes &nbsp;&nbsp;
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="0"
                                        @if($pax->covid_vaccinated == 0)
                                        checked
                                        @endif > No &nbsp;&nbsp;
                                      </label>

                                      <label class="radio-inline">
                                        <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="2"
                                        @if($pax->covid_vaccinated == 2)
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
                      @if($booking->getBookingDetail && $booking->getBookingDetail->count())
                      <div class="sortable sortable-spacing">
                        @foreach ($booking->getBookingDetail as $key  => $booking_detail )
                          <div class="quote card card-default quote-{{$key}}" data-key="0">

                            <div class="card-header">
                              <h3 class="card-title card-title-style quote-title">
                                @if($booking_detail->status == 'active')
                                <span class="badge badge-success">Booked</span>
                                @elseif($booking_detail->status == 'cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                                @endif
                                
                                <span class="border-right mr-2 ml-1"></span>
                                <span class="badge badge-info badge-date-of-service">{{ isset($booking_detail->date_of_service) && !empty($booking_detail->date_of_service) ? $booking_detail->date_of_service : '' }}</span>
                                <span class="badge badge-info badge-time-of-service">{{ isset($booking_detail->time_of_service) && !empty($booking_detail->time_of_service) ? $booking_detail->time_of_service : '' }}</span>
                                <span class="badge badge-info badge-category-id">{{ isset($booking_detail->getCategory->name) && !empty($booking_detail->getCategory->name) ? $booking_detail->getCategory->name : '' }}</span>
                                <span class="badge badge-info badge-supplier-id">{{ isset($booking_detail->getSupplier->name) && !empty($booking_detail->getSupplier->name) ? $booking_detail->getSupplier->name : ''}}</span>
                                <span class="badge badge-info badge-product-id">{{  isset($booking_detail->getProduct->name) && !empty($booking_detail->getProduct->name) ? $booking_detail->getProduct->name : '' }}</span>
                                <span class="badge badge-info badge-supplier-currency-id">{{ isset($booking_detail->getSupplierCurrency->name) && !empty($booking_detail->getSupplierCurrency->name) ? $booking_detail->getSupplierCurrency->code.' - '.$booking_detail->getSupplierCurrency->name : '' }}</span>
                              </h3>
  
                              <div class="card-tools">
                                <input type="hidden" name="quote[{{ $key }}][booking_detail_unique_ref_id]" value="{{ $booking_detail->booking_detail_unique_ref_id }}" >
                                <input type="hidden" name="quote[{{ $key }}][created_by]" id="quote_{{ $key }}_created_by" value="{{ isset($booking_detail->getBookingCancellation->cancelled_by_id) && !empty($booking_detail->getBookingCancellation->cancelled_by_id) ? $booking_detail->getBookingCancellation->cancelled_by_id : Auth::id() }}" >
                                <input type="hidden" name="quote[{{ $key }}][status]" id="quote_{{ $key }}_status" value="{{ isset($booking_detail->status) && !empty($booking_detail->status) ? $booking_detail->status : '' }}" >
                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 collapse-expand-btn" title="Minimize/Maximize" data-card-widget="collapse"><i class="fas fa-minus"></i></a>
                              </div>
                            </div> 
                           
                            <div class="card-body">
                              <div class="row">

                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Start Date of Service <span style="color:red">*</span></label>
                                    <input type="text" value="{{ $booking_detail->date_of_service }}" name="quote[{{ $key }}][date_of_service]" data-name="date_of_service" id="quote_{{ $key }}_date_of_service" class="form-control date-of-service datepicker checkDates bookingDateOfService"  placeholder="Date of Service" autocomplete="off">
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>End Date of Service <span style="color:red">*</span></label>
                                    <input type="text" value="{{ $booking_detail->end_date_of_service }}" name="quote[{{ $key }}][end_date_of_service]" data-name="date_of_service" id="quote_{{ $key }}_end_date_of_service" class="form-control end-date-of-service datepicker"  placeholder="Date of Service" autocomplete="off">
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Number of Nights</label>
                                    <input type="text" name="quote[{{ $key }}][number_of_nights]" value="{{ $booking_detail->number_of_nights }}" id="quote_{{ $key }}_number_of_nights" class="form-control number-of-nights" readonly>
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Time of Service</label>
                                    <input type="time" value="{{ $booking_detail->time_of_service }}" name="quote[{{ $key }}][time_of_service]" data-name="time_of_service" id="quote_{{ $key }}_time_of_service" class="form-control time-of-service " placeholder="Time of Service" autocomplete="off">
                                  </div>
                                </div>

                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Category</label>
                                    <select name="quote[{{ $key }}][category_id]" data-name="category_id" id="quote_{{ $key }}_category_id" class="form-control  select2single  category- select2single  category-id @error('category_id') is-invalid @enderror">
                                      <option value="">Select Category</option>
                                      @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" data-name="{{ $category->name }}" {{ ($booking_detail->category_id == $category->id)? 'selected' : NULL}} > {{ $category->name }} </option>
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
                                        <option value="{{ $location->id }}" {{ ($booking_detail->supplier_location_id == $location->id)? 'selected' : NULL}}> {{ $location->name }} </option>
                                      @endforeach
                                    </select>
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                @php
                                  $supplier_url = \Helper::getSupplierRateSheetUrl($booking_detail->supplier_id, $booking->season_id);
                                  $url          = !empty($supplier_url) ? $supplier_url : '';
                                  $text         = !empty($supplier_url) ? "(View Rate Sheet)" : '';
                                @endphp

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>
                                      Supplier <span style="color:red">*</span>
                                      <a href="{{ $url }}" target="_blank" class="ml-1 view-supplier-rate">{{ $text }}</a>
                                    </label>
                                    <select name="quote[{{ $key }}][supplier_id]" data-name="supplier_id" id="quote_{{ $key }}_supplier_id" class="form-control  select2single  supplier-id @error('supplier_id') is-invalid @enderror">
                                      <option value="">Select Supplier</option>
                                      @if(isset($booking_detail->getCategory) && isset($booking_detail->supplier_location_id) && !empty($booking_detail->supplier_location_id))
                                        @foreach ($booking_detail->getCategory->getSupplierWithLocation($booking_detail->supplier_location_id)->get() as $supplier )
                                          <option value="{{ $supplier->id }}" data-name="{{ $supplier->name }}" {{ ($booking_detail->supplier_id == $supplier->id)? 'selected' : NULL}}  >{{ $supplier->name }}</option>
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
                                    <input type="text" name="quote[{{ $key }}][product_id]"  data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control product-id" value="{{ $booking_detail->product_id }}" placeholder="Enter Product">
                                  </div>
                                </div> --}}

                                {{-- <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Product Location </label>
                                    <select name="quote[{{ $key }}][product_location_id]" data-name="product_location_id" id="quote_{{ $key }}_product_location_id" class="form-control product-location-id select2single @error('product_location_id') is-invalid @enderror">
                                      <option value="">Select Location</option>
                                      @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" {{ ($booking_detail->product_location_id == $location->id)? 'selected' : NULL}}> {{ $location->name }} </option>
                                      @endforeach
                                    </select>
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div> --}}

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Product </label>
                                    <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control  select2single   product-id @error('product_id') is-invalid @enderror">
                                      <option value="">Select Product</option>
                                      @if(isset($booking_detail->getSupplier) && !empty($booking_detail->getSupplier))
                                        @foreach ($booking_detail->getSupplier->getProducts()->get() as $product)
                                          <option value="{{ $product->id }}" data-name="{{ $product->name }}" {{ ($booking_detail->product_id == $product->id)? 'selected' : NULL}}>{{ $product->name }}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                {{-- <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Supervisor</label>
                                    <select name="quote[{{ $key }}][supervisor_id]" data-name="supervisor_id" id="quote_{{ $key }}_supervisor_id" class="form-control   select2single   supervisor-id @error('supervisor_id') is-invalid @enderror">
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
                                    <input type="text" value="{{ $booking_detail->booking_date}}" name="quote[{{ $key }}][booking_date]" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" placeholder="Booking Date">
                                  </div>
                                </div> --}}

                                {{-- <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Booking Due Date <span style="color:red">*</span></label>
                                    <input type="text" value="{{ $booking_detail->booking_due_date }}" name="quote[{{ $key }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date">
                                    <span class="text-danger" role="alert"></span>
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
                                    <select name="quote[{{ $key }}][booking_method_id]" data-name="booking_method_id" id="quote_{{ $key }}_booking_method_id" class="form-control  select2single  booking-method-id @error('booking_method_id') is-invalid @enderror">
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
                                    <select name="quote[{{ $key }}][booked_by_id]" databooking="booked_by_id" id="quote_{{ $key }}_booked_by_id" class="form-control   select2single   booked-by-id @error('booked_by_id') is-invalid @enderror">
                                      <option value="">Select Booked By {{  $booking_detail->booked_by_id }}</option>
                                      @foreach ($booked_by as $book_id)
                                          <option value="{{ $book_id->id }}" {{ $booking_detail->booked_by_id == $book_id->id  ? "selected" : "" }}> {{ $book_id->name }} </option>
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
                                    <select name="quote[{{ $key }}][booking_type_id]" data-name="booking_type_id" id="quote_{{ $key }}_booking_type_id" class="form-control  select2single    booking-type-id @error('booking_type_id') is-invalid @enderror">
                                      <option value="">Select Payment Type</option>
                                      @foreach ($booking_types as $booking_type)
                                      <option value="{{ $booking_type->id }}" data-slug="{{ $booking_type->slug }}" {{ $booking_detail->booking_type_id == $booking_type->id  ? "selected" : "" }}> {{ $booking_type->name }} </option>
                                      @endforeach
                                    </select>

                                    @error('booking_type_id')
                                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="col-sm-2 refundable-percentage-feild {{ isset($booking_detail->booking_type_id) && !empty($booking_detail->booking_type_id) && $booking_detail->booking_type_id == 2 ? '' : 'd-none'  }}">
                                  <div class="form-group">
                                    <label>Refundable % <span style="color:red">*</span></label>
                                    <input type="number" name="quote[{{ $key }}][refundable_percentage]" value="{{ $booking_detail->refundable_percentage }}" data-name="refundable_percentage" id="quote_{{ $key }}_refundable_percentage" class="form-control refundable-percentage" placeholder="Refundable %">
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Supplier Currency <span style="color:red">*</span></label>
                                    <select name="quote[{{ $key }}][supplier_currency_id]" data-name="supplier_currency_id" id="quote_{{ $key }}_supplier_currency_id" class="form-control select2single booking-supplier-currency-id @error('currency_id') is-invalid @enderror">
                                      <option value="">Select Supplier Currency</option>
                                      @foreach ($currencies as $currency)
                                      <option value="{{ $currency->id }}"  data-name="{{ $currency->code.' - '.$currency->name }}" data-code="{{ $currency->code }}" {{ $booking_detail->supplier_currency_id == $currency->id  ? "selected" : "" }}  data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                                      @endforeach
                                    </select>
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Estimated Cost <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->estimated_cost) }}" name="quote[{{ $key }}][estimated_cost]" data-name="estimated_cost" data-status="booking" id="quote_{{ $key }}_estimated_cost" class="form-control estimated-cost hide-arrows" value="0.00">
                                    </div>
                                  </div>
                                </div>
    
                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Actual Cost <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->actual_cost) }}" name="quote[{{ $key }}][actual_cost]" data-name="actual_cost" data-status="booking" id="quote_{{ $key }}_actual_cost" class="form-control actual-cost change" value="0.00">
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-2 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }}">
                                  <div class="form-group">
                                    <label>Markup Amount <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_amount) }}" name="quote[{{ $key }}][markup_amount]" data-name="markup_amount" id="quote_{{ $key }}_markup_amount" class="form-control markup-amount change" value="0.00">
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-2 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }}">
                                  <div class="form-group">
                                    <label>Markup % <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_percentage) }}" name="quote[{{ $key }}][markup_percentage]" data-name="markup_percentage" id="quote_{{ $key }}_markup_percentage" class="form-control markup-percentage change" value="0.00">
                                      <div class="input-group-append">
                                        <div class="input-group-text">%</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-2 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }}">
                                  <div class="form-group">
                                    <label>Selling Price <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->selling_price) }}" name="quote[{{ $key }}][selling_price]" data-name="selling_price" id="quote_{{ $key }}_selling_price" class="form-control selling-price hide-arrows" value="0.00" readonly>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-2 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }}">
                                  <div class="form-group">
                                    <label>Profit % <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->profit_percentage) }}" name="quote[{{ $key }}][profit_percentage]" data-name="profit_percentage" id="quote_{{ $key }}_profit_percentage" class="form-control profit-percentage hide-arrows" value="0.00" readonly>
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
                                        <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->actual_cost_bc) }}" name="quote[{{ $key }}][actual_cost_in_booking_currency]" data-name="actual_cost_in_booking_currency" id="quote_{{ $key }}_actual_cost_in_booking_currency" class="form-control actual-cost-in-booking-currency"  readonly>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }}">
                                  <div class="form-group">
                                    <label>Markup Amount in Booking Currency <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_amount_in_booking_currency) }}" name="quote[{{ $key }}][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_{{ $key }}_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly> 
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3 booking-whole-markup-feilds {{ $booking->markup_type == 'whole' ? 'd-none' : '' }}">
                                  <div class="form-group">
                                    <label>Selling Price in Booking Currency <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->selling_price_in_booking_currency) }}" name="quote[{{ $key }}][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_{{ $key }}_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
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
                                          <input type="hidden" name="quote[{{ $key }}][added_in_sage]" value="{{ $booking_detail->added_in_sage }}"><input data-name="added_in_sage" id="quote_{{ $key }}_added_in_sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($booking_detail->added_in_sage == 1) ? 'checked': '' }}> 
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                @endif --}}
                                      
                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Service Details</label>
                                    <textarea name="quote[{{ $key }}][service_details]" data-name="service_details" id="quote_{{ $key }}_service_details" class="form-control service-details" rows="2" placeholder="Enter Service Details">{{ $booking_detail->service_details }}</textarea>
                                  </div>
                                </div>

                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Internal Comments</label>
                                    <textarea name="quote[{{ $key }}][comments]" data-name="comments" id="quote_{{ $key }}_comments" class="form-control comments" rows="2" placeholder="Enter Comments">{{ $booking_detail->comments }}</textarea>
                                  </div>
                                </div>

                                @if($booking_detail->invoice_url)
                                  <div class="col-sm-2">
                                    <label>Invoice Preview</label>
                                    <div class="form-group">
                                      <a href="{{ $booking_detail->invoice_url }}" class="btn btn-outline-dark">Invoice</a>
                                    </div>
                                  </div>
                                @endif

                                <div class="col-sm-2 d-none">
                                  <div class="form-group">
                                    <label>Outstanding Amount left</label>
                                    <input type="number" value="{{ \Helper::number_format($booking_detail->outstanding_amount_left) }}" name="quote[{{ $key }}][outstanding_amount_left]" data-name="outstanding_amount_left" id="quote_{{ $key }}_outstanding_amount_left" class="form-control outstanding_amount_left hide-arrows" >
                                  </div>
                                </div>
                              </div>  

                            <!-- Administration row -->
                            <h3 class="mt-2 mb-1-half">Administration</h3>
                            <div class="row administraion-row">

                              <div class="col-sm-2">
                                <div class="form-group">
                                  <label>Booking Date</label>
                                  <input type="text" value="{{ $booking_detail->booking_date}}" name="quote[{{ $key }}][booking_date]" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" autocomplete="off" placeholder="Booking Date">
                                </div>
                              </div>

                              <div class="col-sm-2">
                                <div class="form-group">
                                  <label>Booking Due Date  <span style="color:red">*</span></label>
                                  <input type="text" value="{{ $booking_detail->booking_due_date }}" name="quote[{{ $key }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date">
                                  <span class="text-danger" role="alert"></span>
                                </div>
                              </div>

                              <div class="col-sm-2">
                                <div class="form-group">
                                  <label>Booking Method</label>
                                  <select name="quote[{{ $key }}][booking_method_id]" data-name="booking_method_id" id="quote_{{ $key }}_booking_method_id" class="form-control  select2single  booking-method-id @error('booking_method_id') is-invalid @enderror">
                                    <option value="">Select Booking Method</option>
                                    @foreach ($booking_methods as $booking_method)
                                        <option value="{{ $booking_method->id }}" {{ $booking_detail->booking_method_id == $booking_method->id  ? "selected" : "" }}> {{ $booking_method->name }} </option>
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
                                    <option value="">Select Booked By</option>
                                    @foreach ($booked_by as $book_id)
                                        <option value="{{ $book_id->id }}" {{ $booking_detail->booked_by_id == $book_id->id  ? "selected" : "" }}> {{ $book_id->name }} </option>
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
                                      <option value="{{ $supervisor->id }}" {{ ($booking_detail->supervisor_id == $supervisor->id) ? 'selected' : NULL }}> {{ $supervisor->name }} </option>
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
                                  <input type="text" value="{{ $booking_detail->booking_reference }}" name="quote[{{ $key }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $key }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
                                </div>
                              </div>

                              @if(Auth::user()->getRole->slug == 'admin' || Auth::user()->getRole->slug == 'accountant')
                                <div class="col-sm-2 d-flex justify-content-center">
                                  <div class="form-group">
                                    <label>Added in Sage</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="icheck-primary">
                                          <input type="hidden" name="quote[{{ $key }}][added_in_sage]" value="{{ $booking_detail->added_in_sage }}"><input data-name="added_in_sage" id="quote_{{ $key }}_added_in_sage" class="added-in-sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($booking_detail->added_in_sage == 1) ? 'checked': '' }}> 
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              @endif

                            </div>
                            <!-- End Administration row -->
                            
                              @php $total_deposit = 0; @endphp
                              <section class="finance">
                                @if($booking_detail->getBookingFinance && count($booking_detail->getBookingFinance) > 0)
                                  @foreach ($booking_detail->getBookingFinance as $fkey => $finance)
                                    @php
                                      $count = $fkey + 1;
                                      $total_deposit = $total_deposit + $finance->deposit_amount;
                                    @endphp
                                    <h3 class="mt-2 mb-1-half">Payments</h3>
                                    <div class="row finance-clonning row-cols-lg-7 g-0 g-lg-2 mt-2" data-financekey="{{$fkey}}">
                                      <div class="col-sm-3">
                                        <div class="form-group">
                                          <label class="depositeLabel" id="deposite_heading{{ $fkey }}">Payment #{{ $count }}</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                            </div>
                                            <input type="number" value="{{ \Helper::number_format($finance->deposit_amount) }}" name="quote[{{ $key }}][finance][{{ $fkey }}][deposit_amount]" data-name="deposit_amount" id="quote_{{$key}}_finance_{{$fkey}}_deposit_amount" value="0.00" class="form-control deposit-amount remove-zero-values hide-arrows" step="any" >
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Deposit Due Date</label>
                                          <input type="date" value="{{ $finance->deposit_due_date }}" name="quote[{{ $key }}][finance][{{ $fkey }}][deposit_due_date]" data-name="deposit_due_date" id="quote_{{$key}}_finance_{{$fkey}}_deposit_due_date" class="form-control deposit-due-date" >
                                        </div>
                                      </div>

                                      <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Paid Date</label>
                                          <input type="date" value="{{ $finance->paid_date }}" name="quote[{{ $key }}][finance][{{ $fkey }}][paid_date]" data-name="paid_date" id="quote_{{$key}}_finance_{{$fkey}}_paid_date" class="form-control paid-date">
                                        </div>
                                      </div>

                                      <div class="col-sm-2 d-flex justify-content-center">
                                        <div class="form-group {{ isset($finance->deposit_due_date) && !empty($finance->deposit_due_date) && !is_null($status) ? 'd-none' : '' }}">
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

                                      <div class="col-sm-1 d-flex justify-content-center">
                                        <div class="form-group">
                                          <button type="button" onclick="this.closest('.finance-clonning').remove()" class=" btn btn-outline-dark btn-sm">X</button>
                                        </div>
                                      </div>

                                      <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Payment</label>
                                          <select  name="quote[{{ $key }}][finance][{{ $fkey }}][payment_method]" data-name="payment_method" id="quote_{{$key}}_finance_{{$fkey}}_payment_method" class="form-control payment-method select2single" >
                                            <option value="">Select Payment Method</option>
                                            @foreach ($payment_methods as $payment_method)
                                              <option value="{{ $payment_method->id }}" {{ $payment_method->id == $finance->payment_method_id ? 'selected' : '' }}> {{ $payment_method->name }} </option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-sm-3 {{ isset($finance->deposit_due_date) && !empty($finance->deposit_due_date) && !is_null($status) ? 'd-none' : '' }}">
                                        <div class="form-group">
                                          <label>Alert before the following days </label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <button type="button" class="input-group-text minus increment">-</button>
                                            </div>
                                            <input type="text"  name="quote[{{ $key }}][finance][{{$fkey}}][ab_number_of_days]" step="any" name="ab_number_of_days" class="form-control ab_number_of_days remove-zero-values"  size="10" value="{{ $finance->additional_date??0 }}" {{ isset($finance->deposit_due_date) && !empty($finance->deposit_due_date) ? 'readonly' : '' }}>
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
                                              <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                            </div>
                                            <input type="number" value="{{ \Helper::number_format($finance->outstanding_amount) }}" name="quote[{{ $key }}][finance][{{$fkey}}][outstanding_amount]" data-name="outstanding_amount" id="quote_{{$key}}_finance_{{$fkey}}_outstanding_amount" value="0.00" class="form-control outstanding-amount hide-arrows" step="any" readonly>
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
                                            <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                          </div>
                                          <input type="number" name="quote[{{ $key }}][finance][0][deposit_amount]" data-name="deposit_amount" id="quote_{{$key}}_finance_0_deposit_amount" value="0.00" class="form-control deposit-amount remove-zero-values hide-arrows" step="any">
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
                                            <input type="text"  name="quote[{{ $key }}][finance][0][ab_number_of_days]" step="any" name="ab_number_of_days" id="quote_{{$key}}_finance_0_ab_number_of_days" class="form-control ab_number_of_days remove-zero-values"  size="10" value="0">
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
                                            <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                          </div>
                                          <input type="number" value="" name="quote[{{ $key }}][finance][0][outstanding_amount]" data-name="outstanding_amount" id="quote_{{$key}}_finance_0_outstanding_amount" value="0.00" class="form-control outstanding-amount hide-arrows" step="any" readonly>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endif
                              </section>

                              @php $refund_amount = 0; @endphp
                              <section class="refund-by-bank-section">
                                @if($booking_detail->getBookingRefundPayment && count($booking_detail->getBookingRefundPayment) > 0)
                                <h3 class="mt-2 mb-1-half">Refund - By Bank</h3>
                                  @foreach ($booking_detail->getBookingRefundPayment as $rpkey => $payment)
                                  @php
                                    $count = $rpkey + 1;
                                    $total_refund_amount = $refund_amount + $payment->refund_amount;
                                  @endphp
                                    <div class="refund-payment-section">
                                      <div class="row refund-payment-row row-cols-lg-7 g-0 g-lg-2">
                                        <div class="col-sm-2">
                                          <div class="form-group">
                                            <label class="refund-payment-label" id="refund_payment_label_{{ $key }}">Refund Payment #{{ $count }}</label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                              </div>
                                              <input type="number" value="{{ \Helper::number_format($payment->refund_amount) }}" name="quote[{{ $key }}][refund][{{$rpkey}}][refund_amount]" id="quote_{{$key}}_refund_{{$rpkey}}_refund_amount" data-name="refund_amount"  class="form-control refund_amount amount remove-zero-values hide-arrows" step="any">
                                              <span class="text-danger" role="alert"></span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-sm-2">
                                          <div class="form-group">
                                            <label>Refund Date <span style="color:red">*</span></label>
                                            <input type="date" value="{{ $payment->refund_date }}" name="quote[{{ $key }}][refund][{{$rpkey}}][refund_date]" id="quote_{{$key}}_refund_{{$rpkey}}_refund_date" data-name="refund_date"  class="form-control">
                                            <span class="text-danger" role="alert"></span>
                                          </div>
                                        </div>
                                        <div class="col-sm-2">
                                          <div class="form-group">
                                            <label>Bank <span style="color:red">*</span></label>
                                            <select  name="quote[{{ $key }}][refund][{{$rpkey}}][bank]" id="quote_{{$key}}_refund_{{$rpkey}}_bank" data-name="bank"  class="form-control bank select2single">
                                              <option value="">Select Bank</option>
                                              @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}" {{ ($bank->id == $payment->bank_id) ? 'selected' : '' }}> {{ $bank->name }} </option>
                                              @endforeach
                                            </select>
                                            <span class="text-danger" role="alert"></span>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Refund Confirmed By <span style="color:red">*</span></label>
                                            <select  name="quote[{{ $key }}][refund][{{$rpkey}}][refund_confirmed_by]" id="quote_{{$key}}_refund_{{$rpkey}}_refund_confirmed_by"  data-name="refund_confirmed_by"  class="form-control refund_confirmed_by select2single">
                                              <option value="">Select User</option>
                                              @foreach ($sale_persons as $person)
                                                <option  value="{{ $person->id }}" {{ ($person->id == $payment->refund_confirmed_by) ? 'selected' : '' }}>{{ $person->name }}</option>
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
                                                  <input type="hidden" name="quote[{{ $key }}][refund][{{ $rpkey }}][refund_recieved]" value="{{ $payment->refund_recieved }}"><input data-name="refund_recieved" id="quote_{{$key}}_refund_{{$rpkey}}_refund_recieved" class="checkbox" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"  {{ ($payment->refund_recieved == 1)? 'checked': NULL }}> 
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
                                @else
                                <div class="refund-payment-section" hidden>
                                  <h3 class="mt-2 mb-1-half">Refund - By Bank</h3>
                                  <div class="row refund-payment-row row-cols-lg-7 g-0 g-lg-2" >
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label class="refund-payment-label" id="refund_payment_label_{{ $key }}">Refund Payment #1</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                          </div>
                                          <input type="number" value=""  name="quote[{{ $key }}][refund][0][refund_amount]" data-name="refund_amount" id="quote_{{$key}}_refund_0_refund_amount" class="form-control refund_amount amount remove-zero-values hide-arrows" step="any" >
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label>Refund Date <span style="color:red">*</span></label>
                                        <input type="date" value="{{ date('Y-m-d') }}" name="quote[{{ $key }}][refund][0][refund_date]" data-name="refund_date"  class="form-control">
                                      </div>
                                    </div>
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label>Bank <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][refund][0][bank]" data-name="bank" id="quote_{{$key}}_refund_0_bank" class="form-control bank select2single" >
                                          <option value="">Select Bank</option>
                                          @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}"> {{ $bank->name }} </option>
                                          @endforeach
                                        </select>
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Refund Confirmed By <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][refund][0][refund_confirmed_by]" data-name="refund_confirmed_by" id="quote_{{$key}}_refund_0_refund_confirmed_by" class="form-control refund_confirmed_by select2single" >
                                          <option value="">Select User</option>
                                          @foreach ($sale_persons as $person)
                                            <option  value="{{ $person->id }}">{{ $person->name }}</option>
                                          @endforeach
                                        </select>
                                        <span class="text-danger" role="alert"></span>
                                      </div>
                                    </div>
                                    <div class="col-sm-1 d-flex justify-content-end">
                                      <div class="form-group">
                                        <button type="button" class="refund-payment-hidden-btn btn btn-outline-dark btn-sm">X</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                @endif
                              </section>

                              @php $credit_note_amount = 0; @endphp
                              <section class="refund-by-credit-note-section" >
                                @if($booking_detail->getBookingCreditNote && count($booking_detail->getBookingCreditNote) > 0)
                                <h3 class="mt-2 mb-1-half">Refund - By Credit Notes</h3>
                                  @foreach ($booking_detail->getBookingCreditNote as $cnkey => $payment)
  
                                  @php
                                    $count = $cnkey + 1;
                                    $total_credit_note_amount = $credit_note_amount + $payment->credit_note_amount;
                                  @endphp
  
                                    <div class="credit-note-section">
                                      <div class="row credit-note-row else-here row-cols-lg-7 g-0 g-lg-2">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label class="credit_note_label" id="credit_note_label_{{ $cnkey }}">Credit Note Amount Payment #{{$count}} <span style="color:red">*</span></label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                              </div>
                                              <input type="number" value="{{ \Helper::number_format($payment->credit_note_amount) }}" name="quote[{{ $key }}][credit_note][{{$cnkey}}][credit_note_amount]" id="quote_{{ $key }}_credit_note_{{$cnkey}}_credit_note_amount" data-name="credit_note_amount" class="form-control credit-note-amount amount hide-arrows" step="any">
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
                                            <input type="date" value="{{ $payment->credit_note_recieved_date }}" name="quote[{{ $key }}][credit_note][{{$cnkey}}][credit_note_recieved_date]" id="quote_{{ $key }}_credit_note_{{$cnkey}}_credit_note_recieved_date" data-name="credit_note_recieved_date" class="form-control" >
                                            <span class="text-danger" role="alert"></span>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
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
  
                                        <div class="col-sm-1 d-flex justify-content-end">
                                          <div class="form-group">
                                            <button type="button" class="credit-note-hidden-btn btn btn-outline-dark btn-sm d-none">X</button>
                                          </div>
                                        </div>
  
                                      </div>
                                    </div>
                                  
                                  @endforeach
                                  @else
                                  <div class="credit-note-section" hidden>
                                    <h3 class="mt-2 mb-1-half">Refund - By Credit Notes</h3>
                                    <div class="row credit-note-row else-here row-cols-lg-7 g-0 g-lg-2" >
                                      <div class="col-sm-3">
                                        <div class="form-group">
                                          <label class="credit_note_label" id="credit_note_label_{{ $key }}">Credit Note Amount Payment #1 <span style="color:red">*</span></label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                            </div>
                                            <input type="number" value="" name="quote[{{ $key }}][credit_note][0][credit_note_amount]" data-name="credit_note_amount" id="quote_{{ $key }}_credit_note_0_credit_note_amount" class="form-control credit-note-amount amount remove-zero-values hide-arrows" step="any" >
                                          </div>
                                        </div>
                                      </div>
                                      {{-- <div class="col-sm-2" >
                                        <div class="form-group">
                                          <label>Credit Note Supplier ID.</label>
                                          <input type="text" value="{{ $booking_detail->supplier_id  }}" name="quote[{{ $key }}][credit_note][0][credit_note_supplier_id]" data-name="credit_note_supplier_id" class="form-control">
                                        </div>
                                      </div> --}}
                                      <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Credit Note Date <span style="color:red">*</span></label>
                                          <input type="date" value="{{ date('Y-m-d') }}" name="quote[{{ $key }}][credit_note][0][credit_note_recieved_date]" data-name="credit_note_recieved_date" id="quote_{{ $key }}_credit_note_0_credit_note_recieved_date" class="form-control" >
                                        </div>
                                      </div>
                                      <div class="col-sm-3">
                                        <div class="form-group">
                                          <label>Credit Note Recieved By <span style="color:red">*</span></label>
                                          <select  name="quote[{{ $key }}][credit_note][0][credit_note_recieved_by]" data-name="credit_note_recieved_by" id="quote_{{ $key }}_credit_note_0_credit_note_recieved_by" class="form-control credit_note_recieved_by select2single" >
                                            <option value="">Select User</option>
                                            @foreach ($sale_persons as $person)
                                              <option  value="{{ $person->id }}">{{ $person->name }}</option>
                                            @endforeach
                                          </select>
                                          <span class="text-danger" role="alert"></span>
                                        </div>
                                      </div>
                                      <div class="col-sm-1 d-flex justify-content-end">
                                        <div class="form-group">
                                          <button type="button" class="credit-note-hidden-btn btn btn-outline-dark btn-sm">X</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endif
                              </section>

                              <section class="mt-1">
                                <div class="row">
                                  <div class="col-12 text-right">
                                    {{-- {{ ( ($booking_detail->getBookingRefundPayment) && (count($booking_detail->getBookingRefundPayment) > 0) || ($booking_detail->getBookingCreditNote) && (count($booking_detail->getBookingCreditNote) > 0) ) ? 'd-none' : '' }} --}}
                                    <div class="btn-group mr-1 cancel-payemnt-btn ">
                                      @if(isset($total_deposit) && ($total_deposit > 0))
                                        <div class="btn-group  
                                        @if(isset($total_refund_amount) && isset($total_credit_note_amount))
                                          @if($total_refund_amount == $total_deposit || $total_credit_note_amount == $total_deposit || ($total_credit_note_amount + $total_refund_amount) == $total_deposit)
                                          d-none
                                          @endif
                                        @endif
                                        ">
                                          <div class="btn-group dropdown" role="group">
                                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
  
                                              <a class="btn dropdown-item refund-to-bank" data-booking_detail_id="{{$booking_detail->id}}" >Refund to Bank</a>
                                              <a class="btn dropdown-item credit-note" data-booking_detail_id="{{$booking_detail->id}}">Credit Note</a>
                                            </div>
                                          </div>
                                          <button type="button" class="btn btn-danger ">
                                            Cancel Payment
                                          </button>
                                        </div>
                                      @endif
                                    </div>
                                    {{-- {{ isset($total_deposit) && isset($booking_detail->estimated_cost) && ($total_deposit >= $booking_detail->estimated_cost) || ($booking_detail->getBookingRefundPayment) && (count($booking_detail->getBookingRefundPayment) > 0) || ($booking_detail->getBookingCreditNote) && (count($booking_detail->getBookingCreditNote) > 0) ? 'd-none' : ''}} --}}
                                    <button type="button" data-key="0" class="clone_booking_finance float-right btn btn-dark btn-md 
                                    
                                    @if(isset($total_deposit) && isset($booking_detail->actual_cost) && ($total_deposit == $booking_detail->actual_cost) || isset($booking_detail->getBookingRefundPayment) && (count($booking_detail->getBookingRefundPayment) > 0)             )
                                    d-none
                                    @endif()
                                    
                                    ">Add More Payments </button>
                                  </div>
                                </div>
                              </section>
                            </div>  

                          </div>
                        @endforeach
                      </div>
                      @endif

                      <div class="col-sm-6 agencyField {{ ($booking->agency == 0) ? 'd-none': '' }}">
                        <div class="form-group">
                          <label>Agency Commission Type <span style="color:red">*</span></label>
                          <div>
                            <label class="radio-inline">
                              <input type="radio" name="agency_commission_type" class="agency-commission-type" value="net-price" {{ $booking->agency == 1 && $booking->agency_commission_type == 'net-price' ? 'checked' : '' }}>&nbsp; Net Price &nbsp;&nbsp;
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="agency_commission_type" class="agency-commission-type" value="paid-net-of-commission" {{ $booking->agency == 1 && $booking->agency_commission_type == 'paid-net-of-commission' ? 'checked' : '' }}>&nbsp; Paid Net of Commission &nbsp;&nbsp;
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="agency_commission_type" class="agency-commission-type" value="we-pay-commission-on-departure" {{ $booking->agency == 1 && $booking->agency_commission_type == 'we-pay-commission-on-departure' ? 'checked' : '' }}>&nbsp; We pay Commission on Departure
                            </label>
                          </div>
                        </div>
                      </div>
                    
                      <div class="form-group row mt-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Total Net Price</label>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                              </div>
                              <input type="number" name="total_net_price" step="any" class="form-control total-net-price hide-arrows" step="any" min="0"  value="{{ \Helper::number_format($booking->net_price) }}" readonly>
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
                                <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                              </div>
                              <input type="number" value="{{ \Helper::number_format($booking->markup_amount) }}"  step="any" class="form-control total-markup-amount booking-total-markup-change hide-arrows" step="any" min="0" name="total_markup_amount" value="0.00" readonly>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <div class="input-group">
                              <input type="number" value="{{ \Helper::number_format($booking->markup_percentage) }}"  step="any" class="form-control total-markup-percent booking-total-markup-change hide-arrows" min="0" name="total_markup_percent" value="0.00" readonly>
                              <div class="input-group-append"><div class="input-group-text">%</div></div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="paid-net-commission-on-departure {{ $booking->agency == 1 && $booking->agency_commission_type == 'paid-net-of-commission' || $booking->agency == 1 && $booking->agency_commission_type == 'we-pay-commission-on-departure' ? '' : 'd-none' }} ">
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-3 col-form-label">Agency Commission</label>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                                </div>
                                <input type="number" step="any" class="form-control agency-commission remove-zero-values" step="any" min="0" name="agency_commission" value="{{ \Helper::number_format($booking->agency_commission) }}" >
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
                                  <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                                </div>
                                <input type="number" step="any" class="form-control total-net-margin remove-zero-values" step="any" min="0" name="total_net_margin" value="{{ \Helper::number_format($booking->total_net_margin) }}" readonly>
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
                                <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                              </div>
                              <input type="number" value="{{ \Helper::number_format($booking->selling_price) }}" step="any" name="total_selling_price" class="form-control total-selling-price hide-arrows" min="0.00" step="any"  value="0.00" readonly>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Total Profit Percentage</label>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <div class="input-group">
                              <input type="number" value="{{ \Helper::number_format($booking->profit_percentage) }}" step="any" name="total_profit_percentage" class="form-control total-profit-percentage hide-arrows" min="0" step="any" value="0.00" readonly>
                              <div class="input-group-append"><div class="input-group-text">%</div></div>
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
                                <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                              </div>
                              <input type="number" value="{{ \Helper::number_format($booking->amount_per_person) }}" step="any" class="form-control booking-amount-per-person hide-arrows" step="any" min="0" name="booking_amount_per_person" value="0.00" readonly>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">
                          Staff Commission
                          <h5>
                            <span class="badge badge-secondary badge-commission-name" title="Commission Name">{{ isset($booking->getCommission->name) && !empty($booking->getCommission->name) ? $booking->getCommission->name : ''}}</span>
                            <span class="badge badge-secondary badge-commission-group-name" title="Commission Group">{{ isset($booking->getCommissionGroup->name) && !empty($booking->getCommissionGroup->name) ? $booking->getCommissionGroup->name : ''}}</span>
                            <span class="badge badge-secondary badge-commission-percentage" title="Commission Percentage">{{ isset($booking->commission_percentage) && !empty($booking->commission_percentage) ? $booking->commission_percentage.' %' : ''}}</span>
                          </h5>
                        </label>
                        
                        <div class="col-sm-2">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                              </div>
                              <input type="number" step="any" name="commission_amount" class="form-control commission-amount hide-arrows" min="0" step="any" value="{{ \Helper::number_format($booking->commission_amount) }}" readonly>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2 d-none">
                          <div class="form-group">
                            <div class="input-group">
                              <input type="number" step="any" name="commission_percentage" value="{{ \Helper::number_format($booking->commission_percentage) }}" class="form-control commission-percentage hide-arrows" min="0" step="any" readonly>
                              <div class="input-group-append">
                                <div class="input-group-text">%</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
   

                      <div class="form-group row">
                        <div class="col-sm-3">
                            <div class="form-group">
                            <label>Selling Price in Other Currency</label>
                            <select  name="selling_price_other_currency" class="form-control  selling-price-other-currency @error('selling_price_other_currency') is-invalid @enderror">
                                <option value="">Select Currency</option>
                                @foreach ($currencies as $currency)
                                <option value="{{ $currency->code }}" {{ ($booking->selling_currency_oc == $currency->code) ? 'selected':NULL }} data-image="data:image/png;base64, {{$currency->flag}}" > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                                <span class="input-group-text selling-price-other-currency-code">{{ isset($booking->selling_currency_oc) && !empty($booking->selling_currency_oc) ? $booking->selling_currency_oc : '' }}</span>
                              </div>
                              <input type="number" value="{{ \Helper::number_format($booking->selling_price_ocr) }}" step="any" name="selling_price_other_currency_rate" min="0" step="any" class="form-control selling-price-other-currency-rate hide-arrows" value="0.00" readonly>
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

                    </div>

                    @if(isset($ufg_payment_records) && !empty($ufg_payment_records))
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title font-weight-bold">UFG Payment System</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                          <table class="table table-hover text-nowrap">
                            <thead>
                              <tr>
                                <th class="text-center">Ref #</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Payment For</th>
                                <th class="text-center">Payment Method</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Card Holder Name</th>
                                <th class="text-center">Sort Code</th>
                                <th class="text-center">Amount Payable</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody id="ufg_payment_records">
                              @foreach ($ufg_payment_records as $key => $ufg_payment_record)

                                @if(is_array($ufg_payment_records[$key]))
                                  @if(!empty($key))
                                    <tr><td colspan="11" class="text-center font-weight-bold tbody-highlight text-uppercase">{{ $key }}</td></tr>
                                  @endif
                                  @foreach ($ufg_payment_records[$key] as $key => $payment_record)

                                    <tr class="{{ $payment_record['status'] == 'Pending' || $payment_record['status'] == 'pending' ? 'tr-bg-color' : '' }}">
                                      <td class="text-center">{{ ucfirst($payment_record['zoho_booking_reference']) }}</td>
                                      <td class="text-center text-uppercase">{{ ucfirst($payment_record['status']) }}</td>
                                      <td class="text-center">{{ $payment_record['payment_for'] }}</td>
                                      <td class="text-center">
                                        @if($payment_record['payment_type_id'] == 1)
                                          Bank
                                        @endif
                                        @if($payment_record['payment_type_id'] == 2)
                                          Paysafe
                                        @endif
                                      </td>
                                      <td class="text-center">{{ \Carbon\Carbon::parse($payment_record['date'])->format('d/m/Y') }} </td>
                                      <td class="text-center">{{ $payment_record['amount'] }}</td>
                                      <td class="text-center">{{ $payment_record['client_type'] == 1 ? 'Client' : 'Agency' }}</td>
                                      <td class="text-center">{{ $payment_record['card_holder_name'] }}</td>
                                      <td class="text-center">{{ $payment_record['sort_code'] }}</td>
                                      <td class="text-center">{{ $payment_record['amount_payable'] }}</td>
                                      <td class="text-center">
                                        <a href="javascript:void(0)" data-details="{{json_encode($payment_record)}}" class="mr-2 btn btn-outline-info btn-xs view-payment_detail" data-title="View Booking" title="View Details">
                                          <span class="fa fa-eye"></span>
                                        </a>
                                      </td>

                                    </tr>
                                  @endforeach
                                @endif
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    @endif

                    @if(isset($old_ufg_payment_records) && !empty($old_ufg_payment_records))
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title font-weight-bold">Old UFG Payment System</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                          <table class="table table-hover text-nowrap">
                            <thead>
                              <tr>
                                <th class="text-center">Ref #</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Payment For</th>
                                <th class="text-center">Payment Method</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Card Holder Name</th>
                                <th class="text-center">Sort Code</th>
                                <th class="text-center">Amount Payable</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody id="old_ufg_payment_records">
                              @foreach ($old_ufg_payment_records as $key => $old_ufg_payment_record)

                                @if(is_array($old_ufg_payment_records[$key]))
                                  @if(!empty($key))
                                    <tr><td colspan="11" class="text-center font-weight-bold tbody-highlight text-uppercase">{{ $key }}</td></tr>
                                  @endif
                                  @foreach ($old_ufg_payment_records[$key] as $key => $payment_record)

                                    <tr class="{{ $payment_record['status'] == 'Pending' || $payment_record['status'] == 'pending' ? 'tr-bg-color' : '' }}">
                                      <td class="text-center">{{ ucfirst($payment_record['zoho_booking_reference']) }}</td>
                                      <td class="text-center text-uppercase">{{ $payment_record['status'] }}</td>
                                      <td class="text-center">{{ $payment_record['payment_for'] }}</td>
                                      <td class="text-center">
                                        @if($payment_record['payment_type_id'] == 1)
                                          Bank
                                        @endif
                                        @if($payment_record['payment_type_id'] == 2)
                                          Paysafe
                                        @endif
                                      </td>
                                      <td class="text-center">{{ \Carbon\Carbon::parse($payment_record['date'])->format('d/m/Y') }} </td>
                                      <td class="text-center">{{ $payment_record['amount'] }}</td>
                                      <td class="text-center">{{ $payment_record['client_type'] == 1 ? 'Client' : 'Agency' }}</td>
                                      <td class="text-center">{{ $payment_record['card_holder_name'] }}</td>
                                      <td class="text-center">{{ $payment_record['sort_code'] }}</td>
                                      <td class="text-center">{{ $payment_record['amount_payable'] }}</td>
                                      <td class="text-center">
                                        <a href="javascript:void(0)" data-details="{{json_encode($payment_record)}}" class="mr-2 btn btn-outline-info btn-xs view-payment_detail" data-title="View Booking" title="View Details">
                                          <span class="fa fa-eye"></span>
                                        </a>
                                      </td>

                                    </tr>
                                  @endforeach
                                @endif
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    @endif

                  </div>

                  @if($status && !empty($status))
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right submit">Submit</button>
                    <a href="{{ route('bookings.index') }}" class="btn btn-outline-danger buttonSumbit float-right mr-3">Cancel</a>
                  </div>
                @endif
              </form>
              <div id="overlay" class=""></div>
            </div>
          </div>

        </div>
        </div>
      </div>
    </section>
    {{-- @if(isset($exist) && isset($user_id))
      @if($exist == 1 && $user_id != Auth::id())
        @include('partials.override_modal',[ 'status' => 'bookings' , 'id' => $booking->id ])
      @endif
    @endif --}}
  </div>

  @include('partials.payment_details_modal')
  @include('partials.view_rates_modal')
@endsection

@push('js')
<script>
  @if($status && !empty($status))
    $('#update-payment :input').attr('disabled', 'disabled');

    $('.finance :input').removeAttr('disabled');
    $('.refund-payment-section :input').removeAttr('disabled');
    $('.credit-note-section :input').removeAttr('disabled');
    $('button[type="submit"]').removeAttr('disabled');
    $('.cancel-payemnt-btn .btn').removeAttr('disabled');
    $('.clone_booking_finance').removeAttr('disabled');

    // $('.finance :input, .refund-payment-section :input, .credit-note-section  :input, .submit, .cancel-payemnt-btn .btn, .clone_booking_finance').prop('disabled', false);
  @else
    $('#update-payment :input').attr('disabled', 'disabled');
  @endif

  $(window).on('beforeunload', function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var id = "{{encrypt($booking->id)}}";
    var url = "{{ route('has-user-edit', ":id") }}";
    url = url.replace(':id', id);

    $.ajax({
      url: url,
      type: 'delete',  
      dataType: "JSON",
      data: { "id": id, "status": 'bookings' },
      success: function (response)
      {
        console.log(response); 
      },
      error: function(xhr) {
        console.log(xhr.responseText);  
      }
    });
  });
</script>
@endpush