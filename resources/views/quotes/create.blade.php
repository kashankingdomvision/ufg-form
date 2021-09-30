@extends('layouts.app')

@section('title', 'Add Quote')

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
              <h4>Add Quote</h4>
            </div>
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

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center">Quote Form</h3>
              </div>
            
              <form method="POST" action="{{ route('quotes.store') }}" id="quoteCreate" class="create-template"> @csrf
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-sm-6"> 
                      <label>Quote Title <span style="color:red">*</span></label>
                      <div class="form-group">
                        <input type="text" name="quote_title" id="quote_title" class="form-control" placeholder="Enter Quote Title">
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                  

                    <div class="col-sm-6"> 
                      <label>Zoho Reference <span style="color:red">*</span></label>
                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" name="ref_no" id="ref_no" class="reference-name form-control" placeholder="Enter Reference Number" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                        <input type="text" name="quote_no" class="form-control" value="{{ isset($quote_id) & !empty($quote_id) ? $quote_id : '' }}"  placeholder="Quote Reference Number" readonly>
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>TAS Reference <span class="text-secondary">(Optional)</span></label>
                        <input type="text" id="tas_ref" name="tas_ref" class="form-control" value="{{ isset($tas_ref) & !empty($tas_ref) ? $tas_ref : '' }}"  placeholder="TAS Reference Number" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Currency Rate Type <span style="color:red">*</span></label>
                        <div>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="rate_type" value="live" class="rate-type" checked>
                            <span>&nbsp;Live Rate</span>
                          </label>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="rate_type" value="manual" class="rate-type">
                            <span>&nbsp;Manual Rate</span>
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Sales Person <span style="color:red">*</span></label>
                        <select name="sale_person_id" id="sale_person_id" class="form-control select2single sales-person-id">
                          <option selected value="">Select Sales Person</option>
                          @foreach ($sale_persons as $person)
                            <option value="{{ $person->id }}" {{ ($person->id == old('sale_person_id'))? 'selected' : (($person->id == Auth::id())? 'selected':NULL) }}>{{ $person->name }}</option>
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
                            <option value="{{ $commission_type->id }}">{{ $commission_type->name }} ({{ $commission_type->percentage.' %' }})</option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Brand <span style="color:red">*</span></label>
                        <select name="brand_id" id="brand_id" class="form-control select2single getBrandtoHoliday brand-id">
                          <option selected value="" >Select Brand</option>
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
                        <select name="holiday_type_id" id="holiday_type_id" class="form-control select2single appendHolidayType  holiday-type-id ">
                          <option value="">Select Type Of Holiday</option>
                          @if(Auth::user()->getBrand->getHolidayTypes && Auth::user()->getBrand->getHolidayTypes->count())
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
                        <select name="season_id" id="season_id" class="form-control select2single scurrency-id">
                          <option value="">Select Booking Season</option>
                          @foreach ($seasons as $season)
                            <option value="{{ $season->id }}" data-start="{{ $season->start_date }}" data-end="{{ $season->end_date }}" {{ old('season_id') == $season->id  ? "selected" : (($season->default == 1)? 'selected' : NULL) }}> {{ $season->name }} </option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Booking Currency <span style="color:red">*</span></label>
                        <select name="currency_id" id="currency_id" class="form-control select2single booking-currency-id @error('currency_id') is-invalid @enderror">
                          <option selected value="">Select Booking Currency </option>
                          @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}" {{ isset(Auth::user()->getCurrency->id) && !empty(Auth::user()->getCurrency->id) && Auth::user()->getCurrency->id == $currency->id ? 'selected' : '' }}> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                            <input type="radio" name="agency" class="select-agency" value="1" > Yes
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="agency" class="select-agency" value="0"  checked> No
                          </label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-12 agency-columns" >
                    
                      <div class="row mt-1 agencyField d-none" >
                        <div class="col form-group">
                          <label for="inputEmail3" class="">Agency Name</label> <span style="color:red"> *</span>
                          <input type="text"  name="agency_name" id="agency_name" class="form-control" placeholder="Agency Name">
                          <span class="text-danger" role="alert" > </span>
                        </div>
                        <div class="col form-group">
                          <label for="inputEmail3" class="">Agency Contact Name </label> <span style="color:red"> *</span>
                          <input type="text"  name="agency_contact_name" id="agency_contact_name" class="form-control" placeholder="Agency Contact Name">
                          <span class="text-danger" role="alert" > </span>
                        </div>
                        <div class="col form-group">
                          <label for="inputEmail3" class="">Agency Contact No.</label> <span style="color:red"> *</span>
                          <input type="tel"  name="agency_contact" id="agency_contact" class="form-control phone phonegc ">
                            <span class="text-danger error_msggc hide" role="alert"></span>
                            <span class="text-success valid_msggc" role="alert"></span>
                        </div>

                        <div class="col form-group">
                          <label for="inputEmail3" class="">Agency Email </label> <span style="color:red"> *</span>
                          <input type="email"  name="agency_email" id="agency_email" class="form-control" placeholder="Agency Email Address">
                          <span class="text-danger" role="alert" > </span>
                        </div>
                      </div>
                      <div class="row mt-1 PassengerField" >
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Lead Passenger Name <span style="color:red">*</span></label>
                            <input type="text" name="lead_passenger_name" id="lead_passenger_name" class="form-control" placeholder="Lead Passenger Name" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Email Address <span style="color:red">*</span></label> 
                            <input type="email" name="lead_passenger_email" id="lead_passenger_email" class="form-control" placeholder="Email Address" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Contact Number <span style="color:red">*</span></label> 
                            <input type="tel" name="lead_passenger_contact" id="lead_passenger_contact"  class="form-control phone phone0 " >
                            <span class="text-danger error_msg0" role="alert"></span>
                            <span class="text-success valid_msg0" role="alert"></span>
                          </div>
                        </div>
                      
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Date Of Birth</label> 
                            <input type="date" max="{{ date('Y-m-d') }}" id="lead_passenger_dbo" name="lead_passenger_dbo" class="form-control" placeholder="Date Of Birth" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row PassengerField">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Nationality (Passport)</label>
                            <select name="lead_passsenger_nationailty_id" id="lead_passsenger_nationailty_id" class="form-control select2single nationality-id">
                              <option selected value="" >Select Nationality</option>
                              @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ (old('lead_passsenger_nationailty_id') == $country->id)? 'selected': null }}> {{ $country->name }} </option>
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
                                <option value="{{ $country->id }}" {{ (old('lead_passsenger_resident') == $country->id)? 'selected': null }}> {{ $country->name }} </option>
                              @endforeach
                            </select>
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Bedding Preferences</label>
                            <input type="text" name="lead_passenger_bedding_preference" id="lead_passenger_bedding_preference" class="form-control " placeholder="Bedding Preferences" id="bedding_preference" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>  
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Dinning Preferences</label>
                            <input type="text" name="lead_passenger_dinning_preference" id="lead_passenger_dinning_preference" class="form-control" placeholder="Dinning Preferences" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Covid Vaccinated</label>
                            <div>
                              <label class="radio-inline">
                                <input type="radio" name="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="1" > Yes
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="0" checked> No
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
                        <select name="pax_no" id="pax_no" class="form-control select2single paxNumber pax-number @error('pax_no') is-invalid @enderror">
                          <option selected value="">Select Pax No</option>
                          @for($i=1;$i<=30;$i++)
                            <option value={{$i}} {{ old('pax_no') == $i || $i == 1 ? "selected" : "" }}>{{$i}}</option>
                          @endfor
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    
                    <div id="appendPaxName" class="col-md-12 ">
                    
                    </div>
                    <div class="col-md-12 col-offset-md-4">
                      <button type="button" class="add-pax-column btn btn-dark float-right"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                  </div>
                
                  
                  <div class="row mb-2">
                      <div class="col-md-2 offset-md-10">
                        <select name="template" id="tempalte_id" class="float-right select2single form-control template">
                          <option  disabled selected value="">Select Template</option>
                          @foreach ($templates as $template)
                            <option  value="{{ encrypt($template->id) }}">{{ $template->title }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="parent" id="parent">

                    <div class="quote card card-default" data-key="0">

                      <div class="card-header">
                        <div class="card-tools">
                          <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2" title="Minimize/Maximize" data-card-widget="collapse"><i class="fas fa-minus"></i></a>
                          <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 remove d-none" title="Remove"><i class="fas fa-times"></i></a>
                        </div>
                      </div>

                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group ">
                              <div class="modal fade calladdmediaModal" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                @include('partials.addmediaModal')
                              </div>
                            </div>
                            <button type="button" data-show="calladdmediaModal" class="float-right btn btn-dark addmodalforquote" data-toggle="modal" data-target=".exampleModalCenter"><i class="fa fa-upload" aria-hidden="true"></i></button>
                          </div>
                        </div>  

                        <div class="row">
                            
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Start Date of Service <span style="color:red">*</span></label>
                              <input type="text" placeholder="DD/MM/YYYY"  name="quote[0][date_of_service]" data-name="date_of_service" id="quote_0_date_of_service" class="form-control date-of-service datepicker  checkDates bookingDateOfService " autocomplete="off">
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>End Date of Service <span style="color:red">*</span></label>
                              <input type="text" placeholder="DD/MM/YYYY"  name="quote[0][end_date_of_service]" data-name="end_date_of_service" id="quote_0_end_date_of_service" class="form-control end-date-of-service bookingEndDateOfService datepicker" autocomplete="off">
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Time of Service</label>
                              <input type="time" name="quote[0][time_of_service]" data-name="time_of_service" id="quote_0_time_of_service" class="form-control"  autocomplete="off">
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Category <span style="color:red">*</span></label>
                              <select name="quote[0][category_id]" data-name="category_id" id="quote_0_category_id" class="form-control category-id select2single @error('category_id') is-invalid @enderror">
                                <option selected value="">Select Category</option>
                                @foreach ($categories as $category)
                                  <option value="{{ $category->id }}" > {{ $category->name }} </option>
                                @endforeach
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Supplier <span style="color:red">*</span></label>
                              <select name="quote[0][supplier_id]" data-name="supplier_id" id="quote_0_supplier_id" class="form-control supplier-id select2single @error('supplier_id') is-invalid @enderror">
                                <option selected value="">Select Supplier</option>
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Product</label>
                              <input type="text" name="quote[0][product_id]" data-name="product_id" id="quote_0_product_id" class="form-control product-id" placeholder="Enter Product">
                            </div>
                          </div>

                          <div class="col-sm-2">
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
                          </div>

                          <div class="col-sm-2">
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
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Booking Reference</label>
                              <input type="text" name="quote[0][booking_reference]" data-name="booking_refrence" id="quote_0_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
                            </div>
                          </div>

                          <div class="col-sm-2">
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
                          </div>

                          <div class="col-sm-2">
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
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Booking Types </label>
                              <select name="quote[0][booking_type]" data-name="booking_type" id="quote_0_booking_type" class="form-control select2single booking-type-id @error('booking_type_id') is-invalid @enderror">
                                <option selected value="" >Select Booking Type</option>
                                @foreach ($booking_types as $booking_type)
                                  <option value="{{ $booking_type->id }}"> {{$booking_type->name}} </option>
                                @endforeach
                              </select>

                              @error('booking_type_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Supplier Currency <span style="color: red">*</span></label>
                              <select name="quote[0][supplier_currency_id]" data-name="supplier_currency_id" id="quote_0_supplier_currency_id" class="form-control select2single supplier-currency-id @error('currency_id') is-invalid @enderror">
                                <option selected value="" >Select Supplier Currency</option>
                                @foreach ($currencies as $currency)
                                  <option value="{{ $currency->id }}" data-code="{{ $currency->code }}" data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                                  <span class="input-group-text supplier-currency-code"></span>
                                </div>
                                <input type="number" step="any" name="quote[0][estimated_cost]" data-name="estimated_cost" id="quote_0_estimated_cost" class="form-control estimated-cost change-calculation" min="0" value="0.00">
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Markup Amount <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text supplier-currency-code"></span>
                                </div>
                                <input type="number" name="quote[0][markup_amount]" data-name="markup_amount" id="quote_0_markup_amount" class="form-control markup-amount change-calculation" value="0.00" min="0" step="any">
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Markup % <span style="color:red">*</span></label>
                              <div class="input-group">
                                <input type="number" step="any" name="quote[0][markup_percentage]" data-name="markup_percentage" id="quote_0_markup_percentage" class="form-control markup-percentage change-calculation" min="0" value="0.00">
                                <div class="input-group-append">
                                  <div class="input-group-text">%</div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Selling Price <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text supplier-currency-code">
                                    {{-- <i class="fas fa-dollar-sign"></i> --}}
                                  </span>
                                </div>
                                <input type="number" step="any" name="quote[0][selling_price]" data-name="selling_price" id="quote_0_selling_price" class="form-control selling-price hide-arrows" value="0.00" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Profit % <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text supplier-currency-code">
                                    {{-- <i class="fas fa-dollar-sign"></i> --}}
                                  </span>
                                </div>
                                <input type="number" step="any" name="quote[0][profit_percentage]" data-name="profit_percentage" id="quote_0_profit_percentage" class="form-control profit-percentage hide-arrows" value="0.00" readonly>
                                <div class="input-group-append">
                                  <div class="input-group-text">%</div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Estimated Cost in Booking Currency <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                                </div>
                                <input type="number" step="any" name="quote[0][estimated_cost_in_booking_currency]" data-name="estimated_cost_in_booking_currency" id="quote_0_estimated_cost_in_booking_currency" class="form-control estimated-cost-in-booking-currency" value="0.00" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Markup Amount in Booking Currency <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                                </div>
                                <input type="number" step="any" name="quote[0][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_0_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly> 
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Selling Price in Booking Currency <span style="color:red">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                                </div>
                                <input type="number" step="any" name="quote[0][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_0_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
                              </div>
                            </div>
                          </div>

                          @if(Auth::user()->getRole->slug == 'admin' || Auth::user()->getRole->slug == 'accountant')
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
                          @endif

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Comments</label>
                              <textarea name="quote[0][comments]" data-name="comments" id="quote_0_comments" class="form-control comments" rows="2" placeholder="Enter Comments"></textarea>
                            </div>
                          </div> 
                          
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Add Stored Text</label>
                              <button type="button" data-show="callStoredTextModal" class="mr-3 btn btn-outline-dark addmodalforquote" data-toggle="modal">Add Stored Text</button>
                              <div class="modal fade callStoredTextModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                @include('partials.stored_text_modal')
                              </div>
                            </div>
                          </div> <!--col-md-2-->

                        </div>
                      </div>


                    </div>
                    
                    <input type="hidden" id="packageinput0" name="packages[]" class="packageinput" value="1">
                  </div>
               
                  <div class="row">
                    <div class="col-12 text-right">
                      <!-- <button type="button"  id="add_storeText" class="mr-3 btn btn-outline-dark  pull-right">+ Add Stored Text</button> -->
                      <button type="button" id="add_more" class="mr-3 btn btn-outline-dark  pull-right">+ Add more </button>
                      <button type="button" id="save_template" class="btn btn-outline-success  pull-right">Save as Template</button>
                    </div>
                  </div>


                  <!-- <div class="row" id="storedText" style="display:none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label " class="col-sm-3 col-form-label">Stored Text</label>
                        <select multiple="multiple" name="stored_text[]" class="form-control select2-multiple" id="selectstoretext" disabled>
                          @foreach ($storetexts as $text )
                            <option value="{{$text->id}}" >{{ $text->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div> -->

                  <div class="form-group row mt-1">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Total Net Price</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" name="total_net_price" step="any" class="form-control total-net-price hide-arrows" step="any" min="0"  value="0.00" readonly>
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
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" step="any" class="form-control total-markup-amount hide-arrows" step="any" min="0" name="total_markup_amount" value="0.00" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          {{-- <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div> --}}
                          <input type="number" step="any" class="form-control total-markup-percent hide-arrows" min="0" name="total_markup_percent" value="0.00" readonly>
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
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" step="any" name="total_selling_price" class="form-control total-selling-price hide-arrows" min="0.00" step="any"  value="0.00" readonly>
                        </div>
                      </div>
                    </div>
                
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Total Profit Percentage</label>
                    <div class="col-sm-2">
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
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Potential Commission</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" step="any" name="commission_amount" class="form-control commission-amount hide-arrows" min="0" step="any" value="0.00" readonly>
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
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" step="any" class="form-control booking-amount-per-person hide-arrows" step="any" min="0" name="booking_amount_per_person" value="0.00" readonly>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">

                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Selling Price in Other Currency</label>
                        <select  name="selling_price_other_currency" class="form-control selling-price-other-currency @error('selling_price_other_currency') is-invalid @enderror">
                          <option value="" selected >Select Currency</option>
                          @foreach ($currencies as $currency)
                          <option value="{{ $currency->code }}" data-image="data:image/png;base64, {{$currency->flag}}" > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                            <span class="input-group-text  selling-price-other-currency-code"></span>
                          </div>
                          <input type="number" step="any" name="selling_price_other_currency_rate" min="0" step="any" class="form-control selling-price-other-currency-rate hide-arrows" value="0.00" readonly>
                         
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
                          <div class="col-sm-3 relevant-quote">
                            <select  name="revelant_quote[]" multiple class="form-control select2-multiple">
                              @foreach ($quote_ref as $ref)
                                <option value="{{$ref->quote_ref}}"> {{ $ref->quote_ref }} </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success buttonSumbit float-right">Submit</button>
                  <a href="{{ route('quotes.index') }}" class="btn btn-outline-danger buttonSumbit float-right mr-3">Cancel</a>
                </div>
              </form>
              
              <div id="overlay" class=""></div>
            </div>
          </div>
          

        </div>
      </div>
    </section>

    @include('partials.template_modal')
  </div>

@endsection
