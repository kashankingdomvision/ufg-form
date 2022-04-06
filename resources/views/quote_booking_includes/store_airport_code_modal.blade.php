<div class="modal fade" id="store_airport_code_modal" tabindex="-1" role="dialog" aria-labelledby="group-quote-modal-lable" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Airport</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form method="POST" id="store_airport_code_modal_form" action="{{ route('response.airport_codes.store') }}">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="model_name" value="" class="form-control">
                    <input type="hidden" name="category_id" value="" class="form-control">
                    <input type="hidden" name="detail_id"   value="" class="form-control">

                    <div class="form-group">
                        <label>Airport Name <span style="color:red">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Airport Name">
                        <span class="text-danger" role="alert"></span>
                      </div>
      
                      <div class="form-group">
                        <label>IATA Code <span style="color:red">*</span></label>
                        <input type="text" name="iata_code" id="iata_code" class="form-control" placeholder="IATA Code">
                        <span class="text-danger" role="alert"></span>
                      </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <span class=""></span>
                        &nbsp;Submit&nbsp;
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>