@php $val_ = (isset($key) && $key != null)? $key : 0; @endphp
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Stored Text</h5>    
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Select Stored Text</label>
                <select name="quote[{{ $val_ }}][stored_text][select]" data-name="select" class="form-control selectStoredText">
                    <option selected value="" >Select Stored Text</option>
                    @foreach ($storetexts as $text)
                        <option value="{{ $text->slug }}" >{{ $text->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
              <label>Stored Text</label>
                <textarea name="quote[{{ $val_ }}][stored_text][text]" data-name="text" id="quote_{{ $val_ }}_stored_text" class="form-control stored-texts summernote " rows="2" placeholder="Enter Stored Text">{{ isset($q_detail->stored_text) && !empty($q_detail->stored_text) ? $q_detail->stored_text : '' }}</textarea>
            </div>
            <div class="form-group">
              <label>Date</label>
              <input placeholder="DD/MM/YYYY" value="{{ isset($q_detail->action_date) && !empty($q_detail->action_date) ? $q_detail->action_date : '' }}" type="text" name="quote[{{ $val_ }}][stored_text][date]" data-name="stored_text_date" id="quote_{{ $val_ }}_stored_text_date" class="form-control stored-text-date datepicker StoredTextDate" autocomplete="off">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-base QuotemediaModalClose">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
        </div>
    </div>
</div>