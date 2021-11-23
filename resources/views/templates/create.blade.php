@extends('layouts.app')

@section('title', 'Add Template')

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
            <h4>Add Template</h4>
          </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item active">Template Management</li>
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
                <h3 class="card-title text-center">Template Form</h3>
              </div>
            
              <form method="POST" action="{{ route('templates.store') }}" id="create_template"> @csrf
                <div class="card-body">

                  <div class="row p-3">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Template Name <span style="color:red">*</span></label>
                        <input type="text" name="template_name" id="template_name" class="form-control" placeholder="Template name">
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Booking Season <span style="color:red">*</span></label>
                        <select name="season_id" id="season_id" class="form-control select2single" >
                          <option value="">Select Booking Season</option>
                          @foreach ($seasons as $season)
                            <option data-start="{{ $season->start_date }}" data-end="{{ $season->end_date }}" value="{{ $season->id }}" {{ old('season_id') == $season->id  ? "selected" : "" }}> {{ $season->name }} </option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Booking Currency <span style="color:red">*</span></label>
                        <select name="currency_id" id="currency_id" class="form-control select2single booking-currency-id" >
                          <option value="">Select Booking Currency</option>
                          @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}" >  &nbsp; {{$currency->code}} - {{$currency->name}}  </option>
                          @endforeach
                        </select>
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
                        <label>Markup Type <span style="color:red">*</span></label>
                        <div>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="markup_type" value="itemised" class="markup-type" {{ (Auth::user()->markup_type == 'itemised') ? 'checked': '' }} >
                            <span>&nbsp;Itemised Markup </span>
                          </label>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="markup_type" value="whole" class="markup-type" {{ (Auth::user()->markup_type == 'whole') ? 'checked': '' }} >
                            <span>&nbsp;Whole Markup</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row d-none">
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Quote Detail Model Name</label>
                        <input type="text" value="QuoteDetail" name="model_name" id="model_name" class="form-control model-name">
                      </div>
                    </div>
                  </div>


                  <div class="parent" id="parent">
                    <div class="row">
                      <div class="col-md-12 text-right mb-2 p-1">
                        <button type="button" class="btn btn-sm btn-outline-dark mr-2 expand-all-btn" >Expand All</button>
                        <button type="button" class="btn btn-sm btn-outline-dark mr-2 collapse-all-btn" >Collapse All</button>
                      </div>
                    </div>
                    <div class="sortable sortable-spacing">
                      <div class="quote card card-default quote-0" data-key="0">

                        <div class="card-header">
                          <h3 class="card-title card-title-style quote-title"></h3>
                          <h3 class="card-title card-title-style quote-title">
                            <span class="badge badge-info badge-date-of-service"></span>
                            <span class="badge badge-info badge-time-of-service"></span>
                            <span class="badge badge-info badge-category-id"></span>
                            <span class="badge badge-info badge-supplier-id"></span>
                            <span class="badge badge-info badge-product-id"></span>
                            <span class="badge badge-info badge-supplier-currency-id"></span>
                          </h3>

                          <div class="card-tools">
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 add-new-service-below" ><i class="fas fa-plus"></i> &nbsp; Add New Service</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 collapse-expand-btn" title="Minimize/Maximize" data-card-widget="collapse"><i class="fas fa-minus"></i></a>
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
                                <input type="text" placeholder="DD/MM/YYYY"  name="quote[0][end_date_of_service]" data-name="end_date_of_service" id="quote_0_end_date_of_service" class="form-control end-date-of-service datepicker" autocomplete="off">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Number of Nights</label>
                                <input type="text" name="quote[0][number_of_nights]" id="quote_0_number_of_nights" class="form-control number-of-nights" readonly>
                                <span class="text-danger" role="alert"></span>
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
                                <label>Category <span style="color:red">*</span></label>
                                <select name="quote[0][category_id]" data-name="category_id" id="quote_0_category_id" class="form-control category-id select2single @error('category_id') is-invalid @enderror">
                                  <option selected value="">Select Category</option>
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" data-slug="{{ $category->slug }}" data-name="{{ $category->name }}"> {{ $category->name }} </option>
                                  @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>
                                  Supplier <span style="color:red">*</span>
                                  <a href="" target="_blank" class="ml-1 view-supplier-rate"></a>
                                </label>
                                <select name="quote[0][supplier_id]" data-name="supplier_id" id="quote_0_supplier_id" class="form-control supplier-id select2single @error('supplier_id') is-invalid @enderror">
                                  <option selected value="">Select Supplier</option>
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Product</label>
                                <select name="quote[0][product_id]" data-name="product_id" id="quote_0_product_id" class="form-control  select2single product-id @error('product_id') is-invalid @enderror">
                                  <option value="">Select Product</option>
                                </select>
                                @error('product_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div> --}}

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Product </label>
                                <select name="quote[0][product_id]" data-name="product_id" id="quote_0_product_id" class="form-control select2single  product-id @error('product_id') is-invalid @enderror">
                                  <option selected value="">Select Product</option>
                                </select>
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            <div class="col-sm-1 justify-content-center quote-category-detail-btn-parent d-none">
                              <div class="form-group ">
                                <button type="button" data-id="" class="add-category-detail btn btn-dark float-right mt-1"><i class="fa fa-plus" aria-hidden="true"></i></button>
                              </div>
                            </div>

                            <div class="col-sm-2 d-none">
                              <div class="form-group">
                                <label>Category Details</label>
                                <input type="text" name="quote[0][category_details]" value="" id="quote_0_category_details" class="form-control category-details">
                                <span class="text-danger" role="alert"></span>
                              </div>
                            </div>

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Product</label>
                                <input type="text" name="quote[0][product_id]" data-name="product_id" id="quote_0_product_id" class="form-control product-id" placeholder="Enter Product">
                              </div>
                            </div> --}}

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Supervisor</label>
                                <select name="quote[0][supervisor_id]" data-name="supervisor_id" id="quote_0_supervisor_id" class="form-control  select2single  supervisor-id @error('supervisor_id') is-invalid @enderror">
                                  <option value="">Select Supervisor</option>
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
                                <input type="text" name="quote[0][booking_date]" data-name="booking_date" id="quote_0_booking_date"  class="form-control booking-date datepicker bookingDate" placeholder="Booking Date" autocomplete="off">
                              </div>
                            </div> --}}

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Due Date <span style="color:red">*</span></label>
                                <input type="text" name="quote[0][booking_due_date]" data-name="booking_due_date" id="quote_0_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date" autocomplete="off">
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
                                  <option value="">Select Booking Method</option>
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
                                  <option value="">Select Booked By</option>
                                  @foreach ($booked_by as $booked_by)
                                    <option value="{{ $booked_by->id }}" > {{ $booked_by->name }} </option>
                                  @endforeach
                                </select>
                                @error('booked_by_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div> --}}

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Booking Types </label>
                                <select name="quote[0][booking_type_id]" data-name="booking_type_id" id="quote_0_booking_type_id" class="form-control select2single booking-type-id @error('booking_type_id') is-invalid @enderror">
                                  <option value="">Select Booking Type</option>
                                  @foreach ($booking_types as $booking_type)
                                    <option value="{{ $booking_type->id }}"> {{$booking_type->name}} </option>
                                  @endforeach
                                </select>

                                @error('booking_type_id')
                                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-sm-2 refundable-percentage-feild d-none">
                              <div class="form-group">
                                <label>Refundable % <span style="color:red">*</span></label>
                                <input type="number" name="quote[0][refundable_percentage]" data-name="refundable_percentage" id="quote_0_refundable_percentage" class="form-control refundable-percentage" placeholder="Refundable %">
                                <span class="text-danger" role="alert"></span>
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
                                  <input type="number" step="any" name="quote[0][estimated_cost]" data-name="estimated_cost" id="quote_0_estimated_cost" class="form-control estimated-cost change-calculation remove-zero-values" min="0" value="0.00">
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-2 whole-markup-feilds">
                              <div class="form-group">
                                <label>Markup Amount <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text supplier-currency-code"></span>
                                  </div>
                                  <input type="number" name="quote[0][markup_amount]" data-name="markup_amount" id="quote_0_markup_amount" class="form-control markup-amount change-calculation remove-zero-values" value="0.00" min="0" step="any">
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-2 whole-markup-feilds">
                              <div class="form-group">
                                <label>Markup % <span style="color:red">*</span></label>
                                <div class="input-group">
                                  <input type="number" step="any" name="quote[0][markup_percentage]" data-name="markup_percentage" id="quote_0_markup_percentage" class="form-control markup-percentage change-calculation remove-zero-values" min="0" value="0.00">
                                  <div class="input-group-append">
                                    <div class="input-group-text">%</div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-2 whole-markup-feilds">
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

                            <div class="col-sm-2 whole-markup-feilds">
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

                            <div class="col-sm-3 whole-markup-feilds">
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

                            <div class="col-sm-3 whole-markup-feilds">
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

                            {{-- <div class="col-sm-2">
                              <div class="form-group">
                                <label>Service Details</label>
                                <textarea name="quote[0][service_details]" data-name="service_details" id="quote_0_service_details" class="form-control service-details" rows="2" placeholder="Enter Service Details"></textarea>
                              </div>
                            </div> --}}
                          
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Internal Comments <a href="javascript:void(0)" class="ml-1 insert-quick-text"> ( Insert Quick Text ) </a></label>
                                <textarea name="quote[0][comments]" data-name="comments" id="quote_0_comments" class="form-control comments" rows="2" placeholder="Enter Comments"></textarea>
                              </div>
                            </div>
                              
                            <div class="col-sm-2">
                              <label>Add Stored Text</label>
                              <div class="form-group">
                                <button type="button" data-show="callStoredTextModal" class="mr-3 btn btn-outline-dark addmodalforquote" data-toggle="modal">Add Stored Text</button>
                                <div class="modal fade callStoredTextModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                  @include('partials.stored_text_modal')
                                </div>
                              </div>
                            </div> <!--col-md-2-->

                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="parent-spinner text-gray spinner-border-sm "></div>
                  </div>

                  <div class="row">
                    <div class="col-12 text-right">
                      <button type="button" id="add_more" class="btn btn-outline-dark  pull-right ">+ Add more </button>
                    </div>
                  </div>
                
                   
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success float-right">Submit</button>
                  <a href="{{ route('templates.index') }}" class="btn btn-outline-danger buttonSumbit float-right mr-3">Cancel</a>
                  
                </div>
              </form>

              <div id="overlay" class=""></div>
            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
  @include('partials.insert_quick_text',[ 'preset_comments' => $preset_comments ])
  @include('partials.category_detail_feilds')
  @include('partials.new_service_modal',['categories' => $categories, 'module_class' => 'quotes-service-category-btn' ])
  @include('partials.new_service_modal_below',['categories' => $categories, 'module_class' => 'quotes-service-category-btn-below' ])
@endsection

@push('js')

<script src="{{ asset('js/category/jquery-ui.js') }}"></script>
<script src="{{ asset('js/category/formRender.js') }}"></script>

<script>

  var quote  = '';
  var key  = '';
  var formRenderID  = "#build-wrap"; 
  
  $(document).on('click', '.category-detail-feilds-submit', function() {
    var data = JSON.stringify($(formRenderID).formRender("userData"));
    $(`#quote_${key}_category_details`).val(data);
  });

  $(document).on('click', '.add-category-detail', function() {

    quote                 = jQuery(this).closest('.quote');
    key                   = quote.data('key');
    var type              = $(`#quote_${key}_category_id`).find(':selected').data('slug');
    var category_name     = $(`#quote_${key}_category_id`).find(':selected').data('name');
    var category_id       = $(`#quote_${key}_category_id`).val();
    var booking_detail_id = $(this).attr('data-id');
    var url               = '{{route('bookings.category.detail.feilds')}}';
    var modal             = jQuery('.category-detail-feilds');
    var feilds_data       = $(`#quote_${key}_category_details`).val();

    if(typeof type === 'undefined') {
      alert("Please Select Category first");
      return;
    }

    jQuery(function($) {
      var formRenderOptions = {
        formData: feilds_data 
      }

      $(formRenderID).html("");
      $(formRenderID).formRender(formRenderOptions);

      if(feilds_data == ""){
        $(formRenderID).html("No Form Data.");
      }
    });

    modal.modal('show');
    modal.find('.modal-title').html(`${category_name} Details`);

    if(feilds_data == ""){
      modal.find('.modal-footer').addClass("d-none");
    }else{
      modal.find('.modal-footer').removeClass("d-none");
    }

  });

</script>
@endpush