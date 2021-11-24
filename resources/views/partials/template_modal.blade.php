<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Template Modal</h4>
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
            <div>
              <label class="radio-inline">
                <input type="radio" name="privacy_status" class="privacy-status" value="1"> Public

                &nbsp;&nbsp;&nbsp;&nbsp;
              </label>
              <label class="radio-inline">
                <input type="radio" name="privacy_status" class="privacy-status" value="0"> Private
              </label>
            </div>
          </div>
          
        </div>

        <div class="modal-footer justify-content-right">
          <button class="btn btn-primary" type="button" id="submit_template">
            <span class="mr-2 " role="status" aria-hidden="true"></span>
            Save Template
          </button>
        </div>

      </div>
    </div>


    <div id="overlay" class=""></div>
  </div>