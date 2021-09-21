
@php $val_ = (isset($key) && $key != null)? $key : 0; @endphp
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload And Select Image</h5>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <span class="input-group-btn">
            <button data-input="quote_{{ $val_ }}_image" data-preview="quote_{{ $val_ }}_holder" class="btn btn-primary fileManger">
              <i class="fa fa-picture-o"></i> Choose
            </button>
          </span>
          <input id="quote_{{ $val_ }}_image" class="form-control image" value="" data-name="image" type="text" name="quote[{{ $val_ }}][image]">
        </div>
          <div class="previewId m-3" id="quote_{{ $val_ }}_holder" ><img src="{{ (isset($q_detail['image']) && $q_detail['image'] != null)? $q_detail['image'] : NULL }}" class="img-fluid" /></div>  
          <div class="input-group mt-2">
            <div class="form-group">
              <label>Service Details</label>
             
                <textarea name="quote[{{ $val_ }}][service_details]" data-name="service_details" id="quote_{{ $val_ }}_service_details" class="form-control service-details summernote " rows="2" placeholder="Enter Service Details">{!! (isset($q_detail['service_details']) && $q_detail['service_details'] != null)? $q_detail['service_details'] : NULL !!}</textarea>
             </div>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary QuotemediaModalClose">Close</button>
        <button type="button" class="btn btn-primary"   data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
