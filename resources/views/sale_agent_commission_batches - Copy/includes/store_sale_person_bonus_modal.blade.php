<div class="modal fade" id="store_sale_person_bonus_modal">
    <div class="modal-dialog modal-default">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Bonus</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('pay_commissions.store_sale_person_bonus') }}" method="POST" id="store_sale_person_bonus_modal_form">
          @csrf @method('PATCH')
  
          <div class="modal-body">
            <input type="hidden" name="booking_id" value="" class="form-control booking-id hide-arrows" readonly>
  
            <div class="form-group">
              <label>Sale Person Bonus Amount <span style="color:red">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text sale-person-currency-code"></span>
                </div>
                <input type="text" name="sale_person_bonus_amount" id="sale_person_bonus_amount" value="" class="form-control sale-person-bonus-amount hide-arrows">
              </div>
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