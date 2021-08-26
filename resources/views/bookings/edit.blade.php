@extends('layouts.app')
@section('title', 'Edit Booking')
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
              <h4>Edit Booking</h4>
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
    <section class="content" id="content" data-countries="{{ $countries }}">
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
          <div class="col-md-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h1 class="card-title text-center card-title-style">Edit Booking</h1>
                <a href="{{ route('quotes.final', encrypt($booking->quote_id)) }}" target="_blank" class="float-right btn btn-primary btn-md" data-title="Final Quotation" data-target="#Final_Quotation">
                  View Final Quote
                </a>
              </div>
            <form method="POST" action="{{ route('bookings.update', encrypt($booking->id)) }}" id="update-booking" enctype="multipart/form-data"> 
              @csrf @method('put')
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <label>Zoho Reference <span style="color:red">*</span></label>
                      <div class="form-group">
                        <div class="input-group ">
                          <input type="text" name="ref_no" id="ref_no" value="{{ old('ref_no')??$booking->ref_no }}" class="form-control reference-name" placeholder="Enter Reference Number">
                           <div class="input-group-append">
                            <button id="search-reference-btn" class="btn search-reference-btn search-reference" type="button"><span class="mr-2 " role="status" aria-hidden="true"></span>Search</button>
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
                        <input type="text" name="tas_ref" class="form-control" value="{{ $booking->tas_ref }}"  placeholder="TAS Reference Number" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Currency Rate Type <span style="color:red">*</span></label>
                        <div>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="rate_type" class="rate-type" value="live"  {{ ($booking->rate_type == 'live')? 'checked': NULL }} >
                            <span>&nbsp;Live Rate</span>
                          </label>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="rate_type" class="rate-type" value="manual" {{ ($booking->rate_type == 'manual')? 'checked': NULL }}>
                            <span>&nbsp;Manual Rate</span>
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
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Commission Type <span style="color:red">*</span></label>
                        <select name="commission_id" id="commission_id" class="form-control select2single commission-id">
                          <option selected value="" >Select Commission Type </option>
                          @foreach ($commission_types as $commission_type)
                            <option value="{{ $commission_type->id }}" {{  $commission_type->id == $booking->commission_id ? 'selected' : '' }}>{{ $commission_type->name }}</option>
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
                        <select name="season_id" id="season_id" class="form-control  select2single ">
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
                        <select name="currency_id" id="currency_id" class="form-control select2single booking-currency-id @error('currency_id') is-invalid @enderror">
                          <option value="">Select Booking Currency </option>
                          @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" data-code="{{ $currency->code }}" data-image="data:image/png;base64, {{$currency->flag}}" 
                              {{ $currency->id == $booking->currency_id ? 'selected' : ''  }}
                            > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                    <div class="col-md-12 agency-columns" >
                        <div class="row agencyField {{ ($booking->agency == 0) ? 'd-none': '' }}" >
                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Name</label> <span style="color:red"> *</span>
                            <input type="text" value="{{ $booking->agency_name }}" name="agency_name" id="agency_name" class="form-control" placeholder="Agency Name">
                            <span class="text-danger" role="alert" > </span>
                          </div>
                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Contact Name </label> <span style="color:red"> *</span>
                            <input type="text" value="{{ $booking->agency_contact_name }}" name="agency_contact_name" id="agency_contact_name" class="form-control" placeholder="Agency Contact Name">
                            <span class="text-danger" role="alert" > </span>
                          </div>
                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Contact No.</label> <span style="color:red"> *</span>
                            <input type="tel" value="{{ $booking->agency_contact }}" name="agency_contact" id="agency_contact" class="form-control phone phonegc">
                            <span class="text-danger error_msggc hide" role="alert"></span>
                            <span class="text-success valid_msggc" role="alert"></span>
                          </div>
                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Email </label> <span style="color:red"> *</span>
                            <input type="email" value="{{ $booking->agency_email }}" name="agency_email" id="agency_email" class="form-control" placeholder="Agency Email Address">
                            <span class="text-danger" role="alert" > </span>
                          </div>
                        </div>
                        <div class="row mt-1  PassengerField {{ ($booking->agency == 1)? 'd-none': '' }}" >
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
                              <input type="email" value="{{ $booking->lead_passenger_email }}" name="lead_passenger_email" id="lead_passenger_email" class="form-control" placeholder="Email Address" >
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Contact Number <span style="color:red">*</span></label> 
                              <input type="tel" value="{{ $booking->lead_passenger_contact }}" name="lead_passenger_contact" id="lead_passenger_contact"  class="form-control phone phone0" >
                              <span class="text-danger error_msg0" role="alert"></span>
                              <span class="text-success valid_msg0" role="alert"></span>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Date Of Birth <span style="color:red">*</span></label> 
                              <input type="date" value="{{ $booking->lead_passenger_dbo }}" max="{{ date('Y-m-d') }}" id="lead_passenger_dbo" name="lead_passenger_dbo" class="form-control" placeholder="Date Of Birth" >
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row  PassengerField {{ ($booking->agency == 1)? 'd-none': '' }}">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Nationality <span style="color:red">*</span></label>
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
                              <label>Bedding Preferences <span style="color:red">*</span></label>
                              <input type="text" value="{{ $booking->lead_passenger_bedding_preference }}" name="lead_passenger_bedding_preference" id="lead_passenger_bedding_preference" class="form-control " placeholder="Bedding Preferences" id="bedding_preference" >
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>  
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Dinning Preferences <span style="color:red">*</span></label>
                              <input type="text" value="{{ $booking->lead_passenger_dinning_preference }}" name="lead_passenger_dinning_preference" id="lead_passenger_dinning_preference" class="form-control" placeholder="Dinning Preferences" >
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Covid Vaccinated <span style="color:red">*</span></label>
                              <div>
                                <label class="radio-inline">
                                  <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="1" {{ ($booking->lead_passenger_covid_vaccinated ==  1) ? 'checked' : '' }}> Yes
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="0" {{ ($booking->lead_passenger_covid_vaccinated ==  0 || $booking->lead_passenger_covid_vaccinated == null) ? 'checked' : '' }} > No
                                </label>
                              </div>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>
                        </div>
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
                                <div class="mt-1 appendCount" id="appendCount{{ $count }}">
                                    <div class="row" >
                                        <div class="col-md-3 mb-2">
                                            <label class="mainLabel" >Passenger #{{ ($booking->agency == 1)? $count : $count +1  }} Full Name</label> 
                                            <input type="text" name="pax[{{$count}}][full_name]" value="{{ $pax->full_name }}" class="form-control" placeholder="Passsenger Name" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label >Email Address</label> 
                                            <input type="email" name="pax[{{$count}}][email_address]" value="{{ $pax->email }}" class="form-control" placeholder="Email Address" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-sm-3">
                                          <label>Nationality</label>
                                          <select name="pax[{{ $count }}][nationality_id]" class="form-control select2single nationality-id">
                                                  <option selected value="" >Select Nationality</option>
                                              @foreach ($countries as $country)
                                                  <option value="{{ $country->id }}" {{ (old('nationality_id') == $country->id)? 'selected':( ($pax->nationality_id == $country->id)? 'selected':null) }}> {{ $country->name }} </option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label >Contact Number</label> 
                                            <input type="tel" name="pax[{{$count}}][contact_number]" value="{{ $pax->contact }}" class="form-control phone phone{{ $count }}"  >
                                            <span class="text-danger error_msg{{ $count }}" role="alert" > </span>
                                            <span class="text-success valid_msg{{ $count }}" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <label>Date Of Birth</label> 
                                            <input type="date" max="{{  date("Y-m-d") }}" name="pax[{{$count}}][date_of_birth]" value="{{ $pax->date_of_birth }}" class="form-control" placeholder="Date Of Birth" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Bedding Preference</label> 
                                            <input type="text" name="pax[{{$count}}][bedding_preference]" value="{{ $pax->bedding_preference }}" class="form-control" placeholder="Bedding Preferences" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Dinning Preference</label> 
                                            <input type="text" name="pax[{{$count}}][dinning_preference]" value="{{ $pax->dinning_preference }}" class="form-control" placeholder="Dinning Preferences" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>

                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <label>Covid Vaccinated</label>
                                            <div>
                                              <label class="radio-inline">
                                                <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="1" 
                                                @if($pax->covid_vaccinated == 1)
                                                checked
                                                @endif> Yes
                                              </label>
                                              <label class="radio-inline">
                                                <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="0"
                                                @if($pax->covid_vaccinated == 0)
                                                checked
                                                @endif > No
                                              </label>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="col-md-1 mb-2">
                                          <button type="button" class=" remove-pax-column mt-2 btn btn-dark float-right"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                              </div>
                              <div class="col-md-12 col-offset-md-4">
                                <button type="button" class="add-pax-column btn btn-dark float-right"><i class="fa fa-plus" aria-hidden="true"></i></button>
                              </div>
                  </div>
                  <div class="parent" id="parent">
                    @if($booking->getBookingDetail && $booking->getBookingDetail->count())
                      @foreach ($booking->getBookingDetail as $key  => $booking_detail )
                        <div class="quote" data-key="{{$key}}">
                          @if($loop->iteration > 1)
                            <div class="row">
                              <div class="col-sm-12"><button type="button" class="btn pull-right close"> x </button></div>
                            </div>
                          @endif
                          <div class="row"> {{-- ?>>>rowStart --}}
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Date of Service <span style="color:red">*</span></label>
                                <input type="text" value="{{ $booking_detail->date_of_service }}" name="quote[{{ $key }}][date_of_service]" data-name="date_of_service" id="quote_{{ $key }}_date_of_service" class="form-control date-of-service datepicker checkDates bookingDateOfService"  placeholder="Date of Service" autocomplete="off">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Time of Service</label>
                                <input type="time" value="{{ $booking_detail->time_of_service }}" name="quote[{{ $key }}][time_of_service]" data-name="time_of_service" id="quote_{{ $key }}_time_of_service" class="form-control" placeholder="Time of Service" autocomplete="off">
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Category <span style="color:red">*</span></label>
                                <select name="quote[{{ $key }}][category_id]" data-name="category_id" id="quote_{{ $key }}_category_id" class="form-control  select2single  category- select2single  category-id @error('category_id') is-invalid @enderror">
                                  <option value="">Select Category</option>
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" data-slug="{{$category->slug}}" {{ ($booking_detail->category_id == $category->id)? 'selected' : NULL}} > {{ $category->name }} </option>
                                  @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Supplier <span style="color:red">*</span></label>
                                  <select name="quote[{{ $key }}][supplier_id]" data-name="supplier_id" id="quote_{{ $key }}_supplier_id" class="form-control  select2single  supplier-id @error('supplier_id') is-invalid @enderror">
                                    <option value="">Select Supplier</option>
                                    @if(isset($booking_detail->getCategory) && $booking_detail->getCategory->getSupplier)
                                      @foreach ($booking_detail->getCategory->getSupplier as $supplier )
                                        <option value="{{ $supplier->id }}" {{ ($booking_detail->supplier_id == $supplier->id)? 'selected' : NULL}}  >{{ $supplier->name }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                  <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Product</label>
                                <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control  select2single   product-id @error('product_id') is-invalid @enderror">
                                  <option value="">Select Product</option>
                                  @if(isset($booking_detail->getSupplier) && $booking_detail->getSupplier->getProducts)
                                    @foreach ($booking_detail->getSupplier->getProducts as  $product)
                                      <option value="{{ $product->id }}" {{ ($booking_detail->product_id == $product->id)? 'selected' : NULL}}>{{ $product->name }}</option>
                                    @endforeach
                                  @endif
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div> --}}

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Product</label>
                                <input type="text" name="quote[{{ $key }}][product_id]"  data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control product-id" value="{{ $booking_detail->product_id }}" placeholder="Enter Product">
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
                                <label>Booking Date</label>
                                <input type="text" value="{{ $booking_detail->booking_date}}" name="quote[{{ $key }}][booking_date]" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" placeholder="Booking Date">
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Due Date <span style="color:red">*</span></label>
                                <input type="text" value="{{ $booking_detail->booking_due_date }}" name="quote[{{ $key }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Reference</label>
                                <input type="text" value="{{ $booking_detail->booking_reference }}" name="quote[{{ $key }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $key }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
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
                                  <option value="">Select Booked By {{  $booking_detail->booked_by_id }}</option>
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
                                  <label>Booking Types</label>
                                  <select name="quote[{{ $key }}][booking_type]" data-name="booking_type" id="quote_{{ $key }}_booking_type" class="form-control  select2single    booking-type-id @error('booking_type_id') is-invalid @enderror">
                                    <option value="">Select Booking Type</option>
                                    @foreach ($booking_types as $booking_type)
                                      <option value="{{ $booking_type->id }}" {{ $booking_detail->booking_type_id == $booking_type->id  ? "selected" : "" }}> {{ $booking_type->name }} </option>
                                    @endforeach
                                  </select>
                                  @error('booking_type_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                  @enderror
                                </div>
                              </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Supplier Currency <span style="color:red">*</span></label>
                                  <select name="quote[{{ $key }}][supplier_currency_id]" data-name="supplier_currency_id" id="quote_{{ $key }}_supplier_currency_id" class="form-control  select2single  supplier-currency-id @error('currency_id') is-invalid @enderror">
                                    <option value="">Select Supplier Currency</option>
                                    @foreach ($currencies as $currency)
                                      <option value="{{ $currency->id }}" data-code="{{ $currency->code }}" {{ $booking_detail->supplier_currency_id == $currency->id  ? "selected" : "" }}  data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                                    @endforeach
                                  </select>
                                  <span class="text-danger" role="alert"></span>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Actual Cost <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->estimated_cost) }}" name="quote[{{ $key }}][estimated_cost]" data-name="estimated_cost" data-status="booking" id="quote_{{ $key }}_estimated_cost" class="form-control estimated-cost change" value="0.00">
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Markup Amount <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_amount) }}" name="quote[{{ $key }}][markup_amount]" data-name="markup_amount" id="quote_{{ $key }}_markup_amount" class="form-control markup-amount change" value="0.00" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Markup % <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_percentage) }}" name="quote[{{ $key }}][markup_percentage]" data-name="markup_percentage" id="quote_{{ $key }}_markup_percentage" class="form-control markup-percentage change" value="0.00" readonly>
                                  <div class="input-group-append">
                                    <div class="input-group-text">%</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <div class="d-flex">
                                  <label>Selling Price <span style="color:red">*</span></label>
                                  <input type="checkbox" name="cal_selling_price" class="ml-auto mr-2 cal_selling_price" value="Bike" class="ml-6">
                                </div>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->selling_price) }}" name="quote[{{ $key }}][selling_price]" data-name="selling_price" id="quote_{{ $key }}_selling_price" class="form-control selling-price hide-arrows" value="0.00" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-2">
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
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->estimated_cost_bc) }}" name="quote[{{ $key }}][estimated_cost_in_booking_currency]" data-name="estimated_cost_in_booking_currency" id="quote_{{ $key }}_estimated_cost_in_booking_currency" class="form-control estimated-cost-in-booking-currency"  readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Selling Price in Booking Currency <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->selling_price_bc) }}" name="quote[{{ $key }}][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_{{ $key }}_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Markup Amount in Booking Currency <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_amount_bc) }}" name="quote[{{ $key }}][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_{{ $key }}_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly> 
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-2 d-flex justify-content-center">
                              @if(Auth::user()->getRole->slug == 'admin' || Auth::user()->getRole->slug == 'accountant')
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
                              @endif
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Service Details</label>
                                <textarea name="quote[{{ $key }}][service_details]" data-name="service_details" id="quote_{{ $key }}_service_details" class="form-control service-details" rows="2" placeholder="Enter Service Details">{{ $booking_detail->service_details }}</textarea>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Comments</label>
                                <textarea name="quote[{{ $key }}][comments]" data-name="comments" id="quote_{{ $key }}_comments" class="form-control comments" rows="2" placeholder="Enter Comments">{{ $booking_detail->comments }}</textarea>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Invoice Upload</label>
                                <input type="file" name="quote[{{ $key }}][invoice]" data-name="invoice" id="quote_{{ $key }}_inovice" class="form-control invoices hide-arrows" >
                              </div>
                            </div>
                          @if($booking_detail->invoice)
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Invoice Preview</label>
                                <a href="{{ $booking_detail->invoice_url }}" class="btn btn-outline-dark">Invoice</a>
                              </div>
                            </div>
                          @endif
                          
                            <div class="col-sm-2 d-none">
                              <div class="form-group">
                                <label>Outstanding Amount left </label>
                                <input type="number" value="{{ ($booking_detail->getBookingFinance && count($booking_detail->getBookingFinance) > 0) ? \Helper::number_format($booking_detail->outstanding_amount_left) : \Helper::number_format($booking_detail->estimated_cost)  }}" name="quote[{{ $key }}][outstanding_amount_left]" data-name="outstanding_amount_left" id="quote_{{ $key }}_outstanding_amount_left" class="form-control outstanding_amount_left hide-arrows" >
                              </div>
                            </div>
                          </div>{{-- ?>>>rown end --}}

                          <div class="row">
                            <div class="col-sm-12 justify-content-right mb-2">
                              <div class="form-group">

                                <div class="modal-parent">
                                  @include('partials.accomadation_modal')
                                  @include('partials.transfer_modal')
                                  @include('partials.service_excersion_modal')
                                </div>
                                <button type="button" class="add-category-detail btn btn-dark float-right">Add Category Details</button>
                              </div>
                            </div>
                          </div>

                          @php $total_deposit = 0; @endphp
                          <section class="finance">
                            @if($booking_detail->getBookingFinance && count($booking_detail->getBookingFinance) > 0)
                                <h3 class="mt-2 mb-1-half">Payments</h3>
                                @foreach ($booking_detail->getBookingFinance as $fkey => $finance)
                                  @php
                                    $count = $fkey + 1;
                                    $total_deposit = $total_deposit + $finance->deposit_amount;
                                  @endphp
                                  <div class="row finance-clonning row-cols-lg-7 g-0 g-lg-2 mt-2 {{ $finance->status == 'cancelled' ? 'cancelled-payment-styling' : '' }}" data-financekey="{{$fkey}}">
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label class="depositeLabel" id="deposite_heading{{ $fkey }}">Payment #{{ $count }}</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                          </div>
                                          <input type="number" value="{{ \Helper::number_format($finance->deposit_amount) }}" name="quote[{{ $key }}][finance][{{ $fkey }}][deposit_amount]" data-name="deposit_amount" id="quote_{{$key}}_finance_{{$fkey}}_deposit_amount" value="0.00" class="form-control deposit-amount hide-arrows" step="any" {{ $finance->status == 'cancelled' ? 'readonly' : '' }}>
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
                                      <div class="form-group {{ isset($finance->deposit_due_date) && !empty($finance->deposit_due_date) ? 'd-none' : '' }}">
                                        <label>Calender</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="icheck-primary">
                                              <input type="hidden" name="quote[{{ $key }}][finance][{{ $fkey }}][upload_to_calender]" value="{{ $finance->upload_to_calender }}"><input data-name="upload_to_calendar" id="quote_{{$key}}_finance_{{$fkey}}_upload_to_calendar" class="checkbox" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"  {{ ($finance->upload_to_calender == 1)? 'checked': NULL }}> 
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-1 d-flex justify-content-center">
                                      <div class="form-group">
                                        <button type="button" onclick="this.closest('.finance-clonning').remove()" class=" btn btn-outline-dark btn-sm {{ $finance->status == 'cancelled' ? 'd-none' : '' }}" >X</button>
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
                                            <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                          </div>
                                          <input type="number" value="{{ \Helper::number_format($finance->outstanding_amount) }}" name="quote[{{ $key }}][finance][{{$fkey}}][outstanding_amount]" data-name="outstanding_amount" id="quote_{{$key}}_finance_{{$fkey}}_outstanding_amount" value="0.00" class="form-control outstanding-amount hide-arrows" step="any" readonly>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                              @else
                                {{-- /////for single value/ --}}
                                <div class="row finance-clonning row-cols-lg-7 g-0 g-lg-2 mt-2" data-financekey="0">
                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label class="depositeLabel" id="deposite_heading{{ $key }}">Payment #1</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                        </div>
                                        <input type="number" name="quote[{{ $key }}][finance][0][deposit_amount]" data-name="deposit_amount" id="quote_{{$key}}_finance_0_deposit_amount" value="0.00" class="form-control deposit-amount hide-arrows" step="any">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label>Due Date</label>
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
                                      <label>Payment Method</label>
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
                                          <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                        </div>
                                        <input type="number" value="" name="quote[{{ $key }}][finance][0][outstanding_amount]" data-name="outstanding_amount" id="quote_{{$key}}_finance_0_outstanding_amount" value="0.00" class="form-control outstanding-amount hide-arrows" step="any" readonly>
                                      </div>
                                    </div>
                                  </div>
                                  {{-- <div class="col-1">
                                        <button type="button" onclick="this.closest('.finance-clonning').remove()" class="btn btn-sm btn-outline-dark">X</button>
                                  </div> --}}
                                </div>
                                {{-- /////for single value/ --}}
                            @endif
                          </section>
                          <section class="cancel-payment-section">
                            @if($booking_detail->getBookingRefundPayment && count($booking_detail->getBookingRefundPayment) > 0)
                              @foreach ($booking_detail->getBookingRefundPayment as $fkey => $payment)
                                <div class="refund-payment-section">
                                  <h3 class="mt-2 mb-1-half">Refund - By Bank</h3>
                                  <div class="row cancel-payment-row row-cols-lg-7 g-0 g-lg-2 ">
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label class="depositeLabel">Refund Amount <span style="color:red">*</span></label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                          </div>
                                          <input type="number" value="{{ \Helper::number_format($payment->refund_amount) }}" name="quote[{{ $key }}][refund][0][refund_amount]" data-name="refund_amount"  class="form-control refund_amount hide-arrows" step="any" disabled>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label>Refund Date <span style="color:red">*</span></label>
                                        <input type="date" value="{{ $payment->refund_date }}" name="quote[{{ $key }}][refund][0][refund_date]" data-name="refund_date"  class="form-control" disabled>
                                      </div>
                                    </div>
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label>Bank <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][refund][0][bank]" data-name="bank"  class="form-control bank select2single" disabled>
                                          <option value="">Select Bank</option>
                                          @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}" {{ ($bank->id == $payment->bank_id) ? 'selected' : '' }}> {{ $bank->name }} </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Refund Confirmed By <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][refund][0][refund_confirmed_by]" data-name="refund_confirmed_by"  class="form-control refund_confirmed_by select2single" disabled>
                                          <option value="">Select User</option>
                                          @foreach ($sale_persons as $person)
                                            <option  value="{{ $person->id }}" {{ ($person->id == $payment->refund_confirmed_by) ? 'selected' : '' }}>{{ $person->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              @endforeach
                            @else
                              <div class="refund-payment-hidden-section" hidden>
                                <h3 class="mt-2 mb-1-half">Refund - By Bank</h3>
                                <div class="row cancel-payment-row row-cols-lg-7 g-0 g-lg-2" >
                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label class="depositeLabel">Refund Amount <span style="color:red">*</span></label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                        </div>
                                        <input type="number" value=""  name="quote[{{ $key }}][refund][0][refund_amount]" data-name="refund_amount" id="quote_{{$key}}_refund_0_refund_amount" class="form-control refund_amount hide-arrows" step="any" readonly>
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
                          <section>
                            @if($booking_detail->getBookingCreditNote && count($booking_detail->getBookingCreditNote) > 0)
                              @foreach ($booking_detail->getBookingCreditNote as $fkey => $payment)
                                <div class="credit-note-section">

                                  <h3 class="mt-2 mb-1-half">Refund - By Credit Notes</h3>
                                  <div class="row credit-note-row else-here row-cols-lg-7 g-0 g-lg-2">
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label class="depositeLabel">Credit Note Amount <span style="color:red">*</span></label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                          </div>
                                          <input type="number" value="{{ \Helper::number_format($payment->credit_note_amount) }}" name="quote[{{ $key }}][credit_note][0][credit_note_amount]" data-name="credit_note_amount"  class="form-control credit-note-amount hide-arrows" step="any" disabled>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label>Credit Note No. <span style="color:red">*</span></label>
                                        <input type="text" value="{{$payment->credit_note_no}}" name="quote[{{ $key }}][credit_note][0][credit_note_no]" data-name="credit_note_no"  class="form-control" disabled>
                                      </div>
                                    </div>
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label>Credit Note Date <span style="color:red">*</span></label>
                                        <input type="date" value="{{ $payment->credit_note_recieved_date }}" name="quote[{{ $key }}][credit_note][0][credit_note_recieved_date]" data-name="credit_note_recieved_date" class="form-control" disabled>
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Credit Note Received By <span style="color:red">*</span></label>
                                        <select  name="quote[{{ $key }}][credit_note][0][credit_note_recieved_by]" data-name="credit_note_recieved_by" class="form-control credit_note_recieved_by select2single" disabled>
                                          <option value="">Select User</option>
                                          @foreach ($sale_persons as $person)
                                            <option  value="{{ $person->id }}" {{ ($person->id == $payment->credit_note_recieved_by) ? 'selected' : '' }}>{{ $person->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              
                              @endforeach
                              @else
                              <div class="credit-note-hidden-section" hidden>
                                <h3 class="mt-2 mb-1-half">Refund - By Credit Notes</h3>
                                <div class="row credit-note-row else-here row-cols-lg-7 g-0 g-lg-2">
                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label class="depositeLabel">Credit Note Amount <span style="color:red">*</span></label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                        </div>
                                        <input type="number" value="" name="quote[{{ $key }}][credit_note][0][credit_note_amount]" data-name="credit_note_amount" id="quote_{{ $key }}_credit_note_0_credit_note_amount" class="form-control credit-note-amount hide-arrows" step="any"  readonly>
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
                                <div class="btn-group mr-1 cancel-payemnt-btn {{ ( ($booking_detail->getBookingRefundPayment) && (count($booking_detail->getBookingRefundPayment) > 0) || ($booking_detail->getBookingCreditNote) && (count($booking_detail->getBookingCreditNote) > 0) ) ? 'd-none' : '' }}">
                                  @if(isset($total_deposit) && ($total_deposit > 0))
                                    <div class="btn-group">
                                      <div class="btn-group dropdown" role="group">
                                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">

                                          <a class="btn dropdown-item refund-to-bank" data-booking_detail_id="{{$booking_detail->id}}" >Refund to Bank</a>
                                          <a class="btn dropdown-item credit-note" data-booking_detail_id="{{$booking_detail->id}}">Credit Note</a>
                                        </div>
                                      </div>
                                      <button type="button" class="btn btn-danger">
                                        Cancel Payment
                                      </button>
                                    </div>
                                  @endif
                                </div>
                                <button type="button" data-key="0" class="clone_booking_finance float-right btn btn-dark btn-md {{ isset($total_deposit) && isset($booking_detail->estimated_cost) && ($total_deposit >= $booking_detail->estimated_cost) || ($booking_detail->getBookingRefundPayment) && (count($booking_detail->getBookingRefundPayment) > 0) || ($booking_detail->getBookingCreditNote) && (count($booking_detail->getBookingCreditNote) > 0) ? 'd-none' : ''}}">Add More Payments </button>
                              </div>
                            </div>
                          </section>
                        </div>
                      @endforeach
                    @endif
                    <div class="row">
                      <div class="col-12 text-right">
                        <button type="button" id="add_more_booking" class="mr-3 btn btn-outline-dark  pull-right">+ Add more </button>
                      </div>
                    </div>
                    <div class="form-group row  mt-3">
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
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Total Markup Amount</label>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                            </div>
                            <input type="number" value="{{ \Helper::number_format($booking->markup_amount) }}"  step="any" class="form-control total-markup-amount hide-arrows" step="any" min="0" name="total_markup_amount" value="0.00" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <div class="input-group">
                            {{-- <div class="input-group-prepend">
                              <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                            </div> --}}
                            <input type="number" value="{{ \Helper::number_format($booking->markup_percentage) }}"  step="any" class="form-control total-markup-percent hide-arrows" min="0" name="total_markup_percent" value="0.00" readonly>
                            <div class="input-group-append">
                              <div class="input-group-text">%</div>
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
                            <div class="input-group-prepend">
                              <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                            </div>
                            <input type="number" value="{{ \Helper::number_format($booking->profit_percentage) }}" step="any" name="total_profit_percentage" class="form-control total-profit-percentage hide-arrows" min="0" step="any" value="0.00" readonly>
                            <div class="input-group-append">
                              <div class="input-group-text">%</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Potential Commission</label>
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
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Selling Price in Other Currency</label>
                          <select  name="selling_price_other_currency" class="form-control select2single selling-price-other-currency @error('selling_price_other_currency') is-invalid @enderror">
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
                        <div class="form-group mt-2">
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
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Booking Amount Per Person</label>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text selling-price-other-currency-code">{{ isset($booking->selling_currency_oc) && !empty($booking->selling_currency_oc) ? $booking->selling_currency_oc : '' }}</span>
                            </div>
                            <input type="number" value="{{ \Helper::number_format($booking->amount_per_person) }}" step="any" class="form-control booking-amount-per-person hide-arrows" step="any" min="0" name="booking_amount_per_person" value="0.00" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 ">
                          <label for="inputEmail3" class="col-form-label">Relevant Quotes</label>
                        </div>
                        <div class="col-md-9">
                          <div class="row">
                          @forelse  ($booking['revelant_quote'] as $revQuote)
                            <div class="col-sm-2 relevant-quote">
                              <div class="form-group">
                                <input type="text" value="{{ $revQuote }}" class="form-control"  name="revelant_quote[]">
                              </div>
                            </div>
                            @empty
                            <div class="col-sm-2 relevant-quote">
                              <div class="form-group">
                                <input type="text" value="{{ $revQuote }}" class="form-control"  name="revelant_quote[]">
                              </div>
                            </div>
                          @endforelse
                            <div class="col-sm-2">
                              <div class="form-group">
                                  <button type="button" id="cloneRelevantquote" class="btn btn-outline-dark btn "><span class="fa fa-plus"></span></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
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
                                  <tr  class="{{ $payment_record['status'] == 'Pending' || $payment_record['status'] == 'pending' ? 'tr-bg-color' : '' }}">
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
                                  <tr  class="{{ $payment_record['status'] == 'Pending' || $payment_record['status'] == 'pending' ? 'tr-bg-color' : '' }}">
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
                <div class="card-footer">
                  <button type="submit" class="btn btn-success float-right">Submit</button>
                  <a href="{{ route('bookings.index') }}" class="btn btn-outline-danger buttonSumbit float-right mr-3">Cancel</a>
                </div>
            </form>
            <div id="overlay" class=""></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @if($exist && $user_id)
      @if($exist == 1 && $user_id != Auth::id())
        @include('partials.override_modal',[ 'status' => 'bookings' , 'id' => $booking->id ])
      @endif
    @endif
  </div>
  @include('partials.payment_details_modal')
  @include('partials.refund_to_bank')
  @include('partials.credit_note')
@endsection
@push('js')
<script>
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
