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

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center">Quote Form</h3>
              </div>
            
              <div class="card-body">
                <form method="POST" action="{{ route('quotes.store') }}" id="quoteCreate" > @csrf
                  <div class="row mb-2">

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Rate Type <span style="color:red">*</span></label>
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
                    </div>

                    <div class="col-sm-6">
                      <label>Zoho Reference <span style="color:red">*</span></label>

                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" name="ref_no" id="ref_no" class="reference-name form-control" placeholder="Enter Reference Number" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                            <button class="btn btn-outline-secondary search-reference" type="button">Search</button>
                          </div>
                        </div>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Quote Reference <span style="color:red">*</span></label>
                        <input type="text" name="quote_no" class="form-control" value="{{ uniqid() }}" placeholder="Quote Reference Number" readonly>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Lead Passenger Name <span style="color:red">*</span></label>
                        <input type="text" name="lead_passenger" id="lead_passenger" class="form-control" placeholder="Lead Passenger Name" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Brand <span style="color:red">*</span></label>
                        <select name="brand_id" id="brand_id" class="form-control  getBrandtoHoliday  brand-id">
                          <option selected value="" >Select Brand</option>
                          @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id  ? "selected" : "" }}> {{ $brand->name }} </option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Type Of Holiday <span style="color:red">*</span></label>
                        <select name="holiday_type_id" id="holiday_type_id" class="form-control  appendHolidayType  holiday-type-id ">
                          <option selected value="">Select Type Of Holiday</option>
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Sales Person <span style="color:red">*</span></label>
                        <select name="sale_person_id" id="sale_person_id" class="form-control sales-person-id">
                          <option selected value="">Select Sales Person</option>
                          @foreach ($sale_persons as $person)
                            <option value="{{ $person->id }}">{{ $person->name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Booking Season <span style="color:red">*</span></label>
                        <select name="season_id" id="season_id" class="form-control scurrency-id">
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
                        <label>Agency Booking <span style="color:red">*</span></label>
                        <div>
                          <label class="radio-inline">
                            <input class="select-agency"  value="yes" type="radio" name="agency"> Yes
                          </label>
                          <label class="radio-inline">
                            <input  class="select-agency"  value="no" type="radio" name="agency" checked> No
                          </label>
                        </div>
                      </div>
                      <div class="row agency-columns mb-1">
                        
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Dinning Preferences <span style="color:red">*</span></label>
                        <input type="text" name="dinning_preference" id="dinning_preference" class="form-control" placeholder="Dinning Preferences" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Bedding Preferences <span style="color:red">*</span></label>
                        <input type="text" name="bedding_preference" id="bedding_preference" class="form-control " placeholder="Bedding Preferences" id="bedding_preference" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
              

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Booking Currency <span style="color:red">*</span></label>
                        <select name="currency_id" id="currency_id" class="form-control booking-currency-id @error('currency_id') is-invalid @enderror">
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
                        <label>Pax No. <span style="color:red">*</span></label>
                        <select name="pax_no" id="pax_no" class="form-control paxNumber pax-number @error('pax_no') is-invalid @enderror">
                          <option selected value="">Select Pax No</option>
                          @for($i=1;$i<=30;$i++)
                            <option value={{$i}} {{ old('pax_no') == $i || $i == 1 ? "selected" : "" }}>{{$i}}</option>
                          @endfor
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div id="appendPaxName" class="col-md-12"></div>
                  </div>
                  <div class="row">
                      <div class="col-md-3 offset-md-9">
                        <select name="template" id="tempalte_id" class="float-right form-control template">
                          <option  disabled selected value="">Select Template</option>
                          @foreach ($templates as $template)
                            <option  value="{{ encrypt($template->id) }}">{{ $template->title }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="parent" id="parent">
                    <div class="quote" data-key="0">
                      <div class="row">
                          
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Date of Service</label>
                             <input type="text" placeholder="DD/MM/YYYY"  name="quote[0][date_of_service]" data-name="date_of_service" id="quote_0_date_of_service" class="form-control date-of-service datepicker  checkDates bookingDateOfService " autocomplete="off">
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Time of Service</label>
                            <input type="time" name="quote[0][time_of_service]" data-name="time_of_service" id="quote_0_time_of_service" class="form-control" placeholder="Time of Service" autocomplete="off">
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Category</label>
                            <select name="quote[0][category_id]" data-name="category_id" id="quote_0_category_id" class="form-control category-id @error('category_id') is-invalid @enderror">
                              <option selected value="">Select Category</option>
                              @foreach ($categories as $category)
                                <option value="{{ $category->id }}" > {{ $category->name }} </option>
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
                            <select name="quote[0][supplier_id]" data-name="supplier_id" id="quote_0_supplier_id" class="form-control  supplier-id @error('supplier_id') is-invalid @enderror">
                              <option selected value="">Select Supplier</option>
                              {{-- <option value="1">Kashan Cammando</option> --}}
                            </select>

                            @error('supplier_id')
                              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Product</label>
                            <select name="quote[0][product_id]" data-name="product_id" id="quote_0_product_id" class="form-control   product-id @error('product_id') is-invalid @enderror">
                              <option selected value="">Select Product</option>
                            </select>
                            @error('product_id')
                              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Supervisor</label>
                            <select name="quote[0][supervisor_id]" data-name="supervisor_id" id="quote_0_supervisor_id" class="form-control    supervisor-id @error('supervisor_id') is-invalid @enderror">
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
                            <label>Booking Due Date</label>
                             <input placeholder="DD/MM/YYYY" type="text" name="quote[0][booking_due_date]" data-name="booking_due_date" id="quote_0_booking_due_date" class="form-control booking-due-date datepicker  checkDates bookingDueDate" autocomplete="off">
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
                            <select name="quote[0][booking_method_id]" data-name="booking_method_id" id="quote_0_booking_method_id" class="form-control  booking-method-id @error('booking_method_id') is-invalid @enderror">
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
                            <select name="quote[0][booked_by_id]" data-name="booked_by_id" id="quote_0_booked_by_id" class="form-control    booked-by-id @error('booked_by_id') is-invalid @enderror">
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
                            <select name="quote[0][booking_type]" data-name="booking_type" id="quote_0_booking_type" class="form-control    booking-type-id @error('booking_type_id') is-invalid @enderror">
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
                            <select name="quote[0][supplier_currency_id]" data-name="supplier_currency_id" id="quote_0_supplier_currency_id" class="form-control supplier-currency-id @error('currency_id') is-invalid @enderror">
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
                              <input type="number" step="any" name="quote[0][estimated_cost]" data-name="estimated_cost" id="quote_0_estimated_cost" class="form-control estimated-cost change" value="0.00">
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
                              <input type="number" name="quote[0][markup_amount]" data-name="markup_amount" id="quote_0_markup_amount" class="form-control markup-amount change" value="0.00" step="any">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Markup % <span style="color:red">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text supplier-currency-code"></span>
                              </div>
                              <input type="number" step="any" name="quote[0][markup_percentage]" data-name="markup_percentage" id="quote_0_markup_percentage" class="form-control markup-percentage change" value="0.00">
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
                            <label>Selling Price in Booking Currency <span style="color:red">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                              </div>
                              <input type="number" step="any" name="quote[0][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_0_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
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

                        <div class="col-sm-2 d-flex justify-content-center">
                          <div class="form-group">
                            <label>Added in Sage <span style="color:red">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="icheck-primary">
                                  <input type="hidden" name="quote[0][added_in_sage]"  value="0"><input data-name="added_in_sage" id="quote_0_added_in_sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"> 
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Service Details</label>
                            <textarea name="quote[0][service_details]" data-name="service_details" id="quote_0_service_details" class="form-control service-details" rows="2" placeholder="Enter Service Details"></textarea>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Comments</label>
                            <textarea name="quote[0][comments]" data-name="comments" id="quote_0_comments" class="form-control comments" rows="2" placeholder="Enter Comments"></textarea>
                          </div>
                        </div>

                      </div>

                    </div>
                
                  </div>

                  <div class="row">
                    <div class="col-12 text-right">
                      <button type="button" id="add_more" class="btn btn-outline-dark  pull-right ">+ Add more </button>
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
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" step="any" name="total_profit_percentage" class="form-control total-profit-percentage hide-arrows" min="0" step="any" value="0.00" readonly>
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
                        <label>Supplier Selling Price in Other Currency</label>
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
                      <div class="form-group mt-2">
                        <label></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text selling-price-other-currency-code"></span>
                          </div>
                          <input type="number" step="any" name="selling_price_other_currency_rate" min="0" step="any" class="form-control selling-price-other-currency-rate hide-arrows" value="0.00" readonly>
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
                            <span class="input-group-text selling-price-other-currency-code"></span>
                          </div>
                          <input type="number" step="any" class="form-control booking-amount-per-person hide-arrows" step="any" min="0" name="booking_amount_per_person" value="0.00" readonly>
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
