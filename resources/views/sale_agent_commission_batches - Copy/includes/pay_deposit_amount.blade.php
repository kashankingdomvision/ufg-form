<div class="modal fade" id="pay_deposit_amount_modal">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pay Deposit Amount</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
        <form action="{{ route('pay_commissions.pay_deposit_amount') }}" method="POST" id="pay_deposit_amount_modal_form">
            @csrf 

            <div class="modal-body">

                <div class="form-group">
                    <label>Sale Person ID</label>
                    <div class="input-group">
                        <input type="text" name="sale_person_id" id="sale_person_id" value="" class="form-control sale-person-id">
                    </div>
                </div>

                <div class="form-group">
                    <label>Sale Person Currency ID</label>
                    <div class="input-group">
                        <input type="text" name="sale_person_currency_id" id="sale_person_currency_id" value="" class="form-control sale-person-currency-id">
                    </div>
                </div>

                <div class="form-group">
                    <label>Sale Person</label>
                    <div class="input-group">
                        <input type="text" name="sale_person_name" id="sale_person_name" value="" class="form-control sale-person-name">
                    </div>
                </div>

                
                <div class="form-group">
                    <label>
                        Amount to Pay
                    </label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text sale-person-currency-code">{{ $sale_person_currency_code }}</span>
                        </div>
                        <input type="text" name="sale_person_deposit_amount" id="sale_person_deposit_amount" value="" data-type="currency" class="form-control deposit-amount hide-arrows">
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-success">
                    <span class="" role="status" aria-hidden="true"></span>
                        Pay
                    </button>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>