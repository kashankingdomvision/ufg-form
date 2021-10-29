<div class="modal fade insert-quick-text-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('add.product.with.supplier.sync') }}"  method="POST"  id="form_add_product">
                @csrf 
                <div class="modal-header">
                    <h4 class="modal-title">Insert Quick Comment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row" style="max-height: 500px; overflow-y: auto;">

                      @if($preset_comments && $preset_comments->count())
                        <form action="">
                          @foreach ($preset_comments as $key => $preset_comment)
                            <div class="col-sm-4">
                              <div class="form-group">
                                <div>
                                  <label class="radio-inline mr-1">
                                    <input type="radio" name="comment" value="{{ $preset_comment->comment }}" class="quick-comment">
                                    <span>&nbsp; {{ $preset_comment->comment }} </span>
                                  </label>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </form>
                      @else
                        No record found.
                      @endif

                    </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="insert_quick_text_confirm_btn">OK</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel & Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
