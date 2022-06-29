<div class="modal fade" id="adjust_deposited_amount_modal">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adjust Deposit Amount</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="javascript:void(0);" method="POST" id="adjust_deposited_amount_modal_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label>
                            Amount to Pay
                        </label>

                        <div class="input-group d-none">
                            <div class="input-group-prepend">
                                <span class="input-group-text sale-person-currency-code"></span>
                            </div>
                            <input type="text" name="outstanding_amount" id="outstanding_amount" value="0.00" data-type="currency" class="form-control outstanding-amount hide-arrows">
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text sale-person-currency-code"></span>
                            </div>
                            <input type="text" name="adjust_total_deposit_amount" id="adjust_total_deposit_amount" value="0.00" data-type="currency" class="form-control remove-zero-values adjust-total-deposit-amount hide-arrows">
                        </div>
                    </div>
                </div>
                    
                <div class="modal-footer justify-content-right">
                    <button type="button" id="apply_adjust_total_deposit_amount" class="btn btn-success" data-dismiss="modal">
                        Apply
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>