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
            
            <form method="POST" action="{{ route('bookings.update', encrypt($booking->id)) }}" id="update-booking"> 
              @csrf @method('put')
                <div class="card-body">
                  <div class="row mb-2">

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
                        <label>Commission Type <span style="color:red">*</span></label>
                        <select name="commission_id" id="commission_id" class="form-control commission-id">
                          <option selected value="" >Select Commission Type </option>
                          @foreach ($commission_types as $commission_type)
                            <option value="{{ $commission_type->id }}" {{  $commission_type->id == $booking->commission_id ? 'selected' : '' }}>{{ $commission_type->name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <label>Zoho Reference <span style="color:red">*</span></label>
                      <div class="form-group">
                        <div class="input-group ">
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
                        <label>Lead Passenger Name <span style="color:red">*</span></label>
                        <input type="text" value="{{ old('lead_passenger')??$booking->lead_passenger }}" name="lead_passenger" id="lead_passenger" class="form-control" placeholder="Lead Passenger Name" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nationality <span style="color:red">*</span></label>
                        <select name="nationailty_id" id="nationailty_id" class="form-control select2single nationality-id">
                          <option selected value="" >Select Nationality</option>
                          @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ (old('nationality_id') == $country->id)? 'selected': (($booking['country_id'] == $country->id)? 'selected':NULL) }}> {{ $country->name }} </option>
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
                        <label>Agency Booking <span style="color:red">*</span></label>
                        <div>
                          <label class="radio-inline">
                            <input class="select-agency" {{ old('agency') == '1' ? "checked" : ($booking->agency ==  1 ? 'checked' : '') }}  value="1" type="radio" name="agency" > Yes
                          </label>
                          <label class="radio-inline">
                            <input  class="select-agency" {{ old('agency') == '0'  ? "checked" : ($booking->agency ==  0? 'checked' : '') }}  value="0" type="radio" name="agency" > No
                          </label>
                        </div>
                      </div>
                      <div class="row agency-columns mb-1">
                        @if($booking->agency == 1)
                            <div class="col form-group" style="width:175px;">
                                <label for="inputEmail3" class="">Agency Name</label> <span class="text-danger"> *</span>
                                <input type="text" value="{{ $booking->agency_name }}" name="agency_name" class="form-control">
                                <span class="text-danger" role="alert"></span>
                            </div>
                            <div class="col form-group">
                                <label for="inputEmail3" class="">Agency Contact No.</label> <span class="text-danger"> *</span>
                                <input type="text" value="{{ $booking->agency_contact }}" name="agency_contact" class="form-control">
                                <span class="text-danger" role="alert"></span>
                            </div>
                        @endif
                      </div>
                    </div> --}}

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

                      <div class="row agency-columns mb-1" style={{  $booking->agency == 0 ? 'display:none;' : '' }} >
                        @if($booking->agency == 1)
                          <div class="col form-group" >
                            <label for="inputEmail3" class="">Agency Name</label> <span style="color:red"> *</span>
                            <input type="text" name="agency_name" id="agency_name" class="form-control" value="{{ $booking->agency_name }}">
                            <span class="text-danger" role="alert"> </span>
                          </div>

                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Contact No.</label> <span style="color:red"> *</span>
                            <input type="text" value="{{ $booking->agency_contact }}" name="agency_contact" id="agency_contact" class="form-control phone phone0">
                            <span class="text-danger error_msg0" role="alert" > </span>
                          </div>
                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Email </label> <span style="color:red"> *</span>
                            <input type="email" value="{{ $booking->agency_email }}" name="agency_email" id="agency_email" class="form-control">
                            <span class="text-danger" role="alert"></span>
                          </div>
                          @endif
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
                        <label>Dinning Preferences <span style="color:red">*</span></label>
                        <input type="text" value="{{ $booking->dinning_preference }}" name="dinning_preference" id="dinning_preference" class="form-control" placeholder="Dinning Preferences" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Bedding Preferences <span style="color:red">*</span></label>
                        <input type="text" value="{{ $booking->bedding_preference }}" name="bedding_preference" id="bedding_preference" class="form-control" placeholder="Bedding Preferences" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Booking Currency <span style="color:red">*</span></label>
                        <select name="currency_id" id="currency_id" class="form-control booking-currency-id @error('currency_id') is-invalid @enderror">
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
                                    <div class="row" >
                                        <div class="col-md-3 mb-2">
                                            <label >Passenger #{{ ($booking->agency == 1)? $count : $count +1  }} Full Name</label> 
                                            <input type="text" name="pax[{{$count}}][full_name]" value="{{ $pax->full_name }}" class="form-control" placeholder="PASSENGER #2 FULL NAME" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label >Email Address</label> 
                                            <input type="email" name="pax[{{$count}}][email_address]" value="{{ $pax->email }}" class="form-control" placeholder="EMAIL ADDRESS" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-sm-3">
                                          <label>Nationality</label>
                                          <select name="pax[{{ $count }}][nationality_id]" class="form-control select2single nationality-id">
                                                  <option selected value="" >Select Nationality</option>
                                              @foreach ($countries as $country)
                                                  <option value="{{ $country->id }}" {{ (old('nationality_id') == $country->id)? 'selected':( ($pax->country_id == $country->id)? 'selected':null) }}> {{ $country->name }} </option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label >Contact Number</label> 
                                            <input type="number" name="pax[{{$count}}][contact_number]" value="{{ $pax->contact }}" class="form-control phone phone{{ $count }}"  >
                                            <span class="text-danger error_msg{{ $count }}" role="alert" > </span>
                                            <span class="text-danger valid_msg{{ $count }}" role="alert" > </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <label>Date Of Birth</label> 
                                            <input type="date" max="{{  date("Y-m-d") }}" name="pax[{{$count}}][date_of_birth]" value="{{ $pax->date_of_birth }}" class="form-control" placeholder="DBO" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Bedding Preference</label> 
                                            <input type="text" name="pax[{{$count}}][bedding_preference]" value="{{ $pax->bedding_preference }}" class="form-control" placeholder="BEDDING PREFERENCES" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        
                                        <div class="col-md-3 mb-2">
                                            <label>Dinning Preference</label> 
                                            <input type="text" name="pax[{{$count}}][dinning_preference]" value="{{ $pax->dinning_preference }}" class="form-control" placeholder="DINNING PREFERENCES" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        
                    </div>
                  </div>

                  <div class="parent" id="parent">
                    @if($booking->getBookingDetail && $booking->getBookingDetail->count())
                      @foreach ($booking->getBookingDetail as $key  => $booking_detail )
                        <div class="quote" data-key="0">
                          @if($loop->iteration > 1)
                            <div class="row">
                              <div class="col-sm-12"><button type="button" class="btn pull-right close"> x </button></div>
                            </div>
                          @endif
                          <div class="row"> {{-- ?>>>rowStart --}}
                            <div class="col-sm-2">
                              <div class="form-group">
                                  <label>Date of Service</label>
                                  <input type="text" value="{{ $booking_detail->date_of_service }}" name="quote[{{ $key }}][date_of_service]" data-name="date_of_service" id="quote_{{ $key }}_date_of_service" class="form-control date-of-service datepicker checkDates bookingDateOfService"  placeholder="Date of Service" autocomplete="off">
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
                                <label>Category</label>
                                <select name="quote[{{ $key }}][category_id]" data-name="category_id" id="quote_{{ $key }}_category_id" class="form-control  select2single  category- select2single  category-id @error('category_id') is-invalid @enderror">
                                  <option value="">Select Category</option>
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ ($booking_detail->category_id == $category->id)? 'selected' : NULL}} > {{ $category->name }} </option>
                                  @endforeach
                                </select>

                                @error('category_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Supplier</label>
                                  <select name="quote[{{ $key }}][supplier_id]" data-name="supplier_id" id="quote_{{ $key }}_supplier_id" class="form-control  select2single  supplier-id @error('supplier_id') is-invalid @enderror">
                                    <option value="">Select Supplier</option>
                                    @if(isset($booking_detail->getCategory) && $booking_detail->getCategory->getSupplier)
                                      @foreach ($booking_detail->getCategory->getSupplier as $supplier )
                                        <option value="{{ $supplier->id }}" {{ ($booking_detail->supplier_id == $supplier->id)? 'selected' : NULL}}  >{{ $supplier->name }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                  @error('supplier_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                  @enderror
                              </div>
                            </div>

                            <div class="col-sm-2">
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
                                @error('product_id')
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
                                    <option value="{{ $supervisor->id }}" {{ ($booking_detail->supervisor_id == $supervisor->id)? 'selected' : NULL}}> {{ $supervisor->name }} </option>
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
                                <label>Estimated Cost <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->estimated_cost) }}" name="quote[{{ $key }}][estimated_cost]" data-name="estimated_cost" id="quote_{{ $key }}_estimated_cost" class="form-control estimated-cost change" value="0.00">
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
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_amount) }}" name="quote[{{ $key }}][markup_amount]" data-name="markup_amount" id="quote_{{ $key }}_markup_amount" class="form-control markup-amount change" value="0.00">
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-2">
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

                            <div class="col-sm-2">
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

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Estimated Cost in Booking Currency <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text booking-currency-code">{{ ($booking->getCurrency && $booking->getCurrency->count()) ? $booking->getCurrency->code : '' }}</span>
                                  </div>
                                  <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->estimated_cost_bc) }}" name="quote[{{ $key }}][estimated_cost_in_booking_currency]" data-name="estimated_cost_in_booking_currency" id="quote_{{ $key }}_estimated_cost_in_booking_currency" class="form-control estimated-cost-in-booking-currency"  readonly>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-2">
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
                              
                            <div class="col-sm-2">
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

                          </div>{{-- ?>>>rown end --}}
                          
                          <section class="finance">
                              @if($booking_detail->getBookingFinance && count($booking_detail->getBookingFinance) > 0)
                                @foreach ($booking_detail->getBookingFinance as $fkey => $finance)
                                @php $count =  $fkey + 1; @endphp
                                  <div class="row finance-clonning row-cols-lg-7 g-0 g-lg-2">
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label class="depositeLabel" id="deposite_heading{{ $fkey }}">Deposit Payment #{{ $count }}</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                          </div>
                                          <input type="number" value="{{ \Helper::number_format($finance->deposit_amount) }}" name="quote[{{ $key }}][finance][{{ $fkey }}][deposit_amount]" data-name="deposit_amount"  value="0.00" class="form-control deposit-amount hide-arrows" step="any">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-2">
                                      <div class="form-group">
                                        <label>Due Date</label>
                                        <input type="date" value="{{ $finance->deposit_due_date }}" name="quote[{{ $key }}][finance][{{ $fkey }}][deposit_due_date]" data-name="deposit_due_date"  value="" class="form-control deposit-due-date" >
                                      </div>
                                    </div>

                                    <div class="col-2">
                                      <div class="form-group">
                                        <label>Paid Date</label>
                                        <input type="date" value="{{ $finance->paid_date }}" name="quote[{{ $key }}][finance][{{ $fkey }}][paid_date]" data-name="paid_date"  value="" class="form-control paid-date" >
                                      </div>
                                    </div>

                                    <div class="col-2">
                                      <div class="form-group">
                                        <label>Payment</label>
                                        <select  name="quote[{{ $key }}][finance][{{ $fkey }}][payment_method]" data-name="payment_method"  class="form-control payment-method" >
                                          <option value="">Select Payment Method</option>
                                          @foreach ($payment_methods as $payment_method)
                                            <option value="{{ $payment_method->id }}" {{ $payment_method->id == $finance->payment_method_id ? 'selected' : '' }}> {{ $payment_method->name }} </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="col-1 d-flex justify-content-center">
                                      <div class="form-group">
                                        <label>Calender</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="icheck-primary">
                                              <input type="hidden" name="quote[{{ $key }}][finance][{{ $fkey }}][upload_to_calender]" value="{{ $finance->upload_to_calender }}"><input data-name="upload_to_calendar"  type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($finance->upload_to_calender == 1)? 'checked': NULL }}> 
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label>Alert before the following days </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <button type="button" class="input-group-text minus increment">-</button>
                                          </div>
                                          <input type="text"  name="quote[{{ $key }}][finance][0][ab_number_of_days]" step="any" name="ab_number_of_days" class="form-control ab_number_of_days"  size="10" value="{{ $finance->additional_date??0 }}">
                                            <div class="input-group-append">
                                            <button type="button" class="input-group-text plus increment">+</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-1 d-flex justify-content-center">

                                      <div class="form-group">

                                        <button type="button" onclick="this.closest('.finance-clonning').remove()" class=" btn btn-outline-dark btn-sm">X</button>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                              @else
                                {{-- /////for single value/ --}}
                                <div class="row finance-clonning row-cols-lg-7 g-0 g-lg-2">
                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label class="depositeLabel" id="deposite_heading{{ $key }}">Deposit Payment #1</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                        </div>
                                        <input type="number" name="quote[{{ $key }}][finance][0][deposit_amount]" data-name="deposit_amount" id="quote_{{ $key }}_deposit_amount" value="0.00" class="form-control deposit-amount hide-arrows" step="any">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-2">
                                    <div class="form-group">
                                      <label>Due Date</label>
                                      <input type="date" name="quote[{{ $key }}][finance][0][deposit_due_date]" data-name="deposit_due_date" id="quote_{{ $key }}_deposit_due_date" value="" class="form-control deposit-due-date" >
                                    </div>
                                  </div>

                                  <div class="col-2">
                                    <div class="form-group">
                                      <label>Paid Date</label>
                                      <input type="date" name="quote[{{ $key }}][finance][0][paid_date]" data-name="paid_date" id="quote_{{ $key }}_paid_date" value="" class="form-control paid-date" >
                                    </div>
                                  </div>

                                  <div class="col-2">
                                    <div class="form-group">
                                      <label>Payment</label>
                                      <select  name="quote[{{ $key }}][finance][0][payment_method]" data-name="payment_method" id="quote_{{ $key }}_payment_method" class="form-control payment-method" >
                                        <option value="">Select Payment Method</option>
                                        @foreach ($payment_methods as $payment_method)
                                          <option value="{{ $payment_method->id }}"> {{ $payment_method->name }} </option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-1 d-flex justify-content-center">
                                    <div class="form-group">
                                      <label>Calender</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="icheck-primary">
                                            <input type="hidden" name="quote[{{ $key }}][finance][0][upload_to_calender]" value="0"><input data-name="upload_to_calendar" id="quote_{{ $key }}_upload_to_calendar" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"> 
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label>Alert before the following days </label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text minus increment">-</span>
                                        </div>
                                          <input type="text"  name="quote[{{ $key }}][finance][0][ab_number_of_days]" step="any" name="ab_number_of_days" class="form-control ab_number_of_days"  size="10" value="0">
                                        <div class="input-group-append">
                                          <span class="input-group-text plus increment">+</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-1">
                                        <button type="button" onclick="this.closest('.finance-clonning').remove()" class="btn btn-sm btn-outline-dark">X</button>
                                  </div>
                                </div>
                                {{-- /////for single value/ --}}
                              @endif
                              <div class="row ">
                                <div class="col-12">
                                  <button type="button" data-key="0" class=" clone_booking_finance float-right btn btn-dark btn-sm">Add More Payments</button>
                                </div>
                              </div>
                          </section>
                        </div>
                      @endforeach
                    @endif
                  
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
                              <span class="input-group-text selling-price-other-currency-code">{{ isset($booking->selling_currency_oc) && !empty($booking->selling_currency_oc) ? $booking->selling_currency_oc : '' }}</span>
                            </div>
                            <input type="number" value="{{ \Helper::number_format($booking->amount_per_person) }}" step="any" class="form-control booking-amount-per-person hide-arrows" step="any" min="0" name="booking_amount_per_person" value="0.00" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success float-right">Submit</button>
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
