<div class="quote" data-key="{{$count}}">
    {{-- @if($loop->iteration > 1)
      <div class="row">
        <div class="col-sm-12"><button type="button" class="btn pull-right close"> x </button></div>
      </div>
    @endif --}}
    <div class="row"> {{-- ?>>>rowStart --}}


      <div class="col-sm-2">
        <div class="form-group">
          <label>Start Date of Service <span style="color:red">*</span></label>
          <input type="text" value="" name="quote[{{ $count }}][date_of_service]" data-name="date_of_service" id="quote_{{ $count }}_date_of_service" class="form-control date-of-service datepicker checkDates bookingDateOfService"  placeholder="Date of Service" autocomplete="off">
          <span class="text-danger" role="alert"></span>
        </div>
      </div>

      <div class="col-sm-2">
        <div class="form-group">
          <label>End Date of Service <span style="color:red">*</span></label>
          <input type="text" placeholder="DD/MM/YYYY" value="{{ $booking_detail->end_date_of_service }}" name="quote[{{ $count }}][end_date_of_service]" data-name="end_date_of_service" id="quote_{{ $count }}_end_date_of_service" class="form-control end-date-of-service datepicker" autocomplete="off">
          <span class="text-danger" role="alert"></span>
        </div>
      </div>

      <div class="col-sm-2">
        <div class="form-group">
          <label>Time of Service</label>
          <input type="time" value="{{ $booking_detail->time_of_service }}" name="quote[{{ $count }}][time_of_service]" data-name="time_of_service" id="quote_{{ $count }}_time_of_service" class="form-control" placeholder="Time of Service" autocomplete="off">
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Category <span style="color:red">*</span></label>
          <select name="quote[{{ $count }}][category_id]" data-name="category_id" id="quote_{{ $count }}_category_id" class="form-control  select2single  category- select2single  category-id @error('category_id') is-invalid @enderror">
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
            <select name="quote[{{ $count }}][supplier_id]" data-name="supplier_id" id="quote_{{ $count }}_supplier_id" class="form-control  select2single  supplier-id @error('supplier_id') is-invalid @enderror">
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

      <div class="col-sm-1 d-flex justify-content-center">
        <div class="form-group ">

          <div class="modal-parent">
            @include('partials.accomadation_modal')
            @include('partials.transfer_modal')
            @include('partials.service_excersion_modal')
          </div>
          <button type="button" class="add-category-detail btn btn-dark float-right mt-1"><i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
      </div>

      {{-- <div class="col-sm-2">
        <div class="form-group">
          <label>Product</label>
          <select name="quote[{{ $count }}][product_id]" data-name="product_id" id="quote_{{ $count }}_product_id" class="form-control  select2single   product-id @error('product_id') is-invalid @enderror">
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
          <input type="text" name="quote[{{ $count }}][product_id]"  data-name="product_id" id="quote_{{ $count }}_product_id" class="form-control product-id" value="{{ $booking_detail->product_id }}" placeholder="Enter Product">
        </div>
      </div>



      <div class="col-sm-2">
        <div class="form-group">
          <label>Supervisor</label>
          <select name="quote[{{ $count }}][supervisor_id]" data-name="supervisor_id" id="quote_{{ $count }}_supervisor_id" class="form-control   select2single   supervisor-id @error('supervisor_id') is-invalid @enderror">
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
          <input type="text" value="{{ $booking_detail->booking_date}}" name="quote[{{ $count }}][booking_date]" data-name="booking_date" id="quote_{{ $count }}_booking_date"  class="form-control booking-date datepicker bookingDate" placeholder="Booking Date">
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Booking Due Date <span style="color:red">*</span></label>
          <input type="text" value="{{ $booking_detail->booking_due_date }}" name="quote[{{ $count }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $count }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date">
          <span class="text-danger" role="alert"></span>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Booking Reference</label>
          <input type="text" value="{{ $booking_detail->booking_reference }}" name="quote[{{ $count }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $count }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Booking Method</label>
          <select name="quote[{{ $count }}][booking_method_id]" data-name="booking_method_id" id="quote_{{ $count }}_booking_method_id" class="form-control  select2single  booking-method-id @error('booking_method_id') is-invalid @enderror">
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
          <select name="quote[{{ $count }}][booked_by_id]" databooking="booked_by_id" id="quote_{{ $count }}_booked_by_id" class="form-control   select2single   booked-by-id @error('booked_by_id') is-invalid @enderror">
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
            <select name="quote[{{ $count }}][booking_type]" data-name="booking_type" id="quote_{{ $count }}_booking_type" class="form-control  select2single    booking-type-id @error('booking_type_id') is-invalid @enderror">
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
            <select name="quote[{{ $count }}][supplier_currency_id]" data-name="supplier_currency_id" id="quote_{{ $count }}_supplier_currency_id" class="form-control  select2single  supplier-currency-id @error('currency_id') is-invalid @enderror">
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
            <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->estimated_cost) }}" name="quote[{{ $count }}][estimated_cost]" data-name="estimated_cost" data-status="booking" id="quote_{{ $count }}_estimated_cost" class="form-control estimated-cost change" value="0.00">
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
            <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_amount) }}" name="quote[{{ $count }}][markup_amount]" data-name="markup_amount" id="quote_{{ $count }}_markup_amount" class="form-control markup-amount change" value="0.00" readonly>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Markup % <span style="color:red">*</span></label>
          <div class="input-group">
            <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_percentage) }}" name="quote[{{ $count }}][markup_percentage]" data-name="markup_percentage" id="quote_{{ $count }}_markup_percentage" class="form-control markup-percentage change" value="0.00" readonly>
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
            <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->selling_price) }}" name="quote[{{ $count }}][selling_price]" data-name="selling_price" id="quote_{{ $count }}_selling_price" class="form-control selling-price hide-arrows" value="0.00" readonly>
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
            <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->profit_percentage) }}" name="quote[{{ $count }}][profit_percentage]" data-name="profit_percentage" id="quote_{{ $count }}_profit_percentage" class="form-control profit-percentage hide-arrows" value="0.00" readonly>
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
            <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->estimated_cost_bc) }}" name="quote[{{ $count }}][estimated_cost_in_booking_currency]" data-name="estimated_cost_in_booking_currency" id="quote_{{ $count }}_estimated_cost_in_booking_currency" class="form-control estimated-cost-in-booking-currency"  readonly>
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
            <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->selling_price_bc) }}" name="quote[{{ $count }}][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_{{ $count }}_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
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
            <input type="number" step="any" value="{{ \Helper::number_format($booking_detail->markup_amount_bc) }}" name="quote[{{ $count }}][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_{{ $count }}_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly> 
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
                <input type="hidden" name="quote[{{ $count }}][added_in_sage]" value="{{ $booking_detail->added_in_sage }}"><input data-name="added_in_sage" id="quote_{{ $count }}_added_in_sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($booking_detail->added_in_sage == 1) ? 'checked': '' }}> 
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Service Details</label>
          <textarea name="quote[{{ $count }}][service_details]" data-name="service_details" id="quote_{{ $count }}_service_details" class="form-control service-details" rows="2" placeholder="Enter Service Details">{{ $booking_detail->service_details }}</textarea>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Comments</label>
          <textarea name="quote[{{ $count }}][comments]" data-name="comments" id="quote_{{ $count }}_comments" class="form-control comments" rows="2" placeholder="Enter Comments">{{ $booking_detail->comments }}</textarea>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
          <label>Invoice Upload</label>
          <input type="file" name="quote[{{ $count }}][invoice]" data-name="invoice" id="quote_{{ $count }}_inovice" class="form-control invoices hide-arrows" >
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
          <input type="number" value="{{ ($booking_detail->getBookingFinance && count($booking_detail->getBookingFinance) > 0) ? \Helper::number_format($booking_detail->outstanding_amount_left) : \Helper::number_format($booking_detail->estimated_cost)  }}" name="quote[{{ $count }}][outstanding_amount_left]" data-name="outstanding_amount_left" id="quote_{{ $count }}_outstanding_amount_left" class="form-control outstanding_amount_left hide-arrows" >
        </div>
      </div>
    </div>{{-- ?>>>rown end --}}


 
    <section class="finance">
        <h3 class="mt-2 mb-1-half">Payments</h3>
        <div class="row finance-clonning row-cols-lg-7 g-0 g-lg-2 mt-2" data-financekey="0">
            <div class="col-sm-3">
                <div class="form-group">
                <label class="depositeLabel" id="deposite_heading{{ $count }}">Payment #1</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                    </div>
                    <input type="number" name="quote[{{ $count }}][finance][0][deposit_amount]" data-name="deposit_amount" id="quote_{{$count}}_finance_0_deposit_amount" value="0.00" class="form-control deposit-amount hide-arrows" step="any">
                </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                <label>Due Date</label>
                <input type="date" name="quote[{{ $count }}][finance][0][deposit_due_date]" data-name="deposit_due_date" id="quote_{{$count}}_finance_0_deposit_due_date" value="" class="form-control deposit-due-date" >
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                <label>Paid Date</label>
                <input type="date" name="quote[{{ $count }}][finance][0][paid_date]" data-name="paid_date" id="quote_{{$count}}_finance_0_paid_date" value="" class="form-control paid-date" >
                </div>
            </div>

            <div class="col-2 d-flex justify-content-center">
                <div class="form-group">
                    <label>Calender</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="icheck-primary">
                                <input type="hidden" name="quote[{{ $count }}][finance][0][upload_to_calender]" value="0" ><input data-name="upload_to_calendar" id="quote_{{$count}}_finance_0_upload_to_calendar" class="checkbox" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"> 
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
                    <select  name="quote[{{ $count }}][finance][0][payment_method]" data-name="payment_method" id="quote_{{$count}}_finance_0_payment_method" class="form-control payment-method select2single" >
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
                        <input type="text"  name="quote[{{ $count }}][finance][0][ab_number_of_days]" step="any" name="ab_number_of_days" id="quote_{{$count}}_finance_0_ab_number_of_days" class="form-control ab_number_of_days"  size="10" value="0">
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
                        <input type="number" value="" name="quote[{{ $count }}][finance][0][outstanding_amount]" data-name="outstanding_amount" id="quote_{{$count}}_finance_0_outstanding_amount" value="0.00" class="form-control outstanding-amount hide-arrows" step="any" readonly>
                    </div>
                </div>
            </div>
            {{-- <div class="col-1">
                    <button type="button" onclick="this.closest('.finance-clonning').remove()" class="btn btn-sm btn-outline-dark">X</button>
            </div> --}}
        </div>
    </section>

    <section class="mt-1">
      <div class="row">
        <div class="col-12 text-right">
          <button type="button" data-key="0" class="clone_booking_finance float-right btn btn-dark btn-md {{ isset($total_deposit) && isset($booking_detail->estimated_cost) && ($total_deposit >= $booking_detail->estimated_cost) || ($booking_detail->getBookingRefundPayment) && (count($booking_detail->getBookingRefundPayment) > 0) || ($booking_detail->getBookingCreditNote) && (count($booking_detail->getBookingCreditNote) > 0) ? 'd-none' : ''}}">Add More Payments </button>
        </div>
      </div>
    </section>
</div>