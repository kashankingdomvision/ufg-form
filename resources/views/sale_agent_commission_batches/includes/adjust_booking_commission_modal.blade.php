<div class="modal fade" id="adjust_booking_commission_modal">
    <div class="modal-dialog modal-default">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Adjust Commission</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('pay_commissions.adjust_commission') }}" method="POST" id="adjust_booking_commission_form">
          @csrf 

            <div class="modal-body">

                <input type="hidden" name="booking_currency_code" id="booking_currency_code" value="" class="form-control hide-arrows" readonly>
                <input type="hidden" name="sale_person_currency_code" id="sale_person_currency_code" value="" class="form-control hide-arrows" readonly>
                <input type="hidden" name="booking_id" id="booking_id" value="" class="form-control hide-arrows" readonly>
                <input type="hidden" name="batch_id" value="" class="batch-id form-control hide-arrows" readonly>

                <div class="form-group">
                    <label>Current Commission Amount <span style="color:red">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text sale-person-currency-code"></span>
                        </div>
                        <input type="text" name="current_commission_amount" id="current_commission_amount" value="" class="form-control current-commission-amount hide-arrows" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label>Adjust Commission Amount <span style="color:red">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text sale-person-currency-code"></span>
                        </div>
                        <input type="text" name="adjust_commission_amount" id="adjust_commission_amount" value="" class="form-control adjust-commission-amount hide-arrows">
                    </div>
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