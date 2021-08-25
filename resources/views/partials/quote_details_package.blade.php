<div class="package border shadow mt-4" id="package{{ $pack_count }}" data-key="{{ $pack_count }}"> 
    <div class="quote" data-key="{{ $quote_count }}">
      <div class="row">
          
        <div class="col-sm-2">
          <div class="form-group">
            <label>Date of Service</label>
            <input type="text" placeholder="DD/MM/YYYY"  name="quote[{{ $quote_count }}][date_of_service]" data-name="date_of_service" id="quote_{{ $quote_count }}_date_of_service" class="form-control date-of-service datepicker  checkDates bookingDateOfService " autocomplete="off">
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Time of Service</label>
            <input type="time" name="quote[{{ $quote_count }}][time_of_service]" data-name="time_of_service" id="quote_{{ $quote_count }}_time_of_service" class="form-control"  autocomplete="off">
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Category</label>
            <select name="quote[{{ $quote_count }}][category_id]" data-name="category_id" id="quote_{{ $quote_count }}_category_id" class="form-control category-id select2single @error('category_id') is-invalid @enderror">
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
            <select name="quote[{{ $quote_count }}][supplier_id]" data-name="supplier_id" id="quote_{{ $quote_count }}_supplier_id" class="form-control supplier-id select2single @error('supplier_id') is-invalid @enderror">
              <option selected value="">Select Supplier</option>
            </select>

            @error('supplier_id')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Product</label>
            <select name="quote[{{ $quote_count }}][product_id]" data-name="product_id" id="quote_{{ $quote_count }}_product_id" class="form-control select2single  product-id @error('product_id') is-invalid @enderror">
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
            <select name="quote[{{ $quote_count }}][supervisor_id]" data-name="supervisor_id" id="quote_{{ $quote_count }}_supervisor_id" class="form-control select2single supervisor-id @error('supervisor_id') is-invalid @enderror">
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
            <input placeholder="DD/MM/YYYY" type="text" name="quote[{{ $quote_count }}][booking_date]" data-name="booking_date" id="quote_{{ $quote_count }}_booking_date"  class="form-control booking-date datepicker  bookingDate" autocomplete="off" >
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Booking Due Date <span class="text-danger">*</span></label>
            <input placeholder="DD/MM/YYYY" type="text" name="quote[{{ $quote_count }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $quote_count }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" autocomplete="off">
            <span class="text-danger" role="alert"></span>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Booking Reference</label>
            <input type="text" name="quote[{{ $quote_count }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $quote_count }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Booking Method</label>
            <select name="quote[{{ $quote_count }}][booking_method_id]" data-name="booking_method_id" id="quote_{{ $quote_count }}_booking_method_id" class="form-control select2single booking-method-id @error('booking_method_id') is-invalid @enderror">
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
            <select name="quote[{{ $quote_count }}][booked_by_id]" data-name="booked_by_id" id="quote_{{ $quote_count }}_booked_by_id" class="form-control select2single booked-by-id @error('booked_by_id') is-invalid @enderror">
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
            <select name="quote[{{ $quote_count }}][booking_type]" data-name="booking_type" id="quote_{{ $quote_count }}_booking_type" class="form-control select2single booking-type-id @error('booking_type_id') is-invalid @enderror">
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
            <label>Supplier Currency <span class="text-danger">*</span></label>
            <select name="quote[{{ $quote_count }}][supplier_currency_id]" data-name="supplier_currency_id" id="quote_{{ $quote_count }}_supplier_currency_id" class="form-control select2single supplier-currency-id @error('currency_id') is-invalid @enderror">
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
            <label>Estimated Cost <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text supplier-currency-code"></span>
              </div>
              <input type="number" step="any" name="quote[{{ $quote_count }}][estimated_cost]" data-name="estimated_cost" id="quote_{{ $quote_count }}_estimated_cost" class="form-control estimated-cost change" min="{{ $quote_count }}" value="{{ $quote_count }}.{{ $quote_count }}{{ $quote_count }}">
            </div>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Markup Amount <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text supplier-currency-code"></span>
              </div>
              <input type="number" name="quote[{{ $quote_count }}][markup_amount]" data-name="markup_amount" id="quote_{{ $quote_count }}_markup_amount" class="form-control markup-amount change" value="{{ $quote_count }}.{{ $quote_count }}{{ $quote_count }}" min="{{ $quote_count }}" step="any">
            </div>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Markup % <span class="text-danger">*</span></label>
            <div class="input-group">
              <input type="number" step="any" name="quote[{{ $quote_count }}][markup_percentage]" data-name="markup_percentage" id="quote_{{ $quote_count }}_markup_percentage" class="form-control markup-percentage change" min="{{ $quote_count }}" value="{{ $quote_count }}.{{ $quote_count }}{{ $quote_count }}">
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
                <span class="input-group-text supplier-currency-code">
                  {{-- <i class="fas fa-dollar-sign"></i> --}}
                </span>
              </div>
              <input type="number" step="any" name="quote[{{ $quote_count }}][selling_price]" data-name="selling_price" id="quote_{{ $quote_count }}_selling_price" class="form-control selling-price hide-arrows" value="{{ $quote_count }}.{{ $quote_count }}{{ $quote_count }}" readonly>
            </div>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Profit % <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text supplier-currency-code">
                  {{-- <i class="fas fa-dollar-sign"></i> --}}
                </span>
              </div>
              <input type="number" step="any" name="quote[{{ $quote_count }}][profit_percentage]" data-name="profit_percentage" id="quote_{{ $quote_count }}_profit_percentage" class="form-control profit-percentage hide-arrows" value="{{ $quote_count }}.{{ $quote_count }}{{ $quote_count }}" readonly>
              <div class="input-group-append">
                <div class="input-group-text">%</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <label>Estimated Cost in Booking Currency <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
              </div>
              <input type="number" step="any" name="quote[{{ $quote_count }}][estimated_cost_in_booking_currency]" data-name="estimated_cost_in_booking_currency" id="quote_{{ $quote_count }}_estimated_cost_in_booking_currency" class="form-control estimated-cost-in-booking-currency" value="{{ $quote_count }}.{{ $quote_count }}{{ $quote_count }}" readonly>
            </div>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <label>Selling Price in Booking Currency <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
              </div>
              <input type="number" step="any" name="quote[{{ $quote_count }}][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_{{ $quote_count }}_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="{{ $quote_count }}.{{ $quote_count }}{{ $quote_count }}" readonly>
            </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            <label>Markup Amount in Booking Currency <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
              </div>
              <input type="number" step="any" name="quote[{{ $quote_count }}][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_{{ $quote_count }}_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="{{ $quote_count }}.{{ $quote_count }}{{ $quote_count }}" readonly> 
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
                    <input type="hidden" name="quote[{{ $quote_count }}][added_in_sage]"  value="{{ $quote_count }}"><input data-name="added_in_sage" id="quote_{{ $quote_count }}_added_in_sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif

        <div class="col-sm-2">
          <div class="form-group">
            <label>Service Details</label>
            <textarea name="quote[{{ $quote_count }}][service_details]" data-name="service_details" id="quote_{{ $quote_count }}_service_details" class="form-control service-details" rows="2" placeholder="Enter Service Details"></textarea>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Comments</label>
            <textarea name="quote[{{ $quote_count }}][comments]" data-name="comments" id="quote_{{ $quote_count }}_comments" class="form-control comments" rows="2" placeholder="Enter Comments"></textarea>
          </div>
        </div>
      </div>
    </div>
      <input type="hidden" id="packageinput{{ $pack_count }}" name="packages[]" class="packageinput" value="1">
      
      <div class="row p-3 addmorebuttonrow">
        <div class="col-12 text-right">
          <button type="button" data-key="{{ $pack_count }}" class="mr-3 btn btn-outline-dark add_more pull-right">+ Add more </button>
        </div>
      </div>
  </div>