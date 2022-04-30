
<div class="modal fade" id="store_holiday_types_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Assign Brand To Holiday Types</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('store.holiday.types') }}" method="POST" id="store_holiday_types_modal_form">
                <div class="modal-body">
                    
                </div>

                <div class="modal-footer justify-content-right">
                    <button type="submit" class="btn btn-success">
                        <span class=""></span>
                        &nbsp;Submit&nbsp;
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
