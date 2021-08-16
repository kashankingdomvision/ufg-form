  <div class="modal fade" id="refund_to_bank_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('bookings.refund-to-bank') }}"  method="POST"  id="create_refund_to_bank">
                @csrf 
                <div class="modal-header">
                    <h4 class="modal-title">Refund Payments Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="cancel-payment-row else-here row-cols-lg-7 g-0 g-lg-2">
                    <input type="hidden" name="booking_detail_id" id="booking_detail_id">
                    <input type="hidden" name="total_deposit_amount" id="total_deposit_amount" class="total_deposit_amount">

                    <div class="form-group">
                      <label class="depositeLabel">Refund Amount <span style="color:red">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                        </div>
                        <input type="number" value="0.00" name="refund_amount" id="refund_amount" data-name="refund_amount" class="form-control refund_amount hide-arrows" step="any">
                      </div>
                      <span class="text-danger" role="alert"></span>
                    </div>
                
                    <div class="form-group">
                      <label>Refund Date <span style="color:red">*</span></label>
                      <input type="date" value="" name="refund_date" id="refund_date" class="form-control">
                      <span class="text-danger" role="alert"></span>
                    </div>
                  
                    <div class="form-group">
                      <label>Bank <span style="color:red">*</span></label>
                      <select name="bank" id="bank" data-name="bank"  class="form-control bank select2single" >
                        <option value="">Select Bank </option>
                        @foreach ($banks as $bank)
                          <option value="{{ $bank->id }}"> {{ $bank->name }} </option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  
                    <div class="form-group">
                      <label>Refund Confirmed By <span style="color:red">*</span></label>
                      <select name="refund_confirmed_by" id="refund_confirmed_by" data-name="refund_confirmed_by" class="form-control refund_confirmed_by select2single" >
                        <option value="">Select User</option>
                        @foreach ($sale_persons as $person)
                          <option  value="{{ $person->id }}">{{ $person->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                    
                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="loader_icon">
                      <span class="mr-2" role="status" aria-hidden="true"></span>
                      Submit
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
