<div class="row">
    <div class="col-md-12 text-right mb-2 p-1">
      <button type="button" class="btn btn-sm btn-outline-dark mr-2 expand-all-btn" >Expand All</button>
      <button type="button" class="btn btn-sm btn-outline-dark mr-2 collapse-all-btn" >Collapse All</button>
    </div>
  </div>

  <div class="sortable sortable-spacing">
    @foreach ($template->getDetails()->get() as $key  => $q_detail )
      <div class="quote card card-default quote-{{$key}}" data-key="{{$key}}">

        <div class="card-header">
          <h3 class="card-title card-title-style quote-title">
            <span class="badge badge-info badge-date-of-service">{{ isset($q_detail->date_of_service) && !empty($q_detail->date_of_service) ? $q_detail->date_of_service : '' }}</span>
            <span class="badge badge-info badge-time-of-service">{{ isset($q_detail->time_of_service) && !empty($q_detail->time_of_service) ? $q_detail->time_of_service : '' }}</span>
            <span class="badge badge-info badge-category-id">{{ isset($q_detail->getCategory->name) && !empty($q_detail->getCategory->name) ? $q_detail->getCategory->name : '' }}</span>
            <span class="badge badge-info badge-supplier-id">{{ isset($q_detail->getSupplier->name) && !empty($q_detail->getSupplier->name) ? $q_detail->getSupplier->name : ''}}</span>
            <span class="badge badge-info badge-product-id">{{ isset($q_detail->getProduct->name) && !empty($q_detail->getProduct->name) ? $q_detail->getProduct->name : '' }}</span>
            <span class="badge badge-info badge-supplier-currency-id">{{ isset($q_detail->getSupplierCurrency->name) && !empty($q_detail->getSupplierCurrency->name) ? $q_detail->getSupplierCurrency->code.' - '.$q_detail->getSupplierCurrency->name : '' }}</span>
          </h3>
          <div class="card-tools">
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 add-new-service-below" ><i class="fas fa-plus"></i> &nbsp; Add New Service</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 collapse-expand-btn" title="Minimize/Maximize" data-card-widget="collapse"><i class="fas fa-minus"></i></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 remove remove-quote-detail-service" title="Remove"><i class="fas fa-times"></i></a>
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
              <button data-show="calladdmediaModal" type="button" class="float-right btn btn-dark addmodalforquote" data-toggle="modal" data-target=".exampleModalCenter"><i class="fa fa-upload" aria-hidden="true"></i></button>
            </div>
          </div>

          <div class="row">

            <div class="col-sm-2">
              <div class="form-group">
                <label>Date of Service <span style="color:red">*</span></label>
                <input type="text" value="{{ $q_detail->date_of_service }}" name="quote[{{ $key }}][date_of_service]" data-name="date_of_service" id="quote_{{ $key }}_date_of_service" class="form-control date-of-service datepicker checkDates bookingDateOfService"  placeholder="DD/MM/YYYY" autocomplete="off">
                <span class="text-danger" role="alert"></span>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label>End Date of Service <span style="color:red">*</span></label>
                <input type="text" placeholder="DD/MM/YYYY" value="{{ $q_detail->end_date_of_service }}" name="quote[{{ $key }}][end_date_of_service]" data-name="end_date_of_service" id="quote_{{ $key }}_end_date_of_service" class="form-control end-date-of-service bookingEndDateOfService datepicker" autocomplete="off">
                <span class="text-danger" role="alert"></span>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label>Number of Nights</label>
                <input type="text" name="quote[{{ $key }}][number_of_nights]" value="{{ $q_detail->number_of_nights }}" id="quote_{{ $key }}_number_of_nights" class="form-control number-of-nights" readonly>
                <span class="text-danger" role="alert"></span>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label>Time of Service</label>
                <input type="time" value="{{ $q_detail->time_of_service }}" name="quote[{{ $key }}][time_of_service]" data-name="time_of_service" id="quote_{{ $key }}_time_of_service" class="form-control time-of-service" placeholder="Time of Service" autocomplete="off">
              </div>
            </div>

            <div class="col-sm-2 d-none">
              <div class="form-group">
                <label>Quote Detail ID</label>
                <input type="text" value="{{ $q_detail->id }}" name="quote[{{ $key }}][detail_id]"  id="quote_{{ $key }}_detail_id"  class="form-control detail-id">
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label>Category <span style="color:red">*</span></label>

                <select name="quote[{{ $key }}][category_id]" data-name="category_id" id="quote_{{ $key }}_category_id" class="form-control select2single category-select2 category-id @error('category_id') is-invalid @enderror">
                <option value="">Select Category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" data-slug="{{ $category->slug }}" data-name="{{ $category->name }}" {{ ($q_detail->category_id == $category->id)? 'selected' : NULL}} > {{ $category->name }} </option>
                  @endforeach
                </select>

                <span class="text-danger" role="alert"></span>
              </div>
            </div>

            {{-- @php
              $supplier_url = \Helper::getSupplierRateSheetUrl($q_detail->supplier_id, $template->season_id);
              $url          = !empty($supplier_url) ? $supplier_url : '';
              $text         = !empty($supplier_url) ? "(View Rate Sheet)" : '';
            @endphp --}}

            <div class="col-sm-2">
              <div class="form-group">
                <label>
                  Supplier <span style="color:red">*</span>
                  {{-- <a href="{{ $url }}" target="_blank" class="ml-1 view-supplier-rate">{{ $text }}</a> --}}
                </label>
                <select name="quote[{{ $key }}][supplier_id]" data-name="supplier_id" id="quote_{{ $key }}_supplier_id" class="form-control select2single supplier-id @error('supplier_id') is-invalid @enderror">
                    <option value="">Select Supplier</option>
                    @if(isset($q_detail->getCategory) && $q_detail->getCategory->getSupplier)
                        @foreach ($q_detail->getCategory->getSupplier as $supplier )
                        <option value="{{ $supplier->id }}" data-name="{{ $supplier->name }}" {{ ($q_detail->supplier_id == $supplier->id)? 'selected' : NULL}}  >{{ $supplier->name }}</option>
                        @endforeach
                    @endif
                </select>
                <span class="text-danger" role="alert"></span>
              </div>
            </div>

            <div class="col-sm-2 d-none">
              <div class="form-group">
                <label>Category Details</label>
                <input type="text" name="quote[{{ $key }}][category_details]" value="@if(isset($q_detail->getCategory->quote) && isset($q_detail->getCategory->quote) == 1)@if(empty($q_detail->category_details) || is_null($q_detail->category_details)){{ $q_detail->getCategory->feilds }}@else{{$q_detail->category_details}}@endif @endif" id="quote_{{ $key }}_category_details" class="form-control category-details">
                <span class="text-danger" role="alert"></span>
              </div>
            </div>

            {{-- <div class="col-sm-2">
              <div class="form-group">
                <label>Product</label>
                <input type="text" name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control product-id " value="{{ $q_detail->product_id }}" placeholder="Enter Product">
              </div>
            </div> --}}

            <div class="col-sm-1 justify-content-center quote-category-detail-btn-parent {{ isset($q_detail->getCategory->quote) && ($q_detail->getCategory->quote == 0) ? 'd-none' : 'd-flex' }}">
                <div class="form-group ">
                  <button type="button" data-id="{{ $q_detail->id }}" class="add-category-detail btn btn-dark float-right mt-1"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label>Product <a href="javascript:void(0)" class="ml-1 add-new-product"> ( Add New Product ) </a></label>
                <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control  select2single   product-id @error('product_id') is-invalid @enderror">
                  <option value="">Select Product</option>
                  @if(isset($q_detail->getSupplier) && $q_detail->getSupplier->getProducts)
                    @foreach ($q_detail->getSupplier->getProducts as  $product)
                      <option value="{{ $product->id }}" data-name="{{ $product->name }}" {{ ($q_detail->product_id == $product->id)? 'selected' : NULL}}>{{ $product->name }}</option>
                    @endforeach
                  @endif
                </select>
                <span class="text-danger" role="alert"></span>
              </div>
            </div>

            {{-- <div class="col-sm-2">
              <div class="form-group">
                <label>Product <a href="javascript:void(0)" class="ml-1 add-new-product"> ( Add New Product ) </a></label>
                <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id"  class="form-control select2single  product-id @error('product_id') is-invalid @enderror">
                  <option value="">Select Product</option>
                  @if(isset($q_detail->getCategory->getSupplier->getProducts) && !empty($q_detail->getCategory->getSupplier->getProducts))
                    @foreach ($q_detail->getCategory->getSupplier->getProducts as $product )
                      <option value="{{ $product->id }}" data-name="{{ $product->name }}"  {{ ($q_detail->product_id == $product->id) ? 'selected' : NULL }} >{{ $product->name }}</option>
                    @endforeach
                  @endif
                </select>

                <span class="text-danger" role="alert"></span>
              </div>
            </div> --}}

            {{-- <div class="col-sm-2">
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
            </div> --}}

            {{-- <div class="col-sm-2">
              <div class="form-group">
                <label>Booking Date</label>
                <input type="text" value="{{ $q_detail->booking_date }}" name="quote[{{ $key }}][booking_date]" autocomplete="off" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" placeholder="Booking Date">
              </div>
            </div> --}}

            {{-- <div class="col-sm-2">
              <div class="form-group">
                <label>Booking Due Date <span style="color:red">*</span></label>
                <input type="text" value="{{ $q_detail->booking_due_date }}" name="quote[{{ $key }}][booking_due_date]" autocomplete="off" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date" autocomplete="off">
                <span class="text-danger" role="alert"></span>
              </div>
            </div> --}}

            {{-- <div class="col-sm-2">
              <div class="form-group">
                <label>Booking Reference</label>
                <input type="text" value="{{ $q_detail->booking_reference }}" name="quote[{{ $key }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $key }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
              </div>
            </div> --}}

            {{-- <div class="col-sm-2">
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
            </div> --}}

            {{-- <div class="col-sm-2">
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
            </div> --}}

            <div class="col-sm-2">
              <div class="form-group">
                <label>Booking Types</label>
                <select name="quote[{{ $key }}][booking_type_id]" data-name="booking_type_id" id="quote_{{ $key }}_booking_type_id" class="form-control select2single   booking-type-id @error('booking_type_id') is-invalid @enderror">
                  <option value="">Select Booking Type</option>
                  @foreach ($booking_types as $booking_type)
                    <option value="{{ $booking_type->id }}" data-slug="{{ $booking_type->slug }}" {{ $q_detail->booking_type_id == $booking_type->id  ? "selected" : "" }}> {{ $booking_type->name }} </option>
                  @endforeach
                </select>

                @error('booking_type_id')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>
            </div>

            <div class="col-sm-2 refundable-percentage-feild {{ isset($q_detail->booking_type_id) && !empty($q_detail->booking_type_id) && $q_detail->booking_type_id == 2 ? '' : 'd-none'  }}">
              <div class="form-group">
                <label>Refundable % <span style="color:red">*</span></label>
                <input type="number" name="quote[{{ $key }}][refundable_percentage]" value="{{ $q_detail->refundable_percentage }}" data-name="refundable_percentage" id="quote_{{ $key }}_refundable_percentage" class="form-control refundable-percentage" placeholder="Refundable %">
                <span class="text-danger" role="alert"></span>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label> Supplier Currency <span style="color: red">*</span></label>
                <select name="quote[{{ $key }}][supplier_currency_id]" data-name="supplier_currency_id" id="quote_{{ $key }}_supplier_currency_id" class="form-control select2single   supplier-currency-id @error('currency_id') is-invalid @enderror">
                  <option value="">Select Supplier Currency</option>
                  @foreach ($currencies as $currency)
                    <option value="{{ $currency->id }}" data-name="{{ $currency->code.' - '.$currency->name }}" data-code="{{ $currency->code }}" {{ $q_detail->supplier_currency_id == $currency->id  ? "selected" : "" }}  data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
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
                  <input type="number" step="any" value="{{ \Helper::number_format($q_detail->estimated_cost) }}" name="quote[{{ $key }}][estimated_cost]" data-name="estimated_cost" id="quote_{{ $key }}_estimated_cost" class="form-control estimated-cost change-calculation remove-zero-values" min="0">
                </div>
              </div>
            </div>

            <div class="col-sm-2 whole-markup-feilds {{ $template->markup_type == 'whole' ? 'd-none' : '' }}">
              <div class="form-group">
                <label>Markup Amount <span style="color:red">*</span></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text supplier-currency-code">{{ ($q_detail->getSupplierCurrency && $q_detail->getSupplierCurrency->count()) ? $q_detail->getSupplierCurrency->code : '' }}</span>
                  </div>
                  <input type="number" step="any" value="{{ \Helper::number_format($q_detail->markup_amount) }}" name="quote[{{ $key }}][markup_amount]" data-name="markup_amount" id="quote_{{ $key }}_markup_amount" class="form-control markup-amount change-calculation remove-zero-values" min="0">
                </div>
              </div>
            </div>

            <div class="col-sm-2 whole-markup-feilds {{ $template->markup_type == 'whole' ? 'd-none' : '' }}">
              <div class="form-group">
                <label>Markup % <span style="color:red">*</span></label>
                <div class="input-group">
                  <input type="number" step="any" value="{{ \Helper::number_format($q_detail->markup_percentage) }}" name="quote[{{ $key }}][markup_percentage]" data-name="markup_percentage" id="quote_{{ $key }}_markup_percentage" class="form-control markup-percentage change-calculation remove-zero-values" min="0" value="0.00">
                  <div class="input-group-append">
                      <div class="input-group-text">%</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-2 whole-markup-feilds {{ $template->markup_type == 'whole' ? 'd-none' : '' }}">
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

            <div class="col-sm-2 whole-markup-feilds {{ $template->markup_type == 'whole' ? 'd-none' : '' }}">
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

            <div class="col-sm-3">
              <div class="form-group">
                <label>Estimated Cost in Booking Currency <span style="color:red">*</span></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text booking-currency-code">{{ ($template->getCurrency && $template->getCurrency->count()) ? $template->getCurrency->code : '' }}</span>
                  </div>
                  <input type="number" step="any" value="{{ \Helper::number_format($q_detail->estimated_cost_bc) }}" name="quote[{{ $key }}][estimated_cost_in_booking_currency]" data-name="estimated_cost_in_booking_currency" id="quote_{{ $key }}_estimated_cost_in_booking_currency" class="form-control estimated-cost-in-booking-currency" value="0.00" readonly>
                </div>
              </div>
            </div>

            <div class="col-sm-3 whole-markup-feilds {{ $template->markup_type == 'whole' ? 'd-none' : '' }}">
              <div class="form-group">
                <label>Markup Amount in Booking Currency <span style="color:red">*</span></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text booking-currency-code">{{ ($template->getCurrency && $template->getCurrency->count()) ? $template->getCurrency->code : '' }}</span>
                  </div>
                  <input type="number" step="any" value="{{ \Helper::number_format($q_detail->markup_amount_bc) }}" name="quote[{{ $key }}][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_{{ $key }}_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly>
                </div>
              </div>
            </div>

            <div class="col-sm-3 whole-markup-feilds {{ $template->markup_type == 'whole' ? 'd-none' : '' }}">
              <div class="form-group">
                <label>Selling Price in Booking Currency <span style="color:red">*</span></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text booking-currency-code">{{ ($template->getCurrency && $template->getCurrency->count()) ? $template->getCurrency->code : '' }}</span>
                  </div>
                  <input type="number" step="any" value="{{ \Helper::number_format($q_detail->selling_price_bc) }}" name="quote[{{ $key }}][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_{{ $key }}_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
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
                          <input type="hidden" name="quote[{{ $key }}][added_in_sage]" value="{{ $q_detail->added_in_sage }}"><input data-name="added_in_sage" id="quote_{{ $key }}_added_in_sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($q_detail->added_in_sage == 1) ? 'checked': '' }}>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
            @endif --}}

            <div class="col-sm-3">
              <div class="form-group">
                <label>Internal Comments 
                    {{-- <a href="javascript:void(0)" class="ml-1 insert-quick-text"> ( Insert Quick Text ) </a> --}}
                </label>
                <textarea name="quote[{{ $key }}][comments]" data-name="comments" id="quote_{{ $key }}_comments" class="form-control comments" rows="2" placeholder="Enter Comments">{{ $q_detail->comments }}</textarea>
              </div>
            </div>

            <div class="col-sm-2">
              <label>Add Stored Text</label>
              <div class="form-group">
                <button type="button" data-show="callStoredTextModal" class="mr-3 btn btn-outline-dark addmodalforquote" data-toggle="modal">Add Stored Text</button>
                <div class="modal fade callStoredTextModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  @include('partials.template_store_text_modal')
                </div>
              </div>
            </div> <!--col-md-2-->

          </div>
        </div>

      </div>
    @endforeach
  </div>

  <div class="parent-spinner text-gray spinner-border-sm "></div>