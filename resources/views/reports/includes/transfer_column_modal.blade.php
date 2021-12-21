<div class="modal fade transfer-column-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('users.transfer.report.column') }}" class="transfer-column-form" method="POST">
                @csrf 
                <div class="modal-header">
                    <h4 class="modal-title">Action Fields</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="transfer_column_modal_body">
                    
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="transfer_column_save_btn">
                        <span class="mr-2 " role="status" aria-hidden="true"></span>
                        Save &nbsp;
                      </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
