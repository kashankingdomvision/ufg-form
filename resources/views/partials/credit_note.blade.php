<div class="modal fade" id="credit_note_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('bookings.credit-note') }}"  method="POST"  id="create_credit_note">
                @csrf 
                <div class="modal-header">
                    <h4 class="modal-title">Credit Note Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <section class="credit-note-section">
                        <div class="credit-note-row else-here row-cols-lg-7 g-0 g-lg-2">
                            <input type="hidden" name="booking_detail_id" class="booking_detail_id">
                            <input type="hidden" name="total_deposit_amount" class="total_deposit_amount">

                            <div class="form-group">
                                <label class="depositeLabel">Credit Note Amount <span style="color:red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text supplier-currency-code">{{ ($booking_detail->getSupplierCurrency && $booking_detail->getSupplierCurrency->count()) ? $booking_detail->getSupplierCurrency->code : '' }}</span>
                                    </div>
                                    <input type="number" value="0.00" name="credit_note_amount" id="credit_note_amount" data-name="credit_note_amount" class="form-control credit-note-amount hide-arrows" step="any">
                                </div>
                                <span class="text-danger" role="alert"></span>
                            </div>

                            <div class="form-group">
                                <label>Credit Note No. <span style="color:red">*</span></label>
                                <input type="text" value="" name="credit_note_no" data-name="credit_note_no" id="credit_note_no" class="form-control">
                                <span class="text-danger" role="alert"></span>
                            </div>

                            <div class="form-group">
                                <label>Credit Note Date <span style="color:red">*</span></label>
                                <input type="date" value="" name="credit_note_recieved_date" id="credit_note_recieved_date" data-name="credit_note_recieved_date"  class="form-control">
                                <span class="text-danger" role="alert"></span>
                            </div>

                            <div class="form-group">
                                <label>Credit Note Recieved By <span style="color:red">*</span></label>
                                <select  name="credit_note_recieved_by" id="credit_note_recieved_by" data-name="credit_note_recieved_by" class="form-control credit_note_recieved_by select2single" >
                                <option value="">Select User</option>
                                @foreach ($sale_persons as $person)
                                    <option  value="{{ $person->id }}">{{ $person->name }}</option>
                                @endforeach
                                </select>
                                <span class="text-danger" role="alert"></span>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary loader_icon" type="submit">
                      <span class="mr-2" role="status" aria-hidden="true"></span>
                      Submit
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
