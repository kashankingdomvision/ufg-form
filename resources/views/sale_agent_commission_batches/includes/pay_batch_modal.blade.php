<div class="modal fade" id="pay_batch_modal">
    <div class="modal-dialog modal-default">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pay Batch</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('pay_commissions.pay_batch') }}" method="POST" id="pay_batch_modal_form">
          @csrf @method('patch')

          <input type="hidden" name="batch_id" id="batch_id">

            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Payment Method <span style="color:red">*</span></label>
                            <select name="payment_method_id" id="payment_method_id" class="select2single form-control">
                                <option value="">Select Payment Method</option>
                                @foreach ($payment_methods as $payment_method)
                                    <option value="{{ $payment_method->id }}"> {{ $payment_method->name }} </option>
                                @endforeach
                            </select>
                            <span class="text-danger" role="alert"></span>
                        </div>
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


    <div id="overlay" class=""></div>
  </div>