<div class="modal fade" id="new_service_modal_below">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Service </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-2r">

                <input type="hidden" name="current_key" class="current-key">

                <div class="row">
                    @foreach ($categories as $category)
                    <div class="col-md-4">
                        <a type="button" data-id="{{ $category->id }}" data-name="{{ $category->name }}" class="btn btn-primary btn-md  mr-1 mb-2 w-11 {{ $module_class }} service-category-btn-color" >{{ $category->name }} </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>