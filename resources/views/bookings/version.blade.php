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
                <h3 class="card-title text-center">Version Bookings #{{ $log->log_no }} {{ $log->version_no }} </h3>
                <a href="{{ route('bookings.edit', encrypt($log['booking_id'])) }}" data-recall="true" class="btn btn-outline-light btn-sm float-right">Back</a>
              </div>
              <div class="card-body">
                <div class="row mb-2">
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
                      <label>Currency Rate Type <span class="text-danger">*</span></label>
                      <div>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="rate_type" {{ ($booking['rate_type'] == 'live')? 'checked': NULL }} value="live" >
                          <span>&nbsp;Live Rate</span>
                        </label>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="rate_type" {{ ($booking['rate_type'] == 'manual')? 'checked': NULL }} value="manual">
                          <span>&nbsp;Manual Rate</span>
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
                
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Commission Type <span style="color:red">*</span></label>
                      <select name="commission_id" id="commission_id" class="form-control select2single commission-id">
                        <option selected value="" >Select Commission Type </option>
                        @foreach ($commission_types as $commission_type)
                          <option value="{{ $commission_type->id }}" {{  $commission_type->id == $booking['commission_id'] ? 'selected' : '' }}>{{ $commission_type->name }}  &nbsp; ({{ $commission_type->percentage.' %' }})</option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>
                
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
                      <select name="season_id" id="season_id" class="form-control select2single">
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
                      <select name="currency_id" id="booking_currency_id" class="form-control select2single booking-currency-id @error('currency_id') is-invalid @enderror">
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
                            <label>Date Of Birth <span style="color:red">*</span></label> 
                            <input type="date" value="{{ $booking['lead_passenger_dbo'] }}" max="{{ date('Y-m-d') }}" id="lead_passenger_dbo" name="lead_passenger_dbo" class="form-control" placeholder="Date Of Birth" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Nationality <span style="color:red">*</span></label>
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
                            <label>Dinning Preferences <span style="color:red">*</span></label>
                            <input type="text" value="{{ $booking['lead_passenger_dinning_preference'] }}" name="lead_passenger_dinning_preference" id="lead_passenger_dinning_preference" class="form-control" placeholder="Dinning Preferences" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>
                        
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Bedding Preferences <span style="color:red">*</span></label>
                            <input type="text" value="{{ $booking['lead_passenger_bedding_preference'] }}" name="lead_passenger_bedding_preference" id="lead_passenger_bedding_preference" class="form-control " placeholder="Bedding Preferences" id="bedding_preference" >
                            <span class="text-danger" role="alert"></span>
                          </div>
                        </div>  

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Covid Vaccinated <span style="color:red">*</span></label>
                            <div>
                              <label class="radio-inline">
                                <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="1" {{ ( $booking['lead_passenger_covid_vaccinated']  ==  1) ? 'checked' : '' }}> Yes
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="0" {{ ( $booking['lead_passenger_covid_vaccinated']  ==  0 ||  $booking['lead_passenger_covid_vaccinated']  == null) ? 'checked' : '' }} > No
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
                                      <div class="col-sm-3">
                                        <label>Nationality</label>
                                        <select name="pax[{{ $count }}][nationality_id]" class="form-control select2singlesingle nationality-id">
                                                <option selected value="" >Select Nationality</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ (old('nationality_id') == $country->id)? 'selected':( ($pax['nationality_id'] == $country->id)? 'selected':null) }}> {{ $country->name }} </option>
                                            @endforeach
                                        </select>
                                      </div>
                                      <div class="col-md-3 mb-2">
                                          <label >Contact Number</label> 
                                          <input type="tel" name="pax[{{$count}}][contact_number]" value="{{ $pax['contact'] }}" class="form-control phone phone{{ $count }}" >
                                          <span class="text-danger error_msg{{ $count }}" role="alert" > </span>
                                          <span class="text-danger valid_msg{{ $count }}" role="alert" > </span>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-3 mb-2">
                                          <label>Date Of Birth</label> 
                                          <input type="date" max="{{  date("Y-m-d") }}" name="pax[{{$count}}][date_of_birth]" value="{{ $pax['date_of_birth'] }}" class="form-control" placeholder="DBO" >
                                          <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
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

                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label>Covid Vaccinated</label>
                                          <div>
                                            <label class="radio-inline">
                                              <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="1" 
                                              @if($pax['covid_vaccinated'] == 1)
                                              checked
                                              @endif> Yes
                                            </label>
                                            <label class="radio-inline">
                                              <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="0"
                                              @if($pax['covid_vaccinated'] == 0)
                                              checked
                                              @endif > No
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
                  @if($booking['booking'] && count($booking['booking']))
                    @foreach ($booking['booking'] as $key  => $booking_detail )
                      <div class="quote" data-key="0">
                        @if($loop->iteration > 1)
                          <div class="row">
                            <div class="col-sm-12"><button type="button" class="btn pull-right close"> x </button></div>
                          </div>
                        @endif
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
                              <label>Time of Service</label>
                              <input type="time" value="{{ $booking_detail['time_of_service'] }}" name="quote[{{ $key }}][time_of_service]" data-name="time_of_service" id="quote_{{ $key }}_time_of_service" class="form-control" placeholder="Time of Service" autocomplete="off">
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Category</label>
                              <select name="quote[{{ $key }}][category_id]" data-name="category_id" id="quote_{{ $key }}_category_id" class="form-control select2single category-select2 category-id @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                  <option value="{{ $category->id }}" {{ ($booking_detail['category_id'] == $category->id)? 'selected' : NULL}} > {{ $category->name }} </option>
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
                                <select name="quote[{{ $key }}][supplier_id]" data-name="supplier_id" id="quote_{{ $key }}_supplier_id" class="form-control select2single supplier-id @error('supplier_id') is-invalid @enderror">
                                  <option value="">Select Supplier</option>
                                  @if(isset($booking_detail['category_id']))
                                    @foreach ($log->getQueryData($booking_detail['category_id'], 'Category')->first()->getSupplier as $supplier )
                                      <option value="{{ $supplier->id }}" {{ ($booking_detail['supplier_id'] == $supplier->id)? 'selected' : NULL}}  >{{ $supplier->name }}</option>
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
                              <input type="text" name="quote[{{ $key }}][product_id]"  data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control product-id" value="{{ $booking_detail['product_id'] }}" placeholder="Enter Product">
                            </div>
                          </div>

                          {{-- <div class="col-sm-2">
                            <div class="form-group">
                              <label>Product</label>
                              <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control select2single  product-id @error('product_id') is-invalid @enderror">
                                <option value="">Select Product</option>
                                @if(isset($booking_detail['supplier_id']) && $log->getQueryData($booking_detail['supplier_id'], 'Supplier')->first()->getProducts)
                                  @foreach ($log->getQueryData($booking_detail['supplier_id'], 'Supplier')->first()->getProducts as  $product)
                                    <option value="{{ $product->id }}" {{ ($booking_detail['product_id'] == $product->id)? 'selected' : NULL}}>{{ $product->name }}</option>
                                  @endforeach
                                @endif
                              </select>
                              @error('product_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                            </div>
                          </div> --}}

                          <div class="col-sm-2">
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
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Booking Date</label>
                              <input type="text" value="{{ $booking_detail['booking_date'] }}" name="quote[{{ $key }}][booking_date]" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" placeholder="Booking Date">
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Booking Due Date</label>
                              <input type="text" value="{{ $booking_detail['booking_due_date'] }}" name="quote[{{ $key }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date">
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Booking Reference</label>
                              <input type="text" value="{{ $booking_detail['booking_reference'] }}" name="quote[{{ $key }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $key }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
                            </div>
                          </div>
                          <div class="col-sm-2">
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
                          </div>
                          <div class="col-sm-2">
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
                          </div>
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Types</label>
                                <select name="quote[{{ $key }}][booking_type]" data-name="booking_type" id="quote_{{ $key }}_booking_type" class="form-control select2single   booking-type-id @error('booking_type_id') is-invalid @enderror">
                                  <option value="">Select Booking Type</option>
                                  @foreach ($booking_types as $booking_type)
                                    <option value="{{ $booking_type->id }}" {{ $booking_detail['booking_type_id'] == $booking_type->id  ? "selected" : "" }}> {{ $booking_type->name }} </option>
                                  @endforeach
                                </select>
                                @error('booking_type_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Supplier Currency</label>
                                <select name="quote[{{ $key }}][supplier_currency_id]" data-name="supplier_currency_id" id="quote_{{ $key }}_supplier_currency_id" class="form-control    supplier-currency-id @error('currency_id') is-invalid @enderror">
                                  <option value="">Select Supplier Currency</option>
                                  @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}" {{ $booking_detail['supplier_currency_id'] == $currency->id  ? "selected" : "" }}  data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                                  @endforeach
                                </select>
                                @error('currency_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Actual Cost <span class="text-danger">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text supplier-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                </div>
                                <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['estimated_cost']) }}" name="quote[{{ $key }}][estimated_cost]" data-name="estimated_cost" id="quote_{{ $key }}_estimated_cost" class="form-control estimated-cost change" value="0.00">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-2">
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
                          <div class="col-sm-2">
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
                          <div class="col-sm-2">
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
                          <div class="col-sm-2">
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
                                <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['estimated_cost_bc']) }}" name="quote[{{ $key }}][estimated_cost_in_booking_currency]" data-name="estimated_cost_in_booking_currency" id="quote_{{ $key }}_estimated_cost_in_booking_currency" class="form-control estimated-cost-in-booking-currency"  readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Selling Price in Booking Currency <span class="text-danger">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                                </div>
                                <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['selling_price_bc']) }}" name="quote[{{ $key }}][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_{{ $key }}_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Markup Amount in Booking Currency <span class="text-danger">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking['currency_id'], 'Currency')->first()) ? $log->getQueryData($booking['currency_id'], 'Currency')->first()->code : '' }}</span>
                                </div>
                                <input type="number" step="any" value="{{ \Helper::number_format($booking_detail['markup_amount_bc']) }}" name="quote[{{ $key }}][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_{{ $key }}_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly> 
                              </div>
                            </div>
                          </div>
                          @if(Auth::user()->getRole->slug == 'admin' || Auth::user()->getRole->slug == 'accountant')
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
                          @endif
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Service Details</label>
                              <textarea name="quote[{{ $key }}][service_details]" data-name="service_details" id="quote_{{ $key }}_service_details" class="form-control service-details" rows="2" placeholder="Enter Service Details">{{ $booking_detail['service_details'] }}</textarea>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Comments</label>
                              <textarea name="quote[{{ $key }}][comments]" data-name="comments" id="quote_{{ $key }}_comments" class="form-control comments" rows="2" placeholder="Enter Comments">{{ $booking_detail['comments'] }}</textarea>
                            </div>
                          </div>
                          @if($booking_detail['invoice'])
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Invoice Preview</label>
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
                        @if($booking_detail['finance'] && count($booking_detail['finance']) > 0)
                          @foreach ($booking_detail['finance'] as $fkey => $finance)
                            @php $count =  $fkey + 1; @endphp
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
                                  <label>Deposit Due Date</label>
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
                                  <label>Payment</label>
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
                      </div>
                    @endforeach
                  @endif
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
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Total Markup Amount</label>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
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
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Total Selling Price</label>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
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
                        <div class="input-group-prepend">
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="number" value="{{ \Helper::number_format($booking['profit_percentage']) }}" step="any" name="total_profit_percentage" class="form-control total-profit-percentage hide-arrows" min="0" step="any" value="0.00" readonly>
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
                          <span class="input-group-text booking-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="number" step="any" name="commission_amount" class="form-control commission-amount hide-arrows" min="0" step="any" value="{{ \Helper::number_format($booking['commission_amount']) }}" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Supplier Selling Price in Other Currency</label>
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
                    <div class="form-group mt-2">
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
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Booking Amount Per Person</label>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text selling-price-other-currency-code">{{ ($log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()) ? $log->getQueryData($booking_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                        </div>
                        <input type="number" value="{{  \Helper::number_format($booking['amount_per_person']) }}" step="any" class="form-control booking-amount-per-person hide-arrows" step="any" min="0" name="booking_amount_per_person" value="0.00" readonly>
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
                {{-- <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Payment Details</h3>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Status</th>
                          <th>Payment For</th>
                          <th>Date</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>

                        @if(isset($payment_details) && !empty($payment_details))

                          @foreach ($payment_details as $key => $payment_detail)

                            @if(is_array($payment_details[$key]))
                              @if(!empty($key))
                                <tr><td colspan="4" class="text-center font-weight-bold tbody-highlight">{{ strtoupper($key) }}</td></tr>
                              @endif
                              @foreach ($payment_details[$key] as $key => $detail)
                                <tr>
                                  <td>{{ ucfirst($detail['status']) }}</td>
                                  <td>{{$detail['payment_for']}}</td>
                                  <td>{{ \Carbon\Carbon::parse($detail['date'])->format('d/m/Y') }} </td>
                                  <td>{{$detail['amount']}}</td>
                                </tr>
                              @endforeach
                            @endif
                          @endforeach
                          @else
                          <tr align="center"><td colspan="100%">No record found.</td></tr>
                        @endif

                      </tbody>
                    </table>
                  </div>
                </div> --}}

              </div>


            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
