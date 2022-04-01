<div class="modal fade" id="store_booking_cancellation_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cancel Booking</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST"  id="cancel_booking_submit">
          @csrf @method('patch')

          <div class="modal-body">

            <input type="hidden" name="booking_net_price" id="booking_net_price">
            <input type="hidden" name="booking_currency_id" id="booking_currency_id">
            <input type="hidden" name="booking_id" id="booking_id">
            <input type="hidden" name="action_type" id="action_type">

            <div class="form-group">
              <label>Cancellation Charges <span style="color:red">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="booking_currency_code"></span>
                </div>
                <input type="number" name="cancellation_charges" id="cancellation_charges" class="form-control cancellation-charges hide-arrows" placeholder="Cancellation Charges">
              </div>
              <span class="text-danger" role="alert"></span>
              <div id="booking_net_price_text" class="text-muted"></div>
            </div>


            <div class="form-group">
              <label>Cancellation Reason <span style="color:red">*</span></label>
              <textarea id="cancellation_reason" name="cancellation_reason" class="form-control hide-arrows"  placeholder="Enter Cancellation Reason" rows="2" cols="50"></textarea>
              <span class="text-danger" role="alert"></span>
            </div>
          </div>

    
          <div class="modal-footer justify-content-right">
            <button type="submit" class="btn btn-success">
              <span class="" role="status" aria-hidden="true"></span>
              Submit
            </button>

            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>


    <div id="overlay" class=""></div>
  </div>