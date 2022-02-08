<div class="modal fade insert-quick-text-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Insert Quick Comment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row" style="max-height: 500px; overflow-y: auto;">
          @if($preset_comments && $preset_comments->count())
            @foreach ($preset_comments as $key => $preset_comment)
              <div class="col-md-4">
                <div class="form-group">
                  <div>
                    <input type="radio" name="comment" value="{{ $preset_comment->comment }}" id="quick_comment_{{$key}}" class="quick-comment">
                    <label class="radio-inline mr-1" for="quick_comment_{{$key}}">{{ $preset_comment->comment }}</label>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            No record found.
          @endif
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="insert_quick_text_confirm_btn">OK, Add It</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel & Close</button>
      </div>
    </div>
  </div>
</div>
