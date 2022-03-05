<div class="modal fade" id="store_harbour_modal" tabindex="-1" role="dialog" aria-labelledby="group-quote-modal-lable" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Harbours, Train and Points of Interest</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form method="POST" id="store_harbour_modal_form" action="{{ route('response.harbours.store') }}">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="model_name" value="" class="form-control">
                    <input type="hidden" name="category_id" value="" class="form-control">
                    <input type="hidden" name="detail_id"   value="" class="form-control">

                    <div class="form-group">
                        <label>Port ID <span style="color:red">*</span></label>
                        <input type="text" name="port_id" id="port_id" class="form-control" placeholder="Port ID">
                        <span class="text-danger" role="alert"></span>
                    </div>
    
                    <div class="form-group">
                        <label>Harbours, Train and Points of Interest Name <span style="color:red">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Harbours, Train and Points of Interest Name">
                        <span class="text-danger" role="alert"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <span class=""></span>
                        &nbsp;Submit&nbsp;
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>