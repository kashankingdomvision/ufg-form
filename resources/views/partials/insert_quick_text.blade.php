<div class="modal fade insert-quick-text-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('add.product.with.supplier.sync') }}"  method="POST"  id="form_add_product">
                @csrf 
                <div class="modal-header">
                    <h4 class="modal-title">Insert Quick Comment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                              <div>
                                <label class="radio-inline mr-1">
                                  <input type="radio" name="markup_type" value="I will Call you Later." class="quick-comment">
                                  <span>&nbsp; I will Call you Later. </span>
                                </label>
                              </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                              <div>
                                <label class="radio-inline mr-1">
                                  <input type="radio" name="markup_type" value="markup" class="quick-comment">
                                  <span>&nbsp; I will message you Later. </span>
                                </label>
                              </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="submit_add_product">OK</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel & Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
