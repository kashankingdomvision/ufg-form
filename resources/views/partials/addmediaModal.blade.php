
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload And Select Image</h5>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <span class="input-group-btn">
            <a data-input="quote_0_image" data-preview="quote_0_holder" class="btn btn-primary fileManger">
              <i class="fa fa-picture-o"></i> Choose
            </a>
          </span>
          <input id="quote_0_image" class="form-control image" value="" data-name="image" type="text" name="quote[0][image]">
        </div>
          <div class="previewId m-3" id="quote_0_holder" ></div>  
          <div class="input-group mt-2">
            <div class="form-group">
              <label>Service Details</label>
              <textarea name="quote[0][service_details]" data-name="service_details" id="quote_0_service_details" class="form-control service-details summernote " rows="2" placeholder="Enter Service Details"></textarea>
            </div>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary QuotemediaModalClose">Close</button>
        <button type="button" class="btn btn-primary"   data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
