<div class="modal fade" id="dispute_booking_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Commission Dispute Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="dispute_commission_form">
          @csrf @method('patch')

          <div class="modal-body">
            <div class="form-group">
              <label>Dispute Detail <span style="color:red">*</span></label>
              <textarea id="dispute_detail" name="dispute_detail" class="form-control hide-arrows" placeholder="Enter Dispute Details" rows="2" cols="50"></textarea>
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