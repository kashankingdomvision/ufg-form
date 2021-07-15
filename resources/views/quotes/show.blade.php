@extends('layouts.app')
@section('title', 'Final Quote')
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
              <h4>View Final Quote</h4>
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
    <section class="content versions" >
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center">Final Quote</h3>
              </div>
              <form method="POST" class="update-quote" action="{{ route('quotes.update', encrypt($quote->id)) }}"> 
                <div class="card-body">
                  @csrf @method('put')
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Rate Type <span style="color:red">*</span></label>
                        <div>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="rate_type" class="rate-type" value="live" {{ ($quote->rate_type == 'live')? 'checked': NULL }}>
                            <span>&nbsp;Live Rate</span>
                          </label>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="rate_type" class="rate-type" value="manual" {{ ($quote->rate_type == 'manual')? 'checked': NULL }}>
                            <span>&nbsp;Manual Rate</span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Commission Type <span style="color:red">*</span></label>
                        <select name="commission_id" id="commission_id" class="form-control  select2single commission-id">
                          <option selected value="" >Select Commission Type </option>
                          @foreach ($commission_types as $commission_type)
                            <option value="{{ $commission_type->id }}" {{  $commission_type->id == $quote->commission_id ? 'selected' : '' }}>{{ $commission_type->name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label>Zoho Reference <span style="color:red">*</span></label>
                      <div class="form-group">
                        <div class="input-group ">
                          <input type="text" name="ref_no" id="ref_no" value="{{ $quote->ref_no }}" class="form-control reference-name" placeholder="Enter Reference Number">
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
                        <input type="text" value="{{ $quote->quote_ref }}" name="quote_no" class="form-control" placeholder="Quote Reference Number" readonly>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Lead Passenger Name <span style="color:red">*</span></label>
                        <input type="text" value="{{ $quote->lead_passenger }}" name="lead_passenger" id="lead_passenger" class="form-control" placeholder="Lead Passenger Name" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Brand <span style="color:red">*</span></label>
                        <select name="brand_id" id="brand_id" class="form-control  select2single getBrandtoHoliday  brand-id @error('brand_id') is-invalid @enderror">
                          <option value="">Select Brand</option>
                          @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ (old('brand_id') == $brand->id)? "selected" : (($quote->brand_id == $brand->id)? 'selected':NULL) }}> {{ $brand->name }} </option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Type Of Holiday <span style="color:red">*</span></label>
                        <select name="holiday_type_id" id="holiday_type_id" class="form-control  select2single appendHolidayType  holiday-type-id @error('holiday_type_id') is-invalid @enderror">
                          <option value="">Select Type Of Holiday</option>
                          @foreach ($quote->getBrand->getHolidayTypes as $holiday_type)
                            <option value="{{ $holiday_type->id }}" {{  (old('holiday_type_id') == $holiday_type->id)? "selected" : ($quote->holiday_type_id == $holiday_type->id ? 'selected' : '') }} >{{ $holiday_type->name }}</option>
                          @endforeach
                          <option value="">Select Type Of Holiday</option>
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Sales Person <span style="color:red">*</span></label>
                        <select name="sale_person_id" id="sale_person_id" class="form-control  select2single sales-person-id @error('sales_person_id') is-invalid @enderror">
                          <option value="">Select Sales Person</option>
                          @foreach ($sale_persons as $person)
                            <option  value="{{ $person->id }}" {{  (old('sale_person_id') == $person->id)? "selected" : ($quote->sale_person_id == $person->id ? 'selected' : '') }}>{{ $person->name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Booking Season <span style="color:red">*</span></label>
                        <select name="season_id" id="season_id" class="form-control  select2single">
                          <option value="">Select Booking Season</option>
                          @foreach ($seasons as $season)
                            <option value="{{ $season->id }}" data-start="{{ $season->start_date }}" data-end="{{ $season->end_date }}" {{ old('season_id') == $season->id  ? "selected" : ($quote->season_id == $season->id ? 'selected' : '') }}> {{ $season->name }} </option>
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
                            <input class="select-agency" {{ ($quote->agency ==  1 ? 'checked' : '') }}  value="1" type="radio" name="agency" > Yes
                          </label>
                          <label class="radio-inline">
                            <input  class="select-agency" {{ ($quote->agency ==  0 ? 'checked' : '') }}  value="0" type="radio" name="agency" > No
                          </label>
                        </div>
                      </div>
                      <div class="row agency-columns mb-1">
                        @if($quote->agency == 1)
                          <div class="col form-group" style="width:175px;">
                            <label for="inputEmail3" class="">Agency Name</label> <span style="color:red"> *</span>
                            <input type="text" value="{{ $quote->agency_name }}" name="agency_name" class="form-control">
                            <span class="text-danger" role="alert"></span>
                          </div>
                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Contact No.</label> <span style="color:red"> *</span>
                            <input type="text" value="{{ $quote->agency_contact }}" name="agency_contact" class="form-control">
                            <span class="text-danger" role="alert"></span>
                          </div>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Dinning Preferences <span style="color:red">*</span></label>
                        <input type="text" value="{{ $quote->dinning_preference }}" name="dinning_preference" id="dinning_preference"  class="form-control" placeholder="Dinning Preferences" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Bedding Preferences <span style="color:red">*</span></label>
                        <input type="text" value="{{ $quote->bedding_preference }}" name="bedding_preference" id="bedding_preference" class="form-control" placeholder="Bedding Preferences" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Booking Currency <span style="color:red">*</span></label>
                        <select name="currency_id" id="currency_id" class="form-control select2single booking-currency-id @error('currency_id') is-invalid @enderror">
                          <option value="">Select Booking Currency </option>
                          @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" data-code="{{$currency->code}}"  data-image="data:image/png;base64, {{$currency->flag}}" 
                            {{ $currency->id == $quote->currency_id ? 'selected' : ''  }}
                            > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pax No. <span style="color:red">*</span></label>
                        <select name="pax_no" id="pax_no" class="form-control  select2single paxNumber pax-number @error('pax_no') is-invalid @enderror">
                          <option value="">Select Pax No</option>
                          @for($i=1;$i<=30;$i++)
                            <option value={{$i}} {{ (old('pax_no') == $i)? "selected" : (($quote->pax_no == $i)? 'selected': NULL) }}>{{$i}}</option>
                          @endfor
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div id="appendPaxName" class="col-md-12">
                        @if($quote->pax_no > 1)
                            @foreach ($quote->getPaxDetail as $paxKey => $pax )
                            @php $count = $paxKey + 1; @endphp
                                <div class="mb-2 appendCount" id="appendCount{{ $count }}">
                                    <div class="row" >
                                        <div class="col-md-4 mb-2">
                                            <label >Passenger #{{ $count +1  }} Full Name</label> 
                                            <input type="text" name="pax[{{$count}}][full_name]" value="{{ $pax->full_name }}" class="form-control" placeholder="PASSENGER #2 FULL NAME" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label >Email Address</label> 
                                            <input type="email" name="pax[{{$count}}][email_address]" value="{{ $pax->email }}" class="form-control" placeholder="EMAIL ADDRESS" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label >Contact Number</label> 
                                            <input type="number" name="pax[{{$count}}][contact_number]" value="{{ $pax->contact }}" class="form-control" placeholder="CONTACT NUMBER" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <label>Date Of Birth</label> 
                                            <input type="date" max="{{  date("Y-m-d") }}" name="pax[{{$count}}][date_of_birth]" value="{{ $pax->date_of_birth }}" class="form-control" placeholder="CONTACT NUMBER" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label>Bedding Preference</label> 
                                            <input type="text" name="pax[{{$count}}][bedding_preference]" value="{{ $pax->bedding_preference }}" class="form-control" placeholder="BEDDING PREFERENCES" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-4 mb-2">
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
                    @foreach ($quote->getQuoteDetails()->orderBy('date_of_service', 'DESC')->get() as $key  => $q_detail )
                        <div class="quote" data-key="{{$key}}">
                            @if($loop->iteration > 1)
                            <div class="row">
                              <div class="col-sm-12"><button type="button" class="btn pull-right close"> x </button></div>
                            </div>
                            @endif
                            <div class="row"> {{-- ?>>>rowStart --}}
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Date of Service</label>
                                    <input type="text" value="{{ $q_detail->date_of_service }}" name="quote[{{ $key }}][date_of_service]" data-name="date_of_service" id="quote_{{ $key }}_date_of_service" class="form-control date-of-service datepicker checkDates bookingDateOfService"  placeholder="Date of Service" autocomplete="off">
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Time of Service</label>
                                    <input type="time" value="{{ $q_detail->time_of_service }}" name="quote[{{ $key }}][time_of_service]" data-name="time_of_service" id="quote_{{ $key }}_time_of_service" class="form-control" placeholder="Time of Service" autocomplete="off">
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="quote[{{ $key }}][category_id]" data-name="category_id" id="quote_{{ $key }}_category_id" class="form-control select2single category-select2 category-id @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ ($q_detail->category_id == $category->id)? 'selected' : NULL}} > {{ $category->name }} </option>
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
                                        @if(isset($q_detail->getCategory) && $q_detail->getCategory->getSupplier)
                                            @foreach ($q_detail->getCategory->getSupplier as $supplier )
                                            <option value="{{ $supplier->id }}" {{ ($q_detail->supplier_id == $supplier->id)? 'selected' : NULL}}  >{{ $supplier->name }}</option>
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
                                    <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control select2single  product-id @error('product_id') is-invalid @enderror">
                                        <option value="">Select Product</option>
                                    @if(isset($q_detail->getSupplier) && $q_detail->getSupplier->getProducts)
                                        @foreach ($q_detail->getSupplier->getProducts as  $product)
                                            <option value="{{ $product->id }}" {{ ($q_detail->product_id == $product->id)? 'selected' : NULL}}>{{ $product->name }}</option>
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
                                    <select name="quote[{{ $key }}][supervisor_id]" data-name="supervisor_id" id="quote_{{ $key }}_supervisor_id" class="form-control  select2single  supervisor-id @error('supervisor_id') is-invalid @enderror">
                                    <option value="">Select Supervisor</option>
                                    @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}" {{ ($q_detail->supervisor_id == $supervisor->id)? 'selected' : NULL}}> {{ $supervisor->name }} </option>
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
                                    <input type="text" value="{{ $q_detail->booking_date }}" name="quote[{{ $key }}][booking_date]" autocomplete="off" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" placeholder="Booking Date">
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Booking Due Date <span style="color:red">*</span></label>
                                    <input type="text" value="{{ $q_detail->booking_due_date }}" name="quote[{{ $key }}][booking_due_date]" autocomplete="off" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date" autocomplete="off">
                                    <span class="text-danger" role="alert"></span>
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Booking Reference</label>
                                    <input type="text" value="{{ $q_detail->booking_reference }}" name="quote[{{ $key }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $key }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Booking Method</label>
                                    <select name="quote[{{ $key }}][booking_method_id]" data-name="booking_method_id" id="quote_{{ $key }}_booking_method_id" class="form-control select2single booking-method-id @error('booking_method_id') is-invalid @enderror">
                                    <option value="">Select Booking Method</option>
                                    @foreach ($booking_methods as $booking_method)
                                        <option value="{{ $booking_method->id }}" {{ $q_detail->booking_method_id == $booking_method->id  ? "selected" : "" }}> {{ $booking_method->name }} </option>
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
                                    <option value="">Select Booked By {{  $q_detail->booked_by_id }}</option>
                                    @foreach ($booked_by as $book_id)
                                        <option value="{{ $book_id->id }}" {{ $q_detail->booked_by_id == $book_id->id  ? "selected" : "" }}> {{ $book_id->name }} </option>
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
                                        <option value="{{ $booking_type->id }}" {{ $q_detail->booking_type_id == $booking_type->id  ? "selected" : "" }}> {{ $booking_type->name }} </option>
                                    @endforeach
                                    </select>
                                    @error('booking_type_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                </div>
                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label> Supplier Currency <span style="color: red">*</span></label>
                                    <select name="quote[{{ $key }}][supplier_currency_id]" data-name="supplier_currency_id" id="quote_{{ $key }}_supplier_currency_id" class="form-control select2single   supplier-currency-id @error('currency_id') is-invalid @enderror">
                                    <option value="">Select Supplier Currency</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->id }}" data-code="{{ $currency->code }}" {{ $q_detail->supplier_currency_id == $currency->id  ? "selected" : "" }}  data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                                      <span class="input-group-text supplier-currency-code">{{ ($q_detail->getSupplierCurrency && $q_detail->getSupplierCurrency->count()) ? $q_detail->getSupplierCurrency->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail->estimated_cost) }}" name="quote[{{ $key }}][estimated_cost]" data-name="estimated_cost" id="quote_{{ $key }}_estimated_cost" class="form-control estimated-cost change">
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Markup Amount <span style="color:red">*</span></label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text supplier-currency-code">{{ ($q_detail->getSupplierCurrency && $q_detail->getSupplierCurrency->count()) ? $q_detail->getSupplierCurrency->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail->markup_amount) }}" name="quote[{{ $key }}][markup_amount]" data-name="markup_amount" id="quote_{{ $key }}_markup_amount" class="form-control markup-amount change" >
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Markup % <span style="color:red">*</span></label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text supplier-currency-code">{{ ($q_detail->getSupplierCurrency && $q_detail->getSupplierCurrency->count()) ? $q_detail->getSupplierCurrency->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail->markup_percentage) }}" name="quote[{{ $key }}][markup_percentage]" data-name="markup_percentage" id="quote_{{ $key }}_markup_percentage" class="form-control markup-percentage change" value="0.00">
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
                                      <span class="input-group-text supplier-currency-code">{{ ($q_detail->getSupplierCurrency && $q_detail->getSupplierCurrency->count()) ? $q_detail->getSupplierCurrency->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail->selling_price) }}" name="quote[{{ $key }}][selling_price]" data-name="selling_price" id="quote_{{ $key }}_selling_price" class="form-control selling-price hide-arrows" value="0.00" readonly>
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Profit % <span style="color:red">*</span></label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($q_detail->getSupplierCurrency && $q_detail->getSupplierCurrency->count()) ? $q_detail->getSupplierCurrency->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail->profit_percentage) }}" name="quote[{{ $key }}][profit_percentage]" data-name="profit_percentage" id="quote_{{ $key }}_profit_percentage" class="form-control profit-percentage hide-arrows" value="0.00" readonly>
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
                                        <span class="input-group-text booking-currency-code">{{ ($q_detail->getSupplierCurrency && $q_detail->getSupplierCurrency->count()) ? $q_detail->getSupplierCurrency->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($q_detail->estimated_cost_bc) }}" name="quote[{{ $key }}][estimated_cost_in_booking_currency]" data-name="estimated_cost_in_booking_currency" id="quote_{{ $key }}_estimated_cost_in_booking_currency" class="form-control estimated-cost-in-booking-currency" value="0.00" readonly>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  <div class="form-group">
                                      <label>Selling Price in Booking Currency <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text booking-currency-code">{{ ($quote->getCurrency && $quote->getCurrency->count()) ? $quote->getCurrency->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($q_detail->selling_price_bc) }}" name="quote[{{ $key }}][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_{{ $key }}_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Markup Amount in Booking Currency <span style="color:red">*</span></label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text booking-currency-code">{{ ($quote->getCurrency && $quote->getCurrency->count()) ? $quote->getCurrency->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail->markup_amount_bc) }}" name="quote[{{ $key }}][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_{{ $key }}_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly> 
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2 d-flex justify-content-center">
                                <div class="form-group">
                                    <label>Added in Sage</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="icheck-primary">
                                        <input type="hidden" name="quote[{{ $key }}][added_in_sage]"  value="{{ $q_detail->added_in_sage }}">
                                        <input data-name="added_in_sage" {{ ($q_detail->added_in_sage == 1)? 'checked': null }} id="quote_{{ $key }}_added_in_sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"> 
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Service Details</label>
                                    <textarea name="quote[{{ $key }}][service_details]" data-name="service_details" id="quote_{{ $key }}_service_details" class="form-control service-details" rows="2" placeholder="Enter Service Details">{{ $q_detail->service_details }}</textarea>
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Comments</label>
                                    <textarea name="quote[{{ $key }}][comments]" data-name="comments" id="quote_{{ $key }}_comments" class="form-control comments" rows="2" placeholder="Enter Comments">{{ $q_detail->comments }}</textarea>
                                </div>
                                </div>
                            </div>{{-- ?>>>rown end --}}
                        </div>
                    @endforeach
                  </div>
                  
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Total Net Price</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" name="total_net_price" step="any" class="form-control total-net-price hide-arrows" step="any" min="0"  value="{{ \Helper::number_format($quote->net_price) }}" readonly>
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
                            <span class="input-group-text booking-currency-code">{{ ($quote->getCurrency && $quote->getCurrency->count()) ? $quote->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" value="{{ \Helper::number_format($quote->markup_amount) }}"  step="any" class="form-control total-markup-amount hide-arrows" step="any" min="0" name="total_markup_amount" value="0.00" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          {{-- <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div> --}}
                          <input type="number" value="{{ \Helper::number_format($quote->markup_percent) }}"  step="any" class="form-control total-markup-percent hide-arrows" min="0" name="total_markup_percent" value="0.00" readonly>
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
                            <span class="input-group-text booking-currency-code">{{ ($quote->getCurrency && $quote->getCurrency->count()) ? $quote->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" value="{{ \Helper::number_format($quote->selling_price) }}" step="any" name="total_selling_price" class="form-control total-selling-price hide-arrows" min="0.00" step="any"  value="0.00" readonly>
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
                            <span class="input-group-text booking-currency-code">{{ ($quote->getCurrency && $quote->getCurrency->count()) ? $quote->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" value="{{ \Helper::number_format($quote->profit_percentage) }}" step="any" name="total_profit_percentage" class="form-control total-profit-percentage hide-arrows" min="0" step="any" value="0.00" readonly>
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
                          <input type="number" step="any" name="commission_amount" class="form-control commission-amount hide-arrows" min="0" step="any" value="{{ \Helper::number_format($quote->commission_amount) }}" readonly>
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
                           <option value="{{ $currency->code }}" {{ ($quote->selling_currency_oc == $currency->code)? 'selected':NULL }} data-image="data:image/png;base64, {{$currency->flag}}" > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                            <span class="input-group-text selling-price-other-currency-code">{{ isset($quote->selling_currency_oc) && !empty($quote->selling_currency_oc) ? $quote->selling_currency_oc : '' }}</span>
                          </div>
                          <input type="number" value="{{ \Helper::number_format($quote->selling_price_ocr) }}" step="any" name="selling_price_other_currency_rate" min="0" step="any" class="form-control selling-price-other-currency-rate hide-arrows" value="0.00" readonly>
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
                            <span class="input-group-text selling-price-other-currency-code">{{ isset($quote->selling_currency_oc) && !empty($quote->selling_currency_oc) ? $quote->selling_currency_oc : '' }}</span>
                          </div>
                          <input type="number" value="{{ \Helper::number_format($quote->amount_per_person) }}" step="any" class="form-control booking-amount-per-person hide-arrows" step="any" min="0" name="booking_amount_per_person" value="0.00" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
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