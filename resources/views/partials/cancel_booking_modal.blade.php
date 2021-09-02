<div class="modal fade" id="cancel_booking">
    <div class="modal-dialog   modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Template Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

            <input type="text" name="booking_net_price" id="booking_net_price">
            <input type="text" name="booking_currency_id" id="booking_currency_id">

            <div class="form-group">
                <label>Cancellation Charges <span style="color:red">*</span></label>
                <input type="number" name="cancellation_charges" id="cancellation_charges" class="form-control cancellation-charges hide-arrows" placeholder="Cancellation Charges">
                <span class="text-danger" role="alert"></span>
                <h6 id="booking_net_price_text" class="text-muted ">With faded secondary text</h6>
          

            </div>

            <div class="form-group">
                <label>Cancellation Reason <span style="color:red">*</span></label>
                <textarea id="cancellation_reason" name="cancellation_reason" class="form-control hide-arrows"  placeholder="Enter Cancellation Reason" rows="4" cols="50"></textarea>
                <span class="text-danger" role="alert"></span>
            </div>

        </div>

  
        <div class="modal-footer justify-content-right">
            <button class="btn btn-primary" type="button" data-dismiss="modal">
              <span class="mr-2 " role="status" aria-hidden="true"></span>
              Submit
            </button>
  
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>

      </div>
    </div>


    <div id="overlay" class=""></div>
  </div>