<div class="modal fade" id="cancel_booking_service">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cancel Booking Service</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('bookings.cancel.booking') }}"  method="POST"  id="cancel_booking_submit">
          @csrf 

          <div class="modal-body">

            <input type="text" name="sc_total_deposit_amount" id="sc_total_deposit_amount">
            <input type="text" name="sc_supplier_currency_id" id="sc_supplier_currency_id">
       

            <div class="form-group">
              <label>Service Cancellation Charges <span style="color:red">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="sc_supplier_currency_code"></span>
                </div>
                <input type="number" name="service_cancellation_charges" id="service_cancellation_charges" class="form-control service-cancellation-charges hide-arrows" placeholder="Service Cancellation Charges">
              </div>
              <span class="text-danger" role="alert"></span>
              <div id="sc_service_cancellation_charges_text" class="text-muted"></div>
            </div>


            <div class="form-group">
              <label>Cancellation Reason <span style="color:red">*</span></label>
              <textarea id="service_cancellation_reason" name="service_cancellation_reason" class="form-control hide-arrows"  placeholder="Enter Service Cancellation Reason" rows="4" cols="50"></textarea>
              <span class="text-danger" role="alert"></span>
            </div>
          </div>

    
          <div class="modal-footer justify-content-right">
            {{-- <button type="submit" class="btn btn-primary"  id="submit_cancel_booking">
              <span class="mr-2 " role="status" aria-hidden="true"></span>
              Submit
            </button> --}}

            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>


    <div id="overlay" class=""></div>
  </div>