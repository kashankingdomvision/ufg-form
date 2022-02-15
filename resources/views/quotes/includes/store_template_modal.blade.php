<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Template </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label>Template Name <span style="color:red">*</span></label>
            <input type="text" name="template_name" id="template_name" class="form-control" placeholder="Template name">
            <span class="text-danger" role="alert"></span>
          </div>

          <div class="form-group">
            <label>Privacy Status <span style="color:red">*</span></label>
            <div class="d-flex flex-row">

              <div class="custom-control custom-radio mr-1">
                <input type="radio" name="privacy_status" id="privacy_status_public" value="1" class="privacy-status custom-control-input custom-control-input-success custom-control-input-outline" checked>
                <label class="custom-control-label" for="privacy_status_public">Public</label>
              </div>

              <div class="custom-control custom-radio mr-1">
                <input type="radio" name="privacy_status" id="privacy_status_private" value="0" class="privacy-status custom-control-input custom-control-input-success custom-control-input-outline">
                <label class="custom-control-label" for="privacy_status_private">Private</label>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer justify-content-right">
          <button class="btn btn-primary btn-sm" type="button" id="submit_template">
            <span class="mr-2 " role="status" aria-hidden="true"></span>
            Save Template
          </button>

          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>


    <div id="overlay" class=""></div>
  </div>